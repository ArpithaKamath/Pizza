<?php
// the try/catch for these actions is in the caller
function add_topping($db, $topping_name, $is_meat)  
{
// TODO: add code
    $query = 'INSERT into menu_toppings'
            . '(topping, is_meat)'
            . 'VALUES'
            . '(:topping_name, :is_meat)';
    $statement = $db->prepare($query);
    $statement->bindValue(':topping_name', $topping_name);
    $statement->bindValue(':is_meat', $is_meat);
    $statement->execute();
    $statement->closeCursor();
    
}

function get_toppings($db) {
    $query = 'SELECT * FROM menu_toppings';
    $statement = $db->prepare($query);
    $statement->execute();
    $toppings = $statement->fetchAll();
    return $toppings;    
}
function delete_topping($db,$id){
    
    $query='delete from menu_toppings where id=:id';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id);
    
    $statement->execute();
    $statement->closeCursor();
    
}
