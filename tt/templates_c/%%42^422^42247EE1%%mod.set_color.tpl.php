<?php /* Smarty version 2.6.26, created on 2010-07-11 14:02:31
         compiled from mod.set_color.tpl */ ?>
<div class="color_chooser">
<a href="#" class="show_colors">Оцвети</a>
<span class="choose_color">
    <a href="#" class="set_color_btn set_no_color">0</a>
    <?php $this->assign('i', 1); ?>
    <?php $_from = $this->_tpl_vars['colors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['colors_cycle'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['colors_cycle']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item'] => $this->_tpl_vars['color']):
        $this->_foreach['colors_cycle']['iteration']++;
?>
        <a href="#" class="set_color_btn" title="<?php echo $this->_tpl_vars['color']['name']; ?>
" style="background: rgb(<?php echo $this->_tpl_vars['color']['code']; ?>
)"><?php echo $this->_tpl_vars['i']; ?>
</a>
        <?php $this->assign('i', $this->_tpl_vars['i']+1); ?>
    <?php endforeach; endif; unset($_from); ?>
</span>
</div>