{if $resent eq '1'}
	{#reset_sent#}
{else}
	<form method="post">
		{csrf_token post=1}

		<input type="hidden" name="reset_pass" value="reset_pass">

		<div class="form-group">
			<label for="reg_email">{#email#}</label>
			<input type="email" class="form-control" id="reg_email" placeholder="{#email#}" name="email" value="{$data.email|escape}">
		</div>

		<button type="submit" class="btn btn-default">{#do_reset_pass#}</button>
	</form>
{/if}