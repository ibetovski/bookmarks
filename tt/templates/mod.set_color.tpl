<div class="color_chooser">
<a href="#" class="show_colors">Оцвети</a>
<span class="choose_color">
    <a href="#" class="set_color_btn set_no_color">0</a>
    {assign var="i" value=1}
    {foreach key=item item=color from=$colors name=colors_cycle}
        <a href="#" class="set_color_btn" title="{$color.name}" style="background: rgb({$color.code})">{$i}</a>
        {assign var="i" value=$i+1}
    {/foreach}
</span>
</div>