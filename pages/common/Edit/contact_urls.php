			<!-- fieldset : URL(s) -->
			<fieldset class="mb-5" id="fieldset-urls">
				<label>URL(s)</label>
<?php $urls_types = array('Homepage', 'Blog', 'Facebook', 'Instagram', 'Twitter', 'Pinterest', 'LinkedIn', 'Youtube', 'Vimeo'); ?>
				<div class="form-row">
					<div class="form-group col-4 col-md-3">
						<select class="form-control custom-select" id="fieldset-urls-select">
							<option value="" selected disabled>Select</option>
<?php foreach($urls_types as $type){ ?>
							<option value="<?= $type ?>"><?= $type ?></option>
<?php } ?>
						</select>
					</div>
					<div class="form-group col-8 col-md-9">
						<div class="input-group">
							<input type="url" class="form-control" id="fieldset-urls-input" placeholder="http://" />
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary btn-block" id="fieldset-urls-add">ADD</button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-serial" id="fieldset-urls-serial" data-serial="<?= isset($rs['contact_urls']) && !empty($rs['contact_urls'])?$rs['contact_urls']:'' ?>"></div>
				<script defer>
					$(function() {
						if ($('#fieldset-urls-serial').data('serial')) {
							$('#fieldset-urls-serial').data('serial').split(',').forEach(function(url) {
								var url_type = url.split(';')[0];
								var url_value = url.split(';')[1];
								fieldsetUrlsSerial(url_type, url_value);
							});
						}
						fieldsetUrlsInit();
					});
					$('#fieldset-urls-select').on('change', function() {
						$('#fieldset-urls-input').focus();
					});
					$('#fieldset-urls-input').on('keydown', function(e) {
						if (e.keyCode == 13) {
							fieldsetUrlsAdd();
						}
					});
					$('#fieldset-urls-input').on('change blur keyup', function() {
						var pattern = new RegExp('^http://(.*)$|^https://(.*)$');
						if ($(this).val() != '' && !pattern.test($(this).val())) {
							$(this).val('http://' + $(this).val());
						}
					});
					$('#fieldset-urls-add').on('click', function() {
						fieldsetUrlsAdd();
					});
					$('#fieldset-urls').on('click', '[data-toggle="remove"]', function() {
						$(this).parent().remove();
						fieldsetUrlsInit();
					});
					function fieldsetUrlsSerial(url_type, url_value) {
						$('#fieldset-urls-serial').append('<span title="' + url_value + '"><input type="hidden" name="contact_urls[]" value="' + url_type + ';' + url_value + '" />' + url_type + '[<a href="' + url_value + '" target="_blank">Check</a>] <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
					}
					function fieldsetUrlsInit() {
						$('#fieldset-urls-select>option').prop('disabled', false);
						$('#fieldset-urls-select>option:first-child').prop('disabled', true);
						$('#fieldset-urls input[name="contact_urls[]"]').each(function() {
							$('#fieldset-urls-select>option[value="' + $(this).val().split(';')[0] + '"]').prop('disabled', true);
						});
					}
					function fieldsetUrlsAdd() {
						var url_type = htmlspecialchars($('#fieldset-urls-select').val());
						var url_value = htmlspecialchars($('#fieldset-urls-input').val());
						if (!url_type) {
							$('#fieldset-urls-select').focus();
						} else if (!url_value) {
							$('#fieldset-urls-input').focus();
						} else {
							fieldsetUrlsSerial(url_type, url_value);
							$('#fieldset-urls-select>option:first-child').prop('selected', true);
							$('#fieldset-urls-input').val('');
						}
						fieldsetUrlsInit();
					}
				</script>
			</fieldset>
			<!-- /fieldset : URL(s) -->
