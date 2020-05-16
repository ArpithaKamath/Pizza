<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Welcome Student!</h1>
        <h2>Available Sizes</h2>
        <?php foreach ($size_list as $size) : ?>
            <label><?php echo $size['size']; ?></label>
            <label>&nbsp;</label>
        <?php endforeach; ?>
        <h2>Available Toppings</h2>
        <?php foreach ($topping_list as $topping) : ?>
            <label><?php echo $topping['topping']; ?></label>
            <label>&nbsp;</label>
        <?php endforeach; ?>
           
        <form action="index.php" method="post" >
            <br >
            <input type="hidden" name="action" value="user_form">      
            <label>User:</label>
            <select name="user_id">
                <?php foreach ($user_list as $user) : ?>
                    <option value="<?php echo $user['id']; ?> ">
                        <?php echo $user['username']; ?>
                    </option>
                    <label>&nbsp;</label>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Select your Username" />
            <br>
        </form>
            <br >
        <?php if ($user_id != null) : ?>

            <?php if (count($in_progress_list) != 0) : ?>
                <h2>Orders in progress for user <?php echo $username ?></h2>
                <table>
                    <tr>
                        <th>Order ID</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                    <form  action="index.php" method="post" >
                        <?php foreach ($in_progress_list as $list) : ?>
                            <tr>
                                <td><?php echo $list['id']; ?></td>
                                <td><?php echo $list['status']; ?></td>
                                <td>
                                    <?php if ($list['status'] == "baked") : ?>
                                        <input type="hidden" name="order_id_value" value="<?php echo $list['id'] ?>">
                                        <input type="hidden" name="action" value="acknowledge"> 
                                        <input type="submit" value="Acknowledge" />
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </form>

                </table>
            <?php else : ?>
                <h3>No orders for user <?php echo $username ?></h3>
            <?php endif; ?>
        <?php endif; ?>


        <a href="?action=show_order_form&amp;user_id=<?php echo $user_id; ?>">Order Pizza</a>
    </section>
</main>
<?php
include '../view/footer.php';
