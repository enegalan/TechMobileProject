// Add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function hoverLink() {
  list.forEach((item) => {
    item.classList.remove("hovered");
  });
  this.classList.add("hovered");
}

function activeLink() {
  list.forEach((item) => {
    item.classList.remove('active');
  });
  console.log('activing link');
  this.classList.add('active');
}

list.forEach((item) => item.addEventListener("mouseover", hoverLink));
list.forEach((item) => item.addEventListener("click", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
  navigation.classList.toggle("active");
  main.classList.toggle("active");
};

// Menu redirections
const menu_redirections = ['dashboard', 'users', 'opinions', 'faqs', 'smartphones', 'orders'];

menu_redirections.forEach((redirection, index) => {
  var redirection_element = document.querySelector('.' + redirection);
  var redirectionA = document.querySelector('a[href="#' + redirection + '"]');

  // At first display the first redirection by default
  if (index === 0) {
    redirection_element.classList.add('selected');
  }

  redirectionA.addEventListener('click', function () {
    // Remove 'selected' class from all elements
    menu_redirections.forEach((redirection2) => {
      document.querySelector('.' + redirection2)?.classList.remove('selected');
    });

    // Add 'selected' class to the clicked element
    redirection_element.classList.add('selected');
  });
});

/*
  COMMON VIEW FUNCTIONS
*/

function showModal(link, modal) {
  link.addEventListener('click', function () {
    if (!modal.classList.contains('show')) {
      modal.classList.add('show');
    }
  });
}

function closeModal(link, modal) {
  link.addEventListener('click', function () {
    if (modal.classList.contains('show')) {
      modal.classList.remove('show');
    }
  });
}

function onFilterChange(filtersDomIdArray, dataTableBody) {
  filtersDomIdArray.forEach(filter => {
    filter.addEventListener("input", handleFilterChange);
  });
  async function handleFilterChange () {
    const formData = new FormData();
    var filters = {};
    filtersDomIdArray.forEach(filter => {
      filters[filter.id] = filter.value;
    });
    formData.set('filters', JSON.stringify(filters));
    // Remove all rows 
    while (dataTableBody.firstChild) dataTableBody.removeChild(dataTableBody.firstChild);
    try {
      const response = await fetch('php/admin/list_all_users.php', {
        method: 'POST',
        body: formData
      });
      if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
      }
      const newData = await response.text();
      dataTableBody.innerHTML = newData;
    } catch (error) {
      console.error('Error fetching or processing data:', error.message);
    }
  }
}

/* EACH MAIN VIEW FUNCTIONS */
/* USERS */
//Open the add User modal
var add_user_a = document.querySelector('#add_user_a');
var add_user_modal = document.querySelector('.add_user_modal');
showModal(add_user_a, add_user_modal);
//Close the add User modal
var add_user_close = document.querySelector('.add_user_close');
closeModal(add_user_close, add_user_modal);

//Close the edit User modal
var edit_user_modal = document.querySelector('.edit_user_modal');
var edit_user_close = document.querySelector('.edit_user_close');
edit_user_close.addEventListener('click',function () { 
  if (edit_user_modal.classList.contains('show')) {
    edit_user_modal.classList.remove('show');
  }
})
//Create User function
async function createUser(){
  var username = document.querySelector('#add_user_username').value;
  var password = document.querySelector('#add_user_password').value;
  var email = document.querySelector('#add_user_email').value;
  var name = document.querySelector('#add_user_name').value;
  var surname = document.querySelector('#add_user_surname').value;
  var birthdate = document.querySelector('#add_user_birthdate').value;
  var sex = document.querySelector('#add_user_sex option:checked').value;
  var about = document.querySelector('#add_user_about').value;
  var country = document.querySelector('#add_user_country').value;
  var province = document.querySelector('#add_user_province').value;
  var city = document.querySelector('#add_user_city').value;
  var zip = document.querySelector('#add_user_zip').value;
  var address1 = document.querySelector('#add_user_address1').value;
  var address2 = document.querySelector('#add_user_address2').value;
  var phone = document.querySelector('#add_user_phone').value;
  var website = document.querySelector('#add_user_website').value;
  var facebook = document.querySelector('#add_user_facebook').value;
  var twitter = document.querySelector('#add_user_twitter').value;
  var instagram = document.querySelector('#add_user_instagram').value;
  var github = document.querySelector('#add_user_github').value;

  var formData = new FormData();
  formData.append('username', username);
  formData.append('password', password);
  formData.append('email', email);
  formData.append('name', name);
  formData.append('surname', surname);
  formData.append('birthdate', birthdate);
  formData.append('sex', sex);
  formData.append('about', about);
  formData.append('country', country);
  formData.append('province', province);
  formData.append('city', city);
  formData.append('zip', zip);
  formData.append('address1', address1);
  formData.append('address2', address2);
  formData.append('phone', phone);
  formData.append('website', website);
  formData.append('facebook', facebook);
  formData.append('twitter', twitter);
  formData.append('instagram', instagram);
  formData.append('github', github);

  await fetch('./php/admin/createUser.php',{
    method: "POST",
    body: formData
  }).then(res => res.text())
  .then(data => {
    console.log(data);
  })
}

