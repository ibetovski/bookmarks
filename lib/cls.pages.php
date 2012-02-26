<?php
    class pages {
	var $page_number = 1;
	var $offset = 0;
	var $num = 1;
	var $sqlWithPages;
	var $total_pages;
	//	изпълняване на SQL Заявка за страници
	function mysql_pages($sql) {
		$count_all = mysql_query($sql) or die(mysql_error());
		$count_all_row = mysql_num_rows($count_all);
                $this->page_number = (CNTR_ACTION == "page" ? (CNTR_ACTIONID == "" ? 1 : CNTR_ACTIONID) : 1);
		$this->total_pages = ceil($count_all_row / $this->entries_per_page);
		$this->offset = ( $this->page_number - 1) * $this->entries_per_page;
		($this->page_number == 1 ? $this->num=1 : $this->num = $this->offset + 1);
		$this->sqlWithPages = $sql .  " limit " . $this->offset . ", ". $this->entries_per_page;
                
                
		$i 		= 0;
		$step 	= 5;
		$middle = $this->total_pages / 2;
		$middle = ceil($middle);
		$total 	= $this->total_pages;
		$current = $this->page_number;
	}
    }
    
    class bookmarks_pages extends pages {
        var $entries_per_page = 10;
    }
?>