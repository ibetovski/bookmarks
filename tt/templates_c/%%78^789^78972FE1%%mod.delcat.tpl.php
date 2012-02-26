<?php /* Smarty version 2.6.26, created on 2010-02-13 18:41:43
         compiled from mod.delcat.tpl */ ?>
<?php if (@CNTR_CAT != ""): ?>
    <div class="delete_category">
	<form name="delete_category" method="post" action="<?php echo @BASEDIR; ?>
list/<?php echo @CNTR_CAT; ?>
">
	    <?php if ($this->_tpl_vars['cnt_bkm'] < 1): ?>
		<?php echo $this->_reg_objects['forms'][0]->print_input('hidden','catid','delete_cat_confirm','1');?>

	    <?php endif; ?>
	    <?php echo $this->_reg_objects['forms'][0]->print_input('hidden','catid','catid',@CNTR_CAT);?>

	    <?php echo $this->_reg_objects['forms'][0]->print_input('submit','submit','delete_cat',"Изтрии категорията");?>

	</form>
    </div>
<?php endif; ?>

<?php if (isset ( $_POST['delete_cat'] ) && $this->_tpl_vars['cnt_bkm'] > 0): ?>
<div class="covering"></div>
<div class="above_all">
    <form name="delete_category_confirm" method="post">
	<h3>Потвърждавате ли изтриването на тази категория?</h3>
	<p>Изтривайки тази категория, вие ще изтриете всички отметки, които тя съдържа.</p>
	<p>Потвърждавате ли?</p>
	<?php echo $this->_reg_objects['forms'][0]->print_input('hidden','catid','catid',@CNTR_CAT);?>

	<?php echo $this->_reg_objects['forms'][0]->print_input('submit','cancel','cancel',"Отказ");?>

	<?php echo $this->_reg_objects['forms'][0]->print_input('submit','submit','delete_cat_confirm',"Потвърди");?>

    </form>
</div>
<?php endif; ?>