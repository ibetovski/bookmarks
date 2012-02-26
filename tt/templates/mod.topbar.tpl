<div class="topbar">
    {include file="mod.pages.tpl"}
    <h2>{if $cntr_cat == "" || $cntr_cat == 0}{$mod_title}{else}{$user_cats.$cntr_cat}{/if}<span class="cnt"><b>{$cnt_bkm}</b></span></h2>
    <div class="topbuttons">
        <a href="{$smarty.const.BASEDIR}add/{if $cntr_cat == ""}0{else}{$cntr_cat}{/if}" class="button btn_add_bkm" id="btn_add_bkm">
            <span>+ Добави</span>
        </a>
    </div>
</div>
<div class="clearfix"></div>