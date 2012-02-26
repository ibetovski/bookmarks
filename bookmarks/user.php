<?php

	include("../lib/config.php");
	include(ROOTDIR . "/login/login_check.php");
	html_begin($title);
?>
<div class="main">
	<?php
		include(ROOTDIR . "/bookmarks/cats.php");
	?>
	<div class="bookmarks">
		<ol>
		<?php
			if (isset($_GET['id'])){
				
				//показва букмарките за категорията със съответното ИД
				$GET_id = $_GET['id'];
				$get_username_sql = "SELECT * FROM b_users WHERE userid=$GET_id";
				$get_username_query = mysql_query($get_username_sql);
				$get_username = mysql_fetch_array($get_username_query);
				extract($get_username);
				print "<h3>Отметки, добавени от ($u_nick)</h3>";
				$sql = "SELECT b_sites.*, b_categories.*
						FROM b_sites
						LEFT JOIN b_categories on (b_sites.catid=b_categories.catid)
						WHERE userid='$GET_id'";
				$query = mysql_query($sql);
				while ($row = mysql_fetch_array($query)) {
				extract($row);
				?>
					<li><a href="<?=$b_url?>"><?=$b_title?></a> <b>(<a href="<?=BASEDIR?>bookmarks/list.php?catId=<?=$catid?>"><?=$catname?></a>)</b></li>
						<!--<td>
							<a href="edit.php?bid=<?=$bid?>">Edit</a>
						</td>//-->
				<?php
			}
			}
		?>
		</ol>
	</div>
</div>
<?php
	html_end();
?>