//Edit User modal function
async function editUser(user_id) {
  var formData = new FormData();
  formData.append('user_id',user_id);
  //Open the Edit User modal
  if (!edit_user_modal.classList.contains('show')) {
    edit_user_modal.classList.add('show');
  }
  //Get the all inputs
  var user_id_input = document.querySelector('#edit_user_id');
  var username_input = document.querySelector('#edit_user_username');
  var email_input = document.querySelector('#edit_user_email');
  var name_input = document.querySelector('#edit_user_name');
  var surname_input = document.querySelector('#edit_user_surname');
  var birthdate_input = document.querySelector('#edit_user_birthdate');
  var sex_options = document.querySelectorAll('#edit_user_sex option');
  var about_input = document.querySelector('#edit_user_about');
  var country_input = document.querySelector('#edit_user_country');
  var province_input = document.querySelector('#edit_user_province');
  var city_input = document.querySelector('#edit_user_city');
  var zip_input = document.querySelector('#edit_user_zip');
  var address1_input = document.querySelector('#edit_user_address1');
  var address2_input = document.querySelector('#edit_user_address2');
  var phone_input = document.querySelector('#edit_user_phone');
  var website_input = document.querySelector('#edit_user_website');
  var facebook_input = document.querySelector('#edit_user_facebook');
  var twitter_input = document.querySelector('#edit_user_twitter');
  var instagram_input = document.querySelector('#edit_user_instagram');
  var github_input = document.querySelector('#edit_user_github');
  //Get all values of the user
  await fetch('./php/admin/getUser.php',{
    method: "POST",
    body: formData
  }).then(res => res.json())
  .then(data => {
    user_id_input.value = data[0]['id'];
    username_input.value = data[0]['username'];
    email_input.value = data[0]['email'];
    name_input.value = data[0]['name'];
    surname_input.value = data[0]['surname'];
    birthdate_input.value = data[0]['birthdate'];
    sex_options.forEach(function (option){
      if(option.value == data[0]['sex']){
        option.selected = true;
      }
    })
    about_input.value = data[0]['about'];
    country_input.value = data[0]['country'];
    province_input.value = data[0]['province'];
    city_input.value = data[0]['city'];
    zip_input.value = data[0]['zip'];
    address1_input.value = data[0]['address1'];
    address2_input.value = data[0]['address2'];
    phone_input.value = data[0]['phone'];
    website_input.value = data[0]['website'];
    facebook_input.value = data[0]['facebook'];
    twitter_input.value = data[0]['twitter'];
    instagram_input.value = data[0]['instagram'];
    github_input.value = data[0]['github'];
  })
}

