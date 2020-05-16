<?php
// the try/catch for these actions is in the caller
function get_users_list($db,$current_day)  
{

    $query = 'SELECT pizza_orders.id,pizza_orders.user_id, shop_users.username,pizza_orders.status FROM pizza_orders'
            . ' INNER JOIN shop_users '
            . ' ON pizza_orders.user_id= shop_users.id'
            . ' WHERE pizza_orders.day = :current_day';
    $statement = $db->prepare($query);
    $statement->bindValue(':current_day', $current_day);
    $statement->execute();
    $user_list = $statement->fetchALL();
    $statement->closeCursor();
    return $user_list;
}
function update_day($db, $current_day){
    $query = 'UPDATE pizza_sys_tab SET current_day = :next_day'
            . ' WHERE current_day= :current_day';
    $statement = $db->prepare($query);
    $statement->bindValue(':next_day', $current_day+1);
    $statement->bindValue(':current_day', $current_day);
    $statement->execute();
    $statement->closeCursor();
    $query = 'UPDATE pizza_orders SET status="finished" WHERE 1';
    $statement = $db->prepare($query);
    $statement->execute();
    $statement->closeCursor();
}

function get_day($db) {
    $query = 'SELECT * FROM pizza_sys_tab';
    $statement = $db->prepare($query);
    $statement->execute();
    $day = $statement->fetch();
    $statement->closeCursor();
    $current_day = $day['current_day'];
    return $current_day;    
}

