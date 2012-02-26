<?php
    include("forms.php");
    $addForm = new addForm;
    
    $newTitle = $addForm->getTitle($_POST["b_url"]);
    print $newTitle;
    
?>