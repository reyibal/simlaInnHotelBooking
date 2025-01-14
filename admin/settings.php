<?php
    require ('inc/essentials.php');
    adminLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Settings</h3>

                <!--General Settings Section-->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title margin-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                        </div>
                        <h6 class="card-subtitle mb-1 fw-bold">Site Title</h6>
                        <p class="card-text" id="site_title"></p>
                        <h6 class="card-subtitle mb-1 fw-bold">About Us</h6>
                        <p class="card-text" id="site_about"></p>
                    </div>
                </div>

                <!--General Settings Modal--> 

                <div class="modal fade" id="general-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="general_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" name="site_title" id="site_title_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About Us</label>
                                        <textarea name="site_about" id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="resetForm()" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--Shutdown section-->
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title margin-0">Shutdown Settings</h5>
                            <div class="form-check form-switch">
                                <input onchange="upd_shutdown(this.checked ? 1 : 0)" class="form-check-input" type="checkbox" role="switch" id="shutdown-toggle">
                            </div>
                        </div>
                        <p class="card-text">
                            No customers will be allowed to book hotel room, when shutdown mode is turned on
                        </p>
                    </div>
                </div>

                <!--Contact Details Settings Section-->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title margin-0">Contacts Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Phone Numbers</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-telephone-fill"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-twitter-x"></i>
                                        <span id="twitter"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook"></i>
                                        <span id="facebook"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-instagram"></i>
                                        <span id="instagram"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1 fw-bold">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                 <!--Contact Settings Modal--> 

                 <div class="modal fade" id="contacts-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="contacts_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Contact Settings</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Address</label>
                                        <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Google Map Link</label>
                                        <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Phone Numbers (with country code)</label>
                                        <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                        <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email</label>
                                        <input type="email" name="email" id="email_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Twitter</label>
                                        <input type="text" name="twitter" id="twitter_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Facebook</label>
                                        <input type="text" name="facebook" id="facebook_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Instagram</label>
                                        <input type="text" name="instagram" id="instagram_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">iFrame Source</label>
                                        <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="resetForm()" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!--Management Team Section-->

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title margin-0">Management Team</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="row" id="team-data">

                        </div>

                    </div>
                </div>

                <!--Management Team Modal--> 

                <div class="modal fade" id="team-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form id="team_s_form">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Team Member</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="member_name" id="member_name_inp" class="form-control shadow-none" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="resetForm()" class="btn text-secondary shadow-none" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn custom-bg text-white shadow-none">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require ('inc/scripts.php'); ?>
    <script src="scripts/settings.js"></script>

</body>
</html>