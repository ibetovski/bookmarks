<?php /* Smarty version 2.6.26, created on 2010-07-11 13:11:26
         compiled from mod.bkmlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'mod.bkmlist.tpl', 20, false),array('modifier', 'nl2br', 'mod.bkmlist.tpl', 21, false),)), $this); ?>
<div class="bookmarks_list clearfix">
    <?php if ($this->_tpl_vars['user_cats'] == 0): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.nocategories.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
        <ol class="bkm_list" start=<?php echo $this->_tpl_vars['list_start_number']; ?>
>
            <?php if ($this->_tpl_vars['websites'] == 0): ?>
                <p>Няма резултати</p>
            <?php else: ?>
                <?php $_from = $this->_tpl_vars['websites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child_masiv'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child_masiv']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['foo'] => $this->_tpl_vars['value']):
        $this->_foreach['child_masiv']['iteration']++;
?>
                                        <li class="<?php if (!(1 & ($this->_foreach['child_masiv']['iteration']-1))): ?>even<?php else: ?>odd<?php endif; ?>"<?php if ($this->_tpl_vars['value']['color_code']): ?> style="background:rgba(<?php echo $this->_tpl_vars['value']['color_code']; ?>
,0.6)"<?php endif; ?>>
                        <?php if (@CNTR_PAGE != 'edit'): ?>
                            <form method="POST" name="delete_edit" class="delete_edit" action="<?php echo @BASEDIR; ?>
list/<?php echo @CNTR_CAT; ?>
<?php if ($this->_tpl_vars['cur_page'] != 1): ?>/page/<?php echo $this->_tpl_vars['cur_page']; ?>
<?php endif; ?>">
                                <input type="hidden" name="bid" id="id" value="<?php echo $this->_tpl_vars['foo']; ?>
" />
                                <input type="hidden" name="action" id="id" value="foo" />
                                <input type="submit" name="delete" class="delete" id="delete" value="Изтрий" />
                                <input type="submit" name="edit" class="edit" id="edit" class="edit" value="Редактирай" />
                            </form>
                        <?php endif; ?>
                        <a href="<?php echo $this->_tpl_vars['value']['url']; ?>
" target="_blank" id="link-<?php echo ($this->_foreach['child_masiv']['iteration']-1); ?>
" title="<?php echo $this->_tpl_vars['value']['name']; ?>
"><?php if (isset ( $this->_tpl_vars['value']['replace_name'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['replace_name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 65) : smarty_modifier_truncate($_tmp, 65)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 65) : smarty_modifier_truncate($_tmp, 65)); ?>
<?php endif; ?></a>
                        <p class="desc clearfix"><?php if (isset ( $this->_tpl_vars['value']['replace_desc'] )): ?><?php echo smarty_modifier_nl2br($this->_tpl_vars['value']['replace_desc']); ?>
<?php else: ?><?php echo smarty_modifier_nl2br($this->_tpl_vars['value']['desc']); ?>
<?php endif; ?></p>
                        <span class="link"><a href="<?php echo $this->_tpl_vars['value']['url']; ?>
" target="_blank"><?php if (isset ( $this->_tpl_vars['value']['replace_url'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['replace_url'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 85) : smarty_modifier_truncate($_tmp, 85)); ?>
<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['value']['url'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 85) : smarty_modifier_truncate($_tmp, 85)); ?>
<?php endif; ?></a></span>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.set_color.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <?php if (! @CNTR_CAT || @CNTR_PAGE == 'search'): ?>
                        <small>от <a href="<?php echo @BASEDIR; ?>
list/<?php echo $this->_tpl_vars['value']['catid']; ?>
"><?php echo $this->_tpl_vars['value']['catname']; ?>
</a></small><?php endif; ?>
                        <?php if ($_POST['action'] && $_POST['delete_cat'] == false && $_POST['bid'] == $this->_tpl_vars['foo']): ?>
                            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.addform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                        <?php endif; ?>
                    </li>
                <?php endforeach; endif; unset($_from); ?>
            <?php endif; ?>
        </ol>
        <?php if (@CNTR_PAGE == 'add'): ?>
            <?php $this->assign('action', 'add'); ?>
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.addform.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mod.delcat.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>