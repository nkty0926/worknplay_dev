
	<!-- .modal#modalFormSaveResume -->
	<form class="modal needs-validation" id="modalFormSaveResume" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
		<div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
			<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
			<div class="form-group">
				<h5 class="modal-title">Select Folder to Save</h5>
			</div>
			<div class="form-group form-control h-auto px-3 border-0">
<?php foreach($DB->selectWorkResumeFolder() as $i => $folder){ ?>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="workResumeFolder<?= $i ?>" name="save_work_resume_folder" value="<?= $folder['no'] ?>" required />
					<label class="form-check-label" for="workResumeFolder<?= $i ?>"><?= $folder['folder_name'] ?></label>
				</div>
<?php } ?>
				<div class="form-check">
					<input type="radio" class="form-check-input" id="workResumeFolder0" name="save_work_resume_folder" value="0" onfocus="$(this).next('label').find('input').focus();" required />
					<label class="form-check-label" for="workResumeFolder0"><input type="text" class="form-control" name="folder_name" placeholder="New Folder Name" onfocus="$(this).parent('label').prev('input').prop('checked',true);" /></label>
				</div>
			</div>
			<div class="text-right">
				<input type="hidden" name="work_resume" value="<?= $rs['no'] ?>" />
				<button type="submit" class="btn btn-primary" name="action" value="SaveResume">Save</button>
				<button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<script defer>
			$('[data-toggle="modal"][data-target="#modalFormSaveResume"]').on('click', function(){
				if($(this).data('pk'))
					$('#modalFormSaveResume').find('input[name="work_resume"]').val($(this).data('pk'));
			});
			$('#modalFormSaveResume').on('submit', function(){
				$.ajax({ type: 'post', url: '/actions/SaveResume', data: 'action=SaveResume&' + $(this).serialize(), success: function(result){
					Dialog(result); $('#modalFormSaveResume').find('input[type="text"]').val(''); $('#modalFormSaveResume').find('input[type="radio"]').prop('checked', false); $('[data-toggle="modal"][data-target="#modalFormSaveResume"][data-pk="' + $('#modalFormSaveResume').find('input[name="work_resume"]').val() + '"]').addClass('active');
				} }); return false;
			});
		</script>
			</div>
		</div>
	</form>
	<!-- /.modal#modalFormSaveResume -->
