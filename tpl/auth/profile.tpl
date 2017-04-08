<pre>{$smarty.session.user|@print_r}</pre>

<form method="post">
    {csrf_token post=1}
    <input type="hidden" name="logout" value="1">
    <button type="submit" >Logout</button>
</form>