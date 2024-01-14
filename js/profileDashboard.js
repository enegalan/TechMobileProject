$(document).ready(function () {
    // Agregar evento de clic a los enlaces de la lista de pestañas
    $('#myTab a').on('click', function (e) {
        e.preventDefault();
        // Obtener el atributo 'href' del enlace clicado
        var target = $(this).attr('href');
        // Mostrar la pestaña correspondiente y cambiar las clases manualmente
        $('.tab-pane').removeClass('active show');
        $(target).addClass('active show');
        $('#myTab a').removeClass('active show');
        $(this).addClass('active show');
    });

    // Inicializar la tabla DataTable
    $('#my-orders-table').DataTable();
    $('#my-opinions-table').DataTable();

    // Hacer clic en una tarjeta del panel de la cuenta para cambiar de pestaña correspondiente en el banner
    $('.tg-tabs-content-wrapp .my-account-dashboard .card').click(function () {
        var target = $(this).data('target');
        // Mostrar la pestaña correspondiente y cambiar las clases manualmente
        $('.tab-pane').removeClass('active show');
        $(target).addClass('active show');
        $('#myTab a').removeClass('active show');
        $('#myTab a[href="' + target + '"]').addClass('active show');
    });
});
function validate() {

    if (!document.getElementById("inputpassword").value == document.getElementById("inputpassword2").value) toast.push({
        title: 'Passwords does not match',
        style: 'error',
        dismissAfter: '3s'
    });;
    return document.getElementById("inputpassword").value == document.getElementById("inputpassword2").value;
    return toast.push({
        title: 'Password field is required',
        style: 'error',
        dismissAfter: '3s'
    });
}
var add_addressElement = document.querySelector('.add_address');
var edit_addressElement = document.querySelector('.edit_address');
var addressElements = document.querySelectorAll('.address');
var new_addressElement = document.querySelector('.new_address');
var close_add_addressElement = document.querySelector('.close_add_address');
var close_edit_addressElement = document.querySelector('.close_edit_address');

close_edit_addressElement.addEventListener('click', function () {
    if (edit_addressElement.classList.contains('show')) {
        edit_addressElement.classList.remove('show');
    }
});
new_addressElement.addEventListener('click', function () {

    if (!add_addressElement.classList.contains('show')) {
        add_addressElement.classList.add('show');
    }
});

close_add_addressElement.addEventListener('click', function () {
    if (add_addressElement.classList.contains('show')) {
        add_addressElement.classList.remove('show');
    }
});
//Edit Gravatar
document.addEventListener('DOMContentLoaded', function () {
    var edit_gravatar = document.querySelector('.edit-gravatar');
    var edit_gravatar_modal = document.querySelector('.edit-gravatar-modal');
    var edit_gravatar_modal_close = document.querySelector('.edit-gravatar-modal-close');

    edit_gravatar.addEventListener('click', function (event) {
        // Check if the click target is either the edit_gravatar icon or the modal itself
        if (event.target === edit_gravatar.querySelector('.fa-edit')) {
            edit_gravatar_modal.classList.add('show');
        }
    });

    edit_gravatar_modal_close.addEventListener('click', function () {
        edit_gravatar_modal.classList.remove('show');
    });
});

