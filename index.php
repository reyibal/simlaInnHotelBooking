<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simla Inn - Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <?php require('inc/links.php')?>
    <style>
    .availability-form{
      margin-top: -50px;
      z-index: 2;
      position:relative;
    }

    @media screen and(max-width: 575px){
      .availability-form{
        margin-top: 25px;
        padding: 0 35px;
     }
    }
    </style>
</head>
<body class="bg-light">
  <?php require('inc/header.php')?>

  <!-- Carousel -->
  <div class="container-fluid px-lg-4 mt-4">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <?php 
          $res = selectAll('carousel');
          while($row = mysqli_fetch_assoc($res))
          {
              $path = CAROUSEL_IMG_PATH;
              echo <<<data
                <div class="swiper-slide">
                  <img src="$path$row[image]" class="w-100 d-block" />
                </div>      
              data;
          }

        ?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  
  <!-- Check Availability Form -->
  <div class="container availability-form">
    <div class="row">
      <div class="col-lg-12 bg-white shadow p-4 rounded">
        <h5 class="mb-4">Check Booking Availability</h5>
        <form>
          <div class="row align-items-end">
            <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check-In </label>
            <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Check-Out </label>
            <input type="date" class="form-control shadow-none">
            </div>
            <div class="col-lg-3 mb-3">
            <label class="form-label" style="font-weight: 500;">Adult </label>
            <select class="form-select shadow-none">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            </div>
            <div class="col-lg-2 mb-3">
            <label class="form-label" style="font-weight: 500;">Children </label>
            <select class="form-select shadow-none">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
            </div>
            <div class="col-lg-1 mb-lg-3 mt-2">
              <button type="submit" class="btn text-white shadow-none custom-bg">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Our Rooms -->

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Rooms</h2>
  <div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/rooms/1.jpg" class="card-img-top" alt="room-1">
        <div class="card-body">
          <h5>Simple Room Name</h5>
          <h6 class="mb-4">LKR 2,000 per night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Rooms
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Balcony
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Television
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              AC
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Humidifier
            </span>
          </div>
          <div class="guests mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/rooms/1.jpg" class="card-img-top" alt="room-2">
        <div class="card-body">
          <h5>Simple Room Name</h5>
          <h6 class="mb-4">LKR 2,000 per night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Rooms
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Balcony
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Television
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              AC
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Humidifier
            </span>
          </div>
          <div class="guests mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 my-3">
      <div class="card border-0 shadow" style="max-width: 350px; margin: auto;">
        <img src="images/rooms/1.jpg" class="card-img-top" alt="room-3">
        <div class="card-body">
          <h5>Simple Room Name</h5>
          <h6 class="mb-4">LKR 2,000 per night</h6>
          <div class="features mb-4">
            <h6 class="mb-1">Features</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Rooms
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              1 Bathroom
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              2 Balcony
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              3 Sofa
            </span>
          </div>
          <div class="facilities mb-4">
            <h6 class="mb-1">Facilities</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Wifi
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Television
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              AC
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              Humidifier
            </span>
          </div>
                    <div class="guests mb-4">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              5 Adults
            </span>
            <span class="badge rounded-pill text-bg-light mb-3 text-wrap">
              4 Children
            </span>
          </div>
          <div class="rating mb-4">
            <h6 class="mb-1">Rating</h6>
            <span class="badge rounded-pill bg-light">
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
              <i class="bi bi-star-fill text-warning"></i>
            </span>
          </div>
          <div class="d-flex justify-content-evenly mb-2">
            <a href="#" class="btn btn-sm text-white custom-bg shadow-none">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Details</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms >>></a>
    </div>
  </div>
  </div>

