<?php


namespace App\Controllers\ProductController;

use App\Controllers\Auth;
use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\UserModel;
use DateTime;
use DateTimeZone;

class Product extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        if(!empty($this->session->get('UserLogged'))){

            $user_id = $this->session->get('UserLogged');
            $model = new UserModel();
            $user = $model->find((int)$user_id);

        
            if(strval($user['session_id']) == strval(session_id())){
                $this->updateLastActivity();
            }
            else{
                $this->session->destroy();
                return redirect()->to(site_url('product/all'));
                exit;
            }
        }
    }

    public function get_all_products()
    {
        $model = new ProductModel();
        $products = $model->findAll();

        $loggedUserId = session()->get('UserLogged');
        $user_model = new UserModel();
        $user = $user_model->find($loggedUserId);


        return view('all_products', ['products' => $products, 'user' => $user]);
    }




    public function get_product()
    {


        $data = [
            'message' => 'Data retrieved successfully',
            'data' => 'You'
        ];

        $product_model = new ProductModel();
        $product = $product_model->find($_POST['product_id']);





        return json_encode($product);
    }





    public function add_product()
    {

        helper(['add_product']);
        $data = [];


        $rules = [
            'product_name' => ['label' => 'Product Name', 'rules' => 'required'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric'],
            'category' => ['label' => 'Category', 'rules' => 'required'],
            'image_path' => ['label' => 'Image', 'rules' => 'is_image[image_path]|uploaded[image_path]']
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                $file = $this->request->getFile('image_path');
                if ($file->isValid() && !$file->hasMoved()) {

                    $file_name = time() . $file->getFilename();
                    $file->move('./uploads/images', $file_name);
                    $product = new ProductModel();

                    $_POST['image_path'] = $file_name;
                    $product->save($_POST);
                    $data['success'] = 'Product has been added successfully';
                    return redirect()->to(site_url('product/add-product'))->with('success', 'Product has been added successfully');
                } else {
                    echo $file->getError();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        $loggedUserId = session()->get('UserLogged');
        $user_model = new UserModel();
        $user = $user_model->find($loggedUserId);

        $data['user'] = $user;

        return view('add_product', $data);
    }




    public function update_product($id)
    {

        $data = [];

        $rules = [
            'product_name' => ['label' => 'Product Name', 'rules' => 'required'],
            'description' => ['label' => 'Description', 'rules' => 'required'],
            'price' => ['label' => 'Price', 'rules' => 'required|numeric'],
            'category' => ['label' => 'Category', 'rules' => 'required'],

        ];



        if ($this->request->getPost('image_path')) {
            $rules['image_path'] = ['label' => 'Image', 'rules' => 'is_image[image_path]|uploaded[image_path]'];
        }


        $id = (int)$id;
        if (is_int($id) and $id != 0) {

            helper(['update_product']);

            $model = new ProductModel();
            $product = $model->find($id);
            if ($product) {
                $data['product'] = $product;
                if ($this->request->getMethod() == "post") {
                    if ($this->validate($rules)) {
                        if ($this->request->getPost('image_path')) {
                            $file = $this->request->getFile('image_path');
                            if ($file->isValid() && !$file->hasMoved()) {

                                $file_path = FCPATH . 'uploads/images/' . $product['image_path'];
                                if (file_exists($file_path)) {
                                    unlink($file_path);
                                }

                                $file_name = time() . $file->getFilename();
                                $file->move('./uploads/images', $file_name);

                                $product = new ProductModel();
                                $_POST['image_path'] = $file_name;
                                $product->update($id, $_POST);
                                $data['success'] = 'Product has been updated successfully';
                                return redirect()->to('/product/all');
                            } else {
                                echo $file->getError();
                            }
                        } else {
                            $product = new ProductModel();

                            $_POST['image_path'] = $product->find($id)['image_path'];
                            $product->update($id, $_POST);
                            $data['success'] = 'Product has been updated successfully';
                            return redirect()->to('/product/all');
                        }
                    } else {
                        $data['validation'] = $this->validator;
                    }
                }
            } else {
                echo "<center><h2>Product not found</h2></center>";
                return;
            }
        } else {
            echo "<h2><center>Page Not Found 404</center></h2>";
            return;
        }

        $loggedUserId = session()->get('UserLogged');
        $user_model = new UserModel();
        $user = $user_model->find($loggedUserId);

        $data['user'] = $user;

        return view('update_product', $data);
    }




    public function delete_product($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);
        if ($product) {
            $file_path = FCPATH . 'uploads/images/' . $product['image_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $model->delete($id);
            return redirect()->to('product/all');
        }
        echo "Product doesn't exist";
    }
}
