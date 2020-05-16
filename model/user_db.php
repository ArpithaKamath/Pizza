<?php
// the try/catch for these actions is in the caller
function add_user($db, $user_name, $room)  
{

    $query = 'INSERT into shop_users'
            . '(username, room)'
            . 'VALUES'
            . '(:user_name, :room)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_name', $user_name);
    $statement->bindValue(':room', $room);
    $statement->execute();
    $statement->closeCursor();
    
}

function get_user($db) {
    $query = 'SELECT * FROM shop_users';
    $statement = $db->prepare($query);
    $statement->execute();
    $users = $statement->fetchAll();
    return $users;    
}

function get_user_name($db,$user_id){
     $query = 'SELECT * from shop_users WHERE id = :user_id';
     $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    $statement->execute();
    $userDetails=$statement->fetch();
    $statement->closeCursor();
    $username=$userDetails['username'];
    return $username;
 }
 
  function delete_order_topping($db,$order_id){
    $query='delete from order_topping where order_id= :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    
    $statement->execute();
    $statement->closeCursor();
 }
 
 function delete_order($db,$user_id){
    $query='delete from pizza_orders where user_id= :user_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':user_id', $user_id);
    
    $statement->execute();
    $statement->closeCursor();
 }


 function delete_user($db,$id){
    
    $query='delete from shop_users where id=:id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    
    $statement->execute();
    $statement->closeCursor();
    
}



