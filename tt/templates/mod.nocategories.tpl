<form method="POST" class="addform clearfix">
    <p>Няма създадени категории</p>
    <b>Име на категория</b>
    {forms->print_input type="hidden" class="userid" field="userid" value=$smarty.const.logedUser}
    {forms->print_input type="text" class="catname" field="catname" value=$catname}
    <input type="submit" name="add_category" value="запиши" />
</form>