<?php

require('../model/database.php');
require('../model/initial.php');
require('../model/day_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    
}
try {
        $current_day = get_day($db);  // TODO: get day from DB
        $user_list = get_users_list($db, $current_day);
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include ('../errors/database_error.php');
        exit();
    }

if ($action == 'next_day') {
    try {
        update_day($db, $current_day);
        $current_day = get_day($db);  
        $user_list = get_users_list($db, $current_day);
    } catch (Exception $ex) {
        $error_message = $ex->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}


if ($action == 'initial_db') {
    try {
        initial_db($db);
        header("Location: .");
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include ('../errors/database_error.php');
        exit();
    }
}
include 'day_list.php';
