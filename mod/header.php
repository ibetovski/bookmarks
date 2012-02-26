<?php
    $db_users = new db_users;
    $username = $db_users->show_logedUser();
    $search_str=(CNTR_PAGE != "search" ? "Търсене..." : CNTR_CAT);
    $template->assign("search_str",$search_str);
    if ($_GET) {
        extract($_GET);
        foreach($_GET as $key => $val) {
            $template->assign($key,$val);
        }
    }
    $template->assign("logedUser",$username);
    $forms = new forms;
    $template->register_object("forms",$forms,null,false);
    $template->display("mod.header.tpl");
?>