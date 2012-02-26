<?php /* Smarty version 2.6.26, created on 2010-02-09 21:49:54
         compiled from mod.pages.tpl */ ?>
<div class="pages clearfix">
    <?php if ($this->_tpl_vars['total_pages'] > 1): ?>
    <ul>
        <?php $this->assign('page_step', 3); ?>
        <?php if ($this->_tpl_vars['cur_page']-$this->_tpl_vars['page_step'] <= $this->_tpl_vars['page_step']+1): ?>
            <?php $this->assign('loop_value1', 1); ?>
        <?php else: ?>
            <?php $this->assign('loop_value1', $this->_tpl_vars['cur_page']-$this->_tpl_vars['page_step']); ?>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['cur_page']+$this->_tpl_vars['page_step'] > $this->_tpl_vars['total_pages']- ( $this->_tpl_vars['page_step'] + 1 )): ?>
            <?php $this->assign('loop_value2', $this->_tpl_vars['total_pages']); ?>
        <?php else: ?>
            <?php $this->assign('loop_value2', $this->_tpl_vars['cur_page']+$this->_tpl_vars['page_step']); ?>
        <?php endif; ?>
        
        <?php if ($this->_tpl_vars['cur_page'] - ( $this->_tpl_vars['page_step'] + 1 ) > $this->_tpl_vars['page_step']): ?>
            <?php unset($this->_sections['pages_list1']);
$this->_sections['pages_list1']['name'] = 'pages_list1';
$this->_sections['pages_list1']['start'] = (int)1;
$this->_sections['pages_list1']['loop'] = is_array($_loop=$this->_tpl_vars['page_step']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pages_list1']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pages_list1']['show'] = true;
$this->_sections['pages_list1']['max'] = $this->_sections['pages_list1']['loop'];
if ($this->_sections['pages_list1']['start'] < 0)
    $this->_sections['pages_list1']['start'] = max($this->_sections['pages_list1']['step'] > 0 ? 0 : -1, $this->_sections['pages_list1']['loop'] + $this->_sections['pages_list1']['start']);
else
    $this->_sections['pages_list1']['start'] = min($this->_sections['pages_list1']['start'], $this->_sections['pages_list1']['step'] > 0 ? $this->_sections['pages_list1']['loop'] : $this->_sections['pages_list1']['loop']-1);
if ($this->_sections['pages_list1']['show']) {
    $this->_sections['pages_list1']['total'] = min(ceil(($this->_sections['pages_list1']['step'] > 0 ? $this->_sections['pages_list1']['loop'] - $this->_sections['pages_list1']['start'] : $this->_sections['pages_list1']['start']+1)/abs($this->_sections['pages_list1']['step'])), $this->_sections['pages_list1']['max']);
    if ($this->_sections['pages_list1']['total'] == 0)
        $this->_sections['pages_list1']['show'] = false;
} else
    $this->_sections['pages_list1']['total'] = 0;
if ($this->_sections['pages_list1']['show']):

            for ($this->_sections['pages_list1']['index'] = $this->_sections['pages_list1']['start'], $this->_sections['pages_list1']['iteration'] = 1;
                 $this->_sections['pages_list1']['iteration'] <= $this->_sections['pages_list1']['total'];
                 $this->_sections['pages_list1']['index'] += $this->_sections['pages_list1']['step'], $this->_sections['pages_list1']['iteration']++):
$this->_sections['pages_list1']['rownum'] = $this->_sections['pages_list1']['iteration'];
$this->_sections['pages_list1']['index_prev'] = $this->_sections['pages_list1']['index'] - $this->_sections['pages_list1']['step'];
$this->_sections['pages_list1']['index_next'] = $this->_sections['pages_list1']['index'] + $this->_sections['pages_list1']['step'];
$this->_sections['pages_list1']['first']      = ($this->_sections['pages_list1']['iteration'] == 1);
$this->_sections['pages_list1']['last']       = ($this->_sections['pages_list1']['iteration'] == $this->_sections['pages_list1']['total']);
?>
            <li <?php if ($this->_tpl_vars['cur_page'] == $this->_sections['pages_list1']['index']): ?>class="cur<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['page_link']; ?>
<?php echo $this->_sections['pages_list1']['index']; ?>
">
                    <?php echo $this->_sections['pages_list1']['index']; ?>

                </a>
            </li>
            <?php endfor; endif; ?>
            <li><span>...</span></li>
        <?php endif; ?>
        
        
        <?php unset($this->_sections['pages_list2']);
