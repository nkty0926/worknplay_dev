// Dialog
function Dialog(msg) {
	$('.modal').modal('hide');
	$('body').append('<aside class="modal" id="dialog" tabindex="-1" data-backdrop="static" role="dialog"><div class="modal-dialog" style="max-width:400px;" role="document"><div class="modal-content text-center"><div class="modal-header bg-light py-2 justify-content-center"><h6 class="modal-title text-muted font-weight-normal">Woknplay Message</h6></div><div class="modal-body text-center">' + msg + '</div><div class="modal-footer border-top-0 pt-0"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">OK</button></div></div></div></aside>');
	$('#dialog').modal('show');
	$('.modal-backdrop').css('opacity', '0.1');
	$('#dialog .modal-footer>button:first-child').focus();
	setTimeout(function() {
		$('#dialog').modal('hide');
	}, 2000);
}
$(document).on('hidden.bs.modal', '#dialog', function() {
	$('#dialog').remove();
});

// Alert
function Alert(msg, action) {
	$('.modal').modal('hide');
	$('body').append('<aside class="modal" id="alert" tabindex="-1" data-backdrop="static" role="dialog"><div class="modal-dialog" style="max-width:400px;" role="document"><div class="modal-content text-center"><div class="modal-header bg-light py-2 justify-content-center"><h6 class="modal-title text-muted font-weight-normal">Woknplay Message</h6></div><div class="modal-body text-center">' + msg + '</div><div class="modal-footer border-top-0 pt-0"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">OK</button></div></div></div></aside>');
	$('#alert').modal('show');
	$('.modal-backdrop').css('opacity', '0.1');
	$('#alert .modal-footer>button:first-child').focus();
	if (action) {
		$('#alert .modal-footer>button:first-child').on('click', function() {
			action();
		});
	}
}
$(document).on('hidden.bs.modal', '#alert', function() {
	$('#alert').remove();
});

// Confirm
function Confirm(msg, action_true, action_false) {
	$('.modal').modal('hide');
	$('body').append('<aside class="modal" id="confirm" tabindex="-1" data-backdrop="static" role="dialog"><div class="modal-dialog" style="max-width:400px;" role="document"><div class="modal-content text-center"><div class="modal-header bg-light py-2 justify-content-center"><h6 class="modal-title text-muted font-weight-normal">Woknplay Message</h6></div><div class="modal-body text-center">' + msg + '</div><div class="modal-footer border-top-0 pt-0"><button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Yes</button><button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Cancel</button></div></div></div></aside>');
	$('#confirm').modal('show');
	$('.modal-backdrop').css('opacity', '0.1');
	$('#confirm .modal-footer>button:first-child').focus();
	$('#confirm .modal-footer>button:first-child').on('click', function() {
		action_true();
	});
	if (action_false) {
		$('#confirm .modal-footer>button:last-child').on('click', function() {
			action_false();
		});
	}
}
$(document).on('hidden.bs.modal', '#confirm', function() {
	$('#confirm').remove();
});

// [data-toggle="download"]
$(document).on('click', '[data-toggle="download"]', function() {
	var title = $(this).attr('title');
	var path = $(this).attr('data-path');
	var time = new Date().getTime();
	$('body').append('<iframe id="' + time + '" width="0" height="0" frameborder="0" src="' + '/actions/FileDownload?title=' + title + '&path=' + path + '" style="display:none;"></iframe>');
	setTimeout(function() {
		$('#' + time).remove();
	}, 2000);
});

// [data-toggle="action"]
$(document).on('click', '[data-toggle="action"]', function(e) {
	var action = $(this).data('action');
	var table = $(this).data('table');
	var pk = $(this).data('pk');
	var url = '/actions/' + (action.toLowerCase() == action ? 'Action' : action);
	e.stopPropagation();
	if (action == 'Save') {
		$.ajax({
			type : 'post',
			url : url,
			data : 'action=' + action + '&table=' + table + '&pk=' + pk,
			success : function(result) {
				console.log(result + ' : ' + Date());
				if ($(e.target).parents('article').length) {
					$(e.target).toggleClass('active');
				} else {
					$('.save').toggleClass('active');
				}
				if ($(e.target).hasClass('active')) {
					$(e.target).find('span').text(parseInt($(e.target).find('span').text()) + 1);
				} else {
					$(e.target).find('span').text(parseInt($(e.target).find('span').text()) - 1);
				}
			}
		});
	} else if (action == 'close' && table == 'work_job') {
		Confirm("All messages related to the job posting can still be viewed in the message box, even after deletion. Are you sure you want to delete it?", function() {
			$.ajax({
				type : 'post',
				url : url,
				data : 'action=' + action + '&table=' + table + '&pk=' + pk,
				success : function(result) {
					Alert(result, function() {
						location.reload();
					});
				}
			});
		});
	} else if (action == 'delete' && table == 'work_resume') {
		Confirm("All messages related to the resume can still be viewed in the message box, even after deletion. Are you sure you want to delete it?", function() {
			$.ajax({
				type : 'post',
				url : url,
				data : 'action=' + action + '&table=' + table + '&pk=' + pk,
				success : function(result) {
					Alert(result, function() {
						location.reload();
					});
				}
			});
		});
	} else if (action == 'delete') {
		Confirm("Are you sure you want to delete it?", function() {
			$.ajax({
				type : 'post',
				url : url,
				data : 'action=' + action + '&table=' + table + '&pk=' + pk,
				success : function(result) {
					Alert(result, function() {
						location.reload();
					});
				}
			});
		});
	} else {
		$.ajax({
			type : 'post',
			url : url,
			data : 'action=' + action + '&table=' + table + '&pk=' + pk,
			success : function(result) {
				Alert(result, function() {
					location.reload();
				});
			}
		});
	}
});

// .sidebar
$(document).on('show.bs.collapse hide.bs.collapse', '.sidebar .collapse', function(e) {
	if (e.type == 'show') {
		$('.sidebar .card-header>a[data-toggle="collapse"][href="#' + $(this).attr('id') + '"]>i.fa-chevron-down').addClass('fa-chevron-up').removeClass('fa-chevron-down');
	} else {
		$('.sidebar .card-header>a[data-toggle="collapse"][href="#' + $(this).attr('id') + '"]>i.fa-chevron-up').addClass('fa-chevron-down').removeClass('fa-chevron-up');
	}
});

// body>main, body>form
$(function(){
	var offset = 0;
	$('body>nav, body>footer').each(function(){
	    offset+=this.offsetHeight;
	});
	$('body>main, body>form').css('min-height', 'calc(100vh - ' + offset + 'px)');
});
