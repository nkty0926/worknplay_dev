<?php include_once 'pages/common/header.php'; ?>
<style>
#bottomToTop, #topToBottom {
	display: none;
}
main>section {
	width: 100vw;
}
main>nav#sidebar {
	transition: margin .25s ease-out;
}
main>nav#sidebar.hide {
	margin-left: -15rem;
}
main>nav#sidebar .list-group {
	width: 15rem;
	transition: all .25s ease-out;
}
main>nav#sidebar .list-group .list-group {
	width: calc(100% - 1.25rem);
	margin-left: 1.25rem;
}
main>nav#sidebar .list-group-item {
	padding: 0;
}
main>nav#sidebar .list-group-item-action {
	position: relative;
	display: block;
	padding: .75rem 1.25rem;
}
main>nav#sidebar .list-group-item-action.active {
	background-color: var(--primary-dark) !important;
	border-color: var(--primary-darkness) !important;
	color: var(--white) !important;
}
.dataTables_wrapper a, .dataTables_wrapper button {
	display: block;
}
.dataTables_wrapper button:not(.btn) {
	padding: 0;
	border: 0;
	background: none;
	text-align: left;
}
.btn-link {
	color: var(--primary) !important;
}
.btn-link:hover {
	color: var(--primary-dark) !important;
	text-decoration: underline !important;
}
</style>
<script defer>
$(function() {
	$('main>nav#sidebar .list-group-item-action').each(function() {
		if (location.href.indexOf($(this).attr('href')) >= 0) {
			$(this).addClass('active');
			$(this).parents('.list-group-item').eq(1).addClass('bg-light');
			$(this).parents('.collapse').collapse('show');
			var pageTitle = '';
			$(this).parents('.list-group').each(function() {
				if ($(this).prev('.list-group-item-action').length) {
					if (pageTitle) {
						pageTitle = $(this).prev('.list-group-item-action').text() + ' > ' + pageTitle;
					} else {
						pageTitle = $(this).prev('.list-group-item-action').text();
					}
				}
			});
			if (pageTitle) {
				pageTitle += ' > ' + $(this).text();
			} else {
				pageTitle = $(this).text();
			}
			$('#page-title').text(pageTitle);
		}
	});
});
</script>

<!-- main -->
<main class="d-flex">

	<!-- nav#sidebar -->
	<nav class="bg-light border-right<?= $WP->isMobileUser() ? ' hide' : '' ?>" id="sidebar">
		<ul class="list-group list-group-flush">
			<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Member">Members</a></li>
			<li class="list-group-item">
				<a class="list-group-item-action" data-toggle="collapse" data-parent="#sidebar" data-target="#sidebar-common">Common</a>
				<ul class="list-group border-top collapse" id="sidebar-common">
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Common/Question">Contact Us</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Common/Page">Pages</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Common/Email">Email Contents</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Common/Code">Codes</a></li>
<?php if($_SESSION['DEBUG_MODE']){ ?>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Common/LocationSubw">Subway Stations</a></li>
<?php } ?>
					<li class="list-group-item">
						<a class="list-group-item-action" data-toggle="collapse" data-parent="#sidebar-common" data-target="#sidebar-advertisement">Advertisement</a>
						<ul class="list-group border-top collapse" id="sidebar-advertisement">
							<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Advertisement">Work</a></li>
							<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Blogs/Advertisement">Blogs</a></li>
						</ul>
					</li>
				</ul>
			</li>
		</ul>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a class="list-group-item-action" data-toggle="collapse" data-parent="#sidebar" data-target="#sidebar-work">Work</a>
				<ul class="list-group border-top collapse" id="sidebar-work">
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Purchase">Purchase</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Company">Companies</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Job">Jobs</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Event">Events</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Work/Resume">Resumes</a></li>
				</ul>
			</li>
		</ul>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a class="list-group-item-action" data-toggle="collapse" data-parent="#sidebar" data-target="#sidebar-blogs">Blogs</a>
				<ul class="list-group border-top collapse" id="sidebar-blogs">
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Blogs/Profile">Profiles</a></li>
					<li class="list-group-item"><a class="list-group-item-action" href="/ADMIN/Blogs/Article">Articles</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<!-- /nav#sidebar -->

	<script defer>$(function(){ $('#dataTable').DataTable({ searching:true, ordering:true, order:[0, <?= $_GET['MENU']=='Page'?'"asc"':'"desc"' ?>], paging:true, lengthChange:true, pageLength:15, lengthMenu:[10,15,20,25,50,100] }); });</script>

	<style>.checkbox-inline>input[type="checkbox"]+span{color:#777777;}.checkbox-inline>input[type="checkbox"]:checked+span{color:#222222;}table+.pagination{margin-top:0;}</style>

	<script>
$(document).on('click', '[data-toggle="modal"][data-target="#detail"]', function(){
	$('#detail .modal-title').html($(this).attr('title'));
	$('#detail .modal-body').html($(this).attr('data-content'));
}); $(document).on('hidden.bs.modal', '#detail', function(){ $('#detail .modal-body').empty(); });
	</script>

	<aside class="modal" id="detail" tabindex="-1" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"><h4 class="modal-title"></h4></div>
				<div class="modal-body"></div>
				<div class="modal-footer"><button type="button" class="btn btn-light" data-dismiss="modal">OK</button></div>
			</div>
		</div>
	</aside>

	<script>
$(document).on('click', '[data-toggle="action"]', function(e){
	var tr = $(this).parents('tr');
	var action = $(this).attr('data-action');
	var table = $(this).attr('data-table');
	var pk = $(this).attr('data-pk');
	if(action=='delete'){
		Confirm("삭제하시면 복구할 수 없습니다.<br />정말 삭제하시겠습니까?", function(){ $.ajax({
			type: 'post', url: '/actions/Action', data: 'action=' + action + '&table=' + table + '&pk=' + pk,
			success: function(result){ Alert(result, function(){ if(tr) $('#dataTable').DataTable().row(tr).remove().draw(); else location.reload(); }); }
		}) });
	} return false;
});
	</script>

	<!-- section -->
	<section class="py-3 pt-5 py-lg-5 position-relative">

		<a class="btn btn-outline-secondary btn-sm" style="position:absolute;top:10px;left:15px;z-index:999;" href="javascript:void(0);" onclick="$('#sidebar').toggleClass('hide');$(this).find('.fa').toggleClass('fa-chevron-right');"><i class="fa fa-chevron-left<?= $WP->isMobileUser() ? ' fa-chevron-right' : '' ?>"></i></a>

		<div class="container-fluid">
			<h3 class="mb-4" id="page-title"></h3>
		</div>

