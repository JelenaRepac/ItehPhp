<?php
include 'DBBroker.php';
include 'C:\xampp\htdocs\Php-domaci\model\Book.php';
// TO EXTRACT ALL SEND VARIABLES
extract($_POST);

if (isset($_POST['idSend']) && isset($_POST['nameSend']) && isset($_POST['authorSend']) && isset($_POST['publisherSend']) && isset($_POST['isbnSend'])&& isset($_POST['pagesSend'])
 && isset($_POST['coverSend'])) {
    
        $name = $_POST['nameSend'];
        $author = $_POST['authorSend'];
        $publisher= $_POST['publisherSend'];
        $isbn=$_POST['isbnSend'];
        $pages=$_POST['pagesSend'];
        $cover=$_POST['coverSend'];
        $id=$_POST['idSend'];

        $book=new Book($id, $name, $publisher, $isbn, $pages,$cover, $author);
        $status = Book::updateBook($conn, $book);
        if ($status) {
            echo 'Success';
        } else {
            echo $status;
            echo "Failed";
        }
    
}
