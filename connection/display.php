
<?php
require 'DBBroker.php';
require 'C:\xampp\htdocs\Php-domaci\model\Book.php';
extract($_POST);


$num = 1;
$table = '<table class="table" id="sortTable" style="position:relative; width:800px; margin-left:540px">
    <thead>
      <tr>
        <th scope="col">Redni Br</th>
        <th><id="knjige">Book</th>
        <th><id="knjige">Publisher</th>
        <th><id="knjige">Isbn</th>
        <th><id="knjige">Page number</th>
        <th><id="knjige">Cover</th>
       
      </tr>
    </thead>';


$result = Book::selectByAuthorId($_POST['id'], $conn);



if (isset($_POST['displaySend'])) {
  $search = mysqli_real_escape_string($conn, $_POST['displaySend']);
  $result = Book::selectByAuthorId($_POST['id'], $conn);
} else {
  $result = Book::getAllBooks($conn);
}

while ($row = mysqli_fetch_assoc($result)) {
  //concaternation
  
  $name = $row["name"];
  $publisher = $row["publisher"];
  $isbn = $row["ISBN"];
  $pages = $row["pages"];
  $cover = $row["cover"];
  
  $table .= ' <tr>
        <td scope="row">' . $num . '</td>
        <td>' . $name . '</td>
        <td>' . $publisher . '</td>
        <td>' . $isbn. '</td>
        <td>' . $pages. '</td>
        <td>' . $cover . '</td>
        
      </tr>';
  $num++;
}
$table .= "</table>";
echo $table;



?>
