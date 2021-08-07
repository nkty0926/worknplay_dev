<?php
	$_loc_id_ = isset($location_prefix) && !empty($location_prefix) ? $location_prefix . '-' : '';
	$_loc_nm_ = isset($location_prefix) && !empty($location_prefix) ? $location_prefix . '_' : '';
?>
			<!-- fieldset : Location -->
			<fieldset class="mb-5" id="fieldset-<?=$_loc_id_?>location">
<?php if($_GET['MENU']=='Event'){ ?>
				<legend>Location</legend>
<?php }else if(isset($location_prefix) && !empty($location_prefix)){ ?>
				<legend class="<?= isset($location_prefix) && $location_prefix=='desired'?'required':'' ?>"><?= ucfirst($location_prefix) ?> Job Location</legend>
<?php } ?>
				<div class="form-row mb-n3">
					<div class="form-group col-12 col-md">
						<select class="form-control custom-select" id="<?=$_loc_id_?>location-country" name="<?=$_loc_nm_?>location_country" data-child="#<?=$_loc_id_?>location-city" required>
							<option value="0">Country</option>
<?php foreach($DB->selectCode('country') as $country){ ?>
							<option value="<?= $country['no'] ?>"<?= $country['no']==$rs[$_loc_nm_.'location_country']?' selected':'' ?>><?= $country['name'] ?></option>
<?php } ?>
						</select>
					</div>
					<div class="form-group col-12 col-md"<?= $rs[$_loc_nm_.'location_country'] && $rs[$_loc_nm_.'location_country']=='KR'?'':' style="display:none;"' ?>>
						<select class="form-control custom-select" id="<?=$_loc_id_?>location-parent" name="<?=$_loc_nm_?>location_parent" data-parent="#<?=$_loc_id_?>location-country" data-child="#<?=$_loc_id_?>location-child">
							<option value="0">Anywhere</option>
<?php foreach($DB->selectCode('location') as $location_parent){ ?>
							<option value="<?= $location_parent['no'] ?>" data-parent-value="KR"<?= $location_parent['no']==$rs[$_loc_nm_.'location_parent']?' selected':'' ?>><?= $location_parent['name'] ?></option>
<?php } ?>
						</select>
					</div>
					<div class="form-group col-12 col-md"<?= $rs[$_loc_nm_.'location_country'] && $rs[$_loc_nm_.'location_country']=='KR'?'':' style="display:none;"' ?>>
						<select class="form-control custom-select" id="<?=$_loc_id_?>location-child" name="<?=$_loc_nm_?>location_child" data-parent="#<?=$_loc_id_?>location-parent">
							<option value="0" data-parent-value="0">Anywhere</option>
<?php foreach($DB->selectCode('location') as $location_parent){ ?>
							<option value="0" data-parent-value="<?= $location_parent['no'] ?>">Anywhere</option>
<?php foreach($location_parent['children'] as $location_child){ ?>
							<option value="<?= $location_child['no'] ?>" data-parent-value="<?= $location_parent['no'] ?>"<?= $location_child['no']==$rs[$_loc_nm_.'location_child']?' selected':'' ?>><?= $location_child['name'] ?></option>
<?php }} ?>
						</select>
					</div>
					<div class="form-group col-12 col-md"<?= !$rs[$_loc_nm_.'location_country'] || $rs[$_loc_nm_.'location_country']=='KR'?' style="display:none;"':'' ?>>
						<select class="form-control custom-select" id="<?=$_loc_id_?>location-city" name="<?=$_loc_nm_?>location_city" data-parent="#<?=$_loc_id_?>location-country">
							<option value="0">Anywhere</option>
<?php foreach($DB->selectCode('country_city') as $city){ ?>
							<option value="<?= $city['city_name'] ?>" data-parent-value="<?= $city['country_code'] ?>"<?= $city['city_name']==$rs[$_loc_nm_.'location_city']?' selected':'' ?>><?= $city['city_name'] ?></option>
<?php } ?>
						</select>
					</div>
				</div>
				<script defer>
					$('#fieldset-<?=$_loc_id_?>location').on('change', '#<?=$_loc_id_?>location-country', function() {
						if ($(this).val() == 'KR') {
							$('#<?=$_loc_id_?>location-parent').parent('.form-group').show();
							$('#<?=$_loc_id_?>location-city').parent('.form-group').hide();
						} else {
							$('#<?=$_loc_id_?>location-parent, #<?=$_loc_id_?>location-child').parent('.form-group').hide();
							if (window.customSelectOptions && $(window.customSelectOptions[$('#<?=$_loc_id_?>location-city').attr('name')]).is(function(){ return $(this).data('parentValue') == $('#<?=$_loc_id_?>location-country').val(); })
									|| $('#<?=$_loc_id_?>location-city>option[data-parent-value="' + $('#<?=$_loc_id_?>location-country').val() + '"]').length) {
								$('#<?=$_loc_id_?>location-city').parent('.form-group').show();
							} else {
								$('#<?=$_loc_id_?>location-city').parent('.form-group').hide();
							}
						}
					});
					$('#fieldset-<?=$_loc_id_?>location').on('change', '#<?=$_loc_id_?>location-parent', function() {
						if ($(this).val() != '0' && $('#<?=$_loc_id_?>location-child>option[data-parent-value="' + $(this).val() + '"]').length) {
							$('#<?=$_loc_id_?>location-child').parent('.form-group').show();
						} else {
							$('#<?=$_loc_id_?>location-child').parent('.form-group').hide();
						}
					});
				</script>
			</fieldset>
			<!-- /fieldset : Location -->
