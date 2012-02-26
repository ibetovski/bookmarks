<div class="pages clearfix">
    {if $total_pages > 1}
    <ul>
        {assign var="page_step" value=3}
        {if $cur_page-$page_step <= $page_step+1}
            {assign var="loop_value1" value=1}
        {else}
            {assign var="loop_value1" value=$cur_page-$page_step}
        {/if}
        
        {if $cur_page+$page_step > $total_pages-($page_step + 1)}
            {assign var="loop_value2" value=$total_pages}
        {else}
            {assign var="loop_value2" value=$cur_page+$page_step}
        {/if}
        
        {if $cur_page - ($page_step + 1) > $page_step}
            {section name=pages_list1 start=1 loop=$page_step+1 step=1}
            <li {if $cur_page == $smarty.section.pages_list1.index}class="cur{/if}">
                <a href="{$page_link}{$smarty.section.pages_list1.index}">
                    {$smarty.section.pages_list1.index}
                </a>
            </li>
            {/section}
            <li><span>...</span></li>
        {/if}
        
        
        {section name=pages_list2 start=$loop_value1 loop=$cur_page step=1}
        <li {if $cur_page == $smarty.section.pages_list2.index}class="cur{/if}">
            <a href="{$page_link}{$smarty.section.pages_list2.index}">
                {$smarty.section.pages_list2.index}
            </a>
        </li>
        {/section}
        
        {section name=pages_list3 start=$cur_page loop=$loop_value2+1 step=1}
        <li {if $cur_page == $smarty.section.pages_list3.index}class="cur{/if}">
            <a href="{$page_link}{$smarty.section.pages_list3.index}">
                {$smarty.section.pages_list3.index}
            </a>
        </li>
        {/section}
        
        {if ($cur_page + $page_step) <= ($total_pages - ($page_step+1))}
            <li><span>...</span></li>
            {section name=pages_list4 start=$total_pages-$page_step+1 loop=$total_pages+1 step=1}
            <li {if $cur_page == $smarty.section.pages_list4.index}class="cur{/if}">
                <a href="{$page_link}{$smarty.section.pages_list4.index}">
                    {$smarty.section.pages_list4.index}
                </a>
            </li>
            {/section}
        {/if}
    </ul>
    {/if}
</div>
<div class="clearfix"></div>