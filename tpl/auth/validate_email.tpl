{if $confirmed eq '1'}
    <p>{#email_confirmed#}</p>
    <a href="/">Index page</a>
{else}
    {section name=i loop=$errors}
        {if $smarty.section.i.first}<ul class="form_errors">{/if}
        <li>
            {if $errors[i] eq 'bad_token'}{#bad_token_confirm#}{/if}
        </li>
        {if $smarty.section.i.last}</ul>{/if}
    {/section}
    <form method="post">
        {csrf_token post=1}
        <input type="hidden" name="validate_email" value="validate_email">
        <input type="hidden" name="uid" value="{$uid}">

        <div class="form-group">
            <label for="reg_email">{#email_confirm_token#}</label>
            <input type="text" class="form-control" id="reg_email" placeholder="{#email_confirm_token#}" name="token" value="{$token|escape}" required="required">
        </div>
        <button type="submit" class="btn btn-default">{#email_confirm#}</button>
    </form>
{/if}