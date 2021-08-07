<?php if($_GET['MENU']!='Event'){ ?>
			<!-- fieldset : Start Date -->
			<fieldset class="mb-5" id="fieldset-period">
				<legend class="required"><?= $_GET['MENU']=='Resume'?'Available ':'' ?>Start Date</legend>
				<div class="form-group mb-0">
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_1" name="period_type" value="1"<?= isset($rs['period']) && strlen($rs['period'])>1?' checked':'' ?> required />
						<label class="form-check-label" for="period_type_1">Choose a Date</label>
					</div>
<?php if($_GET['MAIN']!='Tefl'){ ?>
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_2" name="period_type" value="2"<?= isset($rs['period']) && $rs['period']==2?' checked':'' ?> required />
						<label class="form-check-label" for="period_type_2">ASAP</label>
					</div>
<?php } ?>
					<div class="form-check form-check-inline">
						<input type="radio" class="form-check-input" id="period_type_3" name="period_type" value="3"<?= isset($rs['period']) && $rs['period']==3?' checked':'' ?> required />
						<label class="form-check-label" for="period_type_3"><?= $_GET['MENU']=='Job'?'Open Until Filled':'Any Time' ?></label>
					</div>
				</div>
				<div class="form-inline mt-2 collapse<?= isset($rs['period']) && strlen($rs['period'])>1?' show':'' ?>">
<?php if($_GET['MENU']=='Resume'){ ?>
					<input type="text" class="form-control" id="period_date" name="period_date" value="<?= isset($rs['period']) && strlen($rs['period'])>1?$rs['period']:'' ?>" placeholder="Start Date" autocomplete="off"<?= isset($rs['period']) && strlen($rs['period'])>1?' required':' disabled' ?> />
					<script defer>$(function(){ $('#period_date').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
<?php }else{ ?>
					<input type="text" class="form-control" id="period_start" name="period_start" value="<?= isset($rs['period']) && strlen($rs['period'])>1?explode(' ~ ', $rs['period'])[0]:'' ?>" placeholder="Start Date" autocomplete="off"<?= isset($rs['period']) && strlen($rs['period'])>1?' required':' disabled' ?> />
					<script defer>$(function(){ $('#period_start').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
					<strong>&nbsp;&nbsp;/&nbsp;&nbsp;</strong>
					<input type="text" class="form-control" id="period_end" name="period_end" value="<?= isset($rs['period']) && explode(' ~ ', $rs['period'])[1]?explode(' ~ ', $rs['period'])[1]:'' ?>" placeholder="Deadline" autocomplete="off" />
					<script defer>$(function(){ $('#period_end').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
<?php } ?>
				</div>
				<script defer>
					$('#fieldset-period input[type="radio"][name="period_type"]').on('change', function() {
						if ($('#fieldset-period input[type="radio"][name="period_type"]:checked').val() == '1')
							$('#fieldset-period .form-inline').addClass('show').find('input').prop('disabled', false).eq(0).prop('required', true);
						else $('#fieldset-period .form-inline').removeClass('show').find('input').prop('disabled', true).eq(0).prop('required', false);
					});
					$('#period_start').on('change', function() {
						if ($('#period_start').val()) {
							$('#period_end').datepicker('option', 'maxDate', $('#period_start').val());
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Start Date -->

<?php }else{ ?>
			<!-- fieldset : Period -->
			<fieldset class="mb-5" id="fieldset-period">
				<legend>Period</legend>
				<div class="form-inline">
					<input type="text" class="form-control" id="period_from" name="period_from" value="<?= isset($rs['period'])?explode(' ~ ', $rs['period'])[0]:'' ?>" autocomplete="off" />
					<script defer>$(function(){ $('#period_from').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
					<strong>&nbsp;&nbsp;~&nbsp;&nbsp;</strong>
					<input type="text" class="form-control" id="period_to" name="period_to" value="<?= explode(' ~ ', $rs['period'])[1]?explode(' ~ ', $rs['period'])[1]:'' ?>" autocomplete="off" />
					<script defer>$(function(){ $('#period_to').datepicker({ minDate: '<?= isset($rs['period']) && $rs['period']?explode(' ~ ', $rs['period'])[0]:0 ?>', dateFormat: 'yy-mm-dd' }); });</script>
				</div>
				<script defer>
					$('#period_from').on('change', function() {
						if ($('#period_from').val()) {
							$('#period_to').datepicker('option', 'minDate', $('#period_from').val());
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Period -->

<?php } ?>