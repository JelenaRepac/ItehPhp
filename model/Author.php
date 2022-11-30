<?php

class Author{
    public $id;
    public $name;
    public $lastname;
    
    //definisemo konstruktor
    public function __construct($id=null,$name=null,$lastname=null)
    {
        $this->id=$id;
        $this->name=$name;
        $this->lastname=$lastname;
    }


    public static function saveAuthor($name,$lastname,$conn){
        $query="INSERT INTO author VALUES
        ('','$name','$lastname');";
        return $conn->query($query);
    }

    public static function getAuthorById($id,$conn){
        $query="SELECT * FROM author WHERE id=$id";
        return $conn->query($query);
    }
}