<!-- Our Facilities -->
<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Our Facilities</h2>
 <div class="container">
  <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/facilities/wifi.svg" width="80px">
      <h5 class="mt-3">Free Wifi</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/facilities/aircon.svg" width="80px">
      <h5 class="mt-3">Air Conditioning</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/facilities/television.svg" width="80px">
      <h5 class="mt-3">Television</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/facilities/parking.svg" width="80px">
      <h5 class="mt-3">Free Parking</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <img src="images/facilities/food.svg" width="80px">
      <h5 class="mt-3">Breakfast</h5>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Facilities >>></a>
    </div>
  </div>
 </div>

 <!--Testimonials-->
 <h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Testimonials</h2>

 <div class="container mt-5">
  <div class="swiper swiper-testimonials">
    <div class="swiper-wrapper mb-5">
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-items-center mb-3">
          <img src="images/facilities/aircon.svg" width="30px">
          <h6 class="m-0 ms-2">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
          sed do eiusmod tempor incididunt 
          ut labore et dolore magna aliqua
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
        <div class="profile d-flex align-items-center mb-3">
          <img src="images/facilities/aircon.svg" width="30px">
          <h6 class="m-0 ms-2">Random user1</h6>
        </div>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
          sed do eiusmod tempor incididunt 
          ut labore et dolore magna aliqua
        </p>
        <div class="rating">
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
          <i class="bi bi-star-fill text-warning"></i>
        </div>
      </div>
      <div class="swiper-slide bg-white p-4">
    <div class="profile d-flex align-items-center mb-3">
      <img src="images/facilities/aircon.svg" width="30px">
      <h6 class="m-0 ms-2">Random user1</h6>
    </div>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
      sed do eiusmod tempor incididunt 
      ut labore et dolore magna aliqua
    </p>
    <div class="rating">
      <i class="bi bi-star-fill text-warning"></i>
      <i class="bi bi-star-fill text-warning"></i>
      <i class="bi bi-star-fill text-warning"></i>
      <i class="bi bi-star-fill text-warning"></i>
    </div>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
  <div class="col-lg-12 text-center mt-5">
    <a href="#" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">Know More >>></a>
  </div>
 </div>

 <!--Reach Us-->

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold h-font">Reach Us</h2>
<div class="container">
  <div class="row">
    <div class="col lg-8 col-md-8 p-4 mb-lg-0 mb-3 bg-white">
      <iframe class="w-100 rounded" height="320px" src="<?php echo $contact_r['iframe']?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="col lg-4 col-md-4">
      <div class="bg-white p-4 rounded mb-4">
        <h5>Call Us</h5>
        <a href="tel: +<?php echo $contact_r['pn1']?>" class="d-inline-block mb-2 text-decoration-none text-dark">
          <i class="bi bi-telephone"></i> +<?php echo $contact_r['pn1']?>
        </a>
        <br>
        <?php
          if($contact_r['pn2']!=''){
            echo<<<data
              <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                <i class="bi bi-telephone"></i> +$contact_r[pn2]
              </a>
            data;
          }
        ?>

      </div>
      <div class="bg-white p-4 rounded mb-4">
        <h5>Follow Us</h5>
        <?php
          if($contact_r['twitter']!='');
          echo<<<data
          <a href="$contact_r[twitter]" class="d-inline-block mb-3" target="_blank">
            <span class="badge bg-light text-dark fs-6 p-2"> 
              <i class="bi bi-twitter-x"></i> Twitter
            </span>
          </a>
          <br>
          data;
        ?>
        <a href="<?php echo $contact_r['facebook']?>" class="d-inline-block mb-3" target="_blank">
          <span class="badge bg-light text-dark fs-6 p-2"> 
            <i class="bi bi-facebook"></i> Facebook
          </span>
        </a>
        <br>
        <a href="<?php echo $contact_r['instagram']?>" class="d-inline-block" target="_blank">
          <span class="badge bg-light text-dark fs-6 p-2"> 
            <i class="bi bi-instagram"></i> Instagram
          </span>
        </a>
      </div>
    </div>
  </div>
</div>

<?php require('inc/footer.php')?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
  <script>
    var swiper = new Swiper(".swiper-container", {
      spaceBetween: 30,
      effect: "fade",
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });

    var swiper = new Swiper(".swiper-testimonials", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      slidesPerView:"3",
      loop: true,
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: false,
      },
      pagination: {
        el: ".swiper-pagination",
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });

  </script>

</body>
</html>