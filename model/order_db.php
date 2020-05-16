<?php

function get_baked_orders($db) {
    $query = 'SELECT pizza_orders.id,pizza_orders.user_id, shop_users.username FROM pizza_orders INNER JOIN shop_users ON pizza_orders.user_id = shop_users.id'
            . ' WHERE status="baked"';
    $statement = $db->prepare($query);
    $statement->execute();

    $baked_order_list = $statement->fetchAll();
    $statement->closeCursor();
    return $baked_order_list;
}

function get_preparing_orders($db) {
    $query = 'SELECT pizza_orders.id,pizza_orders.user_id, shop_users.username FROM pizza_orders INNER JOIN shop_users ON pizza_orders.user_id = shop_users.id'
            . ' WHERE status="preparing"';
    $statement = $db->prepare($query);
    $statement->execute();
    $baked_order_list = $statement->fetchAll();

    $statement->closeCursor();
    return $baked_order_list;
}

function make_oldest_pizza_baked($db) {
    $query = 'SELECT * from pizza_orders where status="preparing"'
            . ' ORDER BY id LIMIT 1';
    $statement = $db->prepare($query);
    $statement->execute();
    $oldest_pizza = $statement->fetch();
    $statement->closeCursor();
    $oldest_pizza_id = $oldest_pizza['id'];
    $query = 'UPDATE pizza_orders SET status="baked"'
            . ' WHERE id= :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $oldest_pizza_id);
    $statement->execute();
    $statement->closeCursor();
}

function get_ordereded_pizza($db, $user_id) {
    $query = '(SELECT * from pizza_orders WHERE status="preparing" and user_id= :user_id)'
            . ' UNION (SELECT * from pizza_orders WHERE status="baked" and user_id= :user_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $order_list = $statement->fetchAll();
    $statement->closeCursor();
    return $order_list;
}

function order_topping($db, $order_id, $topping_name) {
    $query = 'INSERT into order_topping'
            . '(order_id, topping)'
            . 'VALUES'
            . '(:order_id, :topping_name)';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping_name', $topping_name);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function add_order($db, $user_id, $size, $day, $status) {
    $query = 'INSERT into pizza_orders'
            . '(user_id, size, day, status)'
            . 'VALUES'
            . '(:id, :size, :day, :status)';
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $user_id);
    $statement->bindValue(':day', $day);
    $statement->bindValue(':size', $size);
    $statement->bindValue(':status', $status);
    $statement->execute();
    $statement->closeCursor();
}

function get_last_orderId($db) {
    $query = 'SELECT * from pizza_orders ORDER BY id DESC LIMIT 1';
    $statement = $db->prepare($query);
    $statement->execute();
    $order_id_row = $statement->fetch();
    $statement->closeCursor();
    return $order_id_row['id'];
}

function acknowledge($db,$user_id){
    $query = 'UPDATE pizza_orders SET status="finished"'
            . ' WHERE id= :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $user_id);
    $statement->execute();
    $statement->closeCursor();
}
function get_orderId($db, $user_id){
 
    $query = 'SELECT * from pizza_orders where user_id= :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $user=$statement->fetch();
    $statement->closeCursor();
    return $user['id'];
}