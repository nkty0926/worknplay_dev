<?php

include_once 'pages/3000_Work/3200_Work_Detail_header.php';

if (!isset($_GET['list']) || empty($_GET['list'])) {
	$_GET['list'] = 0;
}

?>
	<!-- main -->
	<main class="py-3">
		<div class="container">
			<div class="row">

		<!-- section -->
		<section class="col-lg-<?= $rs['brand']?'12':'9' ?>">

<?php if(isset($rs['desc_pages']) && !empty($rs['desc_pages']) && isset($_GET['page']) && !empty($_GET['page']) && $desc_page = explode('¶', explode('§', $rs['desc_pages'])[$_GET['page']-1])[1]){ ?>
			<!-- .row : Description Page -->
			<div class="row">
				<div class="col-md-12">
					<div class="cke_published"><?= $desc_page ?></div>
				</div>
			</div>
			<!-- /.row : Description Page -->

<?php }else{ if(isset($rs['desc']) && !empty($rs['desc'])){ ?>
			<!-- section : About Us -->
			<section class="row mb-5">
				<div class="col">
					<div class="cke_published"><?= strip_tags($rs['desc'])==$rs['desc']?nl2br($rs['desc']):$rs['desc'] ?></div>
				</div>
			</section>
			<!-- /section : About Us -->

<?php } //desc ?>
<?php if(!$rs['brand']){ ?>
			<!-- section : Company Information -->
			<section class="row mb-5 text-break">
				<div class="col">
<?php if (isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])) { ?>
					<!-- .row -->
					<div class="row mb-1">
						<div class="col-12">
							<span>Industry</span>
							<br />
							<span class="font-weight-bold"><?= $WP->printJobCategory($rs) ?></span>
							<?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ ?>
							<br />
							<?php foreach(explode(',', $rs['job_category_tag']) as $category_tag){ ?>
							<span class="border rounded-pill d-inline-block mr-2 px-2"><?= $category_tag ?></span>
							<?php }} ?>
						</div>
					</div>
					<!-- /.row -->

<?php } // job_category ?>
<?php if(isset($rs['contact_urls']) && !empty($rs['contact_urls'])){
	foreach (explode(',', $rs['contact_urls']) as $url) {
		$url_type = explode(';', $url)[0];
		$url_href = explode(';', $url)[1];
?>
					<div class="row mb-1">
						<div class="col-lg-3 font-weight-bold"><?= ucwords($url_type) ?></div>
						<div class="col-lg-9"><a href="<?= $url_href ?>" target="_blank" title="<?= ucfirst($url_type) ?>"><?= $url_href ?></a></div>
					</div>
<?php }} if(isset($rs['type_name']) && !empty($rs['type_name'])){ ?>
					<div class="row mb-1">
						<div class="col-lg-3 font-weight-bold">Company Type</div>
						<div class="col-lg-9"><?= $rs['type_name'] ?></div>
					</div>
<?php } if(false && $rs['job_industry']){ ?>
					<div class="row mb-1">
						<div class="col-lg-3 font-weight-bold">Industry</div>
						<div class="col-lg-9"><?php foreach(explode(',', $rs['job_industry']) as $industry){ ?><span class="text-dark comma-after" href="/Work/Search/Job?job_industry%5B%5D=<?= urlencode($industry) ?>"><?= $industry ?></span><?php } ?></div>
					</div>
<?php } if(isset($rs['establishment']) && !empty($rs['establishment'])){ ?>
					<div class="row mb-1">
						<div class="col-lg-3 font-weight-bold">Founded</div>
						<div class="col-lg-9"><?= $rs['establishment'] ?></div>
					</div>
<?php } if(isset($rs['employees']) && !empty($rs['employees'])){ ?>
					<div class="row mb-1">
						<div class="col-lg-3 font-weight-bold">Company Size</div>
						<div class="col-lg-9"><?= $rs['employees'] ?> employees</div>
					</div>
<?php } ?>
				</div>
			</section>
			<!-- /section : Company Information -->
