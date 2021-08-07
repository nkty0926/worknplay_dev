			<!-- fieldset : Attachment -->
			<fieldset class="mb-5" id="fieldset-attachment">
				<legend>Attachment <small>(Max file size: 10MB)</small></legend>
				<p class="form-text text-muted mt-n2 mb-2">Recommended File Types: Word, PDF, JPG, and PNG</p>
				<div class="form-group mb-0" id="attachment-target">
<?php if(isset($rs['attachment']) && !empty($rs['attachment'])){ foreach(explode('|', $rs['attachment']) as $attachment){ ?>
					<span class="d-inline-block mb-2 mr-2" title="<?= explode(':', $attachment)[1] ?>">
						<input type="hidden" name="attachment[]" value="<?= $attachment ?>" />
						<?= explode(':', $attachment)[1] ?>
						<a class="form-remove ml-4" href="javascript:void(0);" data-toggle="remove">&times;</a>
					</span>
<?php }} ?>
				</div>
				<label class="btn btn-secondary mb-0 px-4" for="attachment"><i class="fa fa-plus-square"></i> Browse</label>
				<input type="file" id="attachment" data-name="attachment" data-target="#attachment-target" multiple />
			</fieldset>
			<!-- /fieldset : Attachment -->
