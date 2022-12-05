<?php
class User{
  public $id;
  public $username;
  public $password;
  //definisemo konstruktor
  public function __construct($id=null, $username=null, $password=null)
  
  {
      $this->id=$id;
      $this->username=$username;
      $this->password=$password;
  }

  public static function logInUser($username,$password, mysqli $conn )
  {
    $query="select * from user where username='$username' && password='$password'";
    return $conn->query($query);
  }

  public static function insertUser($username,$password,mysqli $conn){
    $query = "INSERT INTO user VALUES
    ('','$username','$password');";
    return $conn->query($query);

  }
  

}

?>