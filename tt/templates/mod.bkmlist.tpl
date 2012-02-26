<div class="bookmarks_list clearfix">
    {if $user_cats == 0}
        {include file="mod.nocategories.tpl"}
    {else}
        <ol class="bkm_list" start={$list_start_number}>
            {if $websites == 0}
                <p>Няма резултати</p>
            {else}
                {foreach key=foo item=value from=$websites name=child_masiv}
                    {*<li {if $smarty.const.CNTR_ACTION != "edit"}"onMouseOver="cut_text('link-{$smarty.foreach.child_masiv.index}')" onMouseOut="uncut_text('link-{$smarty.foreach.child_masiv.index}')""{/if} {if $smarty.const.CNTR_ACTIONID==$foo}class="editing"{/if}>*}
                    <li class="{if $smarty.foreach.child_masiv.index is even}even{else}odd{/if}"{if $value.color_code} style="background:rgba({$value.color_code},0.6)"{/if}>
                        {if $smarty.const.CNTR_PAGE != "edit"}
                            <form method="POST" name="delete_edit" class="delete_edit" action="{$smarty.const.BASEDIR}list/{$smarty.const.CNTR_CAT}{if $cur_page != 1}/page/{$cur_page}{/if}">
                                <input type="hidden" name="bid" id="id" value="{$foo}" />
                                <input type="hidden" name="action" id="id" value="foo" />
                                <input type="submit" name="delete" class="delete" id="delete" value="Изтрий" />
                                <input type="submit" name="edit" class="edit" id="edit" class="edit" value="Редактирай" />
                            </form>
                        {/if}
                        <a href="{$value.url}" target="_blank" id="link-{$smarty.foreach.child_masiv.index}" title="{$value.name}">{if isset($value.replace_name)}{$value.replace_name|truncate:65}{else}{$value.name|truncate:65}{/if}</a>
                        <p class="desc clearfix">{if isset($value.replace_desc)}{$value.replace_desc|@nl2br}{else}{$value.desc|@nl2br}{/if}</p>
                        <span class="link"><a href="{$value.url}" target="_blank">{if isset($value.replace_url)}{$value.replace_url|truncate:85}{else}{$value.url|truncate:85}{/if}</a></span>
                        {include file="mod.set_color.tpl"}
                        {if !$smarty.const.CNTR_CAT || $smarty.const.CNTR_PAGE == "search"}
                        <small>от <a href="{$smarty.const.BASEDIR}list/{$value.catid}">{$value.catname}</a></small>{/if}
                        {if $smarty.post.action && $smarty.post.delete_cat == false && $smarty.post.bid == $foo}
                            {include file="mod.addform.tpl"}
                        {/if}
                    </li>
                {/foreach}
            {/if}
        </ol>
        {if $smarty.const.CNTR_PAGE == "add"}
            {assign var="action" value="add"}
            {include file="mod.addform.tpl"}
        {/if}
    {/if}
    {include file="mod.delcat.tpl"}
</div>