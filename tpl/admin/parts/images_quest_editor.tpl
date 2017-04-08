<div class="span4">
	{foreach from=$albums item=album}
		{assign var=images value=$album.images}
		<div class="box corner-all">
			<div class="box-header grd-white color-silver-dark corner-top">
				<span>альбом {$album.id} - <a href="?act=delete_album&id={$album.id}{csrf_token}&item_id={$item.id}" title="Удалить альбом" class="confirmMe"><i class="icon-trash" style="margin-top: 4px;"></i></a></span>
			</div>
			<div class="box-body">
				<div class="imgList{$album.id} album_table">
					<table>
						<tbody id="uploaded_img_holder{$album.id}">
						{section name=i loop=$images}
							<tr>
								<td nowrap>
									<a href="?act=img_move_up&id={$images[i].id}&item_id={$item.id}" title="Вверх"><i class="icon-arrow-up"></i></a>
									<a href="?act=img_move_down&id={$images[i].id}&item_id={$item.id}" title="Вниз"><i class="icon-arrow-down"></i></a>
									<a href="?act=img_delete&id={$images[i].id}{csrf_token}&item_id={$item.id}" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>
								</td>
								<td>
									<a href="/images/album_quest_images/{$images[i].img_fname}" rel="pretty"><img src="/images/album_quest_images/{$images[i].img_fname}" /></a>
								</td>
							</tr>
						{/section}
						</tbody>
					</table>
				</div>
				<hr/>
				<div class="side-task" id="MultiFileList{$album.id}" data-table="album_images" data-id="{$album.id}"></div>
				<hr/>
				<div>
				<span class="btn btn-success fileinput-button">
					<span>Добавить файлы</span>
					<div id="fileHolder{$album.id}">
						<input type="file" name="files[]" id="alex_upload{$album.id}"  data-albumid="{$album.id}" class="alex_upload" accept=".jpg,.jpeg,.png,.gif" multiple="1">
					</div>
				</span>
				<span  class="do_upload btn btn-success fileinput-button" style="float: right" data-albumid="{$album.id}">
					Загрузить
				</span>
				</div>
			</div>
		</div>
	{/foreach}

	{*<a href="?act=new_album&id={$item.id}" class="btn">Добавить альбом</a>*}
</div>