<?= $this->extend('templates/base.php') ?>

<?php if(!empty(session()->getFlashdata('failed'))): ?>
    <h1><?= session()->getFlashdata('failed'); ?></h1>
<?php endif; ?>

<?= $this->section('content') ?>

<?php foreach ($products as $product) : ?>
    <div class="card mb-3" style="max-width: 1200px; margin-top:5mm;" id="product_<?=$product['id']?>">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/uploads/images/<?= $product['image_path']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $product['product_name']; ?></h5>
                    <p class="card-text"><?= $product['description']; ?></p>
                    <strong class="card-text" style="color: green;"><?= $product['price'] ?></strong>
                </div>
                <div style="margin: 5px; margin-top:11rem; padding-right:1rem;">
                    <a class="btn btn-outline-primary" style="float: right; margin-left:5px;" href="<?= site_url('product/update/'.$product['id']); ?>">Update</a>
                    <button class="btn btn-danger" id='delete_button_<?=$product['id']?>' style="float:right;" onclick="deleteConfirmation('<?= $product['id'] ?>')">Delete</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>





<?= $this->endSection() ?>





<?= $this->section('jscripts') ?>

<style>
    .bootbox.modal {
        display: flex !important;
        align-items: center;
        justify-content: center;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

<script type="text/javascript">
    function deleteConfirmation(id) {
        $.ajax({
            url: "/product/get-product",
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: id
            },
            success: function(resp) {
                $("#response").html();
                bootbox.confirm({
                    title: 'Delete Confirmation',
                    message: 'Do you really want to delete "' + resp.product_name + '"',
                    buttons: {
                        cancel: {
                            label: '<i class="fa fa-times"></i> <span>Yes, I\'m sure</span>',
                            className: 'btn btn-outline-danger'
                        },
                        confirm: {
                            label: '<i class="fa fa-check"></i> Close',
                            className: 'btn btn-outline-secondary'
                        }
                    },
                    callback: function(result) {
                        if (!result) {
                            
                            $.ajax({
                                url: "/product/delete/"+id,
                                type: 'POST',

                                success: function(res){
                                    var contents = document.getElementById('product_'+id);
                                    contents.remove();
                                },
                                error:function(xhr , status , err){
                                    console.log(err);
                                }

                            });
                            
                        }
                    }
                });
            },

        });
    }
</script>







<?= $this->endSection() ?>