//Update User function
async function updateUser(){
  var user_id = document.querySelector('#edit_user_id').value;
  var username = document.querySelector('#edit_user_username').value;
  var password = document.querySelector('#edit_user_password').value;
  var email = document.querySelector('#edit_user_email').value;
  var name = document.querySelector('#edit_user_name').value;
  var surname = document.querySelector('#edit_user_surname').value;
  var birthdate = document.querySelector('#edit_user_birthdate').value;
  var sex = document.querySelector('#edit_user_sex option:checked').value;
  var about = document.querySelector('#edit_user_about').value;
  var country = document.querySelector('#edit_user_country').value;
  var province = document.querySelector('#edit_user_province').value;
  var city = document.querySelector('#edit_user_city').value;
  var zip = document.querySelector('#edit_user_zip').value;
  var address1 = document.querySelector('#edit_user_address1').value;
  var address2 = document.querySelector('#edit_user_address2').value;
  var phone = document.querySelector('#edit_user_phone').value;
  var website = document.querySelector('#edit_user_website').value;
  var facebook = document.querySelector('#edit_user_facebook').value;
  var twitter = document.querySelector('#edit_user_twitter').value;
  var instagram = document.querySelector('#edit_user_instagram').value;
  var github = document.querySelector('#edit_user_github').value;

  var formData = new FormData();
  formData.append('user_id', user_id);
  formData.append('username', username);
  formData.append('password', password);
  formData.append('email', email);
  formData.append('name', name);
  formData.append('surname', surname);
  formData.append('birthdate', birthdate);
  formData.append('sex', sex);
  formData.append('about', about);
  formData.append('country', country);
  formData.append('province', province);
  formData.append('city', city);
  formData.append('zip', zip);
  formData.append('address1', address1);
  formData.append('address2', address2);
  formData.append('phone', phone);
  formData.append('website', website);
  formData.append('facebook', facebook);
  formData.append('twitter', twitter);
  formData.append('instagram', instagram);
  formData.append('github', github);

  await fetch('./php/admin/editUser.php',{
    method: "POST",
    body: formData
  }).then(res => res.text())
  .then(data => {
    console.log(data);
  })
}
//Filters
const userFilters = [
  document.querySelector('.usersFilters #search'),
  document.querySelector('.usersFilters #birthdate'),
  document.querySelector('.usersFilters #joining_date'),
  document.querySelector('.usersFilters #status')
];
const usersTableBody = document.querySelector('.users-table tbody');
onFilterChange(userFilters, usersTableBody)

/* OPINIONS */
/* FAQS */
//Open the add FAQ modal
var add_faq_a = document.querySelector('#add_faq_a');
var add_faq_modal = document.querySelector('.add_faq_modal');
showModal(add_faq_a, add_faq_modal);

//Close the add FAQ modal
var add_faq_close = document.querySelector('.add_faq_close');
closeModal(add_faq_close, add_faq_modal);

//Add FAQ
async function createFAQ() {
  var question = document.querySelector('#add_faq_question').value;
  var answer = document.querySelector('#add_faq_answer').value;
  
  //Append the data into a FormData and send the data to the createSmartphone.php file
  var formData = new FormData();
  formData.append('question', question);
  formData.append('answer', answer);

  await fetch('./php/admin/faqs/createFAQ.php', {
    method: "POST",
    body: formData
  }).then(res => res.text())
    .then(data => {
      console.log(data)
    }).finally(window.location.reload());
}

//Edit FAQ modal
async function editFAQ(faq_id) { 
  var edit_faq_modal = document.querySelector('.edit_faq_modal');
  //Add show class to the edit smartphone modal
  if(!edit_faq_modal.classList.contains('show')){
    edit_faq_modal.classList.add('show');
  }
  //Get the all the <input>
  var id_input = document.querySelector('#edit_faq_id');
  var question_input = document.querySelector('#edit_faq_question');
  var answer_input = document.querySelector('#edit_faq_answer');

  //Fetch the selected smartphone data
  var formData = new FormData();
  formData.append('id',faq_id);
  await fetch('./php/admin/faqs/getFAQ.php',{
    method: "POST",
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    var faq = data[0];
    //Set the data into the correspondient <input>
    id_input.value = faq['id'];
    question_input.value = faq['question'];
    answer_input.value = faq['answer'];
    
  });
}

