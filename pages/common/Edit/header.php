			<!-- fieldset : Header Image -->
			<fieldset class="mb-5" id="fieldset-header">
				<legend>Header Image</legend>
				<div class="form-group" id="header-img-target-collapse-show">
					<div class="row">
						<label class="col-4 col-md-2 col-form-label">Link Url</label>
						<div class="col-8 col-md-10">
							<input type="url" class="form-control" name="header_href" value="<?= htmlspecialchars(trim($rs['header_href'])) ?>" />
						</div>
					</div>
					<div class="row">
						<label class="col-4 col-md-2 col-form-label">Link Target</label>
						<div class="col-8 col-md-10 col-form-label">
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_target_0" name="header_target" value="0"<?= !$rs['header_target']?' checked':'' ?> />
								<label class="form-check-label" for="header_target_0">Open on same page</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_target_1" name="header_target" value="1"<?= $rs['header_target']?' checked':'' ?> />
								<label class="form-check-label" for="header_target_1">Open in new page</label>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-4 col-md-2 col-form-label">Size</label>
						<div class="col-8 col-md-10 col-form-label">
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_size_0" name="header_size" value="0"<?= !$rs['header_size']?' checked':'' ?> />
								<label class="form-check-label" for="header_size_0">Fit to page <small>(1920px x 400px)</small></label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_size_1" name="header_size" value="1"<?= $rs['header_size']?' checked':'' ?> />
								<label class="form-check-label" for="header_size_1">Fit to text <small>(1110px x 200px)</small></label>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-4 col-md-2 col-form-label">Text</label>
						<div class="col-8 col-md-10 col-form-label">
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_text_0" name="header_text" value="0"<?= !$rs['header_text']?' checked':'' ?> />
								<label class="form-check-label" for="header_text_0">Show</label>
							</div>
							<div class="form-check form-check-inline">
								<input type="radio" class="form-check-input" id="header_text_1" name="header_text" value="1"<?= $rs['header_text']?' checked':'' ?> />
								<label class="form-check-label" for="header_text_1">Hide</label>
							</div>
						</div>
					</div>
				</div>
				<div class="collapse<?= $rs['header_img']?'':' show' ?>" id="header-img-target-collapse">
					<label class="btn btn-secondary" for="header_img"><i class="fa fa-plus-square"></i> Browse</label>
				</div>
				<div id="header-img-target">
<?php if(isset($rs['header_img']) && !empty($rs['header_img'])){ ?>
					<figure><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><img src="<?= $rs['header_img'] ?>" onerror="this.src='/assets/images/common-noimage.png'" /></figure>
<?php } ?>
				</div>
				<input type="file" accept="image/gif, image/jpeg, image/png" id="header_img" data-name="header_img" data-target="#header-img-target" data-target-collapse="#header-img-target-collapse" data-target-collapse-show="#header-img-target-collapse-show" />
				<input type="hidden" name="header_img" value="<?= $rs['header_img'] ?>" />
			</fieldset>
			<!-- /fieldset : Header Image -->
