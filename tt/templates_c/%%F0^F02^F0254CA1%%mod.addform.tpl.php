<?php /* Smarty version 2.6.26, created on 2010-02-13 17:43:29
         compiled from mod.addform.tpl */ ?>
<div class="covering"></div>
<div class="above_all">
    <form method="POST" class="addform clearfix">
        <h3><?php if (@CNTR_PAGE == 'add'): ?>Добавяне на отметка<?php else: ?>Редактиране на отметка<?php endif; ?></h3>
        <ul class="addform clearfix">
            <li><b>URL</b><?php echo $this->_reg_objects['forms'][0]->print_input('text','b_url','b_url',$this->_tpl_vars['b_url']);?>
<a href="#" id="clearUrl" title="Изчисти адреса">Изчисти адреса</a><li>
            <li><b>Заглавие</b><?php echo $this->_reg_objects['forms'][0]->print_input('text','b_title','b_title',$this->_tpl_vars['b_title']);?>
</li>
            <li><b>Категория</b><?php echo $this->_reg_objects['forms'][0]->print_select($this->_tpl_vars['user_cats'],'catid',$this->_tpl_vars['catid']);?>
</li>
            <li><b>Или създайте нова</b>
                <?php echo $this->_reg_objects['forms'][0]->print_input('text','new_catname','new_catname',$this->_tpl_vars['new_catname']);?>

                <?php echo $this->_reg_objects['forms'][0]->print_input('hidden','userid','userid',@logedUser);?>

                <?php echo $this->_reg_objects['forms'][0]->print_input('hidden','action','action',$this->_tpl_vars['action']);?>

                <?php echo $this->_reg_objects['forms'][0]->print_input('hidden','bid','bid',$_POST['bid']);?>

            </li>
            <li>
                                                <b>Описание</b><?php echo $this->_reg_objects['forms'][0]->print_textarea('b_desc','b_desc',$this->_tpl_vars['b_desc']);?>

            </li>
            <li>
            <?php if (isset ( $this->_tpl_vars['b_img'] ) && $this->_tpl_vars['b_img'] != 0): ?>
                <ul class="arrThumbs">
                    <?php $_from = $this->_tpl_vars['b_img']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['arrName'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['arrName']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['val']):
        $this->_foreach['arrName']['iteration']++;
?>
                    <li>
                        <img src="<?php echo $this->_tpl_vars['val']; ?>
" width="100" />
                    </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            <?php endif; ?>
            </li>
        </ul>
        <?php echo $this->_reg_objects['forms'][0]->print_input('submit','submit','submit',"Запиши");?>

        <?php echo $this->_reg_objects['forms'][0]->print_input('submit','cancel','cancel',"Отказ");?>

    </form>
</div>