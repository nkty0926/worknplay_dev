			<!-- fieldset : Personal Information -->
			<fieldset class="mb-5" id="fieldset-personal">
				<legend>Personal Information</legend>
				<div class="card">
					<div class="card-body">
						<div class="form-row mb-n3">
							<div class="form-group col-12 col-md-6">
								<label class="required" for="personal_firstname">First Name</label>
								<input type="text" class="form-control" id="personal_firstname" name="personal_firstname" value="<?= htmlspecialchars(trim($rs['personal_firstname'])) ?>" placeholder="First Name" maxlength="255" required />
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required" for="personal_lastname">Last Name</label>
								<input type="text" class="form-control" id="personal_lastname" name="personal_lastname" value="<?= htmlspecialchars(trim($rs['personal_lastname'])) ?>" placeholder="Last Name" maxlength="255" required />
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required" for="personal_nationality">Citizenship</label>
								<div class="dropdown">
									<a class="form-control custom-select custom-select-lg dropdown-toggle" data-toggle="dropdown" data-name="personal_nationality[]" data-multiple-target="#personal-nationality-target">Citizenship</a>
									<div class="dropdown-menu">
<?php $nationalities = array(); foreach($DB->selectCode('personal_nationality') as $nationality){ $nationalities[$nationality['no']] = $nationality['name']; ?>
										<a class="dropdown-item" href="javascript:void(0);" data-value="<?= $nationality['no'] ?>"><?= $nationality['name'] ?></a>
<?php } ?>
									</div>
								</div>
								<div id="personal-nationality-target">
<?php if(isset($rs['personal_nationality']) && !empty($rs['personal_nationality'])){ foreach(explode(',', $rs['personal_nationality']) as $personal_nationality){ ?>
									<span class="mr-2"><input type="hidden" name="personal_nationality[]" value="<?= $personal_nationality ?>" /><?= $nationalities[$personal_nationality] ?> <a href="javascript:void(0);" data-toggle="remove">&times;</a></span>
<?php }} ?>
								</div>
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required" for="personal_gender">Gender</label>
								<select class="form-control custom-select" id="personal_gender" name="personal_gender" required>
									<option value="">Gender</option>
									<option value="1"<?= $rs['personal_gender']==1?' selected':'' ?>>Male</option>
									<option value="2"<?= $rs['personal_gender']==2?' selected':'' ?>>Female</option>
									<option value="3"<?= $rs['personal_gender']==3?' selected':'' ?>>Other</option>
								</select>
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required" for="personal_marital">Marital Status</label>
								<select class="form-control custom-select" id="personal_marital" name="personal_marital" required>
									<option value="">Marital Status</option>
									<option value="1"<?= $rs['personal_marital']==1?' selected':'' ?>>Single</option>
									<option value="2"<?= $rs['personal_marital']==2?' selected':'' ?>>Married</option>
									<option value="3"<?= $rs['personal_marital']==3?' selected':'' ?>>Couple</option>
								</select>
							</div>
							<div class="form-group col-12 col-md-6">
								<label class="required">Date of Birth</label>
								<div class="input-group">
									<select class="form-control custom-select" name="birth_month" style="width:30%;" required>
										<option value="">Month</option>
<?php for($i=0; $i<12; $i++){ ?>
										<option value="<?= $i+1 ?>"<?= explode('-', $rs['personal_birthday'])[1]==$i+1?' selected':'' ?>><?= date('M', strtotime('2020-'.($i+1).'-01')) ?></option>
<?php } ?>
									</select>
									<select class="form-control custom-select" name="birth_date" style="width:30%;" required>
										<option value="">Date</option>
<?php for($i=0; $i<31; $i++){ ?>
										<option value="<?= $i+1 ?>"<?= explode('-', $rs['personal_birthday'])[2]==$i+1?' selected':'' ?>><?= $i+1 ?></option>
<?php } ?>
									</select>
<?php if(false){ ?>
									<select class="form-control custom-select" name="birth_year" style="width:40%;" required>
										<option value="">Year</option>
<?php for($i=date('Y'); $i>=1900; $i--){ ?>
										<option value="<?= $i ?>"<?= explode('-', $rs['personal_birthday'])[0]==$i?' selected':'' ?>><?= $i ?></option>
<?php } ?>
									</select>
<?php }else{ ?>
									<input type="text" class="form-control" name="birth_year" value="<?= explode('-', $rs['personal_birthday'])[0] ?>" placeholder="Year" style="width:40%;" data-type="year" required />
<?php } ?>
								</div>
							</div>
<?php if(false){ ?>
							<div class="form-group col-12 col-md-6">
								<label for="personal_visa">Visa Type</label>
<?php if(false){ ?>
								<select class="form-control custom-select" id="personal_visa" name="personal_visa">
									<option value="">Visa Type</option>
<?php for($i=0; $i<10; $i++){ ?>
									<option value="<?= 'D-'.($i+1) ?>"<?= $rs['personal_visa']=='D-'.($i+1)?' selected':'' ?>><?= 'D-'.($i+1) ?></option>
<?php } ?>
<?php for($i=0; $i<10; $i++){ ?>
									<option value="<?= 'E-'.($i+1) ?>"<?= $rs['personal_visa']=='E-'.($i+1)?' selected':'' ?>><?= 'E-'.($i+1) ?></option>
<?php } ?>
<?php for($i=0; $i<6; $i++){ ?>
									<option value="<?= 'F-'.($i+1) ?>"<?= $rs['personal_visa']=='F-'.($i+1)?' selected':'' ?>><?= 'F-'.($i+1) ?></option>
<?php } ?>
									<option value="Others"<?= $rs['personal_visa']=='Others'?' selected':'' ?>>Others</option>
									<option value="None"<?= $rs['personal_visa']=='None'?' selected':'' ?>>None</option>
								</select>
<?php }else{ ?>
								<input type="text" class="form-control" name="personal_visa" value="<?= htmlspecialchars(trim($rs['personal_visa'])) ?>" placeholder="Visa Type" />
<?php } ?>
							</div>
<?php } ?>
						</div>
					</div>
				</div>
			</fieldset>
			<!-- /fieldset : Personal Details -->
