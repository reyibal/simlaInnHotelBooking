<?php 
require '../inc/db_config.php';
require '../inc/essentials.php';
adminLogin();



if(isset($_POST['add_room']))
{
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));
    $frm_data = filteration($_POST);

    $q1 = "INSERT INTO `rooms`(`name`, `area`, `price`, `quantity`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['area'], $frm_data['price'], $frm_data['quantity'], $frm_data['adult'], $frm_data['children'], $frm_data['description']];

    if(insert($q1, $values, 'siiiiis')){
        $flag = 1;

    }

    $rooms_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `rooms_facilities`(`rooms_id`, `facilities_id`) VALUES (?,?)";

    if($stmt = mysqli_prepare($con,$q2))
    {
        foreach($facilities as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $rooms_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('Query cannot be prepared - insert');
    }

    $q3 = "INSERT INTO `rooms_features`(`rooms_id`, `features_id`) VALUES (?,?)";

    if($stmt = mysqli_prepare($con,$q3))
    {
        foreach($features as $f){
            mysqli_stmt_bind_param($stmt, 'ii', $rooms_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $flag = 0;
        die('Query cannot be prepared - insert');
    }

    if($flag){
        echo 1;
    }
    else{
        echo 0;
    }
}

if(isset($_POST['get_all_rooms']))
{
    $res = selectAll('rooms');
    $i=1;

    $data = "";

    while($row = mysqli_fetch_assoc($res))
    {
        if($row['status']==1){
            $status = "<button onclick='toggle_status($row[id],0)' class='btn btn-dark btn-sm shadow-none'>Active</button>";
        }
        else{
            $status = "<button onclick='toggle_status($row[id],1)' class='btn btn-warning btn-sm shadow-none'>Inactive</button>";
        }
    
        $data.="
            <tr class='align-middle'>
                <td>$i</td>
                <td>$row[name]</td>
                <td>$row[area] sq. ft</td>
                <td>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Adult: $row[adult]
                    </span></br>
                    <span class='badge rounded-pill bg-light text-dark'>
                        Children: $row[children]
                    </span></br>
                </td>       
                <td>Rs. $row[price]</td>
                <td>$row[quantity]</td>
                <td>$status</td>
                <td>
                    <button type='button' onclick='edit_details($row[id])' class='btn btn-primary shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit-room'>
                        <i class='bi bi-pencil-square'></i>
                    </button>
                </td>
            </tr>
        ";
        $i++;
    }


    echo $data;
}

if(isset($_POST['get_room']))
{
    $frm_data = filteration($_POST);

    $res1 = select("SELECT * FROM `rooms` WHERE `id` = ?", [$frm_data['get_room']],'i');
    $res2 = select("SELECT * FROM `rooms_features` WHERE `rooms_id` = ?", [$frm_data['get_room']],'i');
    $res3 = select("SELECT * FROM `rooms_facilities` WHERE `rooms_id` = ?", [$frm_data['get_room']],'i');

    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];
    if(mysqli_num_rows($res2)>0){
        while($row = mysqli_fetch_assoc($res2)){
            array_push($features, $row['features_id']);
        }
    }

    if(mysqli_num_rows($res3)>0){
        while($row = mysqli_fetch_assoc($res3)){
            array_push($facilities, $row['facilities_id']);
        }
    }

    $data = ["roomdata" => $roomdata, "features" => $features, "facilities" => $facilities];

    $data = json_encode($data);

    echo $data;
}

if(isset($_POST['toggle_status']))
{
    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms` SET `status`=? WHERE `id` = ?";
    $v = [$frm_data['value'],$frm_data['toggle_status']];

    if(update($q,$v,'ii')){
        echo 1;
    }
    else{
        echo 0;
    }

}


?>