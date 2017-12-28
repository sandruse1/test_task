<?php
/**
 * Created by PhpStorm.
 * User: sandruse
 * Date: 27.12.2017
 * Time: 16:56
 */

require_once('DB.php');

class Test
{
    private $search;
    private $db;
    private $contract_status;
    private $query_string;
    private $search_type;

    function __construct($search, $contract_status, $search_type){
        $this->search = $search;
        $this->search_type = $search_type; // ( 1 => int , 0 => str )
        $this->contract_status = $contract_status;
        $this->db = new DB();
    }

    function prepear_query_string(){
        $static_part = "SELECT obj_customers.name_customer, obj_customers.company , obj_contracts.number, obj_contracts.date_sign, GROUP_CONCAT(obj_services.title_service) AS 'service_title' FROM obj_customers, obj_contracts, obj_services WHERE ";
        $customer_selector = ($this->search_type) ? "name_customer IN ('" : "id_customer IN ('";
        $customer_part = "obj_customers.".$customer_selector.str_replace(",", "','", $this->search)."')";
        $service_status_part = " AND obj_services.status IN ('".implode("','", $this->contract_status)."')";
        $this->query_string = $static_part.$customer_part.$service_status_part." AND obj_contracts.id_customer = obj_customers.id_customer AND obj_services.id_contract = obj_contracts.id_contract GROUP BY obj_customers.name_customer";
    }

    function db_request(){
        $this->prepear_query_string();
        $query = mysqli_query($this->db->link,$this->query_string);
        $rows = array();
        while($r = mysqli_fetch_assoc($query)) {
            $rows[] = $r;
        }
        print json_encode($rows);
    }

}

if(isset($_POST['search']) && !empty($_POST['search']))
{
    $test = new Test($_POST['search'], $_POST['contract_status'], $_POST['search_type']);
    $test->db_request();
}