$(document).ready(function () {
	$('.form-validate').validate();

	$('#datatables').dataTable({
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sUrl": "/_admin_res/js/datatables/dataTables.rus.txt"
		},
		'fnInitComplete': function () {
			$('#datatables').show();
		}
	});

	$('#datatablesBig').dataTable({
		"sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		"sPaginationType": "bootstrap",
		"oLanguage": {
			"sUrl": "/_admin_res/js/datatables/dataTables.rus.txt"
		},
		'fnInitComplete': function () {
			$('#datatables').show();
		},
		'iDisplayLength': 100
	});

	$('[data-form=uniform]').uniform();
	$('[data-form=datepicker]').datepicker();
	$('[data-form=datepicker]').datepicker().on('changeDate', function () {
		$(this).blur();
	});

	$('.confirmMe').click(function () {
		return confirm('Вы уверены?');
	});

	$('.redactor_content').redactor({
		imageUpload: '/_admin_res/php/upload.php',
		imageGetJson: '/_admin_res/php/list_images.php',
		fileUpload: '/_admin_res/php/upload_file.php',
		lang: 'ru'
	});

	if (typeof allTags != 'undefined')    $('#inputTags').select2({tags: allTags});
	$('[data-form=select2]').select2();
	$('[data-form=select2-group]').select2();

	$(".chosen").chosen();

	$('#multyimgup').MultiFile({
		STRING: {
			denied: 'Вы не можете загрузить файл с типом $ext!',
			duplicate: 'Этот файл уже добавлен:\n$file'
		},
		list: '#MultiFileList'
	});

//	$('#alex_upload').on('change', do_upload);
    init_img_uploader();
    $('#icon').on('change',function(){
        var ic=$(this).val();
        $('#icon_show').html('<i class="fa '+ic+'"></i>');
    });

    $('.show_icon').on('click',function(){
       $(this).next().slideToggle('slow');
    });

//    init_calendar();

});

function get_file_name(v) {
    alert(v);
	v = v.replace(/\\/g, '/', -1);
    alert(v);
	x = v.match(/\/([^\/]*)$/);
    alert(x);
	return x[1];
}

function get_file_ext(v) {
	var res = v.substr(v.lastIndexOf('.') + 1);
	res = res.toLowerCase();
	return res;
}

function init_img_uploader() {
    var fileHolder = [];

    $('.alex_upload').on('change', function () {

        var files = document.getElementById($(this).attr('id')).files;
        var len = files.length;
        var album_id = $(this).data('albumid');

        for (var i = 0; i < len; ++i) {
            var fname = files[i].name;
            var ext = get_file_ext(fname);

            var dupe = $('.fileHolder' + album_id + '[fname="' + fname + '"]').length;
            if (dupe > 0) {
                alert(fname + ' - файл с таким именем уже был добавлен');
                //$self.remove();
                continue;
            }

            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif') {
                var newId = $('.fileHolder' + album_id).length;
                ++newId;
                $('#MultiFileList' + album_id).append('<div class="task fade in fileHolder' + album_id + '" data-id="' + newId + '" id="fileHolder' + newId + '" fname="' + fname + '">' +
                    '<span class="task-desc">' + fname + '</span>' +
                    '<button data-dismiss="alert" class="close">×</button>' +
                    '</div>');
                //$('#fileHolder' + newId).append($self);
                fileHolder[newId] = files[i];
            } else {
                alert('Вы не можете добавить файл с разрешением: ' + ext);
                //$self.remove();
            }
        }

        $(this).val('');
    })

    $('.do_upload').on('click', function () {
        var album_id = $(this).data('albumid');

        $('.fileHolder' + album_id).each(function () {
            var iid = $(this).data('id');
            var obj_id = $('input[name="id"]').val();
            var f = fileHolder[iid];

            var form = new FormData();
            form.append("table", $('#MultiFileList' + album_id).data('table'));
            form.append("id", album_id);
            form.append("new_image", f);

            $.ajax({
                url: "/_admin_res/php/multy_upload.php",
                data: form,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'json',
                beforeSend: function () {
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]  .bar-stripe').remove();
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]  .error').remove();
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]').append('<div class="bar-st bar-stripe"><span class="active fup_progress" data-id="' + iid + '" style="width: 0%;"></span></div>');
                },
                success: function (data) {
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]  .bar-stripe').remove();
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]').remove();

                    var new_img = '<tr><td nowrap>' +
                        '<a href="?act=img_move_up&id=' + data.id + '&item_id=' + obj_id + '" title="Вверх"><i class="icon-arrow-up"></i></a>' +
                        '<a href="?act=img_move_down&id=' + data.id + '&item_id=' + obj_id + '" title="Вниз"><i class="icon-arrow-down"></i></a>' +
                        '<a href="?act=img_delete&id=' + data.id + '&item_id=' + obj_id + '" title="Удалить" class="confirmMe"><i class="icon-trash"></i></a>' +
                        '</td><td><img src="' + data.img + '"</td></tr>';
                    $('#uploaded_img_holder' + album_id).append(new_img);
                },
                xhr: function () {
                    var xhrobj = $.ajaxSettings.xhr();
                    if (xhrobj.upload) {
                        xhrobj.upload.addEventListener('progress', function (event) {
                            var percent = 0;
                            var position = event.loaded || event.position;
                            var total = event.total;
                            if (event.lengthComputable) {
                                percent = Math.ceil(position / total * 100);
                            }
                            $('.fup_progress[data-id="' + iid + '"]').width(percent + '%');
                        }, false);
                    }
                    return xhrobj;
                },
                error: function () {
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]  .bar-stripe').remove();
                    $('.fileHolder' + album_id + '[data-id="' + iid + '"]').append('<span style="color: red; padding-left: 10px" class="error">error</span>');
                }
            });
        })
    })
}

