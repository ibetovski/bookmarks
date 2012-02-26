<?php
    $db_users = new db_users;
    $users = $db_users->get_active_users();
    $template->assign("active_users",$users);
    $template->display("mod.footer.tpl");
    print_debug($str_debug);
    #$cnt = mysql_num_rows($db_users->act_users_query);
    #print "регистринаи: " . $cnt . "<br />";
    #print "гости: " . $db_users->cnt_guests();
?>