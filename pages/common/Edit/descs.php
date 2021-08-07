<?php
	if(!isset($_descs_cke_)) $_descs_cke_ = false;
?>
			<!-- fieldset : Descriptions -->
			<fieldset class="" id="fieldset-descs">
				<!-- legend>Descriptions</legend -->
<?php
	$descs = array(); if(isset($rs['descs']) && !empty($rs['descs'])){ foreach(explode('§', $rs['descs']) as $descs_item){
		$descs[explode('¶', $descs_item)[0]] = explode('¶', $descs_item)[1];
	}}
	$descs_idx=0; foreach($descs_labels as $descs_label){ if(isset($descs[$descs_label]) && !empty($descs[$descs_label])){ $descs_text = $descs[$descs_label]; $descs_idx++;
?>
				<div class="form-group">
					<a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a>
					<label><?= $descs_label ?><input type="hidden" name="descs-label[]" value="<?= $descs_label ?>" /></label>
					<div class="form-group">
						<textarea class="<?= $_descs_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs-desc-<?= $descs_idx ?>" name="descs-desc[]"><?= $descs_text ?></textarea>
						<!-- script defer>$(function(){ CKEDITOR.replace('descs-desc-<?= $descs_idx ?>'); });</script -->
					</div>
				</div>
<?php }} foreach($descs as $descs_label => $descs_text){ if(!in_array($descs_label, $descs_labels)){ $descs_idx++; ?>
				<div class="form-group">
					<a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a>
					<div class="form-group">
						<input type="text" class="form-control" name="descs-label[]" value="<?= htmlspecialchars(trim($descs_label)) ?>" placeholder="Title" />
					</div>
					<div class="form-group">
						<textarea class="<?= $_descs_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs-desc-<?= $descs_idx ?>" name="descs-desc[]"><?= $descs_text ?></textarea>
						<!-- script defer>$(function(){ CKEDITOR.replace('descs-desc-<?= $descs_idx ?>'); });</script -->
					</div>
				</div>
<?php }} ?>
				<div class="mb-n0" id="descs-target">
<?php foreach($descs_labels as $descs_label){ ?>
					<div class="mb-0"><a href="javascript:void(0);" data-toggle="descs" data-value="<?= $descs_label ?>"<?= isset($descs[$descs_label])?' style="display:none;"':'' ?>>+ <?= $descs_label ?></a></div>
<?php } ?>
					<div class="mb-0"><a href="javascript:void(0);" data-toggle="descs">+ Add</a></div>
				</div>
				<input type="hidden" name="descs" />
				<script defer>
					function strip_joiner(str){ if(str) return str.replace(/¶/g, '&para;').replace(/§/g, '&sect;'); else return ''; };
					$('#fieldset-descs').on('click', '[data-toggle="descs"]', function() {
						var idx = $('#descs-target').siblings('.form-group').length + 1;
						while ($('#descs-desc-' + idx).length) idx++;
						var label = $(this).data('value');
						if (label) {
							$('#descs-target').before('<div class="form-group"><a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a><label>' + label + '<input type="hidden" name="descs-label[]" value="' + label + '"/></label><div class="form-group"><textarea class="<?= $_descs_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs-desc-' + idx + '" name="descs-desc[]"></textarea></div></div>');
							$(this).parent().hide();
						} else {
							$('#descs-target').before('<div class="form-group"><a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a><div class="form-group"><input type="text" class="form-control" name="descs-label[]" value="" placeholder="Title"/></div><div class="form-group"><textarea class="<?= $_descs_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs-desc-' + idx + '" name="descs-desc[]"></textarea></div></div>');
						}
<?php if($_descs_cke_){ ?>
						CKEDITOR.replace('descs-desc-' + idx);
<?php }else{ ?>
						$('#descs-desc-' + idx).customTextareaAutosize();
<?php } ?>
					});
					$('#fieldset-descs').on('click', '[data-toggle="remove"]', function() {
						$(this).parent().remove();
						$('#descs-target [data-toggle="descs"]').each(function() {
							var label = $(this).data('value');
							if (label && $('#fieldset-descs input[name="descs-label[]"][value="' + label + '"]').length)
								$(this).parent().hide();
							else
								$(this).parent().show();
						});
					});
					$('#fieldset-descs').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#fieldset-descs>.form-group').each(function() {
							var arr2 = [];
							arr2.push(strip_joiner($(this).find('input[name="descs-label[]"]').val()));
							if ($(this).find('.ckeditor[name="descs-desc[]"]').length) {
								arr2.push(strip_joiner(CKEDITOR.instances[$(this).find('.ckeditor[name="descs-desc[]"]').attr('id')].getData()));
							} else {
								arr2.push(strip_joiner($(this).find('[name="descs-desc[]"]').val()));
							}
							if (arr2[arr2.length - 1] != '')
								arr.push(arr2.join('¶'));
						});
						$('input[type="hidden"][name="descs"]').val(arr.join('§'));
					});
				</script>
			</fieldset>
			<!-- /fieldset : Descriptions -->