//Update FAQ
async function updateFAQ() {
  var faq_id = document.querySelector('#edit_faq_id').value;
  var question = document.querySelector('#edit_faq_question').value;
  var answer = document.querySelector('#edit_faq_answer').value;
  
  //Append the data into a FormData and send the data to the createSmartphone.php file
  var formData = new FormData();
  formData.append('id', faq_id);
  formData.append('question', question);
  formData.append('answer', answer);

  await fetch('./php/admin/faqs/updateFAQ.php', {
    method: "POST",
    body: formData
  }).then(res => res.text())
    .then(data => {
      console.log(data)
    }).finally(window.location.reload());
}

async function deleteFAQ(faq_id) {
  
  //Append the data into a FormData and send the data to the createSmartphone.php file
  var formData = new FormData();
  formData.append('id', faq_id);

  await fetch('./php/admin/faqs/deleteFAQ.php', {
    method: "POST",
    body: formData
  }).then(res => res.text())
    .then(data => {
      console.log(data)
    }).finally(window.location.reload());
}

/* SMARTPHONES */
//Open the add Smartphone modal
var add_smartphone_a = document.querySelector('#add_smartphone_a');
var add_smartphone_modal = document.querySelector('.add_smartphone_modal');
showModal(add_smartphone_a, add_smartphone_modal);

//Close the add Smartphone modal
var add_smartphone_close = document.querySelector('.add_smartphone_close');
closeModal(add_smartphone_close, add_smartphone_modal);

//Load image count and colors
function loadColors1() {
  //Get the colors array
  var colors1 = document.querySelectorAll('.add_smartphone_color_options_div .color-options:checked');
  /*Load the Add images section*/
  //Get <ul>
  var imagesUl1 = document.querySelector('.add_smartphone_images ul');
  //Display the color's <li>
  imagesUl1.innerHTML = '';
  if (colors1.length > 0) {
    for (let i = 0; i < colors1.length; i++) {
      if (i === 0) {
        imagesUl1.innerHTML += `
        <li>
          <input type="radio" color="${colors1[i].value}" name="radioButton" class="radio_button" id="radioColor${i + 1}" checked>
          <label title="${colors1[i].value[0].toUpperCase() + colors1[i].value.slice(1)}" for="radioColor${i + 1}" class="block_goodColor__radio block_goodColor__${colors1[i].value}"></label>
        </li>
      `;
      } else {
        imagesUl1.innerHTML += `
        <li>
          <input type="radio" color="${colors1[i].value}" name="radioButton" class="radio_button" id="radioColor${i + 1}">
          <label title="${colors1[i].value[0].toUpperCase() + colors1[i].value.slice(1)}" for="radioColor${i + 1}" class="block_goodColor__radio block_goodColor__${colors1[i].value}"></label>
        </li>
      `;
      }
    }
  } else {
    imagesUl1.innerHTML = `
        <li>
          <input type="radio" color="black" name="radioButton" class="radio_button" id="radioColor1">
          <label title="Black" for="radioColor1" class="block_goodColor__radio block_goodColor__black"></label>
        </li>
      `;
  }
  //Get the <div class="colors-upload">
  var colorsUpload1 = document.querySelector('.add-smartphone-colors-upload');
  // Load the upload images section
  var colorOptions1 = document.querySelectorAll('.add_smartphone_color_options_div .color-options:checked');
  colorsUpload1.innerHTML = '';
  colorOptions1.forEach(function(color) {
    var colorValue = color.value;
    var isActive = color.classList.contains('active');
    
    colorsUpload1.innerHTML += `
      <div class="${colorValue} ${isActive ? 'active' : ''}">
        <input type="file" class="add_smartphone_upload_image" multiple color="${colorValue}" name="add_smartphone_add_images_${colorValue}">
      </div>
    `;
  });
  radioButtonsChecking1();
}
function loadColors2() {
  //Get the colors array
  var colors2 = document.querySelectorAll('.edit_smartphone_color_options_div .color-options:checked');
  /*Load the Add images section*/
  //Get <ul>
  var imagesUl2 = document.querySelector('.edit_smartphone_images ul');
  //Display the color's <li>
  imagesUl2.innerHTML = '';

  if (colors2.length > 0) {
    for (let i = 0; i < colors2.length; i++) {
      if (i === 0) {
        imagesUl2.innerHTML += `
        <li>
          <input type="radio" color="${colors2[i].value}" name="radioButton" class="radio_button" id="radioColor${i + 1}" checked>
          <label title="${colors2[i].value[0].toUpperCase() + colors2[i].value.slice(1)}" for="radioColor${i + 1}" class="block_goodColor__radio block_goodColor__${colors2[i].value}"></label>
        </li>
      `;
      } else {
        imagesUl2.innerHTML += `
        <li>
          <input type="radio" color="${colors2[i].value}" name="radioButton" class="radio_button" id="radioColor${i + 1}">
          <label title="${colors2[i].value[0].toUpperCase() + colors2[i].value.slice(1)}" for="radioColor${i + 1}" class="block_goodColor__radio block_goodColor__${colors2[i].value}"></label>
        </li>
      `;
      }
    }
  } else {
    imagesUl2.innerHTML = `
        <li>
          <input type="radio" color="black" name="radioButton" class="radio_button" id="radioColor1">
          <label title="Black" for="radioColor1" class="block_goodColor__radio block_goodColor__black"></label>
        </li>
      `;
  }
  //Get the <div class="colors-upload">
  var colorsUpload2 = document.querySelector('.edit-smartphone-colors-upload');
  // Load the upload images section
  var colorOptions2 = document.querySelectorAll('.edit_smartphone_color_options_div .color-options:checked');
  colorsUpload2.innerHTML = '';
  colorOptions2.forEach(function(color) {
    var colorValue = color.value;
    var isActive = color.classList.contains('active');
    
    colorsUpload2.innerHTML += `
      <div class="${colorValue} ${isActive ? 'active' : ''}">
        <input type="file" class="edit_smartphone_upload_image" multiple color="${colorValue}" name="add_smartphone_add_images_${colorValue}">
      </div>
    `;
  });
  radioButtonsChecking2();
}

