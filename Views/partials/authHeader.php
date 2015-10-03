<form action="" method="post">
    <a href="<?= $this->url('products', 'category') ?>">Search By Category</a>
    <a href="<?= $this->url('products', 'available') ?>">Available Products</a>
    <button><a href="<?= $this->url('cart', 'manage') ?>">Cart Manage</a></button>

    <input type="submit" value="Logout" name="logout"></a>
</form>
