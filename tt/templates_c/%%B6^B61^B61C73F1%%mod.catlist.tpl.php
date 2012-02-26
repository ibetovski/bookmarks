<?php /* Smarty version 2.6.26, created on 2010-02-03 20:54:34
         compiled from mod.catlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mod.catlist.tpl', 11, false),)), $this); ?>
<div class="menu">
    <ul>
    <li <?php if ($this->_tpl_vars['cntr_cat'] == "" || $this->_tpl_vars['cntr_cat'] == 0): ?>class="cur"<?php endif; ?>><a href="<?php echo @BASEDIR; ?>
list/"><span>Последно добавени</span></a></li>
    <?php if ($this->_tpl_vars['user_cats'] != 0): ?>
    <?php $_from = $this->_tpl_vars['user_cats']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['parent_masiv'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['parent_masiv']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
        $this->_foreach['parent_masiv']['iteration']++;
?>
        <?php if ($this->_tpl_vars['id'] == $this->_tpl_vars['cntr_cat']): ?>
            <?php $this->assign('css_class', 'cur'); ?>
        <?php else: ?>
            <?php $this->assign('css_class', 'menuItem'); ?>
        <?php endif; ?>
       <li class="<?php echo $this->_tpl_vars['css_class']; ?>
"><a href="<?php echo @BASEDIR; ?>
list/<?php echo $this->_tpl_vars['id']; ?>
" title="<?php echo $this->_tpl_vars['name']; ?>
"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 44) : smarty_modifier_truncate($_tmp, 44)); ?>
</span></a></li>
    <?php endforeach; endif; unset($_from); ?>
    <ul>
    <?php endif; ?>
</div>