//Insert the addresses into the profile.php HTML
addressElements.forEach(function (element) {
    element.addEventListener('click', async function () {
        if (!edit_addressElement.classList.contains('show')) {
            edit_addressElement.classList.add('show');
            var address_id = element.getAttribute('address-id');
            var formData = new FormData();
            formData.append('address_id', address_id);
            await fetch('./php/list_selected_address.php', {
                method: 'POST',
                body: formData
            }).then(res => res.json())
                .then(data => {
                    //Submit Address edit
                    var editing_address_infoDiv = document.querySelector('.editing_address_info');
                    editing_address_infoDiv.innerHTML = `
                                                        <div class="row">
                                                            <div>
                                                                <label for="name">Name</label>
                                                                <input type="text" name="name" id="name" value="${data[0]['name']}">
                                                            </div>
                                                            <div>
                                                                <label for="surname">Surname</label>
                                                                <input type="text" name="surname" id="surname" value="${data[0]['surname']}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div>
                                                                <label for="address1">Address 1</label>
                                                                <input type="text" name="address1" id="address1" value="${data[0]['address1']}">
                                                            </div>
                                                            <div>
                                                                <label for="address2">Address 2</label>
                                                                <input type="text" name="address2" id="address2" value="${data[0]['address2']}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div>
                                                                <label for="city">City</label>
                                                                <input type="text" name="city" id="city" value="${data[0]['city']}">
                                                            </div>
                                                            <div>
                                                                <label for="province">Province</label>
                                                                <input type="text" name="province" id="province" value="${data[0]['province']}">
                                                            </div>
                                                            <div>
                                                                <label for="zip">ZIP</label>
                                                                <input type="text" name="zip" id="zip" value="${data[0]['zip']}">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div>
                                                                <label for="country">Country</label>
                                                                <input type="text" name="country" id="country" value="${data[0]['country']}">
                                                            </div>
                                                            <div>
                                                                <label for="phone">Phone</label>
                                                                <input type="text" name="phone" id="phone" value="${data[0]['phone']}">
                                                            </div>
                                                        </div>
                                                        `;
                    if (data[0]['default'] == 1) {
                        editing_address_infoDiv.innerHTML += `
                            <div class="row">
                                <div>
                                    <label for="default">Change to default address</label>
                                    <input type="checkbox" name="default" id="default${data[0]['id']}" checked>
                                </div>
                            </div>
                        `;
                    } else {
                        editing_address_infoDiv.innerHTML += `
                            <div class="row">
                                <div>
                                    <label for="default">Change to default address</label>
                                    <input type="checkbox" name="default" id="default${data[0]['id']}">
                                </div>
                            </div>
                        `;
                    }
                    editing_address_infoDiv.innerHTML += `<button type="submit" onclick="editSelectedAddress(${data[0]['id']})" class="btn btn-primary">Edit</button>`;
                    editing_address_infoDiv.innerHTML += `<button type="submit" style="margin-left:10px;" onclick="removeSelectedAddress(${data[0]['id']})" class="btn btn-primary">Remove</button>`;
                    //Add the selected address to a localStorage
                    localStorage.setItem('selected_address', JSON.stringify(data));
                });
        }
    });
});

