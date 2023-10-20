<?php 
    class productsModel extends Mysql
    {
        public function __contruct()
        { 
            parent::__construct();
        }

        public function setProduct(string $name, string $desc, string $cost, string $price, string $brand, string $wifi, 
                            string $img, string $resolution, int $stock, string $role, string $provider, string $status)
        {
            //echo("<script>console.log('PHP from model: " . $cost . "');</script>");
            $query_insert = "INSERT INTO products(p_name, p_desc, p_price, p_brand, p_cost, p_wifi, p_img, p_video_res, stock, p_role, p_provider, p_status) 
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = array($name, $desc, $price, $brand, $cost, $wifi,$img,$resolution,$stock,$role,$provider,$status);
            $request_insert = $this->insert($query_insert, $arrData);
            return $request_insert;
        }

        public function getProducts()
        {
            $sql = "SELECT * FROM products";
            $request = $this->select_all($sql);
            return $request;
        }

        public function delProduct($id)
        {
            $sql = "DELETE FROM products WHERE p_id='".$id."'";
            $del = $request = $this->delete($sql);
            return $del;
        }

        public function updateProduct(string $param, string $att, int $p_id)
        {
            $sql = "UPDATE products SET ".$att."=? WHERE p_id=".$p_id;
            //echo("<script>console.log('PHP QUERY: " . $sql . "');</script>");
            $arrData = array($param);
            $request = $this->update($sql,$arrData);
            return $request;
        }

        public function getProduct(int $id)
        {
            $sql = "SELECT * FROM products WHERE p_id =".$id;
            $request = $this->select($sql);
            return $request;
        }
    }
?> 