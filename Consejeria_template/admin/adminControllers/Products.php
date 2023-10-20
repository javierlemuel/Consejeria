<?php

class Products extends Controllers
{
    public function __construct()
    {
        parent::__construct();
        if ( !isset($_SESSION) ) session_start();
        if (!isset($_SESSION['admin_logged_in'])) {
            //dep($_SESSION);
            header('Location:'.base_url().'login');
            exit();
        }
    }

    public function Products()
    {
        $data['page_tag'] = "Products";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "products";
        $this->views->getView($this, "products", $data);
    }

    public function EditProduct()
    {
        //echo "GETs here";
        $p_id = $_GET['p_id'];
        $data = $this->model->getProduct($p_id);
        $data['page_tag'] = "Edit Product";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "editProduct";
        $this->views->getView($this, "editProduct", $data);
    }

    public function insertProduct()
    {
        if (isset($_POST['createproduct'])) {
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'];
            $cost = $_POST['cost'];
            $wifi = $_POST['wifi'];
            $resolution = $_POST['resolution'];
            $stock = $_POST['stock'];
            $role = $_POST['role'];
            $provider = $_POST['provider'];
            $status = $_POST['status'];

            //this is the file itself (image)
            $image1 = $_FILES['image1']['tmp_name'];

            // if (isset($_FILES['imgFile'])) {
            //     $img = $_FILES['imgFile']['name'];
            //     echo $img;
            // } else {
            //     echo "Image not set";
            // }
            //echo $_FILES['image1']['tmp_name'];
            //image names
            $image_name1 = $name . "1.jpeg";
            //upload images
            move_uploaded_file($image1, $_SERVER["DOCUMENT_ROOT"] . "/Consejeria_template/Assets/product-images/" . $image_name1);
            $data = $this->model->setProduct($name, $desc, $cost, $price, $brand, $wifi, $image_name1, $resolution, $stock, $role, $provider, $status);
        }
        header('Location:' . base_url() . 'products');
        exit;
    }

    public function getProducts()
    {
        $data = $this->model->getProducts();
        return $data;
    }

    public function getProduct($p_id)
    {
        $data = $this->model->getProduct($p_id);
        return $data;
    }

    public function deleteProduct()
    {
        $id = $_GET["p_id"];
        $data = $this->model->delProduct($id);
        header('Location:' . base_url() . 'products');
        exit;
    }

    public function updateProduct()
    {
        if (isset($_POST['save_changes'])) {
            $product_id = $_POST['product_id'];
            $name = $_POST['name'];
            $desc = $_POST['description'];
            $price = $_POST['price'];
            $brand = $_POST['brand'];
            $cost = $_POST['cost'];
            $wifi = $_POST['wifi'];
            $image = $_FILES['image1']; //['tmp_name'];
            $resolution = $_POST['resolution'];
            $stock = $_POST['stock'];
            $role = $_POST['role'];
            $provider = $_POST['provider'];
            $status = $_POST['status'];
            $info = $this->model->getProduct($product_id);
            if ($name != $info['p_name']) {
                $att = "p_name";
                $data = $this->model->updateProduct($name, $att, $product_id);
            }

            if ($desc != $info['p_desc']) {
                $att = "p_desc";
                $data = $this->model->updateProduct($desc, $att, $product_id);
            }

            if ($price != $info['p_price']) {
                $att = "p_price";
                $data = $this->model->updateProduct($price, $att, $product_id);
            }

            if ($brand != $info['p_brand']) {
                $att = "p_brand";
                $data = $this->model->updateProduct($brand, $att, $product_id);
            }

            if ($cost != $info['p_cost']) {
                $att = "p_cost";
                $data = $this->model->updateProduct($cost, $att, $product_id);
            }

            if ($wifi != $info['p_wifi']) {
                $att = "p_wifi";
                $data = $this->model->updateProduct($wifi, $att, $product_id);
            }

            if ($resolution != $info['p_video_res']) {
                $att = "p_video_res";
                $data = $this->model->updateProduct($resolution, $att, $product_id);
            }

            if ($stock != $info['stock']) {
                $att = "stock";
                $data = $this->model->updateProduct($stock, $att, $product_id);
            }

            if ($role != $info['p_role']) {
                $att = "p_role";
                $data = $this->model->updateProduct($role, $att, $product_id);
            }

            if ($provider != $info['p_provider']) {
                $att = "p_provider";
                $data = $this->model->updateProduct($provider, $att, $product_id);
            }

            if ($status != $info['p_status']) {
                $att = "p_status";
                $data = $this->model->updateProduct($status, $att, $product_id);
            }

            if ($_FILES['image1']['size'] != 0 && $_FILES['image1']['error'] == 0) {
                echo ("<script>console.log('PHP IMG: image was NOT empty" . "');</script>");
                //this is the file itself (image)
                $image1 = $_FILES['image1']['tmp_name'];
                //image names
                $image_name1 = $name . "1.jpeg";
                //upload images
                move_uploaded_file($image1, $_SERVER["DOCUMENT_ROOT"] . "/Consejeria_template/Assets/product-images/" . $image_name1);
                $att = "p_img";
                $data = $this->model->updateProduct($image_name1,$att,$product_id);
            }
        }
        header('Location:'.base_url().'products');
        exit;
    }
}
