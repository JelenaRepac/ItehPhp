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
    <link rel="stylesheet" type="text/css" href="css/authorsView.css">
   
    <title>Document</title>
</head>

<body>
    <div class="modal fade" id="izmeniTModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog"  style="width:320px">
            <div class="modal-content" style="background-color:sienna;  background-color:sienna; box-shadow: 0 9px 50px hsla(22, 79%, 87%, 0.801); opacity: .9; border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: bisque">Books</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="mb-3">
                           <input type="hidden" class="form-control" name="idAuthor" id="idAutora" >
                        
                            <label for="izmeninaziv" class="form-label">Name:</label>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="nameFields" id="imeAutora" style="width: 280px;">
                        </div>
                        <div class="mb-3">
                            <label for="izmeniautora" class="form-label">Lastname:</label>
                        </div>
                        <div class="mb-3">
                            <form name="form" action="" method="post">    
                                <input type="text" class="nameFields" id="prezimeAutora" name="prezime" style="width: 280px;">
                            </form>
                        </div>	
                       
                    
                    </div>
                    

                </div>
                
            </div>
            
        </div><div id="displayTable" style="position:relative"> </div>
    </div>
    
    <div class="container main-div">
        <div class="div-table">
            <div class="container">
                <h2 class="author">All authors <button type="button" class="btn" onclick="sortTable()" style=" border-color: bisque;"><img src="images/sort.png" style="width: 25px;height: 25px;"></button></h2>
                
               
            </div>
            
           
            <br>
            <div id="displayTypeTable" style="width:1000px;">
                <table class="table" id="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" style="color: bisque"></th>
                            <th scope="col" style="color: bisque" >Name</th>
                            <th scope="col" style="color: bisque" >Lastname</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                        <?php
                        $num = 1;
                           $resultA = Author::getAllAuthors($conn);
                           while ($rowA = mysqli_fetch_array($resultA)){
                            
                           ?>
                             <tr>
                                <td><?php echo $num?></td>
                                <td><?php echo $rowA["nameA"] ?> </td>
                                <td> <?php echo $rowA["lastname"]?></td>
                                
                    
                                
                            <?php 
                            echo 
                                "<td> <button class=' btn btn-update' onclick='seeBooks(\"$rowA[nameA]\",\"$rowA[lastname]\",$rowA[id]);'
                                 style='width:150px !important;height:30px; background-color:bisque; margin-right:10px;  color:#333;'>Show all books</button>
                                <button class=' btn btn-delete' onclick='deleteAuthor($rowA[id]);'
                                style='width:40px !important;height:30px; margin-left:20px'><img src='images/delete.png' style='width: 25px;height: 25px;'></button></td>
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

    <script src="main.js"></script>
    <script type="text/javascript">


        //BRSANJE KNJIGE
        function deleteAuthor(id){
            if(confirm("Author will be deleted. Are you sure you want to delete it?")){

                $req=$.ajax({
                    url:'connection/deleteAuthor.php',
                    type: 'post',
                    data:{
                        'deleteSend':id
                    }
                });
                $req.done(function(res, textStatus, jqXHR) {
                    if (res == "Success") {
                        alert("Author is deleted successfully!")
                        location.reload(true);
                    } else {
                        alert("Author has books and can't be deleted.");
                    
                    }

                });

                $req.fail(function(jqXHR, textStatus, errorThrown) {
                   
                    console.error('Error ' + textStatus, errorThrown);
                })
            }
        }
        
        //PRIKAZIVANJE INFO O AUTORU
        function seeBooks(ime,prezime,id) {
            document.getElementById("imeAutora").value=ime;
            document.getElementById("prezimeAutora").value=prezime;
            
            displayData("SELECT * FROM book WHERE authorId=",id);
             $('#izmeniTModal').modal("show");
        }

        //PRIKAZIVANJE KNJIGA IZABRANOG AUTORA
        function displayData(query,id) {

            var display = query;
            $.ajax({
            url: 'connection/display.php',
            type: 'post',
            data: {
                'displaySend': display,
                'id':id,
            },
            success: function(data, status) {
                $('#displayTable').html(data);

            }
            });
        }
        //SORTIRAJ AUTORE
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