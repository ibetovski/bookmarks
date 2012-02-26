<?php

if ($_POST) {
    extract($_POST);
    
    // Зарежда букмарците
    if ($method == "set_color") {
        $db_websites = new db_websites;
        $res_color = $db_websites->set_color($bid,$color);
        print $res_color;
    }
}

?>