{section name=i loop=$flash_messages}
	<div class="box-body bg-white">
		<div class="alert alert-{$flash_messages[i].type}">
			<button type="button" class="close" data-dismiss="alert">×</button>
			{$flash_messages[i].msg}
		</div>
	</div>
	{if $smarty.section.i.last}
		<div class="clearfix"/>
	{/if}
{/section}
