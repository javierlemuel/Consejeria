<?php

class Reports extends Controllers
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

    public function Reports()
    {
        $data['page_tag'] = "Reports";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "reports";
        $data['grandTotal'] = 0;

        if (isset($_POST['startdate'])) {
            $startdate = $_POST['startdate'];
            $enddate = $_POST['enddate'];
            $group = $_POST['group'];
            $product = $_POST['product'];
        } else {
            $startdate = date('Y-m-d', strtotime('-1 year'));
            $enddate = date("Y-m-d");
            $group = "day";
            $product = 0;
        }
        $data['startdate'] = $startdate;
        $data['enddate'] = $enddate;
        $data['group'] = $group;
        $data['product'] = $product;
        $data['productList'] = $this->model->getProducts();
        //dep($data['productList']);

        if ($group == "month") {
            $report = $this->model->getReportByMonth($product, $startdate, $enddate);
            foreach ($report as $value) {
                $data['grandTotal'] += $value['Total'];
            }
            $data['reportData'] = $report;
            $this->views->getView($this, "reportsMonth", $data);
        } else if ($group == "week") {
            $report = $this->model->getReportByWeek($product, $startdate, $enddate);
            foreach ($report as $value) {
                $data['grandTotal'] += $value['Total'];
            }
            $data['reportData'] = $report;
            $this->views->getView($this, "reportsWeek", $data);
        } else {
            $report = $this->model->getReportByDay($product, $startdate, $enddate);
            foreach ($report as $value) {
                $data['grandTotal'] += $value['Total'];
            }
            $data['reportData'] = $report;
            $this->views->getView($this, "reports", $data);
        }
    }

    public function InventoryReport()
    {
        $data['page_tag'] = "Inventory Report";
        $data['page_title'] = "Dragonfly Drones - Administration";
        $data['page_name'] = "inventoryReport";
        $data['productIn'] = $this->model->getProducts();
        $this->views->getView($this, "inventoryReport", $data);
    }

    public function getProducts()
    {
        $data = $this->model->getProducts();
        return $data;
    }



}