$this->_sections['pages_list2']['name'] = 'pages_list2';
$this->_sections['pages_list2']['start'] = (int)$this->_tpl_vars['loop_value1'];
$this->_sections['pages_list2']['loop'] = is_array($_loop=$this->_tpl_vars['cur_page']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pages_list2']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pages_list2']['show'] = true;
$this->_sections['pages_list2']['max'] = $this->_sections['pages_list2']['loop'];
if ($this->_sections['pages_list2']['start'] < 0)
    $this->_sections['pages_list2']['start'] = max($this->_sections['pages_list2']['step'] > 0 ? 0 : -1, $this->_sections['pages_list2']['loop'] + $this->_sections['pages_list2']['start']);
else
    $this->_sections['pages_list2']['start'] = min($this->_sections['pages_list2']['start'], $this->_sections['pages_list2']['step'] > 0 ? $this->_sections['pages_list2']['loop'] : $this->_sections['pages_list2']['loop']-1);
if ($this->_sections['pages_list2']['show']) {
    $this->_sections['pages_list2']['total'] = min(ceil(($this->_sections['pages_list2']['step'] > 0 ? $this->_sections['pages_list2']['loop'] - $this->_sections['pages_list2']['start'] : $this->_sections['pages_list2']['start']+1)/abs($this->_sections['pages_list2']['step'])), $this->_sections['pages_list2']['max']);
    if ($this->_sections['pages_list2']['total'] == 0)
        $this->_sections['pages_list2']['show'] = false;
} else
    $this->_sections['pages_list2']['total'] = 0;
if ($this->_sections['pages_list2']['show']):

            for ($this->_sections['pages_list2']['index'] = $this->_sections['pages_list2']['start'], $this->_sections['pages_list2']['iteration'] = 1;
                 $this->_sections['pages_list2']['iteration'] <= $this->_sections['pages_list2']['total'];
                 $this->_sections['pages_list2']['index'] += $this->_sections['pages_list2']['step'], $this->_sections['pages_list2']['iteration']++):
$this->_sections['pages_list2']['rownum'] = $this->_sections['pages_list2']['iteration'];
$this->_sections['pages_list2']['index_prev'] = $this->_sections['pages_list2']['index'] - $this->_sections['pages_list2']['step'];
$this->_sections['pages_list2']['index_next'] = $this->_sections['pages_list2']['index'] + $this->_sections['pages_list2']['step'];
$this->_sections['pages_list2']['first']      = ($this->_sections['pages_list2']['iteration'] == 1);
$this->_sections['pages_list2']['last']       = ($this->_sections['pages_list2']['iteration'] == $this->_sections['pages_list2']['total']);
?>
        <li <?php if ($this->_tpl_vars['cur_page'] == $this->_sections['pages_list2']['index']): ?>class="cur<?php endif; ?>">
            <a href="<?php echo $this->_tpl_vars['page_link']; ?>
<?php echo $this->_sections['pages_list2']['index']; ?>
">
                <?php echo $this->_sections['pages_list2']['index']; ?>

            </a>
        </li>
        <?php endfor; endif; ?>
        
        <?php unset($this->_sections['pages_list3']);
$this->_sections['pages_list3']['name'] = 'pages_list3';
$this->_sections['pages_list3']['start'] = (int)$this->_tpl_vars['cur_page'];
$this->_sections['pages_list3']['loop'] = is_array($_loop=$this->_tpl_vars['loop_value2']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pages_list3']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pages_list3']['show'] = true;
$this->_sections['pages_list3']['max'] = $this->_sections['pages_list3']['loop'];
if ($this->_sections['pages_list3']['start'] < 0)
    $this->_sections['pages_list3']['start'] = max($this->_sections['pages_list3']['step'] > 0 ? 0 : -1, $this->_sections['pages_list3']['loop'] + $this->_sections['pages_list3']['start']);
else
    $this->_sections['pages_list3']['start'] = min($this->_sections['pages_list3']['start'], $this->_sections['pages_list3']['step'] > 0 ? $this->_sections['pages_list3']['loop'] : $this->_sections['pages_list3']['loop']-1);
if ($this->_sections['pages_list3']['show']) {
    $this->_sections['pages_list3']['total'] = min(ceil(($this->_sections['pages_list3']['step'] > 0 ? $this->_sections['pages_list3']['loop'] - $this->_sections['pages_list3']['start'] : $this->_sections['pages_list3']['start']+1)/abs($this->_sections['pages_list3']['step'])), $this->_sections['pages_list3']['max']);
    if ($this->_sections['pages_list3']['total'] == 0)
        $this->_sections['pages_list3']['show'] = false;
} else
    $this->_sections['pages_list3']['total'] = 0;
if ($this->_sections['pages_list3']['show']):

            for ($this->_sections['pages_list3']['index'] = $this->_sections['pages_list3']['start'], $this->_sections['pages_list3']['iteration'] = 1;
                 $this->_sections['pages_list3']['iteration'] <= $this->_sections['pages_list3']['total'];
                 $this->_sections['pages_list3']['index'] += $this->_sections['pages_list3']['step'], $this->_sections['pages_list3']['iteration']++):
