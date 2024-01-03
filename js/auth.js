

async function signIn() {
    var auth_email = document.querySelector('#auth_email').value;
    var auth_password = document.querySelector('#auth_password').value;

    var formData = new FormData();
    formData.append('email', auth_email);
    formData.append('password', auth_password);

    await fetch('./php/auth/sign_in.php', {
        method: "POST",
        body: formData
    }).then(res => res.json())
    .then(async data => {
        if (data && data.length > 0) {
            const user_id = data[0]['id'];
            localStorage.setItem('user_id', user_id);
            //Fetch user's cart data from the database
            await fetch('./php/auth/fetch_cart.php?user_id='+user_id)
            .then(res => res.json()).catch(error => {
                console.error("Fetch error:", error);
            })
            .then(cartData => {
                const cart = cartData || {};
                localStorage.setItem('cart', JSON.stringify(cart));
                window.location.reload();

            });
        } else {
            console.log("Sign in failed");
        }
    });

}

async function signInAuto(auth_email, auth_password) {
    var formData = new FormData();
    formData.append('email', auth_email);
    formData.append('password', auth_password);

    await fetch('./php/auth/sign_in.php', {
        method: "POST",
        body: formData
    }).then(res => res.json())
    .then(async data => {
        if (data.length > 0) {
            const user_id = data[0]['id'];
            localStorage.setItem('user_id', user_id);
            //Fetch user's cart data from the database
            await fetch('./php/auth/fetch_cart.php?user_id='+user_id)
            .then(res => res.json())
            .then(cartData => {
                const cart = cartData || {};
                localStorage.setItem('cart', JSON.stringify(cart));
                //window.location.reload(); // It may be useful for the future
            });
        } else {
            console.log("Sign in failed");
        }
    });
}

async function signUp() { 
    //Get the input elements' values
    var sign_up_name = document.querySelector('#sign_up_name').value;
    var sign_up_surname = document.querySelector('#sign_up_surname').value;
    var sign_up_username = document.querySelector('#sign_up_username').value;
    var sign_up_email = document.querySelector('#sign_up_email').value;
    var sign_up_birthdate = document.querySelector('#sign_up_birthdate').value;
    var sign_up_password = document.querySelector('#sign_up_password').value;
    var sign_up_password2 = document.querySelector('#sign_up_password2').value;

    var is_verified = false;

    //Verify if the password is correctly repeated
    if(sign_up_password === sign_up_password2){
        is_verified = true;
    }

    if(is_verified){
        var formData = new FormData();
        formData.append('name',sign_up_name);
        formData.append('surname',sign_up_surname);
        formData.append('username',sign_up_username);
        formData.append('email',sign_up_email);
        formData.append('birthdate',sign_up_birthdate);
        formData.append('password',sign_up_password);
        await fetch('./php/auth/sign_up.php', {
            method: "POST",
            body: formData,
        }).then(res => res.text())
        .then(data => {
            console.log(data);
        })

        //Sign In automatically
        signInAuto(sign_up_email, sign_up_password);
        window.location.reload();
    }else{
        console.log("Incorrect repeated password!")
    }
    
}


async function signOut() { 
    await fetch('./php/auth/sign_out.php')
    .then(res => res.text())
    .then(data => {
        const user_id = localStorage.getItem('user_id'); // Retrieve the current user's ID
        if (user_id) {
            const cart = JSON.parse(localStorage.getItem('cart')) || {};
            delete cart[user_id]; // Remove the cart items for the current user
            localStorage.setItem('cart', JSON.stringify(cart)); // Update cart in local storage
        }

        localStorage.removeItem('user_id'); // Remove the user_id from local storage
        localStorage.setItem('cartAmount', 0); // Remove the cartAmount from local storage
        window.location.reload();
    })
}
