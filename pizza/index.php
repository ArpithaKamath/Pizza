<?php

require('../model/database.php');
require('../model/order_db.php');
require('../model/size_db.php');
require('../model/topping_db.php');
require('../model/user_db.php');
require('../model/day_db.php');

$action = filter_input(INPUT_POST, 'action');

$user_id = null;
$in_progress_list = null;
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'order_list';
    }
}
if ($action == 'order_list') {
    try {
        $size_list = get_sizes($db);
        $topping_list = get_toppings($db);
        $user_list = get_user($db);
        $user_id = filter_input(INPUT_POST, 'user_id');

        include('student_welcome.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
    }
}


if ($action == 'user_form') {
    try {
        $size_list = get_sizes($db);
        $topping_list = get_toppings($db);
        $user_list = get_user($db);

        $user_id = filter_input(INPUT_POST, 'user_id');
        $username = get_user_name($db, $user_id);
        $in_progress_list = get_ordereded_pizza($db, $user_id);
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include('../errors/database_error.php');
        exit();
    }

    include('student_welcome.php');
    //header("Location: .");  
} else if ($action == 'show_order_form') {
    try {
        $user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
        $username = get_user_name($db, $user_id);
        $size_list = get_sizes($db);
        $user_list = get_user($db);
        $topping_list = get_toppings($db);
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include('../errors/database_error.php');
        exit();
    }


    include('order_pizza.php');
} else if ($action == 'submit_order') {
    try {
        $toppings_id = filter_input(INPUT_POST, 'topping', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        $userid = filter_input(INPUT_POST, 'username');
        $size = filter_input(INPUT_POST, 'size');
        $status = "preparing";
        $day = get_day($db);
        add_order($db, $userid, $size, $day, $status);
        $id = get_last_orderId($db);
        foreach ($toppings_id as $key => $value) {
            order_topping($db, $id, $value);
        }
        $size = filter_input(INPUT_POST, 'size');
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include('../errors/database_error.php');
        exit();
    }

    header("Location: .");
} else if ($action == 'acknowledge') {
    // $order_id = filter_input(INPUT_POST, 'order_id');
    try {
        $order_id = filter_input(INPUT_POST, 'order_id_value');
        acknowledge($db, $order_id);
        $size_list = get_sizes($db);
        $topping_list = get_toppings($db);
        $user_list = get_user($db);
        $in_progress_list = get_ordereded_pizza($db, $user_id);
        include('student_welcome.php');
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include('../errors/database_error.php');
        exit();
    }
}




