/**
 * 
 * Form Utility
 */

function htmlspecialchars(str) {
	var map = {
		'&' : '&amp;',
		'<' : '&lt;',
		'>' : '&gt;',
		'"' : '&quot;',
		"'" : '&#039;'
	};
	if (str)
		return str.trim().replace(/[&<>"']/g, function(c) {
			return map[c];
		});
	else
		return '';
}

$(window).on('beforeunload', function() {
	if ($('[data-beforeunload="true"]').length && $('[value]').is(function() {
		if ($(this).val() && $(this).val() != $(this).attr('value'))
			return true;
	})) {
		return "Once you leave this page, your changes will not be saved.";
	}
});

$('input').on('keypress', function(e) {
	if (e.keyCode == 13 && $('[data-beforeunload="true"]').length > 0) {
		return false;
	}
});

$('input[type="checkbox"][data-type="checkall"]').on('change', function() {
	$('input[type="checkbox"][name="' + $(this).attr('name') + '"]').prop('checked', $(this).prop('checked'));
});

/**
 * 
 * Fieldset Anchor
 */

$('a[href^="#fieldset-"]').on('click', function(e) {
	var href = $(this).attr('href');
	e.preventDefault();
	$(href).customScrollAnimate();
});

/**
 * 
 * Textarea Auto Size / Max Length
 */

$.fn.customTextareaAutosize = function() {
	if ($(this).is('textarea.textarea-autosize')) {
		var rows = $(this).attr('rows') && $(this).attr('rows') >= 2 ? $(this).attr('rows') : 2;
		var paddingHeight = $('#desc').outerHeight() - $('#desc').height();
		$(this).css('overflow', 'hidden').css('resize', 'none').css('min-height', 'calc(' + (rows * 1.5) + 'rem + ' + (paddingHeight) + 'px)').css('max-height', '50vh').on('change blur keyup', function() {
			$(this).height(1).height($(this).prop('scrollHeight') - parseInt($(this).css('padding-top')) - parseInt($(this).css('padding-bottom')));
		}).trigger('change');
	}
	return this;
}

$.fn.customTextareaMaxlength = function() {
	if ($(this).is('textarea[maxlength]')) {
		$(this).after('<small class="form-text text-muted float-right"></small>').on('change blur keyup', function() {
			$(this).next('small').html($(this).val().length + '/' + $(this).attr('maxlength'));
		}).trigger('change');
	}
	return this;
}

$(function() {
	$('textarea.textarea-autosize').each(function(){ $(this).customTextareaAutosize(); });
	$('textarea[maxlength]').customTextareaMaxlength();
})

/**
 * 
 * Dynamic Select Options
 */

$(function() {
	$('select[data-child]').trigger('change');
});

$('select[data-child]').on('change', function() {
	var parentElement = $(this);
	var childElement = $(parentElement).data('child');
	var parentValue = $(parentElement).val();
	var childName = $(childElement).attr('name');
	if (!window.customSelectOptions) {
		window.customSelectOptions = [];
	}
	if (!customSelectOptions[childName]) {
		customSelectOptions[childName] = [];
	}
	while (customSelectOptions[childName].length) {
		$(childElement).append(customSelectOptions[childName].shift());
	}
	$(childElement).children('option[data-parent-value]').each(function() {
		if ($(this).data('parentValue') != parentValue) {
			customSelectOptions[childName].push(this);
			$(this).remove();
		}
	});
	if (!$(childElement).find('option:selected').length)
		$(childElement).children('option:first-child').prop('selected', true);
	$(childElement).trigger('change');
});

/**
 * 
 * Input Multiple
 */

$.fn.customInputMultiple = function(_text) {
	$(this).append('<button type="button" class="btn btn-outline-secondary btn-sm" style="margin: .5rem .5rem 0 0;"><span>' + _text.trim() + '</span> <span data-toggle="remove">&times;</span></button>');
}

