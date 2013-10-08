<?php include 'TopPage.php';?>
	<style>
	#output{
		text-align: center;
	}
	</style>
	
	<p id = 'output'>
		This is my first guest book.
		Follow the instructions below.
	</p>

	
	<form action='GuestBook.php' method="POST">
		<input id = 'iName' type = 'text' name= 'name' autofocus = 'autofocus' placeholder = 'Type your name' required ='required'><br>
		<textarea id = 'iMessage' name = 'message' placeholder = 'Enter your message' required = 'required' rows = 4></textarea><br>
		<input type = 'submit' name = 'Send'>
	</form>
	
	
	<?php 
	$myFile = "Text.txt";
	$fileA = fopen($myFile, 'a');
	$time = date('d-m-y h:i:s A');
	
	if (isset($_POST['name']) && isset($_POST['message'])) {
		$name = $_POST['name'];
		$message = $_POST['message'];
		fwrite($fileA, "<br>From: $name\n <br> Message: $message\n <br> Time: $time\n<br>");
	}
	
	$Fileread = fopen($myFile, 'r');
	$theData = fread($Fileread, filesize($myFile));
	
	echo "<p> $theData</p>";
	
	?>

<?php include 'BottomPage.php';?>