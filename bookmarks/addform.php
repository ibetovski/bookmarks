<?php
#$str .= "<form action=\"".url_params(array("editmode"=>0,"edit"=>0))."\" method=\"POST\">\n
#		\t\t<ul class=\"addform\">";

$str .= "<form method=\"POST\" class=\"addform clearfix\">\n
		\t\t<ul class=\"addform clearfix\">";
		
			//	проверява, дали има създадени категории и ако няма, предлага да създаде нова
			function select_categories() {
				global $str_debug;
				$sql = "SELECT *
						FROM ".TBL_CATEGORIES
						." WHERE (userid=".logedUser . ")";
				$str_debug .= $sql . "<hr />";
				$query = mysql_query($sql);
				$str .= "<b>Категория</b> <select name=\"catid\">";
				while ($checking = mysql_fetch_array($query)) {
					extract($checking);
					$str .= "<option value=\"$catid\"".(isset($_GET["catId"]) ? ($_GET["catId"] == $catid ? " selected" : "") : ($_POST ? $_POST["catid"] : $catid)).">$catname</option>";
				}
				$str .= "</select>";
				return $str;
			}
			/* Взима данните на букмарка при EDIT */
			if (isset($_POST["edit"])) {
				$s = "SELECT ".TBL_SITES."* FROM ".TBL_SITES.
					" LEFT JOIN ".TBL_CATEGORIES." USING (catid)
						WHERE bid=".$bid;
				$q = mysql_query($s) or die(mysql_error());
				$result = mysql_fetch_array($q);
				extract($result);
			}
			
			($_POST ? extract($_POST) : false);
			
			$sql = "SELECT *
					FROM ".TBL_CATEGORIES
					." WHERE (userid=".logedUser.")";
			$str_debug .= $sql . "<hr />";
			$query = mysql_query($sql) or die(mysql_error());
			$checking = mysql_num_rows($query);
			if ($checking != 0) {
					if (isset($_GET["edit"]) && $_GET["edit"]==$bid) {
						$str .= $addForm->print_input("hidden","bid","bid",$bid);
					}
					$str .= "<li><b>URL</b>".$addForm->print_input("text","b_url","b_url",$b_url);
					$str .= select_categories();
					
					$str .= "\t\t\t\n
						\t\t\t\t<b>или създайте нова</b>\n";
						$str .= $addForm->print_input("text","new_catname","new_catname",$new_catname);
						$str .= $addForm->print_input("hidden","userid","userid",logedUser);
					$str .= "\n";
					$str .= ((isset($addForm->emptyFields["b_title"]) && !isset($addForm->emptyFields["b_url"])) ? "<li><b>Заглавие</b>".$addForm->print_input("text","b_title","b_title",$b_title):"");
					$str .= "</li>
					<li><b>Описание</b><textarea name=\"b_desc\">$b_desc</textarea></li>";
					$str .= "</ul>";
					$str .= $addForm->print_error();
					$str .= $addForm->print_input("submit","submit","submit","Запиши");
					$str .= $addForm->print_input("submit","cancel","cancel","Отказ");
			} else {
					$str .= "<p>Няма създадени категории</p>
					<b>Име на категория</b>";
					$str .= $addForm->print_input("hidden","userid","userid",logedUser);
					$str .= $addForm->print_input("text","catname","catname",$catname);
					$str .= "<input type=\"submit\" name=\"add_category\" value=\"запиши\" />";
			}
$str .= "</form>";
