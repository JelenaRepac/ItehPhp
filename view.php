<?php
require 'connection/DBBroker.php';
require 'model/Book.php';
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
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change book info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="izmeninaziv" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="izmeninaziv" value="">
                        </div>
                        <div class="mb-3">
                            <label for="izmeninaziv" class="form-label">Author:</label>
                            <input type="text" class="form-control" id="izmeninaziv" value="">
                        </div>
                        <div class="mb-3 sel">
                            <label for="izmenicenu" class="form-label">Publisher:</label>
                            <input type="text" class="form-control" id="izmenicenu" value="">
                            <input type="hidden" id="hidden">
                        </div>
                        <div class="mb-3 sel">
                            <label for="izmenicenu" class="form-label">ISBN:</label>
                            <input type="text" class="form-control" id="izmenicenu" value="">
                            <input type="hidden" id="hidden">
                        </div>
                        <div class="mb-3 sel">
                            <label for="izmenicenu" class="form-label">Page number:</label>
                            <input type="text" class="form-control" id="izmenicenu" value="">
                            <input type="hidden" id="hidden">
                        </div>
                        <div class="mb-3 sel">
                            <label for="izmenicenu" class="form-label">Cover:</label>
                            <input type="text" class="form-control" id="izmenicenu" value="">
                            <input type="hidden" id="hidden">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Otkazi</button>
                        <button type="button" class="btn btn-add" onclick="updateTreatmentType()">Izmeni</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    
    <div class="container main-div">

        <div class="div-table">
            <div class="container knjige">
                <h2>Sve knjige</h2>
            </div>
            <br>
            <div id="displayTypeTable" style="width:1500px;">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Publisher</th>
                            <th scope="col">ISBN</th>
                            <th scope="col">Page number</th>
                            <th scope="col">Cover</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $num = 1;
                        $result = Book::getAllBooks($conn);
                        while ($row = mysqli_fetch_array($result)) {
                            // Add a new option to the combo-box
                            echo "<tr>
            <td>$num</td>
            <td>$row[name]</td>
            <td>$row[authorId]</td>
            <td>$row[publisher]</td>
            <td>$row[ISBN]</td>
            <td>$row[pages]</td>
            <td>$row[cover]</td>
          <td> <button class=' btn btn-update' onclick='getTypeDetails($row[id]);' style='width:150px !important;height:30px; background-color:bisque; margin-top:1px; color:#333;'>Change book info</button>
          <button class=' btn btn-delete' onclick='deleteBook($row[id]);' style='width:150px !important;height:30px; background-color:bisque; margin-top:1px; color:#333;'>Delete book</button></td>
          </tr>
          ";
                            $num = $num + 1;
                        } ?>
                    

                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        function deleteBook(id){
            if(confirm("Book will be deleted. Are you sure you want to delete it?")){

                $req=$.ajax({
                    url:"deleteBook.php",
                    type: 'post',
                    data:{
                        'deleteSend':id
                    }
                });
                $req.done(function(res, textStatus, jqXHR) {
                    if (res == "Success") {

                        location.reload(true);
                        
                      


                    } else {
                        console.log("Book isnt deleted " + res);
                    
                    }

                });

                $req.fail(function(jqXHR, textStatus, errorThrown) {
                    console.error('Error ' + textStatus, errorThrown);
                })
            }
        }
        </script>
    </body>
</html>