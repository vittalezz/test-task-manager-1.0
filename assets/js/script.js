(function( $ ){
	$(document).on('click', 'a.login', function(e) {
		e.preventDefault();
		$('.login-modal-window').toggleClass('close');
	});
	
	var params_arr = [];
	var params = [];
	var url = location.href.split('?');
	var ajaxUrl = '';
	if (typeof url[1] !== 'undefined') {
        params_arr = url[1].split('&');
	}
	for(let i=0; i < params_arr.length; i++) {
		let arr = params_arr[i].split('=');
		if (typeof arr[1] !== 'undefined') {
			params[arr[0]] = arr[1];
		}
	}
	
	url = url[0];
	
	function ajaxUpdate() {
		let ajaxUrl = url + buildParams();
		$.get(ajaxUrl, function(data) {
			data = $(data);
			$('.tasks-items-wrap').html($('.tasks-items-wrap', data).html()).fadeTo(100, 1);
			$('.pagination').html($('.pagination', data).html());
			$('html, body').animate({
				scrollTop: $('h1').offset().top
			});
			history.pushState(null, null, ajaxUrl);
			if( $('form#form_add_task').length > 0 ) {
				$('form#form_add_task').attr('action', ajaxUrl);
			}
		});
	}
	
	function buildParams() {
		let get_parametres = [];
		for (var key in params) {
			get_parametres.push(key + '=' + params[key]);
		}
		let result = '';
		if (get_parametres.length > 0) {
			result = '?' + get_parametres.join('&');
		}
		//console.log(result);
		return result;
	}
	
	$(document).on('click', '.sort-list li', function(e) {
		e.preventDefault();
		$(this).siblings('li').attr('data-sort_direction', '');
		$(this).siblings('li').removeClass('active');
		$(this).addClass('active');
		if ( $(this).attr('data-sort_direction') == 'ASC' ) {
			$(this).attr('data-sort_direction', 'DESC');
			} else {
			$(this).attr('data-sort_direction', 'ASC');
		}
		params['sort_by'] = $(this).attr('data-sort_by');
		params['sort_direction'] = $(this).attr('data-sort_direction');
		ajaxUpdate();
	});
	
	$(document).on('click', '.pagination li a', function(e) {
		e.preventDefault();
		params['page'] = $(this).attr('data-page');
		ajaxUpdate();
	});
	
	$(window).on('load',function(){
		if( $('.add-alert-success').length > 0 ) {
			setTimeout(() => $('.add-alert-success').remove(), 1500);
		}
	});
	
	if( $('form#form_add_task').length > 0 ) {
		$('form#form_add_task').attr('action', document.location.href);
	}
	
	function itemChange(id, completed, description, change) {
		$.post(document.location.href, { json_string:JSON.stringify({task: 'change', id: id, completed: completed, description: description, change: change}) })
		.done(function (response){
			var data = JSON.parse(response);
			if (data.error) {
				alert(data.error);
				window.location.reload(false);
			} else {
				if (change == 1) {
					$('.list-group-item[data-id="' + id + '"').find('.task-is_change').text('(Отредактировано)');
				}
			}
		 }, 'json');
	}
	
	$(document).on('change', '.list-group-item [name="completed"]', function(e) {
		var this_item = $(this).closest('.list-group-item');
		$(this_item).toggleClass('active');
		$(this).siblings('label').text( ( $(this).is(':checked') ) ? 'Выполнено' : 'Не выполнено' );
		var id = $(this_item).attr('data-id');
		var completed = ( $(this).is(':checked') ) ? 1 : 0;
		var description = $(this_item).find('.task-description').val();
		itemChange(id, completed, description, change = 0);
	});
	
	$(document).on('input', '.list-group-item .task-description', function(e) {
		var this_item = $(this).closest('.list-group-item');
		var id = $(this_item).attr('data-id');
		var completed = ( $(this_item).find('[name="completed"]').is(':checked') ) ? 1 : 0;
		var description = $(this).val();
		itemChange(id, completed, description, change = 1);
	});
	
	//Отправка форм
	$(document).on('submit', 'form.ajax-form', function(e) {
		e.preventDefault();
		var form = this;
		var formId = $(form).attr('id');
		var actionUrl = $(form).attr('action');
		$(form).fadeTo('fast', 0.5, function() {
			if (form.enctype) {
				$.ajax({
					url: actionUrl,
					type: 'post',
					data: new FormData(form),
					cache: false,
					contentType: false,
					processData: false,
					success: function(data) {
						$(form).html($('#' + formId, data).html()).fadeTo(100, 1);
						if ( $(form).find('input[name="success"]').length > 0 ) {
							$(form).find('input[name="success"]').remove();
							$(form).find('input').not(':button, :submit, :reset, :hidden').val('');
							$(form).find('textarea').val('');
							$('#login-wrap').html($('#login-wrap', data).html());
							ajaxUpdate();
						}
					},
					error: function(xhr, ajaxOptions, thrownError) {
						alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
					}
				});
			} else {
				$.post(document.baseURI + 'forms', $(form).serialize(), function(data) {
					$(form).replaceWith(data);
				});
			}
		});
	});

})( jQuery );