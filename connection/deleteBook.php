<?php
require 'DBBroker.php';
require 'C:\xampp\htdocs\Php-domaci\model\Book.php';

if(isset($_POST['deleteSend'])){
    $delete=$_POST['deleteSend'];
    $book=new Book ($_POST['deleteSend']);

}
    
    $status=Book::deleteBook($conn, $book);
    if($status){
        echo 'Success';
        
    }else{
        echo $status;
        echo "Failed";
    }
?>