function do_upload() {
	var $self = $(this);
	var val = $self.val();


	var fname = get_file_name(val);
	var ext = get_file_ext(fname);

	var $newE = $(this).clone();
	$newE.val('');


	$self.attr('id', 'weezy');
	$self.off('change');
	$newE.on('change', do_upload);

	$('#fileHolder').append($newE);

	var dupe = $('.fileHolder[fname="' + fname + '"]').length;
	if (dupe > 0) {
		alert('Этот файл уже был добавлен');
		$self.remove();
		return;
	}


	if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif') {
		var newId = $('.fileHolder').length;
		++newId;
		$('#MultiFileList').append('<div class="task fade in fileHolder" id="fileHolder' + newId + '" fname="' + fname + '">' +
			'<span class="task-desc">' + fname + '</span>' +
			'<button data-dismiss="alert" class="close">×</button>' +
			'</div>');
		$('#fileHolder' + newId).append($self);
	} else {
		alert('Вы не можете добавить файл с разрешением: ' + ext);
		$self.remove();
	}
}

function init_calendar() {

	var calendar = $('#calendar').fullCalendar({

		header: {
			left: 'title',
			center: '',
			right: 'prev,next'
		},
		firstDay: 1,
		droppable: true,
		drop: function(date, allDay) {
			var originalEventObject = $(this).data('eventObject');
			var copiedEventObject = $.extend({}, originalEventObject);
			copiedEventObject.start = date;
			copiedEventObject.allDay = allDay;
			$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
			if ($('#drop-remove').is(':checked')) {
				$(this).remove();
			}
		},
		draggable: true,
		selectable: true,
		selectHelper: true,
		editable: true,
		events: calendar_events,

		select: function (start, end, allDay) {
			var dd = start.getDate();
			var mm = start.getMonth() + 1;
			var yyyy = start.getFullYear();
			var startD = dd + '.' + mm + '.' + yyyy;

			var dd = end.getDate();
			var mm = end.getMonth() + 1;
			var yyyy = end.getFullYear();
			var endD = dd + '.' + mm + '.' + yyyy;


			if (confirm('Добавить акцию с ' + startD + ' по ' + endD + '?')) {

				$.ajax({
					url: '/_ajax/admin_save_book.php?start=' + startD + '&end=' + endD + '&oid=' + oid,
					dataType: "json",
					success: function (data, textStatus) {
						if (data.added == 1) {
							calendar.fullCalendar('renderEvent', {
									title: 'book',
									start: start,
									end: end,
									allDay: allDay
								},
								true
							);
						} else {
							alert( data.msg );
						}

					}
				});

			}
			calendar.fullCalendar('unselect');
		}
	});
}