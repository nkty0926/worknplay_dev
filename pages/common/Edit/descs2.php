<?php
	if(!isset($_descs2_cke_)) $_descs2_cke_ = false;
?>
			<!-- fieldset : Descriptions2 -->
			<fieldset class="" id="fieldset-descs2">
				<!-- legend>Descriptions2</legend -->
<?php
	$descs2 = array(); if(isset($rs['descs2']) && !empty($rs['descs2'])){ foreach(explode('§', $rs['descs2']) as $descs2_item){
		$descs2[explode('¶', $descs2_item)[0]] = explode('¶', $descs2_item)[1];
	}}
	$descs2_idx=0; foreach($descs2_labels as $descs2_label){ if(isset($descs2[$descs2_label]) && !empty($descs2[$descs2_label]) || $descs2_idx<2){ $descs2_text = $descs2[$descs2_label]; $descs2_idx++;
?>
				<div class="form-group">
<?php if($descs2_idx>2){ ?>
					<a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a>
<?php } ?>
					<label><?= $descs2_label ?><input type="hidden" name="descs2-label[]" value="<?= $descs2_label ?>" /></label>
					<div class="form-group">
						<textarea class="<?= $_descs2_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs2-desc-<?= $descs2_idx ?>" name="descs2-desc[]"><?= $descs2_text ?></textarea>
						<!-- script defer>$(function(){ CKEDITOR.replace('descs2-desc-<?= $descs2_idx ?>'); });</script -->
					</div>
				</div>
<?php }} foreach($descs2 as $descs2_label => $descs2_text){ if(!in_array($descs2_label, $descs2_labels)){ $descs2_idx++; ?>
				<div class="form-group">
					<a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a>
					<div class="form-group">
						<input type="text" class="form-control" name="descs2-label[]" value="<?= htmlspecialchars(trim($descs2_label)) ?>" placeholder="Title" />
					</div>
					<div class="form-group">
						<textarea class="<?= $_descs2_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs2-desc-<?= $descs2_idx ?>" name="descs2-desc[]"><?= $descs2_text ?></textarea>
						<!-- script defer>$(function(){ CKEDITOR.replace('descs2-desc-<?= $descs2_idx ?>'); });</script -->
					</div>
				</div>
<?php }} ?>
				<div class="mb-n0" id="descs2-target">
<?php if(false){ foreach($descs2_labels as $descs2_label){ ?>
					<div class="mb-0"><a href="javascript:void(0);" data-toggle="descs2" data-value="<?= $descs2_label ?>"<?= isset($descs2[$descs2_label])?' style="display:none;"':'' ?>>+ <?= $descs2_label ?></a></div>
<?php }} ?>
					<div class="mb-0"><a href="javascript:void(0);" data-toggle="descs2">+ Add</a></div>
				</div>
				<input type="hidden" name="descs2" />
				<style>
					#fieldset-descs2 .form-group {
					}
					#fieldset-descs2 .form-group>label, #fieldset-descs2 .form-group>input {
						display: block;
						border: 1px solid #ced4da;
						border-top-left-radius: .5rem;
						border-top-right-radius: .5rem;
						border-bottom-left-radius: 0;
						border-bottom-right-radius: 0;
						margin-bottom: 0;
						padding: .375rem .75rem;
						background-color: #f8f9fa;
					}
					#fieldset-descs2 .form-group>textarea {
						border-top-left-radius: 0;
						border-top-right-radius: 0;
					}
					#fieldset-descs2 [data-toggle="remove"]+.form-group {
						margin-bottom: 0;
					}
				</style>
				<script defer>
					function strip_joiner(str){ if(str) return str.replace(/¶/g, '&para;').replace(/§/g, '&sect;'); else return ''; };
					$('#fieldset-descs2').on('click', '[data-toggle="descs2"]', function() {
						var idx = $('#descs2-target').siblings('.form-group').length + 1;
						while ($('#descs2-desc-' + idx).length) idx++;
						var label = $(this).data('value');
						if (label) {
							$('#descs2-target').before('<div class="form-group"><a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a><label>' + label + '<input type="hidden" name="descs2-label[]" value="' + label + '"/></label><div class="form-group"><textarea class="<?= $_descs2_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs2-desc-' + idx + '" name="descs2-desc[]"></textarea></div></div>');
							$(this).parent().hide();
						} else {
							$('#descs2-target').before('<div class="form-group"><a class="float-right" href="javascript:void(0);" data-toggle="remove">&times;</a><div class="form-group"><input type="text" class="form-control" name="descs2-label[]" value="" placeholder="Title"/></div><div class="form-group"><textarea class="<?= $_descs2_cke_?'ckeditor':'form-control textarea-autosize' ?>" id="descs2-desc-' + idx + '" name="descs2-desc[]"></textarea></div></div>');
						}
<?php if($_descs2_cke_){ ?>
						CKEDITOR.replace('descs2-desc-' + idx);
<?php }else{ ?>
						$('#descs2-desc-' + idx).customTextareaAutosize();
<?php } ?>
					});
					$('#fieldset-descs2').on('click', '[data-toggle="remove"]', function() {
						$(this).parent().remove();
						$('#descs2-target [data-toggle="descs2"]').each(function() {
							var label = $(this).data('value');
							if (label && $('#fieldset-descs2 input[name="descs2-label[]"][value="' + label + '"]').length)
								$(this).parent().hide();
							else
								$(this).parent().show();
						});
					});
					$('#fieldset-descs2').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#fieldset-descs2>.form-group').each(function() {
							var arr2 = [];
							arr2.push(strip_joiner($(this).find('input[name="descs2-label[]"]').val()));
							if ($(this).find('.ckeditor[name="descs2-desc[]"]').length) {
								arr2.push(strip_joiner(CKEDITOR.instances[$(this).find('.ckeditor[name="descs2-desc[]"]').attr('id')].getData()));
							} else {
								arr2.push(strip_joiner($(this).find('[name="descs2-desc[]"]').val()));
							}
							if (arr2[arr2.length - 1] != '')
								arr.push(arr2.join('¶'));
						});
						$('input[type="hidden"][name="descs2"]').val(arr.join('§'));
					});
				</script>
			</fieldset>
			<!-- /fieldset : Descriptions2 -->
