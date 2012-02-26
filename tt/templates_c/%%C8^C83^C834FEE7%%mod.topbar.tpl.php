<?php /* Smarty version 2.6.26, created on 2010-02-03 20:55:39
         compiled from mod.topbar.tpl */ ?>
<div class="topbar">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.pages.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <h2><?php if ($this->_tpl_vars['cntr_cat'] == "" || $this->_tpl_vars['cntr_cat'] == 0): ?><?php echo $this->_tpl_vars['mod_title']; ?>
<?php else: ?><?php echo $this->_tpl_vars['user_cats'][$this->_tpl_vars['cntr_cat']]; ?>
<?php endif; ?><span class="cnt"><b><?php echo $this->_tpl_vars['cnt_bkm']; ?>
</b></span></h2>
    <div class="topbuttons">
        <a href="<?php echo @BASEDIR; ?>
add/<?php if ($this->_tpl_vars['cntr_cat'] == ""): ?>0<?php else: ?><?php echo $this->_tpl_vars['cntr_cat']; ?>
<?php endif; ?>" class="button btn_add_bkm" id="btn_add_bkm">
            <span>+ Добави</span>
        </a>
    </div>
</div>
<div class="clearfix"></div>