<?php } ?>
<?php if(isset($articles) && !empty($articles)){ ?>
			<!-- section : Jobs -->
			<section class="row mb-5" id="Jobs">
				<div class="col">
			<h5 class="mb-3">Jobs</h5>
			<div class="row mb-n3 mx-lg-n2">
<?php for($i=0; $i<2 && $i<count($articles); $i++){ $article = $articles[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-<?= $rs['brand']?'3':'4' ?> mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_hot.php'; ?>
				</div>
<?php } ?>
<?php if(count($articles)>2){ ?>
				<div class="col-12 mb-3 mb-sm-4 mb-lg-3 text-left">
					<a class="btn btn-light" href="/Work/<?= $rs['domain']?$rs['domain']:$_GET['PAGE'] . '/Company/' . $rs['no'] ?>/Jobs">More</a>
				</div>
<?php } ?>
			</div>
				</div>
			</section>
			<!-- /section : Jobs -->

<?php } //articles ?>
<?php if(isset($events) && !empty($events)){ ?>
			<!-- section : News & Events -->
			<section class="row mb-5">
				<div class="col">
			<h5 class="mb-3">News &amp; Events</h5>
			<div class="row mb-n3 mx-lg-n2">
<?php for($i=0; $i<2 && $i<count($events); $i++){ $article = $events[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-<?= $rs['brand']?'3':'4' ?> mb-3 mb-sm-4 mb-lg-3 px-lg-2">
<?php include 'pages/3000_Work/3000_Work_article_event.php'; ?>
				</div>
<?php } ?>
<?php if(count($events)>2){ ?>
				<div class="col-12 mb-3 mb-sm-4 mb-lg-3 text-left">
					<a class="btn btn-light" href="/Work/<?= $rs['domain']?$rs['domain']:$_GET['PAGE'] . '/Company/' . $rs['no'] ?>/Events">More</a>
				</div>
<?php } ?>
			</div>
				</div>
			</section>
			<!-- /section : News & Events -->

<?php } //events ?>
<?php if(isset($stories) && !empty($stories)){ ?>
			<!-- section : Blogs -->
			<section class="row mb-5">
				<div class="col">
			<h5 class="mb-3">Blogs</h5>
			<div class="row mb-n3">
<?php for($i=0; $i<4 && $i<count($stories); $i++){ $article = $stories[$i]; ?>
				<div class="col-12 col-sm-6 col-lg-6 mb-3">
					<article class="position-relative">
						<figure class="float-left mr-2 mb-0">
							<img class="mw-100 mh-100 rounded-circle" src="<?= $article['header_img'] ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-profile.png'" width="60" height="60" />
						</figure>
						<a class="stretched-link text-dark" href="/Blogs/Detail/Article/<?= $article['no'] ?>" title="<?= $article['title'] ?>">
							<h6 class="line-clamp-1"><?= $article['title'] ?></h6>
						</a>
						<p class="mb-0 line-clamp-2 text-black-50"><?= substr($WP->stringFilter($article['desc']), 0, 150) ?></p>
					</article>
				</div>
<?php } ?>
<?php if(count($stories)>4){ ?>
				<div class="col-12 mb-3">
					<a class="btn btn-light" href="/Work/<?= $rs['domain']?$rs['domain']:'Detail/Company/' . $rs['no'] ?>/Blogs">More</a>
				</div>
<?php } ?>
			</div>
				</div>
			</section>
			<!-- /section : Blogs -->

<?php } //events ?>
<?php if(!$rs['brand']){ if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
			<!-- section : Location -->
			<section class="row mb-5">
				<div class="col-lg-6">
					<h5 class="mb-3">Location</h5>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
							<div id="GoogleMap-map" style="height:228px;"></div>
							<input type="hidden" id="GoogleMap-lat" name="addr_lat" value="<?= $rs['addr_lat'] ?>" />
							<input type="hidden" id="GoogleMap-lng" name="addr_lng" value="<?= $rs['addr_lng'] ?>" />
<?php }else{ ?>
							<img class="img-fluid" src="/assets/images/common-noimage.png" alt="Google Map" title="Google Map" />
<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
							<p class="text-left"><?= isset($rs['addr2']) && !empty($rs['addr2']) ? $rs['addr2'] . ', ' : '' ?><?= $rs['addr'] ?></p>
<?php $rs['addr_desc'] = strip_tags($rs['addr_desc']); if(false && isset($rs['addr_desc']) && !empty($rs['addr_desc'])){ ?>
							<div class="text-left<?= strlen($rs['addr_desc'])>150?' float-left':'' ?>" style="width:100%;">
								<hr class="w-25 mb-0" />
								<div class="<?= strlen($rs['addr_desc'])>150?'line-clamp-3 float-left':'' ?>" style="width:100%;">
									<p><?= $rs['addr_desc'] ?></p>
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
									<div class="text-left">
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/?hl=en" target="_blank" title="Recommended travel mode"><figure></figure></a>
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e0?hl=en" target="_blank" title="Driving"><figure></figure></a>
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e3?hl=en" target="_blank" title="Transit"><figure></figure></a>
									</div>
<?php } ?>
								</div>
<?php if(strlen($rs['addr_desc'])>150){ ?>
								<a class="btn btn-link btn-xs text-bold float-right" style="margin-top:-18px; padding:0; border:0; background:#ffffff;" onclick="$(this).prev().toggleClass('line-clamp-3');$(this).hide();$(this).next().show();">... &gt;&gt; read more</a>
								<a class="btn btn-link btn-xs text-bold" style="display:none; padding:0; border:0; background:#ffffff;" onclick="$(this).prev().prev().toggleClass('line-clamp-3');$(this).hide();$(this).prev().show();">&lt;&lt; read more</a>
<?php } ?>
							</div>
<?php }} ?>
						</div>
					</div>
				</div>
			</section>
			<!-- /section : Location -->

<?php }} //addr ?>
<?php } //desc_pages ?>
		</section>
		<!-- /section -->

