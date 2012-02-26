<?php
        /*
        #	EDIT metods
        ###############*/
        if (!isset($addForm))
                $addForm=new addForm;
        if (isset($_POST["submit"])) {
                    extract($_POST);
                foreach($_POST as $key => $val) {
                    $template->assign($key,$val);
                }
        
                    if (isset($b_title) && $b_title != "") {
                        if (isset($new_catname) && strlen($new_catname) > 0) {
                            $addForm->add_new_category($new_catname);
                        }
                    }
                if (!isset($b_title) || $b_title == "") {
                        $title = $addForm->getTitle($b_url);
                        $template->assign("b_title",$title);
                        $_POST["b_title"]=$title;
                        /*$img = $addForm->getImg($b_url);
                        $template->assign("b_img",$img);*/
                        
                }
                
                if ($_POST["action"] == "edit") {
                        $addForm->update($_POST["bid"]);
                        if (!isset($addForm->emptyFields)) {
                                header("Location: ". BASEDIR . "list/".CNTR_CAT . (CNTR_ACTION != "" ? "/" . CNTR_ACTION . "/" . CNTR_ACTIONID : ""));
                        }
                } elseif ($_POST["action"] == "add") {
                        $addForm->insert();
                        
                        if (!isset($addForm->emptyFields)) {
                                header("Location: ".BASEDIR. "list/".CNTR_CAT);
                        }
                }
        }
    
    
        if (isset($_POST["cancel"])) {
                header("Location: ". BASEDIR . "list/". CNTR_CAT);
        }
        if (isset($_POST["add_category"])) {
                extract($_POST);
                $addForm->add_new_category($catname);
                header("Location: ". BASEDIR . "list/");
        }
        
        
        if (isset($_POST["delete"])) {
            if (!isset($db_websites)) {
                    $db_websites = new db_websites;
            }
            $db_websites->delete($_POST["bid"]);
            header("Location: " .BASEDIR . "list/" . CNTR_CAT . (CNTR_ACTION != "" ? "/" . CNTR_ACTION . "/" . CNTR_ACTIONID : ""));
        }
        
        if (isset($_POST["delete_cat_confirm"])) {
                if (!isset($categories))
                        $categories = new categories;
                $categories->delete($_POST["catid"]);
                header("Location: " .BASEDIR. "list/");
        }
        
        if (isset($_POST["search"])) {
                header("Location: ".BASEDIR."search/".$_POST["search_str"]);
        }
        
?>