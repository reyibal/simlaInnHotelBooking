let general_data, contacts_data;

let general_s_form = document.getElementById('general_s_form');
let site_title_inp = document.getElementById('site_title_inp');
let site_about_inp = document.getElementById('site_about_inp');

let team_s_form = document.getElementById('team_s_form');
let member_name_inp = document.getElementById('member_name_inp');
let member_picture_inp = document.getElementById('member_picture_inp');

function get_general() {
    let site_title = document.getElementById('site_title');
    let site_about = document.getElementById('site_about');
    let shutdown_toggle = document.getElementById('shutdown-toggle');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        console.log("Response:", this.responseText);
        try {
            general_data = JSON.parse(this.responseText);

            if (general_data.error) {
                console.error("Error:", general_data.error);
            } else {
                site_title.innerText = general_data.site_title;
                site_about.innerText = general_data.site_about;

                site_title_inp.value = general_data.site_title;
                site_about_inp.value = general_data.site_about;

                if (general_data.shutdown == 0) {
                    shutdown_toggle.checked = false;
                    shutdown_toggle.value = 0;
                } else {
                    shutdown_toggle.checked = true;
                    shutdown_toggle.value = 1;
                }
            }

        } catch (e) {
            console.error("Failed to parse JSON:", e);
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send('get_general=true');
}

general_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    upd_general(site_title_inp.value, site_about_inp.value);
});

function upd_general(site_title_val, site_about_val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        console.log("Response:", this.responseText);

        try {
            let response_data = JSON.parse(this.responseText);

            if (response_data.error) {
                console.error("Error:", response_data.error);
            } else {
                general_data.site_title = site_title_val;
                general_data.site_about = site_about_val;

                document.getElementById('site_title').innerText = site_title_val;
                document.getElementById('site_about').innerText = site_about_val;

                let modal = bootstrap.Modal.getInstance(document.getElementById('general-s'));
                modal.hide();
            }

        } catch (e) {
            console.error("Failed to parse JSON:", e);
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send('site_title=' + encodeURIComponent(site_title_val) + '&site_about=' + encodeURIComponent(site_about_val) + '&upd_general=true');
}

function resetForm() {
    site_title_inp.value = general_data.site_title;
    site_about_inp.value = general_data.site_about;
}

function upd_shutdown(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        console.log("Response:", this.responseText);

        try {
            let response_data = JSON.parse(this.responseText);

            if (response_data.error) {
                console.error("Error:", response_data.error);
            } else {
                general_data.shutdown = val;
            }

        } catch (e) {
            console.error("Failed to parse JSON:", e);
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send('upd_shutdown=true&shutdown=' + val);
}

function get_contacts() {
    let contacts_p_id = ['address', 'gmap', 'pn1', 'pn2', 'email', 'twitter', 'facebook', 'instagram'];
    let iframe = document.getElementById('iframe');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        try {
            contacts_data = JSON.parse(this.responseText);
            contacts_data = Object.values(contacts_data);

            for (let i = 0; i < contacts_p_id.length; i++) {
                document.getElementById(contacts_p_id[i]).innerText = contacts_data[i + 1];
            }

            iframe.src = contacts_data[9];

            // Fill inputs for editing
            address_inp.value = contacts_data[1];
            gmap_inp.value = contacts_data[2];
            pn1_inp.value = contacts_data[3];
            pn2_inp.value = contacts_data[4];
            email_inp.value = contacts_data[5];
            twitter_inp.value = contacts_data[6];
            facebook_inp.value = contacts_data[7];
            instagram_inp.value = contacts_data[8];
            iframe_inp.value = contacts_data[9];

        } catch (e) {
            console.error("Failed to parse JSON:", e);
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send('get_contacts=true');
}

contacts_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    upd_contacts(address_inp.value, gmap_inp.value, pn1_inp.value, pn2_inp.value, email_inp.value, twitter_inp.value, facebook_inp.value, instagram_inp.value, iframe_inp.value);
});

function upd_contacts(address, gmap, pn1, pn2, email, twitter, facebook, instagram, iframe) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        try {
            let response_data = JSON.parse(this.responseText);

            if (response_data.error) {
                console.error("Error:", response_data.error);
            } else {
                get_contacts();  // Refresh contact details

                let modal = bootstrap.Modal.getInstance(document.getElementById('contacts-s'));
                modal.hide();
            }

        } catch (e) {
            console.error("Failed to parse JSON:", e);
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send('address=' + encodeURIComponent(address) + '&gmap=' + encodeURIComponent(gmap) + '&pn1=' + encodeURIComponent(pn1) + '&pn2=' + encodeURIComponent(pn2) + '&email=' + encodeURIComponent(email) + '&twitter=' + encodeURIComponent(twitter) + '&facebook=' + encodeURIComponent(facebook) + '&instagram=' + encodeURIComponent(instagram) + '&iframe=' + encodeURIComponent(iframe) + '&upd_contacts=true');
}

function resetContactForm() {
    get_contacts();  // Reset form to current values
}

team_s_form.addEventListener('submit',function(e){
    e.preventDefault();
    add_member();
});

function add_member()
{
    let data = new FormData();
    data.append('name',member_name_inp.value);
    data.append('picture',member_picture_inp.files[0]);
    data.append('add_member','');

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('team-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if(this.responseText == 'inv_img'){
            alert('error','Only JPG and PNG images are allowed');
        }
        else if(this.responseText == 'inv_size'){
            alert('error','Image should be less than 2MB');
        }
        else if(this.responseText == 'upd_failed'){
            alert('error','Image upload failed. Server Down!');
        }
        else{
            alert('success','New Member Added!');
            member_name_inp.value='';
            member_picture_inp.value='';
            get_members();
        }
    }

    xhr.onerror = function() {
        console.error("Request failed");
    };

    xhr.send(data);
}

function get_members()
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        document.getElementById('team-data').innerHTML = this.responseText;
    }

    xhr.send('get_members');
}

function rem_member(val)
{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/settings_crud.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
    if(this.responseText==1){
        alert('success','Member Removed!');
        get_members(); //when this function is called, the webpage data does not get refereshed - check!!!
    }
    else{
        alert('error','Server Down!');
    }
    }
    xhr.send('rem_member='+val); 
}

window.onload = function() {
    get_general();
    get_contacts();
    get_members();
}