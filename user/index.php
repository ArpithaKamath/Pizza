<?php

require('../model/database.php');
require('../model/user_db.php');
require('../model/order_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_users';
    }
}

if ($action == 'list_users') {
    try {
        $users = get_user($db);
        include('user_list.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
    }
} else if ($action == 'show_add_form') {
    include('user_add.php');
} else if ($action == 'add_user') {
    $user_name = filter_input(INPUT_POST, 'user_name');
    if ($user_name == NULL || $user_name == FALSE) {
        $error = "Invalid topping name";
        include('../errors/error.php');
    } else {
        $room = filter_input(INPUT_POST, 'room');
        if ($room == NULL || $room == FALSE) {
            $error = "Invalid room: " . $room;
            include('../errors/error.php');
            exit();
        }
        try {
            add_user($db, $user_name, $room);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();  // needed here to avoid redirection of next line
        }
        // Redirect back to index.php (see pp. 164-165)
        // (don't include index.php inside index.php)
        header("Location: .");
    }
}
else if($action=='delete'){
    try{
        $user_id = filter_input(INPUT_POST, 'user_id_value');
    $order_id=get_orderId($db, $user_id);
    delete_order_topping($db, $order_id);
    delete_order($db,$user_id);
    delete_user($db,$user_id);
    $users = get_user($db);
    include('user_list.php');
    } catch (Exception $ex) {
$error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();  // needed here to avoid redirection of next line
    }
    
    
}

