			<!-- fieldset : Keyword -->
			<fieldset class="mb-5" id="fieldset-keyword">
				<legend class="d-block w-100">Search Keyword<a class="far fa-question-circle text-decoration-none text-muted text-dark float-right my-1" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Add words or names that are associated with the name of your <?= strtolower($_GET['MENU']) ?>"></a></legend>
				<input type="text" class="form-control form-control-lg" placeholder="Separate by &quot;;&quot;" name="keyword" value="<?= htmlspecialchars(trim($rs['keyword'])) ?>" />
				<script defer>if($('#fieldset-keyword').parents('fieldset').length){ $('#fieldset-keyword').find('.form-control-lg').removeClass('form-control-lg'); }</script>
			</fieldset>
			<!-- /fieldset : Keyword -->
