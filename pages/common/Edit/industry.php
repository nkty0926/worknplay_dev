			<!-- fieldset : Industry -->
			<fieldset class="mb-5" id="fieldset-job-category">
				<legend class="required">Industry<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Select a general industry from the first drop-down box and a more specific industry from the second drop-down box."></a></legend>
				<div class="form-row form-group">
					<div class="col-12 col-md-6">
						<select class="form-control custom-select custom-select-lg" id="job-category-parent" name="job_category_parent" data-child="#job-category-child" required>
							<option value="">Select</option>
<?php $code_work_job_category = $DB->selectCode('work_job_category'); foreach($code_work_job_category as $job_category_parent){ ?>
							<option value="<?= $job_category_parent['no'] ?>"<?= $rs['job_category_parent']==$job_category_parent['no']?' selected':'' ?>><?= $job_category_parent['name'] ?></option>
<?php } ?>
						</select>
					</div>
					<div class="col-12 col-md-6">
						<select class="form-control custom-select custom-select-lg" id="job-category-child" name="job_category_child" data-parent="#job-category-parent" required>
							<option value="" data-parent-value="">Select</option>
<?php foreach($code_work_job_category as $job_category_parent){ ?>
							<!-- <option value="0" data-parent-value="<?= $job_category_parent['no'] ?>">All</option> -->
<?php foreach($job_category_parent['children'] as $job_category_child){ ?>
							<option value="<?= $job_category_child['no'] ?>" data-parent-value="<?= $job_category_parent['no'] ?>"<?= $rs['job_category_child']==$job_category_child['no']?' selected':'' ?>><?= $job_category_child['name'] ?></option>
<?php }} ?>
						</select>
					</div>
				</div>
				<p class="form-text"><strong>Keywords</strong> <sub class="btn btn-primary btn-sm mt-n2 px-1 py-0" id="job-category-tag-toggler" style="width:24px;height:24px;"><i class="fa fa-<?= empty($rs['job_category_child'])?'plus':'times' ?>" data-toggle="collapse" data-target="#job-category-tag" onclick="$(this).toggleClass('fa-plus').toggleClass('fa-times');"></i></sub><br />Add keywords regarding subjects or topics teachers would be teaching. Select from the scroll box or enter your own keywords. You may add 10 keywords.</p>
				<div class="card form-group collapse<?= empty($rs['job_category_child'])?'':' show' ?>" id="job-category-tag">
					<div class="card-body mb-n2">
<?php
	foreach($code_work_job_category as $job_category_parent){
		foreach($job_category_parent['children'] as $job_category_child){
			foreach($job_category_child['children'] as $job_category_tag){
?>
						<label class="mb-1 mr-2" style="<?= $rs['job_category_child']!=$job_category_child['no']?'display:none;':'' ?>">
							<input type="checkbox" class="job-category-tag" value="<?= $job_category_tag['name'] ?>" data-parent-value="<?= $job_category_child['no'] ?>"<?= isset($rs['job_category_tag']) && strpos($rs['job_category_tag'], $job_category_tag['name'])!==false?' checked':'' ?> />
							<span><?= $job_category_tag['name'] ?></span>
						</label>
<?php
			}
		}
	}
?>
						<div class="form-group input-group mb-0 mt-3">
							<input type="text" class="form-control form-control-lg" placeholder="Add Additional Keywords" data-name="job_category_tag[]" data-multiple-target="#job-category-target" />
							<div class="input-group-append">
								<button type="button" class="btn btn-light">ADD</button>
							</div>
						</div>
					</div>
				</div>
				<div id="job-category-target">
<?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ foreach(explode(',', $rs['job_category_tag']) as $category){ ?>
					<span class="mr-2"><input type="hidden" name="job_category_tag[]" value="<?= $category ?>" /><?= $category ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
				</div>
				<script defer>
					$('#job-category-child').on('change', function() {
						$('.job-category-tag').parent('label').hide();
						if ($('.job-category-tag[data-parent-value="' + $('#job-category-child').val() + '"]').length) {
							$('#job-category-tag-toggler').show();
							$('.job-category-tag[data-parent-value="' + $('#job-category-child').val() + '"]').parent('label').show();
						} else {
							$('#job-category-tag-toggler').hide();
							$('#job-category-tag').collapse('hide');
						}
					});
					$('.job-category-tag').on('change', function() {
						var checked = $(this).prop('checked');
						var value = $(this).val();
						$('.job-category-tag').each(function() {
							if ($(this).val() == value) {
								$(this).prop('checked', checked);
							}
						});
						if (checked) {
							if ($('input[name="job_category_tag[]"][value="' + value + '"]').length == 0) {
								$('#job-category-target').append('<span class="mr-2"><input type="hidden" name="job_category_tag[]" value="' + value + '" />' + value + ' <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
							}
						} else {
							$('input[name="job_category_tag[]"][value="' + value + '"]').parent('span').remove();
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Industry -->
