<?php include '../view/header.php'; ?>
<main>
    <section>
        <h1>Topping List</h1>

        <h2>Toppings</h2>
        <table>
            <tr>
                <th>Topping Name</th>
                <th>Has Meat?</th>
                <th>&nbsp;</th>
            </tr>

            <?php foreach ($toppings as $menu) : ?>
                <tr>
                    <td><?php echo $menu['topping']; ?></td>
                    <td><?php echo $menu['is_meat']; ?></td>
                <form action="index.php" name="delete" method="post">
                    <td>
                        <input type="hidden" name="topping_id_value" value="<?php echo $menu['id'] ?>">
                        <input type="hidden" name="action" value="delete"> 
                        <input type="submit" value="Delete" />
                    </td>
                </form>

                </tr>
            <?php endforeach; ?>
        </table>
        <p>
            <a href="?action=show_add_form">Add Topping</a>
        </p>
    </section>
</main>
<?php
include '../view/footer.php';
