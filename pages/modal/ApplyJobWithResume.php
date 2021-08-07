
	<!-- .modal#modalFormApplyJobWithResume -->
	<form class="modal needs-validation" id="modalFormApplyJobWithResume" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title">Apply Now</h5>
			</div>
<?php if(isset($resumes) && !empty($resumes)){ ?>
			<div class="form-group form-control h-auto">
				<label>Select a Resume</label>
				<div class="form-group px-3">
<?php foreach($resumes as $resume){ ?>
					<div class="form-check">
						<input type="radio" class="form-check-input" id="workResume<?= $i ?>" name="work_resume" value="<?= $resume['no'] ?>" required />
						<label class="form-check-label" for="workResume<?= $i ?>"><?= $resume['title'] ?></label>
					</div>
<?php } ?>
				</div>
				<a class="btn btn-outline-secondary" href="/Work/Seeker" target="_blank">Go to My Resume ▶</a>
			</div>
<?php if(!isset($rs['appl_cover_letter']) || !empty($rs['appl_cover_letter'])){ ?>
			<div class="form-group" id="modalFormApplyJobWithResumeCoverLetter">
				<label class="font-weight-bold">Cover Letter for "<span id="modalFormApplyJobWithResumeName"><?= $rs['title'] ?></span>"</label>
				<textarea class="form-control" id="cover_letter" name="cover_letter" rows="5" required></textarea>
			</div>
<?php } ?>
<?php if(isset($rs['appl_questions']) && !empty($rs['appl_questions'])){ ?>
			<div class="form-group">
				<strong>Questions</strong>
<?php foreach(explode('|', $rs['appl_questions']) as $i => $appl_question){ ?>
			<div class="form-group">
				<label for="answer_<?= $i+1 ?>"><?= $i+1 ?>. <?= $appl_question ?></label>
				<input type="hidden" name="questions[]" value="<?= $appl_question ?>" />
				<textarea class="form-control" id="answer_<?= $i+1 ?>" name="answers[]" rows="3" required></textarea>
			</div>
<?php } ?>
			</div>
<?php } ?>
			<div class="text-right">
				<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
				<button type="submit" class="btn btn-primary" name="action" value="ApplyJobWithResume">Send Application</button>
				<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
			</div>
<?php }else{ ?>
			<p class="text-muted mb-5"><i class="fa fa-exclamation-circle"></i> There is no resume registered.</p>
			<div class="text-right">
				<a class="btn btn-outline-secondary" href="/Work/Seeker" target="_blank">Go to Create your Resume ▶</a>
			</div>
<?php } ?>
		</div>
		<script>
			$('#modalFormApplyJobWithResume').on('submit', function(){
				$.ajax({ type: 'post', url: '/actions/ApplyJobWithResume', data: 'action=ApplyJobWithResume&' + $(this).serialize(), success: function(result){
					location.reload();
				} }); return false;
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormApplyJobWithResume -->
