<div class="menu">
    <ul>
    <li {if $cntr_cat == "" || $cntr_cat == 0}class="cur"{/if}><a href="{$smarty.const.BASEDIR}list/"><span>Последно добавени</span></a></li>
    {if $user_cats != 0}
    {foreach key=id item=name from=$user_cats name=parent_masiv}
        {if $id == $cntr_cat}
            {assign var="css_class" value="cur"}
        {else}
            {assign var="css_class" value="menuItem"}
        {/if}
       <li class="{$css_class}"><a href="{$smarty.const.BASEDIR}list/{$id}" title="{$name}"><span>{$name|truncate:44}</span></a></li>
    {/foreach}
    <ul>
    {/if}
</div>