<?php
require 'DBBroker.php';
require 'C:\xampp\htdocs\Php-domaci\model\Book.php';

if(isset($_POST["action"])){
    if($_POST["action"]=="insert"){
        insert();
    }
}
function insert(){

    if($_POST["bookName"]=="" || $_POST["publisher"]=="" || $_POST["isbn"]=="" || $_POST["pageNmb"]=="" || $_POST["cover"]=="" ){
        echo "You must insert values...";
    } else {
        global $conn;

        $name = $_POST["bookName"];
        $publisher = $_POST["publisher"];
        $isbn = $_POST["isbn"];
        $pageNumber = $_POST["pageNmb"];
        $cover = $_POST["cover"];
        $author = $_POST["author"];

        $status = Book::saveBook($name, $publisher, $isbn, $pageNumber, $cover, $author, $conn);

        if ($status) {
            echo "Inserting book succesfully!";

        } else {
            echo $status;
            echo "Failed";

        }
    }
}
 
 

