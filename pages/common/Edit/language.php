			<!-- fieldset : Spoken Languages -->
			<fieldset class="mb-5" id="fieldset-language">
				<legend>Spoken Languages</legend>
				<div class="card">
					<div class="card-body">
				<div class="row mb-n3">
					<div class="form-group col-12 col-md-4">
						<label class="required" for="language_eng">English</label>
						<select class="form-control custom-select" id="language_eng" name="language_eng" required>
							<option value=""<?= isset($rs['language_eng'])?'':' selected' ?> disabled>Select</option>
<?php for($i=0; $i<count($CONF['language_levels']); $i++){ ?>
							<option value="<?= $i+1 ?>"<?= isset($rs['language_eng']) && $rs['language_eng']==$i+1?' selected':'' ?>><?= $CONF['language_levels'][$i] ?></option>
<?php } ?>
						</select>
					</div>
<?php if(false){ ?>
					<div class="form-group col-12 col-md-4">
						<a class="text-bolder float-right" href="javascript:void(0);" onclick="$('#language_kor').val('');">&times;</a>
						<label for="language_kor">Korean</label>
						<select class="form-control custom-select" id="language_kor" name="language_kor">
							<option value=""<?= isset($rs['language_kor'])?'':' selected' ?>>Select</option>
<?php for($i=0; $i<count($CONF['language_levels']); $i++){ ?>
							<option value="<?= $i+1 ?>"<?= isset($rs['language_kor']) && $rs['language_kor']==$i+1?' selected':'' ?>><?= $CONF['language_levels'][$i] ?></option>
<?php } ?>
						</select>
					</div>
<?php } ?>
<?php if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_other){ $language_other = explode(';', $language_other); ?>
					<div class="form-group col-12 col-md-4">
						<a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a>
						<label for="language_<?= $language_other[0] ?>"><?= $language_other[0] ?></label>
						<select class="form-control custom-select" id="language_<?= $language_other[0] ?>" name="language_level[]" data-name="<?= $language_other[0] ?>" required>
<?php for($i=0; $i<count($CONF['language_levels']); $i++){ ?>
							<option value="<?= $i+1 ?>"<?= $language_other[1]==$i+1?' selected':'' ?>><?= $CONF['language_levels'][$i] ?></option>
<?php } ?>
						</select>
					</div>
<?php }} ?>
					<div class="form-group col-12 col-md-4">
						<label for="language_other">Add a Language</label>
						<select class="form-control custom-select" id="language_other" name="language_other">
							<option value="">Select</option>
<?php foreach($DB->selectCode('personal_language') as $language){ ?>
							<option value="<?= $language['name'] ?>"><?= $language['name'] ?></option>
<?php } ?>
						</select>
					</div>
				</div>
					</div>
				</div>
				<input type="hidden" name="language_others" />
				<script defer>
					$('#language_other').on('change', function() {
						var language_other = $(this).val();
						if (language_other) {
							if ($('#fieldset-language select[name="language_level[]"][data-name="' + language_other + '"]').length) {
								$('#fieldset-language select[name="language_level[]"][data-name="' + language_other + '"]').focus();
							} else {
								$('#language_other').parent().before('<div class="form-group col-12 col-md-4"><a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a><label for="language_' + language_other + '">' + language_other + '</label><select class="form-control custom-select" id="language_' + language_other + '" name="language_level[]" data-name="' + language_other + '" required><option value="" disabled>Select</option><?php for($i=0; $i<count($CONF['language_levels']); $i++){ ?><option value="<?= $i+1 ?>"><?= $CONF['language_levels'][$i] ?></option><?php } ?></select></div>').prev().find('select').focus();
							}
						}
						$('#language_other').val('');
					});
					$('#fieldset-language').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#fieldset-language select[name="language_level[]"]').each(function() {
							if ($(this).val()) {
								arr.push($(this).attr('data-name') + ';' + $(this).val());
							}
						});
						$('input[type="hidden"][name="language_others"]').val(arr.toString());
					});
				</script>
			</fieldset>
			<!-- /fieldset : Spoken Languages -->
