<?php /* Smarty version 2.6.26, created on 2010-02-03 23:09:54
         compiled from mod.header.tpl */ ?>
<div class="header">
	<h1><a href="<?php echo @BASEDIR; ?>
">My Bookmarks</a></h1>
        <div class="search">
                <form name="search" method="POST">
                                <input type="text" name="search_str" class="search_str" id="search_str" value="<?php echo $this->_tpl_vars['search_str']; ?>
" <?php if (@CNTR_PAGE != 'search'): ?>onclick="(this.value='')"
                       onblur="(this.value='Търсене...')" <?php endif; ?>/>
                <?php echo $this->_reg_objects['forms'][0]->print_input('submit','submit','search',"Търси");?>

                </form>
        </div>
        <a href="<?php echo @BASEDIR; ?>
login/logout.php" class="button btn_logout" id="btn_logout"><span>Изход</span></a>
        <p><?php echo $this->_tpl_vars['logedUser']; ?>
</p>
</div>