async function createSmartphone() {
  var title = document.querySelector('#smartphone_add_title').value;
  var subtitle1 = document.querySelector('#smartphone_add_subtitle1').value;
  var subtitle2 = document.querySelector('#smartphone_add_subtitle2').value;
  var price = document.querySelector('#smartphone_add_price').value;
  var description = document.querySelector('#smartphone_add_description').value;
  var model = document.querySelector('#smartphone_add_model').value;
  var width = document.querySelector('#smartphone_add_width').value;
  var height = document.querySelector('#smartphone_add_height').value;
  var thick = document.querySelector('#smartphone_add_thick').value;
  var weight = document.querySelector('#smartphone_add_weight').value;
  var display = document.querySelector('#smartphone_add_display').value;
  var chip = document.querySelector('#smartphone_add_chip').value;
  var camera = document.querySelector('#smartphone_add_camera').value;
  var os = document.querySelector('#smartphone_add_os').value;
  var storageOptions = document.querySelectorAll('.add_smartphone_storage_options input:checked');
  var colorOptions = document.querySelectorAll('.add_smartphone_color_options_div .color-options:checked');
  var thumbnail = document.querySelector('#add-smartphone-upload-thumbnail').files[0];
  var image_count = document.querySelector('#add_smartphone_image_count').value;
  var imagesInputs = document.querySelectorAll('.add_smartphone_upload_image');
  var manufacturer_id = document.querySelector('#add_smartphone_manufacturer_id option:checked').value;
  var stock = document.querySelector('#add_smartphone_stock').value;

  //Elements to String conversion (Storage & Colors)
  //Storage
  var storage = "";
  for (let i = 0; i < storageOptions.length; i++) {
    if (i == storageOptions.length - 1) {
      storage += storageOptions[i].value;
    } else {
      storage += storageOptions[i].value + ",";
    }
  }
  //Colors
  var colors = "";
  for (let i = 0; i < colorOptions.length; i++) {
    if (i == colorOptions.length - 1) {
      colors += colorOptions[i].value;
    } else {
      colors += colorOptions[i].value + ",";
    }
  }
  //Append the data into a FormData and send the data to the createSmartphone.php file
  var formData = new FormData();
  formData.append('title', title);
  formData.append('subtitle1', subtitle1);
  formData.append('subtitle2', subtitle2);
  formData.append('price', price);
  formData.append('description', description);
  formData.append('model', model);
  formData.append('width', width);
  formData.append('height', height);
  formData.append('thick', thick);
  formData.append('weight', weight);
  formData.append('display', display);
  formData.append('chip', chip);
  formData.append('camera', camera);
  formData.append('os', os);
  formData.append('storage', storage);
  formData.append('colors', colors);
  formData.append('thumbnail', thumbnail);
  formData.append('image_count', image_count);

  imagesInputs.forEach(function (imagesInput) {
    var images = imagesInput.files;
    var color = imagesInput.getAttribute('color');

    if (images.length != image_count) {
        alert("Por favor, suba exactamente " + image_count + " imágenes para el color " + color);
    } else {
        for (var i = 0; i < images.length; i++) {
            var image = images[i];
            formData.append('images[]', image);
            formData.append('imagesColors[]', color);
        }
    }
});
  formData.append('manufacturer_id', manufacturer_id);
  formData.append('stock', stock);

  await fetch('./php/admin/createSmartphone.php', {
    method: "POST",
    body: formData
  }).then(res => res.text())
    .then(data => {
      console.log(data)
    }).finally(window.location.reload());
}
function radioButtonsChecking1() {
  // Select radio buttons and add change event listeners

  var radioButtons1 = document.querySelectorAll('.add_smartphone_images .radio_button');
  var lastChecked1 = radioButtons1[0];
  addActiveClassRadioColors1(lastChecked1.getAttribute("color"));
  radioButtons1.forEach(function (radioButton) {
    radioButton.addEventListener('click', function () {
      console.log("SELECTED COLORRRR: ", this.getAttribute("color"))
      if (this !== lastChecked1) {
        if (lastChecked1 !== null) {
          lastChecked1.classList.remove('checked');
          removeActiveRadioColor1(lastChecked1.getAttribute("color"));
        }
        this.classList.add('checked');
        lastChecked1 = this;
        // Retrieve the modal and show based on selected color
        var selectedColor = this.getAttribute("color");
        addActiveClassRadioColors1(selectedColor);
      }
    });
  });
  
}
function radioButtonsChecking2() {
  // Select radio buttons and add change event listeners
  var radioButtons2 = document.querySelectorAll('.edit_smartphone_images .radio_button');
  var lastChecked2 = radioButtons2[0];
  addActiveClassRadioColors2(lastChecked2.getAttribute("color"));
  radioButtons2.forEach(function (radioButton) {
    radioButton.addEventListener('click', function () {
      if (this !== lastChecked2) {
        if (lastChecked2 !== null) {
          lastChecked2.classList.remove('checked');
          removeActiveRadioColor2(lastChecked2.getAttribute("color"));
        }
        this.classList.add('checked');
        lastChecked2 = this;
        var selectedColor = this.getAttribute("color");
        addActiveClassRadioColors2(selectedColor);
      }
    });
  });
}

