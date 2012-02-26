<?php /* Smarty version 2.6.26, created on 2010-01-24 06:23:30
         compiled from mod.footer.tpl */ ?>
        <div class="clearfix"></div>
        <div class="footer clearfix"></div>
        <div class="bottom_footer">
            <div class="copyright">Bookmarks Book by <a href="<?php echo @AUTHOR_WEB; ?>
" target="_blank">Iliyan Betovski</a></div>
            <div class="online">
            online:
            <?php $_from = $this->_tpl_vars['active_users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['name']):
?>
                <span><?php echo $this->_tpl_vars['name']; ?>
</span> |
            <?php endforeach; endif; unset($_from); ?>
            </div>
        </div>
    </body>
</html>