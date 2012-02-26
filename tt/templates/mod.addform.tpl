<div class="covering"></div>
<div class="above_all">
    <form method="POST" class="addform clearfix">
        <h3>{if $smarty.const.CNTR_PAGE == "add"}Добавяне на отметка{else}Редактиране на отметка{/if}</h3>
        <ul class="addform clearfix">
            <li><b>URL</b>{forms->print_input type="text" class="b_url" field="b_url" value=$b_url}<a href="#" id="clearUrl" title="Изчисти адреса">Изчисти адреса</a><li>
            <li><b>Заглавие</b>{forms->print_input type="text" class="b_title" field="b_title" value=$b_title}</li>
            <li><b>Категория</b>{forms->print_select masiv=$user_cats field="catid" value=$catid}</li>
            <li><b>Или създайте нова</b>
                {forms->print_input type="text" class="new_catname" field="new_catname" value=$new_catname}
                {forms->print_input type="hidden" class="userid" field="userid" value=$smarty.const.logedUser}
                {forms->print_input type="hidden" class="action" field="action" value=$action}
                {forms->print_input type="hidden" class="bid" field="bid" value=$smarty.post.bid}
            </li>
            <li>
                {*{if isset($forms->emptyFields.b_title) && !isset($forms->emptyFields.b_url)}*}
                {*{/if}*}
                <b>Описание</b>{forms->print_textarea class="b_desc" field="b_desc" value=$b_desc}
            </li>
            <li>
            {if isset($b_img) && $b_img != 0}
                <ul class="arrThumbs">
                    {foreach key=k item=val from=$b_img name=arrName}
                    <li>
                        <img src="{$val}" width="100" />
                    </li>
                    {/foreach}
                </ul>
            {/if}
            </li>
        </ul>
        {forms->print_input type="submit" class="submit" field="submit" value="Запиши"}
        {forms->print_input type="submit" class="cancel" field="cancel" value="Отказ"}
    </form>
</div>