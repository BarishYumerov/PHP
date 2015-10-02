<form action="" method="post">
    <label for="name">Name: </label>
    <input value="<?= $_SESSION['product']['name'] ?>" type="text" id="name" name="name"><br>

    <label for="price">Price: </label>
    <input value="<?= $_SESSION['product']['price'] ?>" type="text" id="price" name="price"><br>

    <label for="Quantity">Quantity: </label>
    <input value="<?= $_SESSION['product']['quantity'] ?>" type="text" id="quantity" name="quantity"><br>

    <label for="category">Category: </label>
    <select name="category" id="category">
        <option value="-1"></option>
        <?php foreach ($_SESSION['categories'] as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" name="edit" value="Edit">
</form>