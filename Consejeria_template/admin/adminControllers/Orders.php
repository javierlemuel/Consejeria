<?php

class Orders extends Controllers
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

    public function orders()
    {
        $data['result'] = $this->model->getOrders();
        $data['page_tag'] = "Orders";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "orders";
        $this->views->getView($this, "orders", $data);
    }


    public function EditOrder()
    {
        $order_id = $_GET['order_id'];
        $data = $this->model->getOrder($order_id);
        $data['page_tag'] = "Edit Order";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "editorders";
        echo ("<script>console.log('PHP from POST: " . json_encode($data) . "');</script>");
        $this->views->getView($this, "Edit", $data);
    }

    public function updateStatus()
    {
        $data = $this->model->getOrders();

            foreach($data as $order)
            {
                if($order['arrival_date'] <= date("Y-m-d"))
                {
                    $status = "arrived";
                    $this->model->updateOrdersStatus($order['order_id'], $status);
                }
                else 
                {
                    if($order['ship_date'] <= date("Y-m-d"))
                    {
                        $status = "shipped";
                        $this->model->updateOrdersStatus($order['order_id'], $status);
                    }
                }
            }
            unset($order);
        
            return;
        
    }

    public function updateOrder()
    {
        if (isset($_POST['edit_order'])) {
            echo ("<script>console.log('PHP from POST: " . json_encode($_POST) . "');</script>");
            //echo("<script>console.log('PHP from POST img: " . $_FILES['image'] . "');</script>");
            // echo("<script>console.log('PHP: " . $_POST['product_id'] . "');</script>");
            $order_id = $_POST['order_id'];
            $tracking = $_POST['tracking'];
            $price = $_POST['price'];
            $status = $_POST['order_status'];

            $info = $this->model->getOrder($order_id);
            echo ("<script>console.log('from DB: " . json_encode($info) . "');</script>");


            if ($price != $info['total_price']) {
                $att = "total_price";
                $data = $this->model->updateOrder($price, $att, $order_id);
            }

            if ($tracking != $info['tracking_number']) {
                $att = "tracking_number";
                $data = $this->model->updateOrder($tracking, $att, $order_id);
            }

            if ($status != $info['order_status']) {


                if ($status == "processed") {
                    if ($info['order_date'] !== null || $info['order_date'] !== "") {
                        $att = "order_date";
                        $date = date('Y-m-d');
                        $data = $this->model->updateOrder($date, $att, $order_id);

                        $att= "ship_date";
                        $date = date('Y-m-d', strtotime("+1 day"));
                        $data = $this->model->updateOrder($date, $att, $order_id);

                        $att= "arrival_date";
                        $date = date('Y-m-d', strtotime("+5 day"));
                        $data = $this->model->updateOrder($date, $att, $order_id);
                    }
                }

                if ($status == "shipped") {
                    if ($info['ship_date'] !== null || $info['ship_date'] !== "") {
                        $att = "ship_date";
                        $date = date('Y-m-d');
                        $data = $this->model->updateOrder($date, $att, $order_id);

                        $att = "arrival_date";
                        $date = date('Y-m-d', strtotime("+4 day"));
                        $data = $this->model->updateOrder($date, $att, $order_id);
                    }
                }

                if ($status == "arrived") {
                    if ($info['arrival_date'] !== null || $info['arrival_date'] !== "") {
                        $att = "arrival_date";
                        $date = date('Y-m-d');
                        $data = $this->model->updateOrder($date, $att, $order_id);
                    }
                    if ($info['ship_date'] == null || $info['ship_date'] == "") {
                        $att = "ship_date";
                        $date = date('Y-m-d');
                        $data = $this->model->updateOrder($date, $att, $order_id);
                    }
                }

                //Update Status
                $att = "order_status";
                $data = $this->model->updateOrder($status, $att, $order_id);
            }
        }
        header('Location:'.base_url().'orders');
        exit;

    }


    public function getOrders()
    {
        $data = $this->model->getOrders();
        return $data;
    }
}
