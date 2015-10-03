<h1>Manage your cart</h1>
<h2>Products:</h2>
<form action="" method="post">
    <input type="submit" name="checkout" value="Checkout Cart">
    <input type="submit" name="empty" value="Empty Cart">
</form>
<h3>
    Your cash: <?= $_SESSION['cash'] ?>;<br>
    Products count in cart: <?= count($_SESSION['userCart']['cartProducts']) ?><br>
    Cart value: <?= $_SESSION['userCart']['value'] ?>;<br>
    Money left after checkout: <?= floatval($_SESSION['cash']) - floatval($_SESSION['userCart']['value'])  ?>
</h3>
<?php foreach ($_SESSION['userCart']['cartProducts'] as $product): ?>
    <form action="" method="post">
        <hr>
        <div id="<?= $product['productId'] ?>">
            <?php
            echo '<p>Name: ' . $product['product']['name'] . '</p>' .
                '<p>Price: ' . $product['product']['price'] . '</p>' .
                '<p>Quantity: ' . $product['quantity'] . '</p>' .
                '<p>Category: ' . $product['product']['categoryId'] . '</p>'.
                '<input type="hidden" name="' . $product['productId'] . '" value="wut"/>'
            ?>
            <input type="submit" name="remove" value="Remove From Cart">
        </div>
        <hr>
    </form>
<?php endforeach; ?>