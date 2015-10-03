<form action="" method="post">
    <button><a href="<?= $this->url('products', 'category') ?>">Search By Category</a></button>
    <button><a href="<?= $this->url('products', 'available') ?>">Available Products</a></button>
    <button><a href="<?= $this->url('products', 'add') ?>">Add Products</a></button>
    <button><a href="<?= $this->url('products', 'myProducts') ?>">My Products</a></button>
    <button><a href="<?= $this->url('cart', 'manage') ?>">Cart Manage</a></button>

    <input type="submit" value="Logout" name="logout"></a>
</form>
