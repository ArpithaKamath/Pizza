<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Current Orders Report</h1>
        <h2>Orders Baked but not delivered</h2>
        <?php if($baked_order_list==NULL) : ?>
            <label>No Baked Orders</label>
        <?php else : ?>
            <?php  foreach ($baked_order_list as $baked) : ?>
            <label>ID:</label>
            <label><?php echo $baked['id']; ?></label>
            <label>User:</label>
            <label><?php echo $baked['username']; ?></label>
            <br >
            <?php endforeach; ?>
        <?php endif; ?>
        <h2>Orders Preparing (in the oven)</h2>
        <?php if(count($preparing_order_list)==0) : ?>
            <label>No Orders are in Oven</label>
        <?php else : ?>
            <?php  foreach ($preparing_order_list as $preparing) : ?>
            <label>ID:</label>
            <label><?php echo $preparing['id']; ?></label>
            <label>User:</label>
            <label><?php echo $preparing['username']; ?></label>
            <br >
            <?php endforeach; ?>
        <?php endif; ?>
        <br> 
        <!--Button for marking oldest preparing pizza as baked -->
        <form  action="index.php" method="post">
            <input type="hidden" name="action" value="change_status">           
            <input type="submit" value="Make Oldest Pizza Baked" />
            <br>
        </form> 
        <br>  
    </section>
</main>
<?php
include '../view/footer.php';
