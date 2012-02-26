<?php

	class nomenclature {
		var $values;
		function insert() {
			$query="INSERT INTO " . $this->table  . "(".implode(",", $this->columns).") VALUES (".implode(",", $this->values).")";
			print $query;
			mysql_query($query);
			header("Location: " . BASEDIR . $this->hdrlocation);
		}
			
		function nomenclature() {
			foreach ($this->columns as $field) {
					$this->values[$field]="\"".$this->clean_input($_POST[$field])."\"";
			}
		}
		function clean_input($input) {
			if(get_magic_quotes_gpc() ) $input = stripslashes($input);
			$input = strip_tags($input);
			return mysql_real_escape_string($input);
		}
	}
	
	class bookmark extends nomenclature {
		var $table="b_sites";
		var $columns=array('userid', 'catid', 'b_title', 'b_url', 'b_desc');
		var $insertlocation = "bookmarks/list.php";
		//var $hdrlocation = "/emp/list.php";
		function insert() {
			if (isset($_POST["new_catname"])) {
				if (strlen($_POST["new_catname"]) != 0) {
					$new_catname = $_POST["new_catname"];
					$add_category_sql = "INSERT INTO b_categories (catname,userid) VALUES ('$new_catname','".logedUser."')";
					$add_category_query = mysql_query($add_category_sql);
					$get_new_id_sql = "SELECT MAX(catid) as catid FROM b_categories WHERE userid='".logedUser."'";
					$get_new_id_query = mysql_query($get_new_id_sql) or die(mysql_error());
					$get_new_id = mysql_fetch_array($get_new_id_query);
					extract($get_new_id);
					$this->values["catid"] = $catid;
				}
			}
			$query="INSERT INTO " . $this->table  . "(".implode(",", $this->columns).") VALUES (".implode(",", $this->values).")";
			mysql_query($query);
			header("Location: " . BASEDIR . $this->insertlocation);
		}
	}
	class category extends nomenclature {
		var $table="b_categories";
		var $columns=array('catname','userid');
		var $insertlocation="bookmarks/add.php";
		//var $hdrlocation = "/emp/list.php";
	}