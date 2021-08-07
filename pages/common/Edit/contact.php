			<!-- fieldset : Contact Information -->
			<fieldset class="mb-5" id="fieldset-contact">
				<legend>Contact Information</legend>
				<p class="form-text text-muted mt-n2 mb-2">You must fill out the required fields. You may choose to hide your contact information by checking the “Hide your contact information” box below. However, messengers and URLs will be visible.</p>
<?php
	if (isset($rs['contact_phone1']) && !empty($rs['contact_phone1']) && substr($rs['contact_phone1'], 0, 1) == '+' && strpos($rs['contact_phone1'], '-') !== false) {
		$rs['contact_phone1_code'] = substr($rs['contact_phone1'], 0, strpos($rs['contact_phone1'], '-'));
		$rs['contact_phone1'] = substr($rs['contact_phone1'], strpos($rs['contact_phone1'], '-') + 1);
	}
	if (isset($rs['contact_phone2']) && !empty($rs['contact_phone2']) && substr($rs['contact_phone2'], 0, 1) == '+' && strpos($rs['contact_phone2'], '-') !== false) {
		$rs['contact_phone2_code'] = substr($rs['contact_phone2'], 0, strpos($rs['contact_phone2'], '-'));
		$rs['contact_phone2'] = substr($rs['contact_phone2'], strpos($rs['contact_phone2'], '-') + 1);
	}
?>
				<div class="card">
					<div class="card-body">
						<div class="form-row">
							<div class="form-group col-12 col-md-6">
								<label class="required" for="contact_phone1">Primary Phone Number</label>
								<div class="input-group">
									<select class="form-control custom-select" name="contact_phone1_code" style="max-width:50%;" required>
										<option value="">Select</option>
<?php foreach($DB->selectCode('country_phone') as $phone_code){ ?>
										<option value="+<?= $phone_code['phone_code'] ?>-"<?= $rs['contact_phone1_code']==$phone_code['phone_code']?' selected':'' ?>>+<?= $phone_code['phone_code'] ?> (<?= $phone_code['name'] ?>)</option>
<?php } ?>
									</select>
									<input type="tel" class="form-control" id="contact_phone1" name="contact_phone1" value="<?= htmlspecialchars(trim($rs['contact_phone1'])) ?>" placeholder="Phone Number" maxlength="64" required />
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<label for="contact_phone2">Secondary Phone Number</label>
								<div class="input-group">
									<select class="form-control custom-select" name="contact_phone2_code" style="max-width:50%;">
										<option value="">Select</option>
<?php foreach($DB->selectCode('country_phone') as $phone_code){ ?>
										<option value="+<?= $phone_code['phone_code'] ?>-"<?= $rs['contact_phone2_code']==$phone_code['phone_code']?' selected':'' ?>>+<?= $phone_code['phone_code'] ?> (<?= $phone_code['name'] ?>)</option>
<?php } ?>
									</select>
									<input type="tel" class="form-control" id="contact_phone2" name="contact_phone2" value="<?= htmlspecialchars(trim($rs['contact_phone2'])) ?>" placeholder="Phone Number" maxlength="64" />
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required" for="contact_email">Email</label>
								<input type="email" class="form-control" id="contact_email" name="contact_email" value="<?= htmlspecialchars(trim($rs['contact_email'])) ?>" placeholder="Email" maxlength="64" required />
							</div>
<?php if($_GET['MENU']!='ResumeProfile'){ ?>
							<div class="form-group col-12 col-md-6">
								<label for="contact_person">Contact Person</label>
								<input type="text" class="form-control" id="contact_person" name="contact_person" value="<?= htmlspecialchars(trim($rs['contact_person'])) ?>" placeholder="Contact Person" maxlength="64" />
							</div>
<?php } ?>
						</div>
<?php include_once 'pages/common/Edit/contact_messengers.php'; ?>
						<div class="form-check" style="padding-top:10px; border-top:1px dashed #cccccc;">
							<input type="checkbox" class="form-check-input" id="contact_private" name="contact_private" value="1"<?= $rs['contact_private']==1?' checked':'' ?> />
							<label class="form-check-label" for="contact_private">Hide your contact information.</label>
						</div>
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Contact Information -->

<?php include_once 'pages/common/Edit/contact_urls.php'; ?>
