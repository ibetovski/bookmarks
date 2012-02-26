<?php
?>
<div class="topbar">
	<?php
		
		$search_str=(isset($_GET["search_str"]) ? $_GET["search_str"] : "");
		
		if (isset($_GET["catId"])) {
			$search=(($_GET["catId"]!=0 && $_GET["catId"]!="") ? "b_sites.catid=".$_GET["catId"] . " AND ": "")." b_sites.userid=". logedUser;
			$title="";
		} else {
			$search="b_sites.userid=". logedUser;
			$title=($search_str ? "Търсене" : "Всички");
		}
		
		$cat_title=new cat_title;
		$cat_title->pr_cat_title($search,"",$title);
		
		print "<div class=\"topbuttons\">";
		$add_bkm=new add_bkm;
		$edit_bkm=new edit_bkm;
		#$edit_bkm->pr_btn("[edit mode]","btn_edit_bkm",(isset($_GET["catId"]) ? $_GET["catId"] : 0));
		$GET_catid=(isset($_GET["catId"]) ? $_GET["catId"] : 0);
		$add_bkm->pr_btn("+ Добави","btn_add_bkm", url_params(array("add"=>1,"catid"=>$GET_catid)));
		print "</div>";
	
	?>
</div>