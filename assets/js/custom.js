/**
 * 
 * Scroll Animation
 */

$.fn.customScrollAnimate = function() {
	$('html').animate({
		'scrollTop' : $(this).offset().top - parseInt($(this).css('margin-bottom')) / 2 - $('.navbar.sticky-top').outerHeight()
	}, 200);
	return this;
}

// a[href=""], a.disabled
$(document).on('click', 'a[href=""], a.disabled', function() {
	return false;
});

// a[href="#img-modal"]
$(document).on('click', 'a[href="#img-modal"]', function() {
	if ($(this).find('img, figure[src]').length) {
		var src = $(this).find('img, figure[src]').attr('src');
		var title = $(this).find('img, figure[src]').attr('title');
		$('.modal').modal('hide');
		$('body').append($('<div class="modal modal-carousel" id="img-modal" tabindex="-1" style="display:block;"></div>').html([ $('<div class="modal-dialog modal-lg"></div>').html([ $('<div class="modal-content"></div>').html([ $('<button type="button" class="close" data-dismiss="modal">&times;</button>'), $('<img class="img-fluid" src="' + src + '" title="' + (title ? title : '') + '"/>') ]) ]) ]));
		$('#img-modal').modal('show');
		return false;
	}
});
$(document).on('hidden.bs.modal', '#img-modal', function() {
	$('#img-modal').remove();
});

// img[alt], img[title]
$(function() {
	$('img[title][alt=""], img[title]:not([alt])').each(function() {
		$(this).attr('alt', $(this).attr('title'));
	});
	$('img[alt][title=""], img[alt]:not([title])').each(function() {
		$(this).attr('title', $(this).attr('alt'));
	});
});

// [data-toggle="popover"], [data-toggle="tooltip"]
$(function() {
	$('[data-toggle="popover"]').popover();
	$('[data-toggle="tooltip"]').tooltip();
});

// [data-toggle="collapse"][data-parent]
$(document).on('click', '[data-toggle="collapse"][data-parent]', function() {
	$($(this).data('parent')).find('.collapse').not($(this).data('target')).collapse('hide');
});

// [data-toggle="tbody-collapse"]
$(document).on('click', '[data-toggle="tbody-collapse"]', function() {
	$(this).find('tr').toggleClass('active').parents('tbody').next('.collapse').toggleClass('show');
});

// [data-toggle="print"]
$(document).on('click', '[data-toggle="print"]', function() {
	$('iframe[id!="st_gdpr_iframe"]:visible').each(function() {
		$(this).after('<div class="iframe-placeholder card card-body" style="width:' + $(this).width() + 'px;height:' + $(this).height() + 'px;">VIDEO</div>').hide();
	});
	window.print();
	$('iframe:hidden+.iframe-placeholder').each(function() {
		$(this).before('iframe').show().next('.iframe-placeholder').remove();
	});
});

// .tab-pane
$(function() {
	$('.tab-content').each(function() {
		if ($(this).find(location.hash).length) {
			$('[href="' + location.hash + '"]').trigger('click');
			$(window).scrollTop(0);
		} else {
			$('[href="' + '#' + $(this).find('.tab-pane').eq(0).attr('id') + '"]').trigger('click');
		}
	});
});

// #topToBottom, .fixed-top.fade
$(function() {
	var offset = 0;
	$('body>nav, body>header').not('.fixed-top').each(function() {
		offset += $(this).outerHeight();
	});
	$('#topToBottom').addClass('fade show');
	$(window).on('scroll', function() {
		if ($(window).scrollTop() > offset) {
			$('#topToBottom').removeClass('show').hide();
			$('.fixed-top.fade').show().addClass('show');
		} else {
			$('#topToBottom').show().addClass('show');
			$('.fixed-top.fade').removeClass('show').hide();
		}
	});
});

// .col-xs-
$(function() {
	$('[class*="col-xs-"]').each(function() {
		$(this).attr('class', $(this).attr('class').replace('col-xs-', 'col-'));
	});
});

//DataTable
$(document).on('click', '[data-dt-idx]', function(){
	history.pushState({dtIdx: $(this).data('dtIdx')}, document.title, location.href.split('#')[0] + '#dtIdx=' + $(this).data('dtIdx'));
});
$(function(){
	if ($('#dataTable').length) {
		if (location.hash.indexOf('#dtIdx=') != -1) {
			$('#dataTable').dataTable().fnPageChange(parseInt(location.hash.replace('#dtIdx=', '')) - 1, true);
		} else if ($('#dataTable_filter').length) {
			$('#dataTable').DataTable().search(decodeURIComponent(location.hash).substr(1)).draw();
		}
	}
});