function addActiveClassRadioColors1(color) {
  if(!document.querySelector('.add-smartphone-colors-upload .' + color).classList.contains('active'))document.querySelector('.add-smartphone-colors-upload .' + color).classList.add('active');
}
function addActiveClassRadioColors2(color) {
  if(!document.querySelector('.edit-smartphone-colors-upload .' + color).classList.contains('active'))document.querySelector('.edit-smartphone-colors-upload .' + color).classList.add('active');
}

function removeActiveRadioColor1(color) {
  var colorElement1 = document.querySelector('.add-smartphone-colors-upload .' + color);
  colorElement1.classList.remove('active');
}
function removeActiveRadioColor2(color) {
  var colorElement2 = document.querySelector('.edit-smartphone-colors-upload .' + color);
  colorElement2.classList.remove('active');
}

//Remove Smartphone
async function removeSmartphone(smartphone_id) { 
  var formData = new FormData();
  formData.append('smartphone_id',smartphone_id)
  await fetch('./php/admin/removeSmartphone.php',{
    method: "POST",
    body: formData
  }).finally(window.location.reload());
}

/*Edit Smartphone*/
//Listeners
var edit_smartphone_close = document.querySelector('.edit_smartphone_close');
var edit_smartphone_modal = document.querySelector('.edit_smartphone_modal');
edit_smartphone_close.addEventListener('click',function () { 
  if(edit_smartphone_modal.classList.contains('show')){
    edit_smartphone_modal.classList.remove('show');
  }
})
//Edit button click function
async function editSmartphone(smartphone_id) { 
  //Add show class to the edit smartphone modal
  if(!edit_smartphone_modal.classList.contains('show')){
    edit_smartphone_modal.classList.add('show');
  }
  //Get the all the <input>
  var id_input = document.querySelector('#smartphone_edit_id');
  var title_input = document.querySelector('#smartphone_edit_title');
  var subtitle1_input = document.querySelector('#smartphone_edit_subtitle1');
  var subtitle2_input = document.querySelector('#smartphone_edit_subtitle2');
  var price_input = document.querySelector('#smartphone_edit_price');
  var description_input = document.querySelector('#smartphone_edit_description');
  var model_input = document.querySelector('#smartphone_edit_model');
  var width_input = document.querySelector('#smartphone_edit_width');
  var height_input = document.querySelector('#smartphone_edit_height');
  var thick_input = document.querySelector('#smartphone_edit_thick');
  var weight_input = document.querySelector('#smartphone_edit_weight');
  var display_input = document.querySelector('#smartphone_edit_display');
  var chip_input = document.querySelector('#smartphone_edit_chip');
  var camera_input = document.querySelector('#smartphone_edit_camera');
  var os_input = document.querySelector('#smartphone_edit_os');
  var storage_inputs = document.querySelectorAll('.edit_smartphone_storage_options input');
  var thumbnail_input = document.querySelector('#edit-smartphone-upload-thumbnail');
  var image_count_input = document.querySelector('#edit_smartphone_image_count');
  var manufacturer_id_input = document.querySelector('#edit_smartphone_manufacturer_id');
  var stock_input = document.querySelector('#edit_smartphone_stock');

  var colorsInputs = document.querySelectorAll('.edit_smartphone_color_options_div .color-options');
  var imagesInputs = document.querySelectorAll('.edit_smartphone_upload_image');

  //Fetch the selected smartphone data
  var formData = new FormData();
  formData.append('smartphone_id',smartphone_id);
  await fetch('./php/admin/getSmartphone.php',{
    method: "POST",
    body: formData
  })
  .then(res => res.json())
  .then(data => {
    var smartphone = data[0];
    //Set the data into the correspondient <input>
    id_input.value = smartphone['id'];
    title_input.value = smartphone['title'];
    subtitle1_input.value = smartphone['subtitle1'];
    subtitle2_input.value = smartphone['subtitle2'];
    price_input.value = smartphone['price'];
    description_input.value = smartphone['description'];
    model_input.value = smartphone['model'];
    width_input.value = smartphone['width'];
    height_input.value = smartphone['height'];
    thick_input.value = smartphone['thick'];
    weight_input.value = smartphone['weight'];
    display_input.value = smartphone['display'];
    chip_input.value = smartphone['chip'];
    camera_input.value = smartphone['camera'];
    os_input.value = smartphone['os'];
    image_count_input.value = smartphone['image_count'];
    manufacturer_id_input.value = smartphone['manufacturer_id'];
    stock_input.value = smartphone['stock'];
    //Set storages checked
    var storageArray = smartphone['storage'].split(",");
    for (let i = 0; i < storage_inputs.length; i++) {
      if (storageArray.includes(storage_inputs[i].value)) {
        storage_inputs[i].checked = true;
      } else {
        storage_inputs[i].checked = false;
      }
    }
    //Set colors checked
    var colorArray = smartphone['colors'].split(",");
    for(let i = 0; i < colorsInputs.length;i++){
      if(colorArray.includes(colorsInputs[i].value)){
        colorsInputs[i].checked = true;
      }else{
        colorsInputs[i].checked = false;
      }
    }

    loadColors2();
  });
}

