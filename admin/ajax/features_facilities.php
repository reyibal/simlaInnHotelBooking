<?php 
require '../inc/db_config.php';
require '../inc/essentials.php';
adminLogin();

$response = [];

if(isset($_POST['add_feature'])) {
    $frm_data = filteration($_POST);

    $q = "INSERT INTO `features`(`name`) VALUES (?)";
    $values = [$frm_data['name']];
    $res = insert($q, $values, 's');
    $response['result'] = $res;
    echo json_encode($response);
    exit;
}

if(isset($_POST['get_features'])) 
{
    $res = selectAll('features');
    $i=1;

    while($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr>
                <td>$i</td>
                <td>$row[name]</td>
                <td>
                    <button onclick="remove_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </td>
            </tr>   
        data;
        $i++;
    }
    exit;
}

if(isset($_POST['remove_feature'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['remove_feature']];

    $check_q = select ('SELECT * FROM `rooms_features` WHERE `features_id`=?',[$frm_data['remove_feature']], 'i');

    if(mysqli_num_rows($check_q)==0){
        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    }
    else{
        echo 'room_added';
    }
    
}

if (isset($_POST['add_facility'])) {
    $frm_data = filteration($_POST);

    if (!isset($_FILES['icon'])) {
        echo json_encode(['result' => 0, 'error' => 'File not received']);
        exit;
    }

    $img_r = uploadSVGImage($_FILES['icon'], FACILITIES_FOLDER);

    if ($img_r == 'inv_img') {
        echo json_encode(['result' => 0, 'error' => 'Invalid image format']);
        exit;
    } else if ($img_r == 'inv_size') {
        echo json_encode(['result' => 0, 'error' => 'Image size exceeds limit']);
        exit;
    } else if ($img_r == 'upd_failed') {
        echo json_encode(['result' => 0, 'error' => 'Image upload failed']);
        exit;
    } else {
        $q = "INSERT INTO `facilities`(`name`, `icon`, `description`) VALUES (?,?,?)";
        $values = [$frm_data['name'], $img_r, $frm_data['description']];
        $res = insert($q, $values, 'sss');
        echo json_encode(['result' => $res]);
        exit;
    }
}

if(isset($_POST['get_facilities'])) 
{
    $res = selectAll('facilities');
    $i=1;
    $path = FACILITIES_IMG_PATH;

    while($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <tr class='align-middle'>
                <td>$i</td>
                <td><img src="$path$row[icon]" width="100px"></td>
                <td>$row[name]</td>
                <td>$row[description]</td>
                <td>
                    <button onclick="remove_facility($row[id])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash3"></i> Delete
                    </button>
                </td>
            </tr>   
        data;
        $i++;
    }
    exit;
}

if(isset($_POST['remove_facility'])) { //getting incorrect alert message saying 'Server down
    $frm_data = filteration($_POST);
    $values = [$frm_data['remove_facility']];

    $check_q = select ('SELECT * FROM `rooms_facilities` WHERE `facilities_id`=?',[$frm_data['remove_facility']], 'i');

    if(mysqli_num_rows($check_q)==0)
    {
        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($pre_q, $values, 'i');
        $img = mysqli_fetch_assoc($res);

        if(deleteImage($img['icon'], FACILITIES_FOLDER)){
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $res = delete($q, $values, 'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }
    else{
        echo 'room_added';
    }

}


?>