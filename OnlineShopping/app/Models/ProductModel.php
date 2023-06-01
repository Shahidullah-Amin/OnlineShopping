<?php namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{

    protected $table = 'product';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;


    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['product_name', 'description', 'image_path' , 'category' , 'price'];

    protected $dateFormat    = 'datetime';
    protected $createdField  = 'product_created_at';
    protected $updatedField  = 'product_updated_at';
    protected $deletedField  = 'product_deleted_at';

}

?>