			<!-- fieldset : Languages -->
			<fieldset class="mb-5" id="fieldset-languages">
				<legend>Languages Available</legend>
				<div class="dropdown">
					<a class="form-control custom-select dropdown-toggle" data-toggle="dropdown" data-name="languages[]" data-target-serial="#languages-serial">Languages Available</a>
					<ul class="dropdown-menu">
<?php $languages = $DB->selectCode('personal_language'); foreach($languages as $language){ ?>
						<li><a><?= $language['name'] ?></a></li>
<?php } ?>
					</ul>
				</div>
				<div class="form-serial" id="languages-serial">
<?php if(isset($rs['languages']) && !empty($rs['languages'])){ foreach(explode(',', $rs['languages']) as $language){ ?>
					<span>
						<input type="hidden" name="languages[]" value="<?= $language ?>" />
						<?= $language ?>
						<a href="javascript:void(0);" data-toggle="remove">&times;</a>
					</span>
<?php }} ?>
				</div>
			</fieldset>
			<!-- /fieldset : Languages -->