<?php if(!$rs['brand']){ ?>
		<!-- aside -->
		<aside class="col-lg-<?= $rs['brand']?'12':'3' ?>">

<?php include_once 'pages/3000_Work/3210_Work_Detail_aside.php'; ?>

		</aside>
		<!-- /aside -->

<?php } ?>
<?php if($rs['brand']){ ?>
		<section class="col-lg-12">
			<div class="row">
				<div class="col-lg-6">
					<div class="row mb-3 text-break">
						<!-- <div class="col-lg-2 mb-1 mb-lg-0">
							<img class="img-thumbnail" src="<?= $rs['logo_img'] ?>" alt="<?= $rs['name'] ?>" title="<?= $rs['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
						</div> -->
						<div class="col-lg-12">
							<h5 class="mb-2">More Company Information</h5>
							<!-- <div class="sharethis-inline-share-buttons float-lg-right text-left"></div> -->
							<!-- <h4><?= $rs['name'] ?><?= $rs['name_kor']?' <small class="d-block d-lg-inline">(' . $rs['name_kor'] . ')</small>':'' ?></h4> -->
<?php if(isset($rs['type_name']) && !empty($rs['type_name'])){ ?>
							<p class="mb-0">Company Type</p>
							<p class="mb-1 text-black-50"><?= $rs['type_name'] ?></p>
<?php } if(isset($rs['keyword2']) && !empty($rs['keyword2'])){ ?>
							<p class="mb-0">Business Area</p>
							<p class="mb-1 text-black-50"><?= str_replace(';', ', ', $rs['keyword2']) ?></p>
<?php } if(isset($rs['location_parent_name']) && !empty($rs['location_parent_name']) || isset($rs['location_country_name']) && !empty($rs['location_country_name'])){ ?>
							<p class="mb-0">Location</p>
							<p class="mb-1 text-black-50"><?= $WP->printLocation($rs) ?></p>
<?php } if(isset($rs['establishment']) && !empty($rs['establishment'])){ ?>
							<p class="mb-0">Founded</p>
							<p class="mb-1 text-black-50"><?= $rs['establishment'] ?></p>
<?php } if(isset($rs['employees']) && !empty($rs['employees'])){ ?>
							<p class="mb-0">Company Size</p>
							<p class="mb-1 text-black-50"><?= $rs['employees'] ?> employees</p>
<?php } if(isset($rs['contact_urls']) && !empty($rs['contact_urls'])){
?>
							<p class="mb-0">URL(s)</p>
<?php
	foreach (explode(',', $rs['contact_urls']) as $url) {
		$url_type = explode(';', $url)[0];
		$url_href = explode(';', $url)[1];
?>
							<p class="mb-1"><a class="text-dark" href="<?= $url_href ?>" target="_blank"><img src="/assets/icons/urls/<?= strtolower($url_type) ?>.png" alt="<?= $url_type ?>:" title="<?= $url_type ?>" width="16" height="16" /> <?= $url_href ?></a></p>
<?php }} if(false && $rs['job_industry']){ ?>
							<p class="mb-0">Industry</p>
							<p class="mb-1 text-black-50"><?php foreach(explode(',', $rs['job_industry']) as $industry){ ?><span class="text-dark comma-after" href="/Work/Search/Job?job_industry%5B%5D=<?= urlencode($industry) ?>"><?= $industry ?></span><?php } ?></p>
<?php } ?>
						</div>
					</div>
<?php if (isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])) { ?>
					<!-- .row -->
					<div class="row mb-3 mt-n2">
						<div class="col-12">
							<span>Industry</span>
							<br />
							<span class="font-weight-bold"><?= $WP->printJobCategory($rs) ?></span>
							<?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ ?>
							<br />
							<?php foreach(explode(',', $rs['job_category_tag']) as $category_tag){ ?>
							<span class="border rounded-pill d-inline-block mr-2 px-2"><?= $category_tag ?></span>
							<?php }} ?>
						</div>
					</div>
					<!-- /.row -->

