<?php include '../view/header.php'; ?>
<main>
    <h1>Add Topping</h1>
    <form action="index.php" method="post" id="add_user_form">
        <div >
        <input type="hidden" name="action" value="add_user">
        <div style="float: left; width: 200px;"><label>User Name:</label></div>
        <div style="float: left; width: 200px;"><input type="text" name="user_name" /></div>
        </div>
        <br>
        <div >
            <div style="float: left; width: 200px;"><label>Room :</label></div>
            <div style="float: left; width: 200px;"><input type="number" name="room" min="1" ></div>
        </div>
        <br>
        <label>&nbsp;</label>
        <input type="submit" value="Add User" />
        
        <br>
        <br>
    </form>
    <p>
        <a href="?action=list_users">View User List</a>
    </p>
</main>
<?php include '../view/footer.php'; ?>


