{if $login_error}
    <ul class="form_errors">
        <li>{#login_error#}</li>
    </ul>
{/if}

<form method="post">
    {csrf_token post=1}
    <input type="hidden" name="perform_login" value="perform_login">
    {if !empty($smarty.server.auth_config.use_username)}
        <div class="form-group">
            <label form="reg_username">{#username#}</label>
            <input type="username" class="form-control" id="reg_username" placeholder="{#username#}" name="username" value="{$data.username|escape}">
        </div>
    {/if}
    {if !empty($smarty.server.auth_config.use_email)}
        <div class="form-group">
            <label for="reg_email">{#email#}</label>
            <input type="email" class="form-control" id="reg_email" placeholder="{#email#}" name="email" value="{$data.email|escape}">
        </div>
    {/if}
    <div class="form-group">
        <label for="reg_password1">{#password#}</label>
        <input type="password" class="form-control" id="reg_password1" placeholder="{#password#}" required="required" name="password">
    </div>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="remember_me" value="1"> {#remember_me#}
        </label>
    </div>

    <button type="submit" class="btn btn-default">{#do_login#}</button>
</form>

<p>
    <a href="/auth/forgot.html">{#forgot_link#}</a>
</p>

{if !empty($smarty.server.auth_config.vk_login) }
    <br/>
    <p>
        <a class="show-popup" data-target="vk_login">Login through VK</a>
    </p>
    <script>
        var vk_app_id = '{$smarty.server.vk_app_id}';
    </script>
    <script src="http://userapi.com/js/api/openapi.js" type="text/javascript" charset="utf-8"></script>

    <div class="vk-login-popup popup-win" id="vk_login">
        <a class="close-popup"></a>
        <div id="vk_auth"></div>
    </div>
{/if}

{if !empty($smarty.server.auth_config.vk_login) }
    <br/>
    <p>
        <a href="{$ok_login_url}">Login through OK</a>
    </p>
{/if}

{if !empty($smarty.server.auth_config.fb_login) }
    <br/>
    <p>
        <a href="{$fb_login_url}">Login through FB</a>
    </p>
{/if}