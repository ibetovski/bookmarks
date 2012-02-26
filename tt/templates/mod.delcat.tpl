{if $smarty.const.CNTR_CAT != ""}
    <div class="delete_category">
	<form name="delete_category" method="post" action="{$smarty.const.BASEDIR}list/{$smarty.const.CNTR_CAT}">
	    {if $cnt_bkm < 1}
		{forms->print_input type="hidden" class="catid" field="delete_cat_confirm" value="1"}
	    {/if}
	    {forms->print_input type="hidden" class="catid" field="catid" value=$smarty.const.CNTR_CAT}
	    {forms->print_input type="submit" class="submit" field="delete_cat" value="Изтрии категорията"}
	</form>
    </div>
{/if}

{if isset($smarty.post.delete_cat) && $cnt_bkm > 0}
<div class="covering"></div>
<div class="above_all">
    <form name="delete_category_confirm" method="post">
	<h3>Потвърждавате ли изтриването на тази категория?</h3>
	<p>Изтривайки тази категория, вие ще изтриете всички отметки, които тя съдържа.</p>
	<p>Потвърждавате ли?</p>
	{forms->print_input type="hidden" class="catid" field="catid" value=$smarty.const.CNTR_CAT}
	{forms->print_input type="submit" class="cancel" field="cancel" value="Отказ"}
	{forms->print_input type="submit" class="submit" field="delete_cat_confirm" value="Потвърди"}
    </form>
</div>
{/if}