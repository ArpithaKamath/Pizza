<?php include '../view/header.php'; ?>
<main>
    <section>
        
    </section>
    <section>
       <h1>User List</h1>
       
        <table>
            <tr>
                <th>User Name</th>
                <th>Room</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['username']; ?></td>
                <td><?php echo $user['room']; ?></td>
                <form action="index.php" name="delete" method="post">
                    <td>
                        <input type="hidden" name="user_id_value" value="<?php echo $user['id'] ?>">
                        <input type="hidden" name="action" value="delete"> 
                        <input type="submit" value="Delete" />
                    </td>
                </form>
            </tr>
            <?php endforeach; ?>
        </table>
        <p>
            <a href="?action=show_add_form">Add User</a>
        </p>
    </section>
</main>
<?php include '../view/footer.php'; 