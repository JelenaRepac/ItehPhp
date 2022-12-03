<?php
require 'DBBroker.php';
require 'C:\xampp\htdocs\Php-domaci\model\Author.php';

if(isset($_POST['deleteSend'])){
    $delete=$_POST['deleteSend'];
    $author=new Author ($_POST['deleteSend']);

}
    
    $status=Author::deleteAuthor($conn, $author);
    if($status){
        echo 'Success';
        
    }else{
        echo $status;
        echo "Failed";
    }
?>
