<?php foreach ($_SESSION['products'] as $product): ?>
    <form action="" method="post">
        <hr>
        <div id="<?= $product['id'] ?>">
            <?php
            echo '<p>Name: ' . $product['name'] . '</p>' .
                '<p>Price: ' . $product['price'] . '</p>' .
                '<p>Quantity: ' . $product['quantity'] . '</p>' .
                '<p>Category: ' . $product['category'] . '</p>'.
                '<input type="hidden" name="' . $product['id'] . '" value="wut"/>'
            ?>
            <input type="submit" name="edit" value="Edit">
            <input type="submit" name="delete" value="Delete">
        </div>
        <hr>
    </form>
<?php endforeach; ?>

