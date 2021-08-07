// input[type="file"][data-name][data-target]
$(document).on('change', 'input[type="file"][data-name][data-target]', function() {
	var name = $(this).attr('data-name');
	var target = $(this).attr('data-target');
	var target_collapse = $(this).attr('data-target-collapse');
	var target_collapse_show = $(this).attr('data-target-collapse-show');
	var multiple = $(this).attr('multiple') == 'multiple';
	var formData = new FormData();
	var files = [];
	if (multiple)
		name += '[]';
	for (var i = 0; i < $(this)[0].files.length; i++) {
		formData.append(name, $(this)[0].files[i]);
		files.push($(this)[0].files[i]);
	}
	if (files.length) {
		$.ajax({
			type : 'post',
			url : '/actions/FileUpload',
			data : formData,
			cache : false,
			contentType : false,
			processData : false,
			success : function(result) {
				console.log(result);
				if (result && result != 'file upload failed') {
					if (name == 'attachment[]') {
						var results = result.split('|');
						for (var i = 0; i < results.length; i++) {
							$(target).append('<span class="d-inline-block mb-2 mr-2" title="' + files[i].name + '"><input type="hidden" name="attachment[]" value="' + results[i] + ':' + files[i].name + '"/>' + files[i].name + ' <a class="form-remove ml-4" href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
						}
					} else if (name == 'attachment') {
						$(target).find('span').remove();
						$(target).append('<span class="d-inline-block mb-2 mr-2" title="' + files[0].name + '"><input type="hidden" name="attachment[]" value="' + result + ':' + files[0].name + '"/>' + files[0].name + ' <a class="form-remove ml-4" href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
					} else if (multiple) {
						var results = result.split(',');
						for (var i = 0; i < results.length; i++) {
							$(target).append('<article class="col-sm-6 col-md-3 mb-3"><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><figure><img src="' + results[i] + '" alt="file upload fail"/></figure><input type="text" class="form-control form-control-sm" placeholder="Caption"/></article>');
						}
					} else {
						$(target).find('figure').remove();
						$(target).append('<figure><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><img src="' + result + '" alt="file upload fail"/></figure>');
						if (name)
							$('input[type="hidden"][name="' + name + '"]').val(result);
					}
					if (target_collapse)
						$(target_collapse).removeClass('show');
					if (target_collapse_show)
						$(target_collapse_show).addClass('show');
				} else {
					Alert("The file exceeds the size limit.");
				}
			},
			error : function() {
				Alert("Error");
			}
		});
	}
	$(this)[0].value = '';
});

// [data-toggle="remove"]
$(document).on('click', '[data-toggle="remove"]', function() {
	var input = $(this).parents('fieldset').find('input[type="file"][data-name][data-target]');
	var name = $(input).attr('data-name');
	var target = $(input).attr('data-target');
	var target_collapse = $(input).attr('data-target-collapse');
	var target_collapse_show = $(input).attr('data-target-collapse-show');
	var multiple = $(input).attr('multiple') == 'multiple';
	if (name)
		$('input[type="hidden"][name="' + name + '"]').val('');
	if (target_collapse)
		$(target_collapse).addClass('show');
	if (target_collapse_show)
		$(target_collapse_show).removeClass('show');
	$(this).parent().remove();
});

// input[name="domain"]
$(function() {
	var input_name = $('input[name="name"]');
	var input_domain = $('input[name="domain"]');
	var form_name = $('body>form').attr('name');
	$(input_name).on('change blur keyup', function() {
		if ($(input_name).val().replace(/[^0-9|A-Z|a-z]/g, '')) {
			$(input_domain).val($(input_name).val().replace(/[^0-9|A-Z|a-z]/g, ''));
		}
	});
	$(input_name).add(input_domain).on('change blur keyup', function() {
		$.ajax({
			type : 'post',
			url : '/actions/DupCheck',
			data : 'action=DupCheck&table=' + form_name + '&domain=' + $(input_domain).val(),
			success : function(result) {
				if (!result && $(input_domain).val() && $(input_domain).val() != input_domain.attr('value')) {
					$(input_domain).parents('.form-group').eq(0).addClass('is-invalid');
					$(input_domain).val($(input_domain).val() + '1').trigger('change');
				} else {
					$(input_domain).parents('.form-group').eq(0).removeClass('is-invalid');
				}
			}
		});
	});
});

// button[data-type]
$(function() {
	// #preview
	if (location.hash == '#preview') {
		$('.d-preview-none').hide();
		$('body').append('<div class="modal-backdrop show" style="opacity: 0;"></div>');
	}
	// #copy
	else if($('input[name="pk"]').length && location.hash=='#copy'){
		$('input[name="pk"], input[name="domain"]').val('');
		$('input[type="hidden"][name="publ"]').val('0');
	}
	// #hashtag
	else if($('input[name="hashtag"]').length && location.hash){
		$('input[name="hashtag"]').val($('input[name="hashtag"]').val() + ' ' + decodeURIComponent(location.hash));
	}
});
$(document).on('click', 'button[data-type]', function(e) {
	var form = $(this).parents('form');
	var type = $(this).data('type');
	if ($(form).find('.is-invalid').length) {
		e.preventDefault();
		if ($(form).find('.is-invalid').eq(0).parents('fieldset').length) {
			$(form).find('.is-invalid').eq(0).parents('fieldset').customScrollAnimate();
		}
	}
	if ($(form).find('input[name="submit_type"]').length == 0) {
		$(form).append('<input type="hidden" name="submit_type" value="" />');
	}
	$(form).find('input[name="submit_type"]').val(type);
	if (type == 'save' || type == 'preview') {
		if (type == 'save') {
			$.ajax({
				type : 'post',
				url : $(form).attr('action'),
				data : $(form).serialize(),
				success : function(result) {
					console.log(result);
					if (!isNaN(parseInt(result))) {
						$('input[type="hidden"][name="pk"]').val(result);
						$(form).find('a[href*="_NEW"]').each(function() {
							$(this).attr('href', $(this).attr('href').replace('_NEW', result));
						});
						Dialog("Registered information saved.");
					} else {
						Alert("Error");
					}
				}
			});
		} else if (type == 'preview') {
			var window_preview = window.open('about:blank', 'window_preview', 'width=1250, height=600, status=no, menubar=no, toolbar=no, titlebar=no, scrollbars=yes, resizable=yes');
			if (window_preview) {
				$(form).attr('target', 'window_preview');
				$(form).submit();
				$(form).removeAttr('target');
			} else {
				Alert("Please turn off your pop-up blocker.");
				return false;
			}
		}
		$(form).find('input[name="submit_type"]').remove();
		return false;
	} else if (type == 'publish') {
		if ($(this).attr('name')) {
			$(form).append('<input type="hidden" name="' + $(this).attr('name') + '" value="' + $(this).attr('value') + '"/>');
		}
		$(form).find('[pattern]').removeAttr('pattern');
		$('[data-beforeunload]').removeAttr('data-beforeunload');
		$(form).find('input[type="hidden"][name="publ"]').val('1');
	}
});