<?php } // job_category ?>
<?php if(empty($articles) || $expired){ ?>
					<p>이 회사에 관심이 있으십니까? 워크앤플레이 매치업 서비스를 이용하시면 더 좋은 결과를...</p>
					<a class="d-inline-block" href="/design/CompanyBrand">Show Matchup Service »</a>
					<a class="btn btn-primary d-inline-block mt-2" href="javascript:void(0);">Apply</a>
<?php }else if(!$rs['contact_private']){ ?>
					<h6>Contact Information</h6>
<?php if(isset($rs['contact_phone1']) && !empty($rs['contact_phone1'])){ ?>
					<p class="mb-0">Primary Phone Number: <?= $rs['contact_phone1'] ?></p>
<?php } if(isset($rs['contact_phone2']) && !empty($rs['contact_phone2'])){ ?>
					<p class="mb-0">Secondary Phone Number: <?= $rs['contact_phone2'] ?></p>
<?php } if(isset($rs['contact_email']) && !empty($rs['contact_email'])){ ?>
					<p class="mb-0">Email: <?= $rs['contact_email'] ?></p>
<?php } if(isset($rs['contact_person']) && !empty($rs['contact_person'])){ ?>
					<p class="mb-0">Contact Person: <?= $rs['contact_person'] ?></p>
<?php } if(isset($rs['contact_messengers']) && !empty($rs['contact_messengers'])){ ?>
<?php foreach(explode(',', $rs['contact_messengers']) as $contact_messenger){ $messenger = explode(';', $contact_messenger); ?>
					<p class="mb-0"><?= $messenger[0] ?>: <?= $messenger[1] ?></p>
<?php } ?>
<?php }}else if($_SESSION['ID']){ ?>
					<p class="mb-0">Send Message to Company</p>
					<p class="mb-1 text-black-50">If you have questions to company, please send me a message</p>
					<form class="needs-validation d-print-none" id="formMessage">
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" rows="5" placeholder="Message*" required></textarea>
						</div>
						<div class="form-group mb-0">
							<input type="hidden" name="main" value="work" />
							<input type="hidden" name="table" value="work_company" />
							<input type="hidden" name="pk" value="<?= $rs['no'] ?>" />
							<button type="submit" class="btn btn-primary" name="action" value="Message">Send Message</button>
						</div>
						<script defer>
							$('#formMessage').on('submit', function() {
								$.ajax({ type : 'post', url : '/actions/Message', data : 'action=Message&' + $(this).serialize(), success : function(result) {
									location.reload();
								} }); return false;
							});
						</script>
					</form>
<?php }else{ ?>
					<p class="mb-0">Send Message to Company</p>
					<p class="mb-1 text-black-50">If you have questions to company, please send me a message</p>
					<div class="form-group mb-0 d-print-none" onclick="Confirm('Please Log In', function(){ location.href = '/LogIn'; });">
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" disabled />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" rows="5" placeholder="Message*" disabled></textarea>
						</div>
						<div class="form-group mb-0">
							<button type="button" class="btn btn-primary" onclick="Confirm('Please Log In', function(){ location.href = '/LogIn'; });">Send Message</button>
						</div>
					</div>
<?php } ?>
				</div>
				<div class="col-lg-6">
					<h5 class="mb-2">Location</h5>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
							<div id="GoogleMap-map" style="height:228px;"></div>
							<input type="hidden" id="GoogleMap-lat" name="addr_lat" value="<?= $rs['addr_lat'] ?>" />
							<input type="hidden" id="GoogleMap-lng" name="addr_lng" value="<?= $rs['addr_lng'] ?>" />
