
	<!-- .modal#modalFormApplyJobWithFile -->
	<form class="modal needs-validation" id="modalFormApplyJobWithFile" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title">Apply without Registration</h5>
			</div>
			<p class="text-muted">To apply without creating an account on Theworknplay, please fill out the fields below and attach your resume as a Word or PDF file.</p>
			<div class="form-group">
				<label class="required">Title</label>
				<input type="text" class="form-control" name="title" required />
			</div>
			<div class="form-row">
				<div class="col-sm-6 form-group">
					<label class="required" for="personal_firstname">First Name</label>
					<input type="text" class="form-control" id="personal_firstname" name="personal_firstname" required />
				</div>
				<div class="col-sm-6 form-group">
					<label class="required" for="personal_lastname">Last Name</label>
					<input type="text" class="form-control" id="personal_lastname" name="personal_lastname" required />
				</div>
			</div>
			<div class="form-group">
				<label class="required" for="personal_nationality">Citizenship</label>
				<div class="dropdown">
					<a class="form-control custom-select custom-select-lg dropdown-toggle required" data-toggle="dropdown" data-name="personal_nationality[]" data-multiple-target="#personal-nationality-target">Citizenship</a>
					<div class="dropdown-menu">
<?php $nationalities = array(); foreach($DB->selectCode('personal_nationality') as $nationality){ $nationalities[$nationality['no']] = $nationality['name']; ?>
						<a class="dropdown-item" href="javascript:void(0);" data-value="<?= $nationality['no'] ?>"><?= $nationality['name'] ?></a>
<?php } ?>
					</div>
				</div>
				<div id="personal-nationality-target">
<?php if(isset($rs['personal_nationality']) && !empty($rs['personal_nationality'])){ foreach(explode(',', $rs['personal_nationality']) as $personal_nationality){ ?>
					<span class="mr-2"><input type="hidden" name="personal_nationality[]" value="<?= $personal_nationality ?>" /><?= $nationalities[$personal_nationality] ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
				</div>
			</div>
			<div class="form-group">
				<label class="required" for="contact_email">Email Address</label>
				<input type="email" class="form-control" id="contact_email" name="contact_email" required />
			</div>
			<div class="form-group">
				<label class="required" for="attachment">Attachment <small>(10MB)</small></label>
				<div class="form-serial" id="attachmentSerial"></div>
				<label class="btn btn-secondary px-4" for="attachment"><i class="fa fa-plus-square"></i> Browse</label>
				<input type="file" id="attachment" data-name="attachment" data-target="#attachmentSerial" accept=".pdf,.docx,.doc,.rtf" />
			</div>
			<div class="form-group">
				<figure><img src="<?php require_once 'pages/common/ncaptcha.php'; ?>" /></figure>
				<input type="text" class="form-control" name="ncaptcha_value" required />
			</div>
			<div class="text-right">
				<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
				<button type="submit" class="btn btn-primary" name="action" value="ApplyJobWithFile">Send Application</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<script>
			$('#modalFormApplyJobWithFile').on('submit', function(){
				$.ajax({ type: 'post', url: '/actions/ApplyJobWithFile', data: 'action=ApplyJobWithFile&' + $(this).serialize(), success: function(result){
					location.reload();
				} }); return false;
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormApplyJobWithFile -->
