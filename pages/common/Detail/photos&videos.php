<?php if(isset($rs['photos']) && !empty($rs['photos']) || isset($rs['videos']) && !empty($rs['videos'])){
	$gallery = array(); if(isset($rs['videos']) && !empty($rs['videos'])){ foreach(explode(',', $rs['videos']) as $video){
		if(strpos($video, 'youtube')){
			array_push($gallery, '<svg viewBox="0 0 68 48" style="position:absolute; top:0; bottom:0; left:0; right:0; width:68px; height:auto; max-width:25%; margin:auto;"><path d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#FF0000"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg><img width="100%" height="auto" src="' . explode('?', str_replace('www.youtube.com/embed/', 'img.youtube.com/vi/', $video))[0] . '/0.jpg" />');
		}else if(strpos($video, 'vimeo')){
			array_push($gallery, '<svg viewBox="0 0 68 48" style="position:absolute; top:0; bottom:0; left:0; right:0; width:68px; height:auto; max-width:25%; margin:auto;"><path d="M66.52,7.74c-0.78-2.93-2.49-5.41-5.42-6.19C55.79,.13,34,0,34,0S12.21,.13,6.9,1.55 C3.97,2.33,2.27,4.81,1.48,7.74C0.06,13.05,0,24,0,24s0.06,10.95,1.48,16.26c0.78,2.93,2.49,5.41,5.42,6.19 C12.21,47.87,34,48,34,48s21.79-0.13,27.1-1.55c2.93-0.78,4.64-3.26,5.42-6.19C67.94,34.95,68,24,68,24S67.94,13.05,66.52,7.74z" fill="#00adef"></path><path d="M 45,24 27,14 27,34" fill="#fff"></path></svg><img width="100%" height="auto" src="' . unserialize(file_get_contents(explode('?', str_replace('player.vimeo.com/video/', 'vimeo.com/api/v2/video/', $video))[0] . '.php'))[0]['thumbnail_medium'] . '" />');
		}else{
			array_push($gallery, '<iframe type="text/html" width="100%" height="300px" frameborder="0" src="' . $video . '"></iframe>');
		}
	}} if(isset($rs['photos']) && !empty($rs['photos'])){ foreach(explode(',', $rs['photos']) as $photo){
		array_push($gallery, '<img width="100%" height="auto" src="' . $photo . '" />');
	}}
?>
			<!-- section : Photos & Videos -->
			<section class="row">
				<div class="col">

					<!-- Gallery -->
					<div class="form-row d-block">
<?php for($i=0; $i<count($gallery); $i++){ ?>
						<div class="col-4 col-md-3 mb-2 float-left">
							<a href="javascript:void(0);" data-toggle="modal" data-target="#galleryModal" onclick="$('#galleryModal').carousel(<?= $i ?>);">
								<div class="embed-responsive embed-responsive-16by9">
									<div class="embed-responsive-item d-flex align-items-center"><?= $gallery[$i] ?></div>
								</div>
							</a>
						</div>
<?php } ?>
					</div>
					<!-- /Gallery -->

<?php
	$carousel = array(); if(isset($rs['videos']) && !empty($rs['videos'])){ foreach(explode(',', $rs['videos']) as $video){
		array_push($carousel, '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="' . $video . '"></iframe></div>');
	}} if(isset($rs['photos']) && !empty($rs['photos'])){ foreach(explode(',', $rs['photos']) as $photo){
		array_push($carousel, '<img width="100%" height="auto" src="' . $photo . '" />');
	}}
?>
					<!-- .modal#galleryModal -->
					<div class="modal" id="galleryModal" tabindex="-1" role="dialog" aria-hidden="true" autocomplete="off">
						<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content shadow">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="z-index:1;position:absolute;top:-3rem;right:0;line-height:2rem;font-size:5rem;color:white;font-weight:lighter;">&times;</button>
						<!-- .carousel#galleryModalCarousel -->
						<div class="carousel" id="galleryModalCarousel" data-interval="false">
							<div class="carousel-inner">
<?php foreach($carousel as $i => $carousel_item){ ?>
								<div class="carousel-item<?= $i==0?' active':'' ?>">
									<figure style="display:flex;align-items:center;margin:0;max-height:calc(100vh - 7rem);">
										<?= $carousel_item ?>
										<figcaption class="carousel-caption position-fixed"><?= explode('" alt="', explode('" title="', $carousel_item)[1])[0] ?></figcaption>
									</figure>
								</div>
<?php } ?>
							</div>
<?php if(count($carousel)>1){ ?>
							<ol class="carousel-indicators position-fixed">
<?php foreach($carousel as $i => $carousel_item){ ?>
								<li <?= $i==0?'class="active" ':'' ?>data-target="#galleryModalCarousel" data-slide-to="<?= $i ?>"></li>
<?php } ?>
							</ol>
							<a class="carousel-control-prev position-fixed" href="#galleryModalCarousel" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next position-fixed" href="#galleryModalCarousel" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
<?php } ?>
						</div>
						<!-- /.carousel#galleryModalCarousel -->
					</div>
						</div>
					</div>
					<!-- /.modal#galleryModal -->

				</div>
			</section>
			<!-- /section : Photos & Videos -->

<?php } ?>