$this->_sections['pages_list3']['rownum'] = $this->_sections['pages_list3']['iteration'];
$this->_sections['pages_list3']['index_prev'] = $this->_sections['pages_list3']['index'] - $this->_sections['pages_list3']['step'];
$this->_sections['pages_list3']['index_next'] = $this->_sections['pages_list3']['index'] + $this->_sections['pages_list3']['step'];
$this->_sections['pages_list3']['first']      = ($this->_sections['pages_list3']['iteration'] == 1);
$this->_sections['pages_list3']['last']       = ($this->_sections['pages_list3']['iteration'] == $this->_sections['pages_list3']['total']);
?>
        <li <?php if ($this->_tpl_vars['cur_page'] == $this->_sections['pages_list3']['index']): ?>class="cur<?php endif; ?>">
            <a href="<?php echo $this->_tpl_vars['page_link']; ?>
<?php echo $this->_sections['pages_list3']['index']; ?>
">
                <?php echo $this->_sections['pages_list3']['index']; ?>

            </a>
        </li>
        <?php endfor; endif; ?>
        
        <?php if (( $this->_tpl_vars['cur_page'] + $this->_tpl_vars['page_step'] ) <= ( $this->_tpl_vars['total_pages'] - ( $this->_tpl_vars['page_step']+1 ) )): ?>
            <li><span>...</span></li>
            <?php unset($this->_sections['pages_list4']);
$this->_sections['pages_list4']['name'] = 'pages_list4';
$this->_sections['pages_list4']['start'] = (int)$this->_tpl_vars['total_pages']-$this->_tpl_vars['page_step']+1;
$this->_sections['pages_list4']['loop'] = is_array($_loop=$this->_tpl_vars['total_pages']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pages_list4']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['pages_list4']['show'] = true;
$this->_sections['pages_list4']['max'] = $this->_sections['pages_list4']['loop'];
if ($this->_sections['pages_list4']['start'] < 0)
    $this->_sections['pages_list4']['start'] = max($this->_sections['pages_list4']['step'] > 0 ? 0 : -1, $this->_sections['pages_list4']['loop'] + $this->_sections['pages_list4']['start']);
else
    $this->_sections['pages_list4']['start'] = min($this->_sections['pages_list4']['start'], $this->_sections['pages_list4']['step'] > 0 ? $this->_sections['pages_list4']['loop'] : $this->_sections['pages_list4']['loop']-1);
if ($this->_sections['pages_list4']['show']) {
    $this->_sections['pages_list4']['total'] = min(ceil(($this->_sections['pages_list4']['step'] > 0 ? $this->_sections['pages_list4']['loop'] - $this->_sections['pages_list4']['start'] : $this->_sections['pages_list4']['start']+1)/abs($this->_sections['pages_list4']['step'])), $this->_sections['pages_list4']['max']);
    if ($this->_sections['pages_list4']['total'] == 0)
        $this->_sections['pages_list4']['show'] = false;
} else
    $this->_sections['pages_list4']['total'] = 0;
if ($this->_sections['pages_list4']['show']):

            for ($this->_sections['pages_list4']['index'] = $this->_sections['pages_list4']['start'], $this->_sections['pages_list4']['iteration'] = 1;
                 $this->_sections['pages_list4']['iteration'] <= $this->_sections['pages_list4']['total'];
                 $this->_sections['pages_list4']['index'] += $this->_sections['pages_list4']['step'], $this->_sections['pages_list4']['iteration']++):
$this->_sections['pages_list4']['rownum'] = $this->_sections['pages_list4']['iteration'];
$this->_sections['pages_list4']['index_prev'] = $this->_sections['pages_list4']['index'] - $this->_sections['pages_list4']['step'];
$this->_sections['pages_list4']['index_next'] = $this->_sections['pages_list4']['index'] + $this->_sections['pages_list4']['step'];
$this->_sections['pages_list4']['first']      = ($this->_sections['pages_list4']['iteration'] == 1);
$this->_sections['pages_list4']['last']       = ($this->_sections['pages_list4']['iteration'] == $this->_sections['pages_list4']['total']);
?>
            <li <?php if ($this->_tpl_vars['cur_page'] == $this->_sections['pages_list4']['index']): ?>class="cur<?php endif; ?>">
                <a href="<?php echo $this->_tpl_vars['page_link']; ?>
<?php echo $this->_sections['pages_list4']['index']; ?>
">
                    <?php echo $this->_sections['pages_list4']['index']; ?>

                </a>
            </li>
            <?php endfor; endif; ?>
        <?php endif; ?>
    </ul>
    <?php endif; ?>
</div>
<div class="clearfix"></div>