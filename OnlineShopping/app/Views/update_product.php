<?= $this->extend('templates/base.php') ?>

<?= $this->section('content') ?>

<?php if (isset($success)) : ?>
    <div class="alert alert-info d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            <?= $success ?>
        </div>
    </div>
<?php endif ?>


<form method='POST' action='/product/update/<?=$product['id']?>' enctype="multipart/form-data" style="margin-top: 5mm;padding: 10mm; border:1px solid gray; border-radius:5px; margin-bottom:5mm;">
    <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" value="<?= $product['product_name'] ?>" name="product_name" aria-describedby="emailHelp">
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('product_name'); ?>
            </div>
        <?php endif; ?>
    </div>



    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $product['description']; ?></textarea>
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('description'); ?>
            </div>
        <?php endif; ?>
    </div>



    <label for="price" class="form-label">Price</label>
    <div>
        <div class="input-group <?php if (!isset($validation)) {
                                    echo "mb-3";
                                } ?>">
            <span class="input-group-text">$</span>
            <input type="text" id="price" name="price" value="<?= $product['price'] ?>" class="form-control" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>
        </div>
        <?php if (isset($validation)) : ?>
            <div class="text-danger mb-3">
                <?= $validation->getError('price'); ?>
            </div>
        <?php endif; ?>
    </div>



    <div class="form-group mb-3">
        <label for="price" class="form-label">Category</label>
        <select class="form-select" aria-label="Category" id='category' name="category">
            <option <?php if($product['category']=='electronics'){echo"selected";} ?>  value="electronics">Electronics</option>
            <option <?php if($product['category']=='fashion'){echo "selected";} ?> value="fashion">Fashion</option>
            <option <?php if($product['category']=='home, living'){echo "selected";} ?> value="home, living">Home, Living</option>
            <option <?php if($product['category']=='Auto Garden , Construction Market'){echo "selected";} ?> value="Auto Garden , Construction Market">Construction</option>
        </select>
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('category'); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="mb-3">
        <label for="product_image" class="form-label">Choose Image <span style='font-weight:bold;'><?= $product['image_path']; ?></span></label>
        <input class="form-control" type="file" id="product_image" name="image_path" value="<?= $product['image_path'] ?>">
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('image_path'); ?>
            </div>
        <?php endif; ?>
    </div>



    <div style="margin-top:10mm;display: flex; justify-content:center; align-items:center;">
        <button type="submit" class="btn btn-outline-primary">Update</button>
    </div>
</form>



<?= $this->endSection() ?>