<?php }else{ ?>
							<img class="img-fluid" src="/assets/images/common-noimage.png" alt="Google Map" title="Google Map" />
<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
							<p class="text-left"><?= isset($rs['addr2']) && !empty($rs['addr2']) ? $rs['addr2'] . ', ' : '' ?><?= $rs['addr'] ?></p>
<?php $rs['addr_desc'] = strip_tags($rs['addr_desc']); if(false && isset($rs['addr_desc']) && !empty($rs['addr_desc'])){ ?>
							<div class="text-left<?= strlen($rs['addr_desc'])>150?' float-left':'' ?>" style="width:100%;">
								<hr class="w-25 mb-0" />
								<div class="<?= strlen($rs['addr_desc'])>150?'line-clamp-3 float-left':'' ?>" style="width:100%;">
									<p><?= $rs['addr_desc'] ?></p>
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
									<div class="text-left">
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/?hl=en" target="_blank" title="Recommended travel mode"><figure></figure></a>
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e0?hl=en" target="_blank" title="Driving"><figure></figure></a>
										<a class="google-direction" href="https://www.google.co.kr/maps/dir//<?= $rs['addr'] ?>/@<?= $rs['addr_lat'] ?>,<?= $rs['addr_lng'] ?>,13z/data=!4m2!4m1!3e3?hl=en" target="_blank" title="Transit"><figure></figure></a>
									</div>
<?php } ?>
								</div>
<?php if(strlen($rs['addr_desc'])>150){ ?>
								<a class="btn btn-link btn-xs text-bold float-right" style="margin-top:-18px; padding:0; border:0; background:#ffffff;" onclick="$(this).prev().toggleClass('line-clamp-3');$(this).hide();$(this).next().show();">... &gt;&gt; read more</a>
								<a class="btn btn-link btn-xs text-bold" style="display:none; padding:0; border:0; background:#ffffff;" onclick="$(this).prev().prev().toggleClass('line-clamp-3');$(this).hide();$(this).prev().show();">&lt;&lt; read more</a>
<?php } ?>
							</div>
<?php }} ?>
						</div>
					</div>
				</div>
			</div>
		</section>

<?php } ?>
			</div>
		</div>
	</main>
	<!-- /main -->