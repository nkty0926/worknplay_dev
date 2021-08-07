			<!-- fieldset : Messengers -->
			<fieldset class="form-group" id="fieldset-messengers">
				<label>Messengers</label>
<?php $messenger_types = array('KakaoTalk', 'Line', 'Facebook', 'Skype', 'WeChat', 'Hangouts', 'WhatsApp'); ?>
				<div class="form-row">
					<div class="form-group col-4 col-md-3">
						<select class="form-control custom-select" id="fieldset-messengers-select">
							<option value="" selected disabled>Select</option>
<?php foreach($messenger_types as $type){ ?>
							<option value="<?= $type ?>"><?= $type ?></option>
<?php } ?>
						</select>
					</div>
					<div class="form-group col-8 col-md-9">
						<div class="input-group">
							<input type="text" class="form-control" id="fieldset-messengers-input" placeholder="Messenger ID" pattern="0-9|A-Z|a-z" />
							<div class="input-group-append">
								<button type="button" class="btn btn-outline-secondary btn-block" id="fieldset-messengers-add">ADD</button>
							</div>
						</div>
					</div>
				</div>
				<div class="form-serial" id="fieldset-messengers-serial" data-serial="<?= isset($rs['contact_messengers']) && !empty($rs['contact_messengers'])?$rs['contact_messengers']:'' ?>"></div>
				<script defer>
					$(function() {
						if ($('#fieldset-messengers-serial').data('serial')) {
							$('#fieldset-messengers-serial').data('serial').split(',').forEach(function(messenger) {
								var messenger_type = messenger.split(';')[0];
								var messenger_value = messenger.split(';')[1];
								fieldsetMessengersSerial(messenger_type, messenger_value);
							});
						}
						fieldsetMessengersInit();
					});
					$('#fieldset-messengers-select').on('change', function() {
						$('#fieldset-messengers-input').focus();
					});
					$('#fieldset-messengers-input').on('keydown', function(e) {
						if (e.keyCode == 13) {
							fieldsetMessengersAdd();
						}
					});
					$('#fieldset-messengers-add').on('click', function() {
						fieldsetMessengersAdd();
					});
					$('#fieldset-messengers').on('click', '[data-toggle="remove"]', function() {
						$(this).parent().remove();
						fieldsetMessengersInit();
					});
					function fieldsetMessengersSerial(messenger_type, messenger_value) {
						$('#fieldset-messengers-serial').append('<span title="' + messenger_type + ' : ' + messenger_value + '"><input type="hidden" name="contact_messengers[]" value="' + messenger_type + ';' + messenger_value + '" />' + messenger_type + ' : ' + messenger_value + ' <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>');
					}
					function fieldsetMessengersInit() {
						$('#fieldset-messengers-select>option').prop('disabled', false);
						$('#fieldset-messengers-select>option:first-child').prop('disabled', true);
						$('#fieldset-messengers input[name="contact_messengers[]"]').each(function() {
							$('#fieldset-messengers-select>option[value="' + $(this).val().split(';')[0] + '"]').prop('disabled', true);
						});
					}
					function fieldsetMessengersAdd() {
						var messenger_type = htmlspecialchars($('#fieldset-messengers-select').val());
						var messenger_value = htmlspecialchars($('#fieldset-messengers-input').val());
						if (!messenger_type) {
							$('#fieldset-messengers-select').focus();
						} else if (!messenger_value) {
							$('#fieldset-messengers-input').focus();
						} else {
							fieldsetMessengersSerial(messenger_type, messenger_value);
							$('#fieldset-messengers-select>option:first-child').prop('selected', true);
							$('#fieldset-messengers-input').val('');
						}
						fieldsetMessengersInit();
					}
				</script>
			</fieldset>
			<!-- /fieldset : Messengers -->
