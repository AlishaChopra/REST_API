<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once '../config/dbclass.php';
include_once '../entities/crudOperation.php';
$db = new dbclass();
$connection = $db->dbConnect();
$dataRead = new crudOperation($connection);
$res=$dataRead->read();
$row_count=$res->num_rows;
if($row_count>0)
{
    $emp_arr=array();
    $emp_arr['data']=array();
    while($r=$res->fetch_assoc()){
        extract($r);
        $emp_item=array(
        'ename' => $ename,
        'designation' => $designation,
        'salary' => $salary
        );
    array_push($emp_arr['data'],$emp_item);
    }
    echo json_encode($emp_arr);
    
}
else{
    echo json_encode(
        array('message'=>'no employee data')
    );
}

?>