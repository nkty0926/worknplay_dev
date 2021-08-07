			<!-- fieldset : Address -->
			<fieldset class="mb-5" id="fieldset-addr">
				<legend class="required">Location</legend>
<?php include_once 'pages/common/Edit/location.php'; ?>
				<div class="card collapse<?= isset($rs['location_parent']) && !empty($rs['location_parent'])?' show':'' ?>">
					<div class="card-body mb-n3">
						<a class="small text-muted float-right" href="https://support.google.com/maps/answer/6320846?hl=en" target="_blank">Add a missing place to the map</a>
						<div class="form-group">
							<label for="GoogleMap_input">Address</label>
							<input type="text" class="form-control" id="GoogleMap-addr" name="addr" value="<?= htmlspecialchars(trim($rs['addr'])) ?>" placeholder="Address" />
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="addr2" name="addr2" value="<?= htmlspecialchars(trim($rs['addr2'])) ?>" placeholder="Detailed Address" />
						</div>
						<div class="form-group">
							<label>Map</label>
							<div id="GoogleMap-map" style="height:300px;"></div>
						</div>
						<div class="form-group d-none">
							<label>Direction</label>
							<textarea class="ckeditor" id="addr_desc" name="addr_desc"><?= $rs['addr_desc'] ?></textarea>
							<!-- script defer>$(function(){ CKEDITOR.replace('addr_desc'); });</script -->
						</div>
					</div>
				</div>
				<script defer>
					$('#location-child').on('change', function() {
						$('#fieldset-addr .card').collapse('show');
					});
				</script>
				<input type="hidden" id="GoogleMap-lat" name="addr_lat" value="<?= $rs['addr_lat'] ?>" />
				<input type="hidden" id="GoogleMap-lng" name="addr_lng" value="<?= $rs['addr_lng'] ?>" />
			</fieldset>
			<!-- /fieldset : Address -->
