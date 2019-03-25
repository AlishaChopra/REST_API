<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With ');

include_once '../config/dbclass.php';
include_once '../entities/crudOperation.php';
$db = new dbclass();
$connection = $db->dbConnect();
$dataRead = new crudOperation($connection);
$data = json_decode(file_get_contents("php://input"));
$dataRead->emp_id= $data->emp_id;
if($dataRead->deleteEmp())
{
    echo json_encode(
        array('message'=>'delete successful')
    );
}
else{
    echo json_encode(
        array('message'=>'delete not successful')
    );
}
?>