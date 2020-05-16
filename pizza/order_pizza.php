<?php include '../view/header.php'; ?>
<main>
    <h1> Build Your Pizza </h1>
    <form method="POST" action="index.php">
        <input type = "hidden" value="submit_order" name="action">
        <h2>Pizza Size:</h2>
        <?php foreach ($size_list as $size) : ?>
            <input type="radio" name="size" value="<?php echo $size['size']; ?>"/><?php echo $size['size']; ?>
        <?php endforeach; ?>
        <h2>Toppings:</h2>
        <div class="topping_type">
            <div class="meat">
                <p>Meat</p>
                <?php foreach ($topping_list as $topping) : ?>
                    <?php if ($topping['is_meat']) : ?>
                        <div id="meat">
                            <input type="checkbox" name="topping[]" value="<?php echo $topping['topping'] ?>"/>
                            <?php echo $topping['topping']; ?><br/>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="meatless">
                <p>Meatless</p>
                <?php foreach ($topping_list as $topping) : ?>
                    <?php if (!$topping['is_meat']) : ?>
                        <div id="meatless">
                            <input type="checkbox" name="topping[]" value="<?php echo $topping['topping'] ?>"/>
                            <?php echo $topping['topping']; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <br>
        <br>
        <label>UserName:</label>
        <select name="username">
            <option value="<?php echo $user_id; ?> ">
                <?php echo $username; ?>
            </option>
            <?php foreach ($user_list as $user) : ?>
                <?php if ($user['id'] != $user_id) : ?>
                    <option value="<?php echo $user['id']; ?> ">
                        <?php echo $user['username']; ?>
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <br >
        <input type="submit" value="Order Pizza" />
        <br >
    </form>
</main>
<?php
include '../view/footer.php';