//Update the smartphone
async function updateSmartphone() { 
  var id = document.querySelector('#smartphone_edit_id').value;
  var title = document.querySelector('#smartphone_edit_title').value;
  var subtitle1 = document.querySelector('#smartphone_edit_subtitle1').value;
  var subtitle2 = document.querySelector('#smartphone_edit_subtitle2').value;
  var price = document.querySelector('#smartphone_edit_price').value;
  var description = document.querySelector('#smartphone_edit_description').value;
  var model = document.querySelector('#smartphone_edit_model').value;
  var width = document.querySelector('#smartphone_edit_width').value;
  var height = document.querySelector('#smartphone_edit_height').value;
  var thick = document.querySelector('#smartphone_edit_thick').value;
  var weight = document.querySelector('#smartphone_edit_weight').value;
  var display = document.querySelector('#smartphone_edit_display').value;
  var chip = document.querySelector('#smartphone_edit_chip').value;
  var camera = document.querySelector('#smartphone_edit_camera').value;
  var os = document.querySelector('#smartphone_edit_os').value;
  var thumbnail = document.querySelector('#edit-smartphone-upload-thumbnail').files[0];
  var image_count = document.querySelector('#edit_smartphone_image_count').value;
  var manufacturer_id = document.querySelector('#edit_smartphone_manufacturer_id').value;
  var stock = document.querySelector('#edit_smartphone_stock').value;

  var storage_inputs = document.querySelectorAll('.edit_smartphone_storage_options input:checked');
  var colorsInputs = document.querySelectorAll('.edit_smartphone_color_options_div .color-options:checked');
  var imagesInputs = document.querySelectorAll('.edit_smartphone_upload_image');

  //Elements to String conversion (Storage & Colors)
  //Storage
  var storage = "";
  for (let i = 0; i < storage_inputs.length; i++) {
    if (i == storage_inputs.length - 1) {
      storage += storage_inputs[i].value;
    } else {
      storage += storage_inputs[i].value + ",";
    }
  }
  //Colors
  var colors = "";
  for (let i = 0; i < colorsInputs.length; i++) {
    if (i == colorsInputs.length - 1) {
      colors += colorsInputs[i].value;
    } else {
      colors += colorsInputs[i].value + ",";
    }
  }
  //Append the data into a FormData and send the data to the createSmartphone.php file
  var formData = new FormData();
  formData.append('id',id);
  formData.append('title', title);
  formData.append('subtitle1', subtitle1);
  formData.append('subtitle2', subtitle2);
  formData.append('price', price);
  formData.append('description', description);
  formData.append('model', model);
  formData.append('width', width);
  formData.append('height', height);
  formData.append('thick', thick);
  formData.append('weight', weight);
  formData.append('display', display);
  formData.append('chip', chip);
  formData.append('camera', camera);
  formData.append('os', os);
  formData.append('storage', storage);
  formData.append('colors', colors);
  if (thumbnail !== null) {
    formData.append('thumbnail', thumbnail);
  }
  formData.append('image_count', image_count);

  imagesInputs.forEach(function (imagesInput) {
    var images = imagesInput.files;
    var color = imagesInput.getAttribute('color');
  
    if (images.length > 0) {
      if (images.length != image_count) {
        alert("Por favor, suba exactamente " + image_count + " imágenes para el color " + color);
      } else {
        for (var i = 0; i < images.length; i++) {
          var image = images[i];
          formData.append('images[]', image);
          formData.append('imagesColors[]', color);
        }
      }
    }
  });
  formData.append('manufacturer_id', manufacturer_id);
  formData.append('stock', stock);

  await fetch('./php/admin/editSmartphone.php', {
    method: "POST",
    body: formData
  }).then(res => res.text())
    .then(data => {
      console.log(data)
    }).finally(window.location.reload());
}