<form action="" method="post">
    <label for="name">Name: </label><input type="text" id="name" name="name"><br>
    <label for="price">Price: </label><input type="text" id="price" name="price"><br>
    <label for="Quantity">Quantity: </label><input type="text" id="quantity" name="quantity"><br>
    <label for="category">Category: </label>
    <select name="category" id="category">
        <?php foreach ($_SESSION['categories'] as $category): ?>
            <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" name="create" value="Create">
</form>