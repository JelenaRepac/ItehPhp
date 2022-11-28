<?php
include 'connection/DBBroker.php';
include 'model/Book.php';

extract($_POST);
if(isset($_POST['id'])){
    $unique=$_POST['id'];

    $result=Book::selectById($unique,$conn);
    $response=array();

    while($row=mysqli_fetch_assoc($result)){
        $response=$row;
    }
    echo json_encode($response);}
    else{
        $response['status']=200;
        $response['message']="Data not found";
    
}