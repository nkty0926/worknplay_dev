			<!-- fieldset : Logo -->
			<fieldset class="mb-5" id="fieldset-logo">
				<legend class="<?= $_GET['MAIN']=='Blogs'?'required':'' ?>"><?= $_GET['MAIN']=='Account' || $_GET['MAIN']=='Blogs' || $_GET['MENU']=='ResumeProfile'?'Profile Picture':'Company Logo' ?></legend>
<?php if($_GET['MAIN']=='Account' || $_GET['MAIN']=='Blogs' || $_GET['MENU']=='ResumeProfile'){ ?>
				<p class="form-text text-muted mt-n2 mb-2">Add a professional photo to help employers picture you working on their team</p>
<?php } ?>
				<div class="collapse<?= $rs['logo_img']?'':' show' ?>" id="logo-img-target-collapse">
					<label class="btn btn-secondary" for="logo_img"><i class="fa fa-plus-square"></i> Browse</label>
				</div>
				<div id="logo-img-target">
<?php if(isset($rs['logo_img']) && !empty($rs['logo_img'])){ ?>
					<figure><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><img src="<?= $rs['logo_img']?>" onerror="this.src='/assets/images/common-noimage.png'" /></figure>
<?php } ?>
				</div>
				<input type="file" accept="image/gif, image/jpeg, image/png" class="d-none" id="logo_img" data-name="logo_img" data-target="#logo-img-target" data-target-collapse="#logo-img-target-collapse" />
				<input type="hidden" name="logo_img" value="<?= $rs['logo_img'] ?>"<?= $_GET['MAIN']=='Blogs'?' required':'' ?> />
				
<?php if($_GET['MAIN']=='Blogs'){ ?>
				<style>
					.is-invalid {
						box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgb(169, 68, 66, 0.6);
					}
				</style>
				<script defer>
					$('form.needs-validation').on('click', 'button[type="submit"]', function(e) {
						if (!$('#fieldset-logo [name="logo_img"]').val()) {
							if (!$('#fieldset-logo').parent().is('.is-invalid')) {
								$('#fieldset-logo').wrap('<div class="is-invalid"></div>');
							}
						} else {
							$('#fieldset-logo').unwrap();
						}
					});
				</script>
<?php } ?>
			</fieldset>
			<!-- /fieldset : Logo -->
