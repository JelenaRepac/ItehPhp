<?php
class Book{
    public $id;
    public $name;
    public $publisher;
    public $ISBN;
    public $pages;
    public $cover;
    public $author;

    //konstruktor
    public function __construct($id=null, $name=null, $publisher=null, $ISBN=null, $pages=null, $cover=null, $author=null)
    {
        $this-> id=$id;
        $this-> name=$name;
        $this-> publisher=$publisher;
        $this-> ISBN=$ISBN;
        $this-> pages=$pages;
        $this-> cover= $cover;
        $this-> author=$author;
    }


    public static function saveBook($name,$publisher,$isbn,$pages,$cover,$author,$conn)
    {
        $query="INSERT INTO book
        VALUES ('','$name','$publisher','$isbn','$pages','$cover','$author');";
        return $conn-> query($query);
    }
    
}