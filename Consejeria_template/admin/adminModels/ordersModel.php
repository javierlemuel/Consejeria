<?php 
    class ordersModel extends Mysql
    {
        public function __contruct()
        {
            parent::__construct();
        }

        public function getOrders()
        {
            $sql = "SELECT * FROM orders";
            $request = $this->select_all($sql);
            return $request;
        }

        public function updateOrder(string $param, string $att, int $order_id)
        {
            $sql = "UPDATE orders SET ".$att."=? WHERE order_id=".$order_id;
            //echo("<script>console.log('PHP QUERY: " . $sql . "');</script>");
            $arrData = array($param);
            $request = $this->update($sql,$arrData);
            return $request;
        }


        public function getOrder(int $id)
        {
            $sql = "SELECT * FROM orders WHERE order_id =".$id;
            $request = $this->select($sql);
            return $request;
        }

        public function updateOrdersStatus($orderid, $status)
        {
            $sql = "UPDATE orders SET order_status = ? WHERE order_id = ?";
            $arrData = array($status, $orderid);
            $request = $this->update($sql, $arrData);
            return;

        }

    }
?> 