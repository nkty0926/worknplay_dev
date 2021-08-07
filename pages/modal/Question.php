
	<!-- .modal#modalFormQuestion -->
	<form class="modal needs-validation" id="modalFormQuestion" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title"><?= $modalFormQuestion['title']?$modalFormQuestion['title']:'Report This Job' ?></h5>
			</div>
			<div class="form-row">
				<div class="col-sm-6 form-group">
					<input type="text" class="form-control" name="name" placeholder="Name*" maxlength="64" required />
				</div>
				<div class="col-sm-6 form-group">
					<input type="email" class="form-control" name="email" placeholder="Email*" maxlength="64" required />
				</div>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
			</div>
			<div class="form-group">
				<textarea class="form-control" name="content" placeholder="Message*" required></textarea>
			</div>
			<div class="text-right">
				<input type="hidden" name="page" value="<?= $PAGE['no'] ?>" />
				<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
				<button type="submit" class="btn btn-outline-secondary">Send</button>
			</div>
		</div>
		<script defer>
			$('#modalFormQuestion').on('submit', function(){
				$.ajax({ type: 'post', url: '/actions/Question', data: 'action=Question&' + $(this).serialize(), success: function(result){
					Dialog(result); $('#modalFormQuestion').find('input[type!="hidden"], textarea').val('');
				} }); return false;
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormQuestion -->
