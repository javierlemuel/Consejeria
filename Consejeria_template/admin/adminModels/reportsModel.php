<?php
class reportsModel extends Mysql
{
    public function __contruct()
    {
        parent::__construct();
    }

    public function getProducts()
    {
        $sql = "SELECT * FROM products";
        $request = $this->select_all($sql);
        return $request;
    }

    public function getReportByDay($Productid, $startdate, $enddate)
    {
        if ($Productid == "" || $Productid == "0") {
            $sql = "select DAY(order_date) Day, MONTHNAME(order_date) Month, YEAR(order_date) Year, sum(product_quantity) AS Quantity, SUM(total_price) Total"
                . " from orders O"
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " GROUP by  DAY(order_date), MONTH(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        } else {
            $sql = "select DAY(order_date) Day, MONTHNAME(order_date) Month, YEAR(order_date) Year,  sum(product_quantity) AS Quantity, SUM(total_price) Total"
                . " from orders O "
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " AND c.p_id = " .$Productid
                . " GROUP by  DAY(order_date), MONTH(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        }

        return $request;
    }

    public function getReportByWeek($Productid, $startdate, $enddate)
    {
        if ($Productid == "" || $Productid == "0") {
            $sql = "select WEEK(order_date) Week, YEAR(order_date) Year,  sum(product_quantity) AS Quantity, SUM(total_price) Total"
                . " from orders O"
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " GROUP by  WEEK(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        } else {
            $sql = "select WEEK(order_date) Week, YEAR(order_date) Year,  sum(product_quantity) AS Quantity,  SUM(total_price) Total"
                . " from orders O "
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " AND c.p_id = " .$Productid
                . " GROUP by  WEEK(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        }

        return $request;
    }

    public function getReportByMonth($Productid, $startdate, $enddate)
    {
        if ($Productid == "" || $Productid == "0") {
            $sql = "select MONTHNAME(order_date) Month, YEAR(order_date) Year, sum(product_quantity) AS Quantity, SUM(total_price) Total"
                . " from orders O"
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " GROUP by  MONTH(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        } else {
            $sql = "select MONTHNAME(order_date) Month, YEAR(order_date) Year, sum(product_quantity) AS Quantity, SUM(total_price) Total"
                . " from orders O "
                . " join contains C ON c.order_id = O.order_id"
                . " WHERE (order_date BETWEEN '" .$startdate  ."' AND '" .$enddate ."')"
                . " AND c.p_id = " .$Productid
                . " GROUP by MONTH(order_date), YEAR(order_date);";
            $request = $this->select_all($sql);
        }

        return $request;
    }
}
