<?php
include 'connection/DBBroker.php';
include 'model/Book.php';
include 'model/Author.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/view.css">
   
    <title>Document</title>
</head>

<body>
    <div class="modal fade" id="izmeniTModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color:sienna;  background-color:sienna; box-shadow: 0 9px 50px hsla(22, 79%, 87%, 0.801); opacity: .9; border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: bisque">Change book info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <input type="hidden" class="form-control" id="idKnjige" >
                            <label for="izmeninaziv" class="form-label">Name:</label>
                            <input type="text" class="form-control"  id="naziv" >
                        </div>
                        <div class="mb-3">
                            <label for="izmeniautora" class="form-label">Autor:</label>
                            <select id="author" style="background: #fff; color: #333; border-radius: 5px 5px 5px 5px; width:330px; height:30px; margin-top:1%;  font-family: 'Abel', sans-serif;">
									<option id="autor"></option>
								<?php
								
								$query = "SELECT * FROM `author`";
								$result = mysqli_query($conn, $query);
								while ($row = mysqli_fetch_array($result)){
									// Add a new option to the combo-box
									echo "<option value='$row[id]'>$row[nameA] $row[lastname]</option> ";

								}
								?>
								
								</select></td></tr>
                        </div>
                        
                        <div class="mb-3">
                            <label for="izmenipublikaciju" class="form-label">Publisher:</label>
                            <input type="text" class="form-control" id="publikacija">
                            
                        </div>
                        
                        <div class="mb-3">
                            <label for="izmeniisbn" class="form-label">ISBN:</label>
                            <input type="text" class="form-control" id="isbn" >
                            
                        </div>
                        <div class="mb-3">
                            <label for="izmenistranice" class="form-label">Page number:</label>
                            <input type="text" class="form-control" id="stranice" >
                            
                        </div>
                        <div class="mb-3">
                            <label for="izmenikoricu" class="form-label">Cover:</label>
                            <input type="text" class="form-control" id="korica" >
                            <input type="hidden" id="hidden">
                           
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-add" style='width:100px !important;height:30px; background-color:bisque; margin-top:1px; color:#333' onclick="updateBook()">Change</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="container main-div">

        <div class="div-table">
            <div class="container knjige">
                <h2>All books <button type="button" class="btn" onclick="sortTable()" style=" border-color: bisque;"><img src="images/sort.png" style="width: 25px;height: 25px;"></button></h2>
                </h2>	
            </div>
            
            
            <br>
            <div id="displayTypeTable" style="width:1500px;">
                <table class="table" id="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" style="color: bisque"></th>
                            <th scope="col" style="color: bisque" >Name</th>
                            <th scope="col" style="color: bisque" >Author</th>
                            <th scope="col" style="color: bisque" >Publisher</th>
                            <th scope="col" style="color: bisque" >ISBN</th>
                            <th scope="col" style="color: bisque" >Page number</th>
                            <th scope="col" style="color: bisque" >Cover</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                       

                        $result = Book::getAllBooks($conn);
                        while ($row = mysqli_fetch_array($result)) {
                           $authorId=$row["authorId"];
                           $name=$row["name"];
                           $resultA = Author::getAuthorById($authorId,$conn);
                           while ($rowA = mysqli_fetch_array($resultA)){
                            
                            $authorName=$rowA['nameA'];
                            $authorLastname=$rowA['lastname'];
                           }
                           ?>
                             <tr>
                                <td><?php echo $num?></td>
                                <td><?php echo $row["name"] ?> </td>
                                <td> <?php echo $authorName?> <?php echo $authorLastname?></td>
                                <td><?php echo $row["publisher"] ?></td>
                                <td><?php echo $row["ISBN"] ?></td>
                                <td><?php echo $row["pages"] ?></td>
                                <td><?php echo $row["cover"] ?></td>
                            
                            <?php 
                            echo 
                                "<td> <button class=' btn btn-update' onclick='getBookDetails(\"$row[name]\",\"$row[publisher]\",\"$row[ISBN]\",\"$row[cover]\",$row[pages],$row[id],\"$authorName\",\"$authorLastname\");'
                                 style='width:150px !important;height:30px; background-color:bisque; margin-top:1px; color:#333;'>Change book info</button>
                                 <button class=' btn btn-delete' onclick='deleteBook($row[id]);'
                                 style='width:50px !important;height:30px; margin-left: 20px'><img src='images/delete.png' style='width: 25px;height: 25px;'></button></td>
                                 </tr>
                                <?php ";
                            $num = $num + 1;
                            
                        }
                         ?>
                        
                    

                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    
    <script type="text/javascript">
        //BRSANJE KNJIGE
        function deleteBook(id){
            if(confirm("Book will be deleted. Are you sure you want to delete it?")){

                $req=$.ajax({
                    url:'connection/deleteBook.php',
                    type: 'post',
                    data:{
                        'deleteSend':id
                    }
                });
                $req.done(function(res, textStatus, jqXHR) {
                    if (res == "Success") {
                        alert("Book is deleted successfully!");
                        location.reload(true);
                    } else {
                        alert("Book isnt deleted, try again");
                    
                    }

                });

                $req.fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error ' + textStatus, errorThrown);
                })
            }
        }
        
        //PREUZIMANJE INFO O KNJIZI
        function getBookDetails(name,publisher,isbn,cover,pages,id,authorName,authorLastname) {
            document.getElementById("naziv").value=name;
            document.getElementById("publikacija").value=publisher;
            document.getElementById("isbn").value=isbn;
            document.getElementById("korica").value=cover;
            document.getElementById("stranice").value=pages;
            document.getElementById("hidden").value=id;
            $('#izmeniTModal').modal("show");
        }
    
        //AZURIRANJE INFORMACIJA O KNJIZI
       function updateBook(){
            $(document).ready(function(){
		        var data={
                nameSend:$("#naziv").val(),
                authorSend:$("#author").val(),
                publisherSend:$("#publikacija").val(),
                isbnSend:$("#isbn").val(),
                pagesSend:$("#stranice").val(),
                coverSend:$("#korica").val(),
                idSend:$("#hidden").val()
			
            };
            $.ajax({
                url: 'connection/updateBook.php',
                type: 'post',
                data: data,
                success: function(response){
                        alert("Successfully updated book info!");
                        location.reload(true);
                    
                }
            });
            });
        }
        //SORTIRAJ KNJIGE
        function sortTable() {
            var table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById("table");
            switching = true;
            while (switching) {
                switching = false;
                rows = table.rows;
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("TD")[1];
                    y = rows[i + 1].getElementsByTagName("TD")[1];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }
        </script>

       
        

        
    </body>
</html>