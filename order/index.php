<?php

require('../model/database.php');
require('../model/order_db.php');
require('../model/user_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_orders';
    }
}

if ($action == 'list_orders') {
    try {
        $baked_order_list = get_baked_orders($db);
        $preparing_order_list= get_preparing_orders($db);
        include('order_list.php');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
    }
}
else if($action == 'change_status'){
    try{
        make_oldest_pizza_baked($db);
    } catch (Exception $ex) {
         $error_message = $ex->getMessage();
        include('../errors/database_error.php');
    }
    header("Location: .");
}

