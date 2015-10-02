<form action="" method="post">
    <select name="category" id="category">
        <option value="-1"></option>
        <?php foreach ($_SESSION['categories'] as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" name="search" value="Search">
</form>

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
        </div>
        <hr>
    </form>
<?php endforeach; ?>