async function editSelectedAddress(address_id) {
    var formData = new FormData();
    var selected_address = JSON.parse(localStorage.getItem('selected_address'));
    var defaultVal = document.querySelector('.editing_address_info .row input#default' + address_id).checked;

    if (defaultVal) {
        defaultVal = 1;
    } else {
        defaultVal = 0;
    }

    for (let i = 0; i < selected_address.length; i++) {
        if (selected_address[i]['default'] !== defaultVal) {
            selected_address[i]['default'] = defaultVal;
        }
    }

    // Convert the selected_address array to a JSON string
    const selected_addressJSON = JSON.stringify(selected_address);

    // Append the JSON string to the formData
    formData.append('selected_address', selected_addressJSON);

    await fetch('./php/edit_selected_address.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
        .then(data => {
            edit_addressElement.classList.remove('show');
            //Reload the window to show the new information
            window.location.reload();
        });
}

async function removeSelectedAddress(address_id) {
    var formData = new FormData();

    // Append the JSON string to the formData
    formData.append('address_id', address_id);

    await fetch('./php/remove_selected_address.php', {
        method: 'POST',
        body: formData
    }).then(response => response.text())
        .then(data => {
            edit_addressElement.classList.remove('show');
            //Reload the window to show the new information
            window.location.reload();
        });
}

//My Cards
let selectedCard = null;
var remove_card_a = document.querySelector('.remove_card_a');
//Remove Card
remove_card_a.addEventListener('click', async function () {
    var selected_card_id = localStorage.getItem('selected_card_id');
    var formData = new FormData();
    formData.append('card_id', selected_card_id);
    await fetch('./php/remove_card.php', {
        method: "POST",
        body: formData
    }).then(res => res.text())
        .then(data => {
            //Reload the window to remove the card from the HTML correctly
            window.location.reload();
        })
})
//Cancel edition Card
var cancel_card_btn = document.querySelector('.cancel_card_btn');
cancel_card_btn.addEventListener('click', function () {
    const cards = document.querySelectorAll('.account');
    cards.forEach(function (element) {
        element.classList.remove('selected')
        selectedCard = null;
        document.querySelector('.card_info_edit').innerHTML = "Select a card";
    });
    const card_options = document.querySelector('.card_options');
    card_options.classList.remove('show');
})

//Save edition Card
var save_card_btn = document.querySelector('.save_card_btn');
save_card_btn.addEventListener('click', async function () {
    var selected_card_id = localStorage.getItem('selected_card_id');
    var selected_card_name = document.querySelector('#card-name-' + selected_card_id).value;
    var selected_card_number = document.querySelector('#card-number-' + selected_card_id).value;
    var selected_card_cvv = document.querySelector('#card-cvv-' + selected_card_id).value;
    var selected_card_due_year = document.querySelector('#card-due-year-' + selected_card_id).value;
    var selected_card_due_month = document.querySelector('#card-due-month-' + selected_card_id).value;

    var formData = new FormData();
    formData.append('card_id', selected_card_id);
    formData.append('card_name', selected_card_name);
    formData.append('card_number', selected_card_number);
    formData.append('card_cvv', selected_card_cvv);
    formData.append('card_due_year', selected_card_due_year);
    formData.append('card_due_month', selected_card_due_month);
    fetch('./php/update_card.php', {
        method: "POST",
        body: formData
    }).then(res => res.text())
        .then(data => {
            //Reload to show the new information
            window.location.reload();
        });
})
//At first it must say Select a card
document.querySelector('.card_info_edit').innerHTML = "Select a card";

//Select a Card
function selectCard(card_id) {
    const card = document.querySelector('#card-' + card_id);
    const card_options = document.querySelector('.card_options');
    //Show card options
    card_options.classList.add('show');
    //If card is already selected, remove the class selected
    if (selectedCard) {
        selectedCard.classList.remove('selected');
        localStorage.removeItem('selected_card_id');
    }
    //If the selected card is different from the previous
    if (selectedCard !== card) {
        selectedCard = card;
        card.classList.add('selected');
        displaySelectedCardInfo(card_id);
        localStorage.setItem('selected_card_id', card_id);
    } else {
        selectedCard = null;
        document.querySelector('.card_info_edit').innerHTML = "Select a card";
        localStorage.removeItem('selected_card_id');
        //Remove the card options show class
        card_options.classList.remove('show');
    }
}

async function displaySelectedCardInfo(card_id) {
    var card_info_editElement = document.querySelector('.card_info_edit');
    var formData = new FormData();
    formData.append('card_id', card_id);
    await fetch('./php/list_selected_card_info.php', {
        method: "POST",
        body: formData
    }).then(res => res.json())
        .then(data => {
            //Due Year
            const selectedYear = new Date(data[0]['due_year']);
            const yearSelectOptions = generateYearSelectOptions(selectedYear, data[0]['id']);
            //Due Month
            const dueMonth = data[0]['due_month']; // Asumiendo que tienes data definido en algún lugar
            const monthOptions = generateMonthOptions(dueMonth, data[0]['id']);
            card_info_editElement.innerHTML = `
                    <div class="card_name">
                        <span><b>Card name</b></span>
                        <input type="text" minlength="5" maxlength="30" id="card-name-${data[0]['id']}" value="${data[0]['name']}">
                    </div>
                    <div class="card_number">
                        <span><b>Card number</b></span>
                        <input type="text" minlength="11" maxlength="19" oninput="formatCreditCardNumber(this)" id="card-number-${data[0]['id']}" value="${data[0]['number']}">
                    </div>
                    <div class="card_cvv">
                        <span><b>CVV</b></span>
                        <input minlength="3" maxlength="3" type="text" oninput="limitToNumbers(this)" id="card-cvv-${data[0]['id']}" value="${data[0]['cvv']}">
                    </div>
                    <div class="card_due_date">
                        <span><b>Card due date</b></span>
                        <div class="row">
                            <select id="card-due-month-${data[0]['id']}" name="due_month">
                                ${monthOptions}
                            </select>
                            ${yearSelectOptions}
                        </div>
                    </div>
                `;
        });
}
function generateYearSelectOptions(selectedYear, id) {
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const endYear = currentYear + 20;
    let options = "";
    for (let year = currentYear; year <= endYear; year++) {
        const selected = year === selectedYear.getFullYear() ? "selected" : "";
        options += `<option value='${year}' ${selected}>${year}</option>`;
    }
    const select = `<select id="card-due-year-${id}" name='year'>${options}</select>`;
    return select;
}
function generateMonthOptions(selectedMonth, id) {
    const months = [
        { value: "01", name: "01" },
        { value: "02", name: "02" },
        { value: "03", name: "03" },
        { value: "04", name: "04" },
        { value: "05", name: "05" },
        { value: "06", name: "06" },
        { value: "07", name: "07" },
        { value: "08", name: "08" },
        { value: "09", name: "09" },
        { value: "10", name: "10" },
        { value: "11", name: "11" },
        { value: "12", name: "12" }
    ];

    let options = "";

    for (const month of months) {
        const selected = month.value === selectedMonth ? "selected" : "";
        options += `<option value='${month.value}' ${selected}>${month.name}</option>`;
    }

    return options;
}
//Add a new card modal
var add_card_modal = document.querySelector('.add_card_modal');
var add_card = document.querySelector('#add_card');
var add_card_modal_close = document.querySelector('.add_card_modal_close');

add_card.addEventListener('click', function () {
    if (!add_card_modal.classList.contains('show')) {
        add_card_modal.classList.add('show');
    }
});

add_card_modal_close.addEventListener('click', function () {
    if (add_card_modal.classList.contains('show')) {
        add_card_modal.classList.remove('show');
    }
})

//Cada 4 digitos se crea un espacio en blanco obligatorio para escribir un credit_number
var card_number = document.querySelector('#card-number');
card_number.addEventListener('input', function () {
    formatCreditCardNumber(this);
});

function formatCreditCardNumber(input) {
    // Obtener el valor actual del input y eliminar espacios en blanco
    let value = input.value.replace(/\s/g, '');

    // Eliminar todos los caracteres no numéricos
    value = value.replace(/\D/g, '');

    // Dividir en grupos de cuatro caracteres
    let formattedValue = '';
    for (let i = 0; i < value.length; i += 4) {
        formattedValue += value.substr(i, 4) + ' ';
    }

    // Actualizar el valor en el input
    input.value = formattedValue.trim();
}

//Function to limit text inputs to numbers
function limitToNumbers(input) {
    input.value = input.value.replace(/\D/g, '').substr(0, 16);
}


const show_answer_replies_dom = document.querySelector('.show_answer_replies');
show_answer_replies_dom.classList.add('disabled');
// Open replies modal function
document.querySelectorAll('.viewReplies').forEach(element => {
    element.addEventListener('click', async (event) => {
        event.preventDefault();
        const opinion_id = event.target.getAttribute("data-id");
        const formData = new FormData();
        formData.append('id', opinion_id);

        await fetch('php/getOpinionReplies.php', {
            method: 'POST',
            body: formData,
        }).then(res => res.text())
            .then(data => {
                show_answer_replies_dom.innerHTML = data;

                show_answer_replies_dom.classList.remove('disabled');

                // Set each opinion rating stars width
                const opinion_stars = document.querySelectorAll('.opinion_stars');
                opinion_stars.forEach(opinion_star => {
                    const opinion_star_value = parseFloat(opinion_star.getAttribute('value'));
                    setRatingStars(opinion_star, opinion_star_value, 5);
                });

                function setRatingStars(element, avg_value, max_value) {
                    const max_width = 100; // with max value

                    var actual_width = (avg_value / max_value) * max_width;
                    actual_width = Math.min(max_width, actual_width);
                    element.style.width = actual_width + "%";
                }

                function setAllRepliesDisabled() {
                    document.querySelectorAll('.reply_opinion').forEach(element => {
                        !element.classList.contains('disabled') && element.classList.add('disabled')
                        element.classList.contains('active') && element.classList.remove('active');
                    });
                }

                // Open opinion answer reply
                document.querySelectorAll('.opinion_answer_reply').forEach(element => {
                    element.addEventListener("click", showAnswerReplyForm);
                })

                function showAnswerReplyForm(event) {
                    setAllRepliesDisabled();
                    document.querySelectorAll('.reply_answer_opinion').forEach(element => {
                        if (element.getAttribute('data-id') === event.target.getAttribute('data-id')) {
                            element.classList.contains('disabled') && element.classList.remove('disabled')
                            !element.classList.contains('active') && element.classList.add('active');
                        }
                    })
                }

                // Set all opinion replies disabled
                setAllAnswerRepliesDisabled();

                function setAllAnswerRepliesDisabled() {
                    setAllRepliesDisabled();
                    document.querySelectorAll('.reply_answer_opinion').forEach(element => {
                        !element.classList.contains('disabled') && element.classList.add('disabled')
                        element.classList.contains('active') && element.classList.remove('active');
                    });
                }

                document.querySelectorAll('.reply_cancel_button').forEach(element => {
                    element.addEventListener('click', setAllAnswerRepliesDisabled);
                })

                // Request the opinion answer reply
                document.querySelectorAll('.reply_answer_button').forEach(button => {
                    button.addEventListener('click', async (event) => {
                        var opinion_id = event.target.getAttribute('data-id');
                        var answer_id = event.target.getAttribute('answer-id');
                        var comment = document.querySelector('.reply_answer_opinion[data-id="' + answer_id + '"] .reply_textarea').value;
                        const formData = new FormData();
                        formData.append('opinion_id', opinion_id);
                        formData.append('comment', comment);

                        if (comment.length >= 15) {
                            await fetch('php/reply_opinion.php', {
                                method: 'POST',
                                body: formData,
                            }).then(res => res.text())
                                .then(data => {
                                    window.location.reload();
                                })
                        }
                    });
                });

            })
    })
});