$('.form-control.dropdown-toggle[data-name][data-multiple-target]+.dropdown-menu>.dropdown-item, .form-control[data-name][data-multiple-target]+.input-group-append>.btn').on('click', function() {
	var input, value, text, name, target, max;
	if ($(this).parent('.dropdown-menu').prev('.form-control.dropdown-toggle').length) {
		input = $(this).parent('.dropdown-menu').prev('.form-control.dropdown-toggle');
		value = $(this).data('value') ? $(this).data('value') : $(this).text();
		text = $(this).text();
	} else if ($(this).parent('.input-group-append').prev('.form-control').length) {
		input = $(this).parent('.input-group-append').prev('.form-control');
		value = text = $(input).val();
		$(input).val('');
	} else return;
	name = $(input).data('name');
	target = $(input).data('multipleTarget');
	max = $(input).data('max');
	if ($(target).length && value) {
		if (!$(target).find('input').is(function() {
			return $(this).val() == value;
		})) {
			if (max && $(target).children('span').length >= parseInt(max))
				Alert("Maximum " + max + " options allowed.");
			else $(target).append('<span class="mr-2"><input type="hidden" name="' + name + '" value="' + value + '"/>' + text + ' <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
		}
	}
});

$('input[type="hidden"][data-type="multiple"][data-target]').each(function() {
	var multiple_input = this;
	var multiple_name = $(multiple_input).attr('name');
	var multiple_value = $(multiple_input).val();
	var multiple_target = $(multiple_input).data('target');
	JSON.parse(multiple_value.replace(/'/g, '"')).forEach(function(_text) {
		$(multiple_target).customInputMultiple(_text);
	});
	$(multiple_target).on('click', '[data-toggle="remove"]', function() {
		var multiple_values = JSON.parse($(multiple_input).val().replace(/'/g, '"'));
		var data_value = $(this).prev('span').text();
		multiple_values.splice(multiple_values.indexOf(data_value), 1);
		$(multiple_input).val(JSON.stringify(multiple_values));
		$(this).parent().remove();
	});
	$('[data-name="' + multiple_name + '"]').on('keypress click', function(e) {
		if (e.type == 'keypress' && e.keyCode == 13 || e.type == 'click' && $(this).is('button')) {
			var multiple_values = JSON.parse($(multiple_input).val().replace(/'/g, '"'));
			var data_input = $('input[data-name="' + multiple_name + '"]');
			var data_value = $(data_input).val().trim();
			e.preventDefault();
			if (multiple_values.indexOf(data_value) >= 0) {
				$(multiple_target).find('span').each(function() {
					if ($(this).text() == data_value) {
						$(this).parent().focus();
					}
				});
			} else if (data_value) {
				$(data_input).val('');
				multiple_values.push(data_value);
				$(multiple_input).val(JSON.stringify(multiple_values));
				$(multiple_target).customInputMultiple(data_value);
			}
		}
	});
});

/**
 * 
 * Input Dropdown
 */

$('input[type="text"][data-toggle="dropdown"]').on('change blur keyup', function() {
	var keyword = $(this).val().toLowerCase();
	$(this).parents('.dropdown').addClass('show').find('.dropdown-menu').addClass('show').find('.dropdown-item').each(function() {
		if (!keyword || $(this).is('.disabled') || $(this).text().toLowerCase().indexOf(keyword) == -1)
			$(this).hide();
		else
			$(this).show();
	});
	if (!$(this).siblings('.dropdown-menu').find('.dropdown-item:visible').length) {
		$(this).parents('.dropdown').removeClass('show').find('.dropdown-menu').removeClass('show');
	}
});

$('input[type="text"][data-toggle="dropdown"]').parent('.dropdown').on('show.bs.dropdown', function(){
	if (!$(this).find('.dropdown-item:visible').length) {
		return false;
	}
});

$('input[type="text"][data-toggle="dropdown"]+.dropdown-menu>.dropdown-item').on('click', function() {
	$(this).parents('.dropdown-menu').prev('.dropdown-toggle').val($(this).text()).trigger('change');
});

/**
 * 
 * Form Validation
 */

$.fn.customInputPattern = function(_pattern) {
	if (_pattern) {
		$(this).attr('pattern', _pattern);
	}
	$(this).on('change blur keyup', function() {
		if ($(this).attr('pattern')) {
			var pattern = new RegExp('[^' + $(this).attr('pattern') + ']');
			if ($(this).val() == '' || pattern.test($(this).val())) {
				$(this).val($(this).val().replace(pattern, ''));
			}
		}
	});
	return this;
}

$.fn.customInputInvalid = function(_pattern) {
	if (_pattern) {
		$(this).data('pattern', _pattern);
	}
	$(this).on('change blur keyup', function() {
		if ($(this).data('pattern')) {
			var pattern = new RegExp($(this).data('pattern'));
			if ($(this).val() == '' || pattern.test($(this).val())) {
				$(this).removeClass('is-invalid').next('.invalid-feedback').remove();
			} else {
				if ($(this).attr('type') == 'url') {
					$(this).val('http://' + $(this).val());
				}
				$(this).customInputFeedback();
			}
		}
	});
	return this;
}

$.fn.customInputFeedback = function() {
	if (!$(this).hasClass('is-invalid') && ($(this).hasClass('form-control') || $(this).hasClass('form-group'))) {
		$(this).addClass('is-invalid');
		if ($(this).next('.invalid-feedback').length == 0 && !$(this).parent().hasClass('form-inline') && !$(this).parent().hasClass('input-group') && !$(this).parent().hasClass('dropdown')) {
			$(this).after($('<div class="invalid-feedback">Please fill in the necessary information.</div>'));
		}
	}
	return this;
}

$(function() {
	$('input[pattern]').customInputPattern();
	$('input[type="number"], input[data-type="year"]').customInputPattern('0-9');
	$('input[type="tel"]').customInputPattern('0-9|\\+|\\-');
	$('input[data-type="domain"]').customInputPattern('0-9|A-Z|a-z');
	$('input[data-type="name"]').customInputPattern(' |0-9|A-Z|a-z|ㄱ-ㅎ|ㅏ-ㅣ|가-힣');
	$('input[data-type="title"]').customInputPattern('\x20-\x7E|ㄱ-ㅎ|ㅏ-ㅣ|가-힣');
	$('input[data-pattern]').customInputInvalid();
	$('input[type="email"]').customInputInvalid('^([0-9|A-Z|a-z|_|\\-|\\.]+)@([0-9|a-z|\\-|\\.]+)\\\.([a-z]{2,})$');
	$('input[type="url"]').customInputInvalid('^http://(.*)$|^https://(.*)$');
	$('input[data-type="year"]').customInputInvalid('^[0-9]{4}$');
});

$('input[type="number"]').on('keydown', function(e) {
	if (e.keyCode == 69) {
		e.preventDefault();
	}
});

$('input[type="number"][min]').on('change blur', function() {
	if (parseInt($(this).val()) < $(this).attr('min')) {
		$(this).val($(this).attr('min'));
	}
});

$('input[type="number"][max]').on('change blur', function() {
	if (parseInt($(this).val()) > $(this).attr('max')) {
		$(this).val($(this).attr('max'));
	}
});

$('form[data-required="checkbox"]').each(function() {
	if ($(this).find('input[type="checkbox"]').length) {
		$(this).find('button[type="submit"]').addClass('disabled');
		$(this).find('input[type="checkbox"]').on('change', function() {
			if ($('input[name="' + $(this).attr('name') + '"][value]:checked').length == 0) {
				$(this).parents('form[data-required="checkbox"]').find('button[type="submit"]').addClass('disabled');
			} else {
				$(this).parents('form[data-required="checkbox"]').find('button[type="submit"]').removeClass('disabled');
			}
		});
	}
});

$('form.needs-validation').on('click', 'button[type="submit"][data-type!="save"]', function(e) {
	var form = $(this).parents('form.needs-validation');
	$(form).find('.form-control[required]:not([disabled]):not(:hidden)').each(function() {
		if (!$(this).val() || $(this).val() == '0' && $(this).is('select') && $(this).find('option').length > 1) {
			$(this).customInputFeedback().on('change blur keyup', function customRemoveFeedback() {
				if ($(this).val()) {
					$(this).off('change blur keyup', '', customRemoveFeedback).removeClass('is-invalid').next('.invalid-feedback').remove();
				}
			});
		}
	});
	$(form).find('input[type="checkbox"][required], input[type="radio"][required]').each(function() {
		if ($('input[name="' + $(this).attr('name') + '"][value]:checked').length == 0) {
			if ($(this).parents('.form-control').length)
				$(this).parents('.form-control').customInputFeedback();
			else if ($(this).parents('.form-group').length)
				$(this).parents('.form-group').customInputFeedback();
			$('input[name="' + $(this).attr('name') + '"]').on('change', function customRemoveFeedback() {
				$('input[name="' + $(this).attr('name') + '"]').off('change', '', customRemoveFeedback);
				$(this).parents('.form-control, .form-group').removeClass('is-invalid').next('.invalid-feedback').remove();
			});
		}
	});
	$(form).find('.form-control.required[data-name][data-multiple-target]').each(function() {
		var target = $(this).data('multipleTarget');
		if ($(target).children('span').length == 0) {
			$(this).customInputFeedback().on('click', function customRemoveFeedback() {
				$(this).off('click', '', customRemoveFeedback).removeClass('is-invalid').next('.invalid-feedback').remove();
			});
		}
	});
	$(form).find('.cke_required').each(function(){
		if (CKEDITOR.instances[$(this).attr('id')].getData() == '') {
			if ($(this).parents('.form-group').length)
				$(this).parents('.form-group').customInputFeedback().on('mouseover', function customRemoveFeedback() {
					$(this).removeClass('is-invalid').off('mouseover', '', customRemoveFeedback);
				});
		}
	})
	if ($(form).find('.is-invalid').length) {
		e.preventDefault();
		if ($(form).find('.is-invalid').eq(0).parents('fieldset').length) {
			$(form).find('.is-invalid').eq(0).parents('fieldset').customScrollAnimate();
		}
		if (!$('.modal.show').length) {
			Alert('Please fill in the necessary information.');
		}
	} else {
		$(form).find('[pattern]').removeAttr('pattern');
		$('[data-beforeunload]').removeAttr('data-beforeunload');
	}
});
