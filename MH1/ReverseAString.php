<?php include 'TopPage.php';?>
	<style>
	#output{
		text-align: center;
	}
	</style>
	<p id = 'output'>
		I will reverse a string for you :D
	</p>

	
	<form action='ReverseAString.php' method="POST">
		<input id = 'iName' type = 'text' name= 'name' autofocus = 'autofocus' placeholder = 'Enter The Dungeon' required ='required'><br>
		<input type = 'submit' name = 'Send'>
	</form>
	<?php 
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$reversed = strrev($name);
		echo "<p id = 'output'> Here is the string reversed: $reversed </p>";
}
	
	
	
	
	?>

<?php include 'BottomPage.php';?>