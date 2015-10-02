<form action="" method="post">
    <?php
        echo '<p>Name: ' . $_SESSION['product']['name'].
              '<p>Available quantity: ' . $_SESSION['product']['quantity'].
              '<p>Price: ' . $_SESSION['product']['price'];
    ?><br>
    <label for="quantity">Enter quantity: </label>
    <input type="text" name="quantity" id="quantity">
    <input type="submit" name="buy">
</form>