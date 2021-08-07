<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
			<p class="mb-2"><?= isset($rs['addr2']) && !empty($rs['addr2']) ? $rs['addr2'] . ', ' : '' ?><?= $rs['addr'] ?></p>
<?php } //addr ?>
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
			<div class="border mb-2" id="GoogleMap-map" style="height:300px;"></div>
			<input type="hidden" id="GoogleMap-lat" name="addr_lat" value="<?= $rs['addr_lat'] ?>" />
			<input type="hidden" id="GoogleMap-lng" name="addr_lng" value="<?= $rs['addr_lng'] ?>" />
<?php } //lat, lng ?>
<?php if(isset($rs['addr_desc']) && !empty($rs['addr_desc'])){ ?>
			<div class="row mb-2">
				<div class="col-12">
			<div class="cke_published"><?= $rs['addr_desc'] ?></div>
				</div>
			</div>
<?php } //addr_desc ?>
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
			<div class="row mb-2">
				<div class="col-12">
					<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/?hl=en" target="_blank" title="Recommended travel mode"><figure></figure></a>
					<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e0?hl=en" target="_blank" title="Driving"><figure></figure></a>
					<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e3?hl=en" target="_blank" title="Transit"><figure></figure></a>
				</div>
				<style>
					.google-direction{display:inline-block;margin:0 4px;padding:4px;border-radius:16px;background:#4285F4;}
					.google-direction>figure{width:24px;height:24px;margin:0;background-size:96px 216px;background-image:url(//maps.gstatic.com/tactile/directions/omnibox/directions-1x-20150929.png);}
					.google-direction:first-child>figure{background-position:-24px -72px;}
					.google-direction:nth-child(2)>figure{background-position:-24px -96px;}
					.google-direction:nth-child(3)>figure{background-position:-24px -120px;}
				</style>
			</div>
<?php } //lat, lng ?>