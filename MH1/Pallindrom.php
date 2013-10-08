<?php include 'TopPage.php';?>
		<style>
	#output{
		text-align: center;
	}
	</style>
	<p id = 'output'>
		Is it a Pallindrom ?
	</p>

	
	<form action='Pallindrom.php' method="POST">
		<input id = 'iName' type = 'text' name= 'name' autofocus = 'autofocus' placeholder = 'Enter The Dungeon' required ='required'><br>
		<input type = 'submit' name = 'Send'>
	</form>
	<?php 
	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$name = str_replace(" ", "", $name);
		$reversed = strrev($name);
		if (strtolower($name) == strtolower($reversed)) {
			echo "<p id = 'output'>Yes it is: $name </p>";
		}
		else {
		echo "<p id = 'output'> Not a Pallindrom </p>";
		}
}
	
	
	
	
	?>
<?php include 'BottomPage.php';?>