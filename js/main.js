function addBook(action){
	$(document).ready(function(){
		var data={
			action: action,
			bookName:$("#bookName").val();
			author:$("#author").val();
			publisher:$("#publisher").val();
			isbn:$("#isbn").val();
			pageNumber:$("#pageNmb").val();
			cover:$("#cover").val();
			
		}
		$.ajax({
			url: 'connection/addBook.php',
			type: 'post',
			data: data,
			success: function(response){
				alert(response);
			}
    	});
	});

}