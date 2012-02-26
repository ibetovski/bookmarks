        <div class="clearfix"></div>
        <div class="footer clearfix"></div>
        <div class="bottom_footer">
            <div class="copyright">Bookmarks Book by <a href="{$smarty.const.AUTHOR_WEB}" target="_blank">Iliyan Betovski</a></div>
            <div class="online">
            online:
            {foreach key=key item=name from=$active_users}
                <span>{$name}</span> |
            {/foreach}
            </div>
        </div>
    </body>
</html>