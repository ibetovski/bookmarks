<?php
?>
<div class="header">
	<h1><a href="<?=BASEDIR?>">My Bookmarks</a></h1>
	<?php
		
		$search_str=(isset($_GET["search_str"]) ? $_GET["search_str"] : "");
		
		$searchbox=new searchbox;
		$searchbox->print_search("form",$search_str);
		
		$btn_logout=new btn_logout;
		$btn_logout->pr_btn("Изход","btn_logout");
		$db_users = new db_users;
		print "<p>".$db_users->show_logedUser()."</p>";
	?>
</div>