<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../config/dbclass.php';
include_once '../entities/crudOperation.php';
$db = new dbclass();
$connection = $db->dbConnect();
$dataRead = new crudOperation($connection);
//echo $_GET['emp_id'];
$dataRead->emp_id=isset($_GET['emp_id']) ? $_GET['emp_id'] : die();
$dataRead->readWhere();
//echo $dataRead->emp_id;
$data_arr=array(
    'emp_id' => $dataRead->emp_id,
    'ename' => $dataRead->ename,
    'designation' => $dataRead->designation,
    'salary' => $dataRead->salary
);
//print_r(json_encode($data_arr));
echo(json_encode($data_arr));
//print_r(json_encode($data_arr));
?>