<?php
	
	class page {
		#
		#	SQL променливи за генериране на заявка
		var $distinct=0;
		var $cols="*";
		var $fnc_cols="";
		var $table="";
		var $group="";
		var $uxtime="";
		var $joins="";
		var $orderby="";
		var $limit="";
		function make_query($sql_where,$sql_search,$limit) {
			
			global $str_debug;
			
			$database = new MySQLDB;
			
			if ($sql_search) {
				$search_masiv = explode(" ",$sql_search);
				$b_title = "b_sites.b_title";
				$b_desc = "b_sites.b_desc";
				$sql_search="";
				if (isset($this->sql_replace)) {
					$max_index = count($search_masiv) - 1;
					foreach ($search_masiv as $key =>$word) {
						$b_title="REPLACE($b_title, '$word', '<b>$word</b>')";
						$b_desc="REPLACE($b_desc, '$word', '<b>$word</b>')";
						
						$sql_search .= " \n(b_title LIKE '%$word%' OR b_desc LIKE '%$word%') ";
						$sql_search .=($key != $max_index ? " OR " : "");
					}
					$b_title .= " as 'replace_b_title'";
					$b_desc .= " as 'replace_b_desc'";
					array_push($this->cols,$b_title,$b_desc);
				}
			}
			
			$this->where = "WHERE ";
			$this->where .= "(b_sites.userid=" . logedUser .")".(($sql_where || $sql_search) ? " AND " : "");
			$this->where .= $sql_where .(($sql_where && $sql_search) ? " AND " : "") . ($sql_search ? "(".$sql_search.")" : ""); 	// добавям скоби около sql_search, за да не търси в другите юзъри
			
			if ($limit) {
				$this->limit = "\nLIMIT ".$limit;
			}
			//	прави стринг със сумирани колони
			$fnc_cols="";
			if (isset($this->fnc_cols) && is_array($this->fnc_cols) && !empty($this->fnc_cols)) {
				$fnc_cols_cnt = count($this->fnc_cols);
				$cnt=1;
				foreach($this->fnc_cols as $col => $value) {
					$fnc_cols .= $value . "(".$col.") AS '".$col."'" . ($cnt != $sumcols_cnt ? ", \n\t" : " \n");
					$cnt++;
				}
			}
			$cols="";
			if (isset($this->cols) && is_array($this->cols) && !empty($this->cols)) {
				$cols .= implode(',',$this->cols);
				$cols .=(isset($sumcols) ? "," : "");
			} else {
				$cols = $this->cols;
			}
			//	прави стринг с LEFT JOIN
			$joins="";
			foreach($this->joins as $jtable => $relcol) {
				if (!is_array($relcol)) {
					$joins .= "\t LEFT JOIN ".$jtable;
					if (strpos($relcol,'.') == false) {
						$joins .= " USING (".$relcol.") \n";
					} else {
						list($tmp_table, $tmp_relcol) = split("[.]",$relcol);
						$joins .= " ON (".$jtable.".".$tmp_relcol."=".$this->table.".".$tmp_relcol.")\n";
					}
				} else {
					$joins .= "\t LEFT JOIN ".$jtable." ON (";
					foreach($relcol as $col1 => $col2) {
						//	проверява, дали ключа съществува в масива за TIMESTAMP
						if (array_key_exists($col1,$this->uxtime)) {
							$timecol1 = "FROM_UNIXTIME(".$this->table.".".$col1.",'".$this->uxtime[$col1]."')";
						}
						if (array_key_exists($col2,$this->uxtime)) {
							$timecol2 = "FROM_UNIXTIME(".$jtable.".".$col2.",'".$this->uxtime[$col2]."')";
						}
						$joins .= (array_key_exists($col1,$this->uxtime) ? $timecol1 : $this->table.".".$col1) ."=";		//	колона 1 - TIMESTAMP
						$joins .= (array_key_exists($col2,$this->uxtime) ? $timecol2 : $jtable.".".$col2);					//	колона 2 - TIMESTAMP
						$joins .= ($col1 == max($relcol) ? " AND " : ")\n");		//	ако околоната не е последна в масива, да добави AND
					}
				}
			}
			//	добавя order by, ако е посочено
			$orderby=($this->orderby != "" ? "\nORDER BY " . $this->orderby : "");
			//	добавя дистинкт, ако е посочен като 1
			$distinct=($this->distinct ? "DISTINCT " : "");
			$sql = "SELECT ".$distinct.(isset($cols) ? $cols : "").(isset($sumcols) ? $sumcols : "")." \nFROM ".$this->table . "\n". $joins . $this->where . $this->group . $orderby . $this->limit;
			$str_debug .= htmlspecialchars($sql) . "<hr />";
			$this->query = mysql_query($sql) or die(mysql_error());
		}
		
	}
			
			
	#++++++++++++++++++++++
	#
	#	БУТОНИ
	#
	#++++++++++++++++++++++
	class buttons extends page {
		var $file="";
		function pr_btn($txt="",$name="",$params="") {
			if ($this->show) {
				$str="";
				$str .= "<a href=\"".BASEDIR.$this->subfolder.$this->file.($params != "" ? $params : "")."\" class=\"button ".$name."\" id=\"".$name."\">\n";
				$str .="\t<span>".$txt."</span>\n";
				$str .="</a>\n";
				print $str;
			}
		}
	}
		#	бутон за добавяне на букмарк
		class add_bkm extends buttons {
			var $file="list.php";
			var $subfolder="bookmarks/";
			var $id="catId";
			var $show=1;

			function add_bkm() {
				$this->show = (EDITPAGE ? 0 : 1);
			}
		}
		class edit_bkm extends buttons {
			var $file="add.php";
			var $subfolder="bookmarks/";
			var $id="catId";
			var $show=1;
			function edit_bkm() {
				$this->show = (EDITPAGE ? 0 : 1);
			}
			function pr_btn($txt="",$name="",$id="") {
				if ($this->show) {
					$str="";
					$set = ((isset($_GET["editmode"]) && $_GET["editmode"]==1) ? 0 : 1);
					$str .= "<a href=\"".url_params(array("editmode"=>$set))."\" class=\"button ".$name."\" id=\"".$name."\">\n";
					$str .="\t<span>".$txt."</span>\n";
					$str .="</a>\n";
					print $str;
				}
			}
		}
		#	бутон за logout
		class btn_logout extends buttons {
			var $file="logout.php";
			var $subfolder="login/";
			var $show=1;
		}
	
	class cat_title extends page {
		var $cols=array("catname");
		var $table="b_sites";
		var $joins=array(
						"b_categories"	=>	"catid",
						"b_users"		=>	"b_sites.userid"
						);
	}
?>