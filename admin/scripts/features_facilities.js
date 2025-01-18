let feature_s_form = document.getElementById('feature_s_form');
let facility_s_form = document.getElementById('facility_s_form');

feature_s_form.addEventListener('submit',function(e){
e.preventDefault();
add_feature();
});

function add_feature() 
{
let data = new FormData();
data.append('name', feature_s_form.elements['feature_name'].value);
data.append('add_feature', '');

let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);

xhr.onload = function () {
    try {
        let response = JSON.parse(this.responseText);

        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (response.result == 1) {
            alert('success', 'New Feature Added!');
            feature_s_form.elements['feature_name'].value = '';
            get_features();
        } else {
            alert('error', 'Error in Backend: ' + (response.error || 'Unknown error'));
        }
    } catch (e) {
        alert('error', 'Invalid response from server: ' + this.responseText);
    }
};

xhr.onerror = function () {
alert('error', 'Network error occurred while adding the feature.');
};

xhr.send(data);
}

function get_features()
{
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload = function() {
    document.getElementById('features-data').innerHTML = this.responseText;
}

xhr.send('get_features');
}

function remove_feature(val) 
{
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload = function () {
    console.log("Remove Feature Response: ", this.responseText);
    if (this.responseText == 1) {
        alert('success', 'Feature Removed!');
        get_features();
    } else if (this.responseText == 'room_added') {
        alert('error', 'Feature is already added to a room!');
    } else {
        alert('error', 'Server Down! Response: ' + this.responseText);
    }
};

xhr.send('remove_feature=' + val);
}


facility_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_facility();
});

function add_facility()
{
let data = new FormData();
data.append('name',facility_s_form.elements['facility_name'].value);
data.append('icon',facility_s_form.elements['facility_icon'].files[0]);
data.append('description',facility_s_form.elements['facility_description'].value);
data.append('add_facility','');

let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);

xhr.onload = function() {
    let response = JSON.parse(this.responseText);
    var myModal = document.getElementById('facility-s');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    if(this.responseText == 'inv_img'){
        alert('error','Only SVG images are allowed');
    }
    else if(this.responseText == 'inv_size'){
        alert('error','Image should be less than 1MB');
    }
    else if(this.responseText == 'upd_failed'){
        alert('error','Image upload failed. Server Down!');
    }
    else{
        alert('success','New Facility Added!');
        facility_s_form.reset();
        get_facilities();
    }
}
xhr.send(data);
}

function get_facilities()
{
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload = function() {
    document.getElementById('facilities-data').innerHTML = this.responseText;
}

xhr.send('get_facilities');
}

function remove_facility(val)
{
let xhr = new XMLHttpRequest();
xhr.open("POST", "ajax/features_facilities.php", true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onload = function () {
console.log("Remove Facility Response: ", this.responseText);
if (this.responseText == 1) {
    alert('success', 'Facility Removed!');
    get_facilities();
} else if(this.responseText == 'room_added'){
    alert('error', 'Facilitye is already added to a room!');
}
{
    alert('error', 'Server Down! Response: ' + this.responseText);
}
}
xhr.send('remove_facility='+val); 
}

window.onload = function() {
get_features();
get_facilities();
}   
