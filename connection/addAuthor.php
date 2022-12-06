<?php
require 'DBBroker.php';
require 'C:\xampp\htdocs\Php-domaci\model\Author.php';
if(isset($_POST["action"])){
    if($_POST["action"]=="insert"){
        insert();
    }
}

function insert(){
    if($_POST["name"]=="" || $_POST["lastname"]==""){
        echo "You must insert values for name and lastname...";
    } else {
        global $conn;

        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $status = Author::saveAuthor($name, $lastname, $conn);

        if ($status) {
            echo "Inserting author succesfully!";

        } else {
            echo $status;
            echo "Failed";

        }
    }

}