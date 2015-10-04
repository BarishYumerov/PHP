<h1>Manage your cart</h1>
<h2>Products:</h2>
<form action="" method="post">
    <input type="submit" name="checkout" value="Checkout Cart">
    <input type="submit" name="empty" value="Empty Cart">
</form>
<h3>
    Your cash: <?= $_SESSION['cash'] ?> <br>
    Products count in cart: <?= count($_SESSION['userCart']['cartProducts']) ?><br>
    Cart value: <?= $_SESSION['userCart']['value'] ?><br>
    Money left after checkout: <?= floatval($_SESSION['cash']) - floatval($_SESSION['userCart']['value'])  ?>
</h3>
<?php foreach ($_SESSION['userCart']['cartProducts'] as $product): ?>
    <form action="" method="post">
        <hr>
        <div id="<?= $product['productId'] ?>">
            <?php
            echo '<p><b>Name:</b> ' . $product['product']['name'] . '</p>' .
                '<p><b>Price:</b> ' . $product['product']['price'] . '</p>' .
                '<p><b>Quantity:</b> ' . $product['quantity'] . '</p>' .
                '<p><b>Category:</b> ' . $product['product']['category'] . '</p>'.
                '<input type="hidden" name="id" value="' . $product['id'] . '"/>'.
                '<input type="hidden" name="productId" value="' . $product['productId'] . '"/>'.
                '<input type="hidden" name="quantity" value="' . $product['quantity'] . '"/>'.
                '<input type="hidden" name="price" value="' . $product['product']['price'] . '"/>'
            ?>
            <input type="submit" name="remove" value="Remove From Cart">
        </div>
        <hr>
    </form>
<?php endforeach; ?>