<?= $this->extend('templates/base.php') ?>

<?= $this->section('content') ?>

<?php if(!empty(session()->getFlashdata('success'))): ?>
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            <?= session()->getFlashdata('success')?>
        </div>
    </div>
<?php endif ?>
<legend class="text-center mt-3 ">
    <h2>
        Add Your Product
    </h2>
</legend>

<form method='POST' action="<?=site_url('product/add-product'); ?>" enctype="multipart/form-data" style="margin-top: 5mm;padding: 10mm; border:1px solid gray; border-radius:5px; margin-bottom:5mm;">
    <div class="mb-3">
        <label for="product_name" class="form-label">Product Name</label>
        <input type="text" class="form-control" id="product_name" name="product_name" value="<?=set_value('product_name')?>" aria-describedby="emailHelp">
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('product_name'); ?>
            </div>
        <?php endif; ?>
    </div>



    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea class="form-control" id="description" name="description" rows="3"><?=set_value('description')?></textarea>
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
            <input type="text" id="price" name="price" class="form-control" value="<?=set_value('price')?>" aria-label="Amount (to the nearest dollar)">
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
        <select class="form-select" aria-label="Category" id='category' name="category" ?>">
            <option <?= set_value('category')=='electronics'?('selected'):(null) ?> value="electronics">Electronics</option>
            <option <?= set_value('category')=='fashion'?('selected'):(null) ?> value="fashion">Fashion</option>
            <option <?= set_value('category')=='home, living'?('selected'):(null) ?> value="home, living">Home, Living</option>
            <option <?= set_value('category')=='Auto Garden , Construction Market'?('selected'):(null) ?> value="Auto Garden , Construction Market">Construction</option>
        </select>
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('category'); ?>
            </div>
        <?php endif; ?>
    </div>


    <div class="mb-3">
        <label for="product_image" class="form-label">Choose Image</label>
        <input class="form-control" type="file" id="product_image" name="image_path" value="<?= set_value('image_path')?>">
        <?php if (isset($validation)) : ?>
            <div class="text-danger">
                <?= $validation->getError('image_path'); ?>
            </div>
        <?php endif; ?>
    </div>



    <div style="margin-top:10mm;display: flex; justify-content:center; align-items:center;">
        <button type="submit" class="btn btn-outline-dark"> Save </button>
    </div>
</form>



<?= $this->endSection() ?>