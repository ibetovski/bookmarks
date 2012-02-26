<?php /* Smarty version 2.6.26, created on 2010-01-31 12:56:33
         compiled from mod.nocategories.tpl */ ?>
<form method="POST" class="addform clearfix">
    <p>Няма създадени категории</p>
    <b>Име на категория</b>
    <?php echo $this->_reg_objects['forms'][0]->print_input('hidden','userid','userid',@logedUser);?>

    <?php echo $this->_reg_objects['forms'][0]->print_input('text','catname','catname',$this->_tpl_vars['catname']);?>

    <input type="submit" name="add_category" value="запиши" />
</form>