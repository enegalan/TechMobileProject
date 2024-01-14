const cartItemCountDropdownElement = document.querySelector('i.fa-solid.fa-cart-shopping');
var cartItemCountDropdownContentValue = 0;

if (document.querySelector('#addToCart') !== null) {
    const addToCartButton = document.querySelector('#addToCart');
    addToCartButton.addEventListener('click', addToCart);
}

async function addToCart(event) {
    const cart = JSON.parse(localStorage.getItem('cart')) || {};

    const user_id = localStorage.getItem('user_id');
    if (!user_id) {
        console.log("User not logged in");
        return;
    }

    if (!cart.hasOwnProperty(user_id)) {
        cart[user_id] = [];
    }

    const main_content = document.querySelector('#contenidoprincipal');
    const product_id = main_content.dataset.productId;

    const amountInput = document.querySelector('#amountInput');
    const amount = parseInt(amountInput.value, 10);

    const image = document.querySelector('#image_' + product_id + "_1").src;

    const name = document.querySelector('.smartphone_main_title').innerHTML;

    const price = document.querySelector('.block_price__currency').innerHTML;
    const priceAsNumber = parseFloat(price);

    const userCart = cart[user_id];
    const existingProduct = userCart.find(item => item.product_id === product_id);

    if (existingProduct) {
        existingProduct.amount += amount;
        toast.push({
            title: amount > 1 ? amount + ' smartphones added to cart' : amount + ' smartphone added to cart',
            content: existingProduct.amount + ' ' + name,
            style: 'success',
            dismissAfter: '3s'
        });
    } else {
        userCart.push({
            'product_id': product_id,
            'name': name,
            'amount': amount,
            'price': priceAsNumber,
            'image': image
        });
        toast.push({
            title: amount > 1 ? amount + ' smartphones added to cart' : amount + ' smartphone added to cart',
            content: amount + ' ' + name,
            style: 'success',
            dismissAfter: '3s'
        });
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Update the user's cart data in the database
    await updateCartInDatabase(user_id, cart);

    updateCartDOM();
    updateCartItemCountDropdownElement();
    event.preventDefault();
}

async function updateCartInDatabase(user_id, cart) {
    const formData = new FormData();
    formData.append('user_id', user_id);
    formData.append('cart', JSON.stringify(cart));

    await fetch('./php/auth/update_cart.php', {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        
    })
    .catch(error => {
        toast.push({
            title: 'Error updating cart',
            style: 'error',
            dismissAfter: '3s'
        });
    });
}

function listCartProducts(){
    updateCartDOM()
}

function removeProductFromCart(product_id) {
    const user_id = localStorage.getItem('user_id');
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    
    if (cart.hasOwnProperty(user_id)) {
        const userCart = cart[user_id];
        // Find the index of the item with the matching product_id
        let index = -1;
        let amount = 0;
        for (let i = 0; i < userCart.length; i++) {
            if (userCart[i].product_id == product_id) {
                index = i;
                amount = userCart[i].amount;
                break;
            }
        }

        if (index !== -1) {
            // Remove the item from the user's cart array
            userCart.splice(index, 1);

            // Update the localStorage with the updated cart array
            localStorage.setItem('cart', JSON.stringify(cart));

            // Update the cartItemCountDropdownContentValue
            cartItemCountDropdownContentValue -= amount;

            // Rebuild the cart representation and update the DOM
            updateCartDOM();

            // Update the cart item count in the dropdown element
            updateCartItemCountDropdownElement();

            setOrderSummary();

            localStorage.setItem('cartAmount', cartItemCountDropdownContentValue);

            // Update the cart data in the database
            updateCartInDatabase(user_id, cart);
        }

        toast.push({
            title: 'Smartphone removed from cart',
            content: name + ' removed from cart.',
            style: 'success',
            dismissAfter: '3s'
        });
    }
}

function updateCartDOM() {
    var summaryCard = document.querySelector('.summary_card');
    var cart = JSON.parse(localStorage.getItem('cart')) || {};
    const user_id = localStorage.getItem('user_id');

    // Clear the summaryCard before rebuilding the cart items
    if (summaryCard !== null) {
        summaryCard.innerHTML = '';

        if (cart.hasOwnProperty(user_id)) {
            const userCart = cart[user_id];

            userCart.forEach(item => {
                const product_id = item.product_id;
                const amount = item.amount;
                const name = item.name;
                const image = item.image;
                let price = parseFloat(item.price); // Convert the price to a floating-point number
                price *= amount;
                price = price.toFixed(2);

                summaryCard.innerHTML += `
                    <div class="card_item">
                        <div class="product_img">
                            <img src="${image}" alt="" />
                        </div>
                        <div class="product_info">
                            <h1>${name}</h1>
                            <div class="close-btn" onclick="removeProductFromCart(${product_id})">
                                <i class="fa fa-close"></i>
                            </div>
                            <div class="product_rate_info">
                                <h1 class="product_price">${price}</h1>
                                <div class="cart_units">
                                    <span class="pqt">${amount}</span>
                                    <div class="pqt_plus_minus">
                                        <span onclick="removeUnitFromCart(${product_id})" class="pqt-minus">-</span>
                                        <span onclick="addUnitFromCart(${product_id})" class="pqt-plus">+</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        // When there are no products in the user's cart
        if (!cart.hasOwnProperty(user_id) || cart[user_id].length === 0) {
            summaryCard.innerHTML = `<div class="cart-no-results">Cart is empty</div>`;
            updateCartItemCountDropdownElement();
            localStorage.setItem('cartAmount', 0);
        }
    }
}

function updateCartItemCountDropdownElement() {
    const user_id = localStorage.getItem('user_id');
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    let cartAmount = 0;

    if (cart.hasOwnProperty(user_id)) {
        const userCart = cart[user_id];
        userCart.forEach(item => {
            cartAmount += item.amount; // Accumulate the amount of each item in the user's cart
        });
    }

    // Set the data attribute and style for the dropdown element
    cartItemCountDropdownElement.setAttribute('data-cart-value', cartAmount);
    cartItemCountDropdownElement.style.content = cartAmount;

    // Set the cart item count to localStorage
    localStorage.setItem('cartAmount', cartAmount);
}

function setOrderSummary() {
    const user_id = localStorage.getItem('user_id');
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    let totalAmount = 0;

    if (cart.hasOwnProperty(user_id)) {
        const userCart = cart[user_id];
        userCart.forEach(item => {
            const itemAmount = parseFloat(item.price) * item.amount;
            totalAmount += itemAmount;
        });
    }

    var orderSummaryElement = document.querySelector('.order_price h4');
    if (orderSummaryElement !== null) {
        orderSummaryElement.innerHTML = `${totalAmount.toFixed(2)} €`;

        var totalAmountElement = document.querySelector('.order_total h4');
        var orderServiceElement = document.querySelector('.order_service h4');
        var serviceCharge = 0; // Default value if the service charge is not found or invalid
        if (orderServiceElement !== null) {
            const serviceChargeValue = parseFloat(orderServiceElement.innerHTML);
            if (!isNaN(serviceChargeValue)) {
                serviceCharge = serviceChargeValue;
            }
        }
        var totalAmountWithService = totalAmount + serviceCharge;
        totalAmountElement.innerHTML = `${totalAmountWithService.toFixed(2)}€`;
    }
}

async function updateCartItem(product_id, amount) {
    const user_id = localStorage.getItem('user_id');
    const cart = JSON.parse(localStorage.getItem('cart')) || {};
    let cartItemCount = 0;

    if (cart.hasOwnProperty(user_id)) {
        const userCart = cart[user_id];
        let index = -1;
        let newAmount = 0;

        // Find the product in the user's cart
        for (let i = 0; i < userCart.length; i++) {
            if (userCart[i].product_id == product_id) {
                index = i;
                newAmount = userCart[i].amount + amount; // Modify the amount based on the parameter
                break;
            }
        }

        if (index !== -1) {
            // If the new amount is greater than 0, update the product amount
            if (newAmount > 0) {
                userCart[index].amount = newAmount;
                cartItemCount = newAmount;
            } else {
                // If the new amount is 0, remove the product from the user's cart
                userCart.splice(index, 1);
            }

            // Update the localStorage with the updated cart array
            localStorage.setItem('cart', JSON.stringify(cart));

            // Update the cartItemCountDropdownContentValue
            cartItemCount = userCart.reduce((total, item) => total + item.amount, 0);
            localStorage.setItem('cartAmount', cartItemCount);

            // Rebuild the cart representation and update the DOM
            updateCartDOM();

            // Update the cart item count in the dropdown element
            updateCartItemCountDropdownElement();

            // Update the order summary
            setOrderSummary();

            await updateCartInDatabase(user_id, cart)
        }
    }
}

function removeUnitFromCart(product_id) {
    updateCartItem(product_id, -1); // Reduce the amount by 1
    toast.push({
        title: 'Smartphone removed from cart',
        style: 'success',
        dismissAfter: '3s'
    });
}

function addUnitFromCart(product_id) {
    updateCartItem(product_id, 1); // Increase the amount by 1
    toast.push({
        title: 'Smartphone added to cart',
        style: 'success',
        dismissAfter: '3s'
    });
}

//Select a shopping address
var addresses = document.querySelectorAll('.my_addresses div');
var selected = null;
addresses.forEach(function (element) { 
    element.addEventListener('click', function () { 
        if(!element.classList.contains('selected')){
            element.classList.add('selected');
            if(selected !== null){
                selected.classList.remove('selected');
            }
            selected = element;
        }
    })
})

document.addEventListener("DOMContentLoaded", function (event) {
    updateCartDOM();
    updateCartItemCountDropdownElement();
    event.preventDefault();
});

listCartProducts();
setOrderSummary();