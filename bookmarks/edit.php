<?php
session_start();
	include("../lib/config.php");
	
	html_begin($title);

//get bookmark ID
$bid = $_GET['bid'];

?>
<div class="main">
<form action="edit.php" method="POST">
	<table border="1">
		<?php
		//показва текущите данни за букмарките в текстовите полета
		$sql = "SELECT * FROM b_sites WHERE bid='$bid'";
		$query = mysql_query($sql);
		while ($row = mysql_fetch_array($query)) {
			extract($row);
			?>	
				<tr>
					<td><input type="text" name="bookmarkTitle" value="<?=$b_title?>" size="60"></td>
				</tr>
				<tr>
					<td><input type="text" name="bookmarkDesc" value="<?=$b_desc?>" size="60"></td>
				</tr>
				<tr>
					<td><input type="text" name="bookmarkURL" value="<?=$b_url?>" size="60"></td>
				</tr>
				<tr>
					<td><input type="hidden" name="bid" value="<?=$bid?>"></td>
				</tr>
			<?php
		}
	?>
		
	</table>
	<p>
	<input type="submit" name="submit" value="Submit" />
	<input type="button" value="Back" onclick="javascript:parent.location = 'list.php'" />
	</p>
	<?php
	//ъпдейтва базата с редактираните данни - ако нищо не се промени, просто ъпдейтва текущите данни
		if (isset($_POST["submit"])){
			$bTitle = $_POST['bookmarkTitle'];
			$bDesc = $_POST['bookmarkDesc'];
			$bURL = $_POST['bookmarkURL'];
			$bID= $_POST['bid'];
			
			$sqlUpdate = "UPDATE b_sites SET b_url='$bURL', b_title='$bTitle', b_desc='$bDesc' WHERE bid='$bID'";
			$updateQuery = mysql_query($sqlUpdate) or die("Error:" . $mysql_error());
			
			if($updateQuery){
				echo "Вашата промяна беше записана успешно.";
			}else {
				echo "Промяната ви беше неуспешна. Моля опитайте по-късно.";
			}
		}
	?>
</form>
</div>
<?php

	html_end();
?>
