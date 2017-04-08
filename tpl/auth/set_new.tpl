{if $pass_set eq '1'}
	{#password_set#}
{else}
	{section name=i loop=$errors}
		{if $smarty.section.i.first}<ul class="form_errors">{/if}

		<li>
			{if $errors[i] eq 'bad_token'}{#bad_token#}
			{elseif $errors[i] eq 'no_password'}{#no_password#}
			{elseif $errors[i] eq 'passwords_not_match'}{#passwords_not_match#}
			{/if}
		</li>

		{if $smarty.section.i.last}</ul>{/if}
	{/section}

	<form method="post">
		{csrf_token post=1}

		<input type="hidden" name="set_new_pass" value="set_new_pass">
		<input type="hidden" name="token" value="{$data.token|escape}">
		<input type="hidden" name="uid" value="{$data.id|escape}">

		<div class="form-group">
			<label for="reg_password1">{#password#}</label>
			<input type="password" class="form-control" id="reg_password1" placeholder="{#password#}" required="required" name="reg_password1" >
		</div>
		<div class="form-group">
			<label for="reg_password2">{#repeat_password#}</label>
			<input type="password" class="form-control" id="reg_password2" placeholder="{#repeat_password#}" required="required" name="reg_password2" >
		</div>
		<button type="submit" class="btn btn-default">{#do_set_pass#}</button>
	</form>
{/if}