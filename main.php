<?php
include 'connection/DBBroker.php';
include 'model/Author.php';
include 'model/Book.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Knjige</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
	<div id="heder">
	</div>
	<div class="main">
		<div class="pageContainer" style="margin-bottom: 50px;">
        <table width="90%" cllpadding="10" cellspacing="10" align="center" >
        	<tr>
            <td width="50%" style="vertical-align: top;">
                <form>
            	<table cellpadding="5" cellspacing="5">
                	<tr><td  style="font-weight: bold; color:bisque">Type the name of the book..</td></tr>
                	<tr><td><input class="input-txt" name="search_text" type="text" size="40"/></td></tr>
                    <tr><td><button class="btn" type="search" name="search" >Search</button></td></tr>
					<tr><td><a href="http://localhost:8080/Php-domaci/view.php" button  class="btn" type="showAll" name="showAll" style="text-decoration:none; display:block">Show all books</a></button></td></tr>					
					
                </table>
            	</form>
                <div id="resultDiv"></div>
            </td>
            </tr>
			<tr>
				
			</tr>
        </table>
		<table width="90%" cellpadding="10" cellspacing="10" align="center" >
            	
					<td height="50%" valign="top" width="50%">
                    	<form name="add_form">
            				<table id="table" cellpadding="5" cellspacing="5" align="center" style="text-align: center;" >
                				<tr><td id="heading"><b>Books</b></td></tr>
                    			<tr><td>Name:<br/><input class="input-txt" id="bookName" type="text" name="naziv" size="40" /></td></tr>          
                    			<tr><td>Author:<br/> 
								<select id="author" style="background: #fff; color: #333; border-radius: 5px 5px 5px 5px; width:330px; height:30px; margin-top:1%;  font-family: 'Abel', sans-serif;">
									<option value="" disabled selected hidden>Choose an author</option>
								<?php
								
								$query = "SELECT * FROM `author`";
								$result = mysqli_query($conn, $query);
								while ($row = mysqli_fetch_array($result)){
									// Add a new option to the combo-box
									echo "<option value='$row[id]'>$row[nameA] $row[lastname]</option> ";

								}
								?>
								
								</select></td></tr>
                    			<tr><td>Publisher:<br/><input class="input-txt" id="publisher" type="text" name="izdavac" size="40" /></td></tr>
                    			<tr><td>ISBN:<br/><input class="input-txt" id="isbn" type="text" name="isbn" size="40" /></td></tr>
                    			<tr><td>Page number:<br/><input  class="input-txt" id="pageNmb" type="text" name="brojst" size="40" /></td></tr>
								<tr><td>Cover:<br/><input class="input-txt" id="cover" type="text" name="povez" size="40" /></td></tr>
                    			<tr><td><button type="button" class="btn" onclick="addBook('insert');">Insert book</button></td></tr>
                			</table>
            			</form>
					</td>
					<td height="50%" valign="top">
                    	<form name="add_Author">
            				<table id="table" cellpadding="5" cellspacing="5" align="center" style="text-align: center;" >
                				<tr><td id="heading"><b>Authors</b></td></tr>
                    			<tr><td>Name:<br/><input class="input-txt" id="name" value="" type="text"  size="40" /></td></tr>                   
                    			<tr><td>Lastname:<br/><input class="input-txt" id="lastName" value="" type="text"  size="40" /></td></tr>
                    			
								<tr><td><button type="button" class="btn" onclick="addAuthor('insert');">Insert author</button></td></tr>
                			</table>
            			</form>
					</td>
            	
        </table>
        </div>
	</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
<script type="text/javascript">

function addAuthor(action){
    $(document).ready(function(){
        var data={
            action: action,
            name: $("#name").val(),
            lastname: $("#lastName").val()
        };

        $.ajax({
            url: 'connection/addAuthor.php',
            type: 'post',
            data: data,
            success: function(response){
                alert(response);
				location.reload(true);
            }
        });
    });
}

function addBook(action){
	$(document).ready(function(){
		var data={
			action: action,
			bookName:$("#bookName").val(),
			author:$("#author").val(),
			publisher:$("#publisher").val(),
			isbn:$("#isbn").val(),
			pageNmb:$("#pageNmb").val(),
			cover:$("#cover").val()
			
		};
		$.ajax({
			url: 'connection/addBook.php',
			type: 'post',
			data: data,
			success: function(response){
				alert(response);
				location.reload(true);
				
			}
    	});
	});

}
</script>
</body>

</html>