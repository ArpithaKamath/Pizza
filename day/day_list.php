<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Today is day <?php echo $current_day; ?></h1>
        
        <!-- for testability, please do not change these two buttons -->
        <form action="index.php" method="post">
            <input type="hidden" name="action" value="next_day">
            <input type="submit" value="Change to day <?php echo $current_day + 1; ?>" />
        </form>

        <form  action="index.php" method="post">
            <input type="hidden" name="action" value="initial_db">           
            <input type="submit" value="Initialize DB (making day = 1)" />
            <br>
        </form>      
        <br>
        <h2>Today's Orders</h2>
        <!-- TODO show list of today's orders -->
         <table>
            <tr>
                <th>Order Id</th>
                <th>User</th>
                <th>Status</th>
            </tr>
            <?php foreach ($user_list as $info) : ?>
            <tr>
                <td><?php echo $info['id']; ?></td>
                <td><?php echo $info['username']; ?></td>
                <td><?php echo $info['status']; ?></td>
                
            </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>
<?php include '../view/footer.php'; 