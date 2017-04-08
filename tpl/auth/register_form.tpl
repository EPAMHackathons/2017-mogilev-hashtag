
{if $reg_form_errors}
    <ul class="form_errors">
        {foreach from=$reg_form_errors item=err}
            <li>
                {if $err eq 'no_username'}{#no_username#}
                {elseif $err eq 'bad_email'}{#bad_email#}
                {elseif $err eq 'no_email'}{#no_email#}
                {elseif $err eq 'no_password'}{#no_password#}
                {elseif $err eq 'passwords_not_match'}{#passwords_not_match#}
                {elseif $err eq 'username_used'}{#username_used#}
                {elseif $err eq 'email_used'}{#email_used#}
                {/if}
            </li>
        {/foreach}
        {if $smarty.section.i.first}{/if}


    </ul>
{/if}

<form role="form" method="post">
    {csrf_token post=1}
    <input type="hidden" name="perform_register" value="perform_register">
    {if !empty($smarty.server.auth_config.use_username)}
        <div class="form-group">
            <label form="reg_username">{#username#}</label>
            <input type="username" class="form-control" id="reg_username" placeholder="{#username#}" required="required" name="username" value="{$data.username|escape}">
        </div>
    {/if}
    {if !empty($smarty.server.auth_config.use_email)}
        <div class="form-group">
            <label for="reg_email">{#email#}</label>
            <input type="email" class="form-control" id="reg_email" placeholder="{#email#}" required="required" name="email" value="{$data.email|escape}">
        </div>
    {/if}
    <div class="form-group">
        <label for="reg_password1">{#password#}</label>
        <input type="password" class="form-control" id="reg_password1" placeholder="{#password#}" required="required" name="reg_password1">
    </div>
    <div class="form-group">
        <label for="reg_password2">{#repeat_password#}</label>
        <input type="password" class="form-control" id="reg_password2" placeholder="{#repeat_password#}" required="required" name="reg_password2">
    </div>
    <button type="submit" class="btn btn-default">{#do_register#}</button>
</form>