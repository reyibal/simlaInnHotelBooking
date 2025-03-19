<div class="container-fluid bg-white mt-5">
  <div class="row">
      <div class="col-lg-4 p-4">
        <h3 class="h-font fw-bold fs-3 mb-2"><?php echo $settings_r['site_title'] ?></h3>
        <p>
          <?php echo $settings_r['site_about'] ?>
        </p>
      </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Links</h5>
      <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
      <a href="rooms.php" class="d-inline-block mb-2 text-dark text-decoration-none">Rooms</a><br>
      <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a><br>
      <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact Us</a><br>
      <a href="about.php" class="d-inline-block mb-2 text-dark text-decoration-none">About</a>
    </div>
    <div class="col-lg-4 p-4">
      <h5 class="mb-3">Follow Us</h5>
      <?php 
        if($contact_r['twitter']!=''){
          echo<<<data
            <a href="$contact_r[twitter]" class="d-inline-block text-dark text-decoration-none mb-2"> 
              <i class="bi bi-twitter-x me-1"></i> Twitter
            </a><br>
          data;
        }
      ?>
      <a href="<?php echo $contact_r['facebook']?>" class="d-inline-block text-dark text-decoration-none mb-2"> 
        <i class="bi bi-facebook me-1" ></i> Facebook
      </a><br>
      <a href="<?php echo $contact_r['instagram']?>" class="d-inline-block text-dark text-decoration-none"> 
        <i class="bi bi-instagram me-1"></i> Instagram
      </a><br>
    </div>
  </div>
</div>

<h6 class="text-center bg-dark text-white p-3 m-0">Designed and Developed by CR</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>

    function alert(type,msg,position='body')
    {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
        <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
            <strong class="me-3">${msg}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        `;

        if(position=='body'){
          document.body.append(element);
          element.classList.add('custom-alert'); 
        }
        else{
          document.getElementById(position).appendChild(element);
        }

        // Auto-remove alert after 5 seconds
        setTimeout(() => {
            element.remove();
        }, 5000);
    }

    function remAlert(){
      document.getElementsByClassName('alert')[0].remove();
    }
    
  function setActive()
  {
    let navbar = document.getElementById('nav-bar');
    let a_tags = navbar.getElementsByTagName('a');

    for(i=0; i<a_tags.length; i++)
    {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];

      if(document.location.href.indexOf(file_name) >= 0){
        a_tags[i].classList.add('active');
      }
    }
  }

  let register_form = document.getElementById('register-form');

  register_form.addEventListener('submit', (e)=>{
    e.preventDefault();

    let data = new FormData();
    data.append('name',register_form.elements['name'].value);
    data.append('email',register_form.elements['email'].value);
    data.append('phonenum',register_form.elements['phonenum'].value);
    data.append('address',register_form.elements['address'].value);
    data.append('pincode',register_form.elements['pincode'].value);
    data.append('dob',register_form.elements['dob'].value);
    data.append('pass',register_form.elements['pass'].value);
    data.append('cpass',register_form.elements['cpass'].value);
    data.append('profile',register_form.elements['profile'].files[0]);
    data.append('register','');

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register.php", true);

    xhr.onload = function (){
      if(this.responseText == 'pass_mismatch'){
        alert('error',"Password mismatch");
      }
      else if(this.responseText == 'email_already'){
        alert('error',"Email is already registered");
      }
      else if(this.responseText == 'phone_already'){
        alert('error',"Phone number is already registered");
      }
      else if(this.responseText == 'inv_img'){
        alert('error',"Only JPG, WEBP, PNG images are allowed");
      }
      else if(this.responseText == 'upd_failed'){
        alert('error',"Image upload failed");
      }
      else if(this.responseText == 'ins_failed'){
        alert('error',"Registration failed, server down");
      }
      else{
        alert('success',"Registration successful. Login to continue");
        register_form.reset();
      }
    }

    xhr.send(data);
  });

  
 setActive(); 
</script>