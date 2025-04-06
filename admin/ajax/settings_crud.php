<?php 
require '../inc/db_config.php';
require '../inc/essentials.php';
adminLogin();

// Start output buffering to prevent any accidental output
ob_start();

$response = [];

// Handle get_general request
if (isset($_POST['get_general'])) {
    $q = "SELECT * FROM settings WHERE sr_no=?";
    $values = [1];
    $res = select($q, $values, "i");
    
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        if ($data) {
            $response = $data;
        } else {
            $response = ["error" => "No data found."];
        }
    } else {
        $response = ["error" => "Query failed."];
    }

    echo json_encode($response);
    exit;
}

// Handle upd_general request
if (isset($_POST['upd_general'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE settings SET site_title=?, site_about=? WHERE sr_no=?";
    $values = [$frm_data['site_title'], $frm_data['site_about'], 1];
    $res = update($q, $values, 'ssi');
    
    if ($res) {
        $response = ["success" => "Settings updated successfully."];
    } else {
        $response = ["error" => "Update failed."];
    }

    echo json_encode($response);
    exit;
}

//Handle upd_shutdown request
if (isset($_POST['upd_shutdown']) && isset($_POST['shutdown'])) 
{
    $shutdown = intval($_POST['shutdown']);
    
    $query = "UPDATE settings SET shutdown = ? WHERE sr_no = ?";
    $values = [$shutdown, 1];
    $res = update($query, $values, 'ii');
    
    echo $res;
    exit;
}
// if(isset($_POST['upd_shutdown']))
// {
//     $frm_data = ($_POST['upd_shutdown']==0) ? 1 : 0;

//     $q = "UPDATE settings SET shutdown = ? WHERE sr_no = ?";
//     $values = [$frm_data,1];
//     $res = update($q,$values,'ii');
//     echo $res;
// }

// Handle get_contacts request
if (isset($_POST['get_contacts'])) {
    $q = "SELECT * FROM contact_details WHERE sr_no=?";
    $values = [1];
    $res = select($q, $values, "i");
    
    if ($res) {
        $data = mysqli_fetch_assoc($res);
        if ($data) {
            $response = $data;
        } else {
            $response = ["error" => "No data found."];
        }
    } else {
        $response = ["error" => "Query failed."];
    }

    echo json_encode($response);
    exit;
}

// Handle upd_contacts request
if (isset($_POST['upd_contacts'])) {
    $frm_data = filteration($_POST);

    $q = "UPDATE contact_details SET 
            address=?, 
            gmap=?, 
            pn1=?, 
            pn2=?, 
            email=?, 
            twitter=?, 
            facebook=?, 
            instagram=?, 
            iframe=? 
          WHERE sr_no=?";
    $values = [
        $frm_data['address'], 
        $frm_data['gmap'], 
        $frm_data['pn1'], 
        $frm_data['pn2'], 
        $frm_data['email'], 
        $frm_data['twitter'], 
        $frm_data['facebook'], 
        $frm_data['instagram'], 
        $frm_data['iframe'], 
        1
    ];
    $res = update($q, $values, 'sssssssssi');
    
    if ($res) {
        $response = ["success" => "Contact details updated successfully."];
    } else {
        $response = ["error" => "Failed to update contact details."];
    }

    echo json_encode($response);
    exit;
}

    if(isset($_POST['add_member']))
    {
        $frm_data = filteration($_POST);

        $img_r = uploadImage($_FILES['picture'],ABOUT_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if ($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `team_details`(`name`, `picture`) VALUES (?,?)";
            $values = [$frm_data['name'],$img_r];
            $res = insert($q,$values,'ss');
            echo $res;
        }
    }

    if(isset($_POST['get_members']))
    {
        $res = selectAll('team_details');

        while($row = mysqli_fetch_assoc($res))
        {
            $path = ABOUT_IMG_PATH;
            echo <<<data
                <div class="col-md-2 mb-3">
                    <div class="card text-bg-dark">
                        <img src="$path$row[picture]" class="card-img">
                        <div class="card-img-overlay text-end">
                            <button onclick="rem_member($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                                <i class="bi bi-trash3"></i> Delete
                            </button>
                        </div>
                        <p class="card-text text-center px-3 py-2"><small>$row[name]</small></p>
                    </div>
                </div>            
            data;
        }
    }

    if(isset($_POST['rem_member']))
    {
        $frm_data = filteration($_POST);
        $values = [$frm_data['rem_member']];

        $pre_q = "SELECT * FROM `team_details` WHERE `sr_no`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['picture'], ABOUT_FOLDER)){
            $q = "DELETE FROM `team_details` WHERE `sr_no`=?";
            $res = delete($q, $values, 'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }
// If none of the above conditions are met, return an error
$response = ["error" => "Invalid request."];
echo json_encode($response);
exit;
