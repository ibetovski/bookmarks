<div class="header">
	<h1><a href="{$smarty.const.BASEDIR}">My Bookmarks</a></h1>
        <div class="search">
                <form name="search" method="POST">
                {*{forms->print_input type="text" class="search_str" field="search_str" value=$search_str}*}
                <input type="text" name="search_str" class="search_str" id="search_str" value="{$search_str}" {if $smarty.const.CNTR_PAGE != "search"}onclick="(this.value='')"
                       onblur="(this.value='Търсене...')" {/if}/>
                {forms->print_input type="submit" class="submit" field="search" value="Търси"}
                </form>
        </div>
        <a href="{$smarty.const.BASEDIR}login/logout.php" class="button btn_logout" id="btn_logout"><span>Изход</span></a>
        <p>{$logedUser}</p>
</div>