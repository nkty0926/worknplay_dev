<?php
$rs = $DB->selectWorkJob($_POST['no']);
$articles = $DB->selectWorkJob(null, $rs['work_company']);
for($i=0; $i<count($articles); $i++){ if($articles[$i]['no']==$rs['no']) unset($articles[$i]); }
$company = $DB->selectWorkCompany($rs['work_company']);
$saved = $DB->selectSave('work_job', $rs['no']);
$applied = $_SESSION['ID'] ? count($DB->selectWorkJobApplication(null, $rs['no'], $_SESSION['ID'])) : 0;
?>
				<!-- .card -->
				<div class="card border-top-0 rounded-0 mb-3">
					<div class="card-body">
						<div class="dropdown no-arrow" data-dropdown-trigger="hover">
							<a class="float-right dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
							<div class="dropdown-menu dropdown-menu-right" style="top:24px;margin-top:0;">
								<a class="dropdown-item" href="/Work/Detail/Job/<?= $rs['no'] ?>" target="_blank">View in a new tab</a>
								<!-- <a class="dropdown-item" data-toggle="modal" href="#modalFormQuestion">Report this job</a> -->
							</div>
							<style>[data-dropdown-trigger="hover"]::before{content:"";position:absolute;top:0;right:0;display:block;width:100%;height:24px;}</style>
							<script defer>
								$(function(){
									$('[data-dropdown-trigger="hover"]').on('mouseover', function(){ $(this).find('[data-toggle="dropdown"]').dropdown('show'); });
									$('[data-dropdown-trigger="hover"]').on('mouseout', function(){ $(this).find('[data-toggle="dropdown"]').dropdown('hide'); });
								});
							</script>
						</div>
<?php if(isset($rs['company_logo_img']) && !empty($rs['company_logo_img'])){ ?>
						<figure class="d-flex align-items-center border" style="width:96px;height:96px;">
							<img class="d-block mx-auto mh-100 mw-100" src="<?= $rs['company_logo_img'] ?>" alt="<?= $rs['name'] ?>" title="<?= $rs['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
						</figure>
<?php } ?>
						<h4 style="font-size:1.4rem;"><?= $rs['title'] ?></h4>
						<p>
							<i class="far fa-fw fa-building"></i>
							<a class="text-primary" id="companyName" href="/Work/Detail/Company/<?= $rs['work_company'] ?>" target="_blank"><?= $rs['company_name'] ?></a>
<?php if(isset($rs['location_parent_name']) && !empty($rs['location_parent_name']) || isset($rs['location_country_name']) && !empty($rs['location_country_name'])){ $rs['location_child_name'] = ''; ?>
							<i class="font-weight-bold">&middot;</i>
							<i class="fas fa-fw fa-map-marker-alt"></i>
							<span><?= $WP->printLocation($rs) ?></span>
<?php } ?>
							<br />
							<i class="far fa-fw fa-clock"></i>
							<span><?= $WP->printPeriod($rs) ?></span>
<?php if(isset($rs['employer_type']) && !empty($rs['employer_type'])){ ?>
							<br />
							<i class="far fa-fw fa-handshake"></i>
							<span>Employer Type : <?= $rs['employer_type'] ?></span>
<?php } ?>
						</p>
						<p class="mb-0">
<?php if(isset($rs['appl_type']) && !empty($rs['appl_type'])){ ?>
							<a class="btn btn-primary" href="<?= $rs['appl_text'] ?>" target="_blank">Visit Website</a>
<?php }else if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-primary<?= $applied?' disabled':'' ?>" data-toggle="modal" data-target="#modalFormApplyJobWithResume"><?= $applied?'Applied Job':'Apply Now' ?></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-primary"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Apply Now</button>
							<span class="ml-2">or</span>
							<button type="button" class="btn btn-link px-1" data-toggle="modal" data-target="#modalFormApplyJobWithFile">Apply without Registration</button>
<?php } if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-light float-right save<?= $saved?' active':'' ?>" data-toggle="action" data-action="Save" data-table="work_job" data-pk="<?= $rs['no'] ?>"></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-light float-right"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Save</button>
<?php } ?>
						</p>
					</div>
				</div>
				<!-- /.card -->

				<!-- ul.nav -->
				<ul class="nav nav-underline mb-3">
					<li class="nav-item">
						<a class="nav-link active" href="#tabJobDetail" data-toggle="tab" role="tab">Job Overview</a>
					</li>
<?php if(!empty($articles) && count($articles)){ ?>
					<li class="nav-item">
						<a class="nav-link" href="#tabCompanyJobs" data-toggle="tab" role="tab">Jobs</a>
					</li>
<?php } ?>
					<li class="nav-item">
						<a class="nav-link" href="#tabCompanyProfile" data-toggle="tab" role="tab">Company Info</a>
					</li>
				</ul>
				<!-- /ul.nav -->

				<!-- .tab-content -->
				<div class="tab-content pr-2">

					<!-- /.tab-pane#tabJobDetail -->
					<div class="tab-pane active" id="tabJobDetail" role="tabpanel">

						<!-- .row -->
						<div class="row mb-5">
<?php if(isset($rs['job_type']) || true){ ?>
							<div class="col-6 col-lg-4">
								<span>Job Type</span>
								<p class="font-weight-bold text-break"><?= $WP->printJobType($rs) ?></p>
							</div>
<?php } if(isset($rs['education_level']) && !empty($rs['education_level'])){ ?>
							<div class="col-6 col-lg-4">
								<span>Education Level</span>
								<p class="font-weight-bold text-break"><?= $CONF['education_levels'][$rs['education_level']-1] ?></p>
							</div>
<?php } if(isset($rs['career_level']) && !empty($rs['career_level'])){ ?>
							<div class="col-6 col-lg-4">
								<span>Career Level</span>
								<p class="font-weight-bold text-break"><?= $CONF['career_levels'][$rs['career_level']-1] ?></p>
							</div>
<?php } if(isset($rs['period']) && !empty($rs['period'])){ ?>
							<div class="col-6 col-lg-4">
								<span>Start Date</span>
								<p class="font-weight-bold text-break"><?= strlen($rs['period'])>1?date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0])):($rs['period']==2?'ASAP':($rs['period']==3?'Open Until Filled':'')) ?></p>
							</div>
<?php } if(isset(explode(' ~ ', $rs['period'])[1]) && !empty(isset(explode(' ~ ', $rs['period'])[1]))){ ?>
							<div class="col-6 col-lg-4">
								<span>Deadline</span>
								<p class="font-weight-bold text-break"><?= date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[1])) ?></p>
							</div>
<?php } if(isset($rs['language_eng']) && !empty($rs['language_eng'])){ ?>
							<div class="col-6 col-lg-4">
								<span>English</span>
								<p class="font-weight-bold text-break"><?= $CONF['language_levels'][$rs['language_eng']-1] ?></p>
							</div>
<?php } if(isset($rs['language_kor']) && !empty($rs['language_kor'])){ ?>
							<div class="col-6 col-lg-4">
								<span>Korean</span>
								<p class="font-weight-bold text-break"><?= $CONF['language_levels'][$rs['language_kor']-1] ?></p>
							</div>
<?php } if(isset($rs['language_others']) && !empty($rs['language_others'])){ foreach(explode(',', $rs['language_others']) as $language_others){ ?>
							<div class="col-6 col-lg-4">
								<span><?= explode(';', $language_others)[0] ?></span>
								<p class="font-weight-bold text-break"><?= $CONF['language_levels'][explode(';', $language_others)[1]-1] ?></p>
							</div>
<?php }} if(isset($rs['visa_type']) && !empty($rs['visa_type'])){ ?>
							<div class="col-6 col-lg-4">
								<span>Visa Sponsorship</span>
								<p class="font-weight-bold text-break"><?= $rs['visa_type'] ?></p>
							</div>
<?php } ?>
						</div>
						<!-- /.row -->

<?php if (isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])) { ?>
						<!-- .row -->
						<div class="row mb-5 mt-n5">
							<div class="col-12">
								<span>Industry :</span>
								<span class="font-weight-bold"><?= $WP->printJobCategory($rs) ?></span>
<?php if(isset($rs['job_category_tag']) && !empty($rs['job_category_tag'])){ ?>
								<p class="mt-1 mb-2">
<?php foreach(explode(',', $rs['job_category_tag']) as $category_tag){ ?>
									<span class="small border rounded bg-light d-inline-block mb-2 mr-2 px-2"><?= $category_tag ?></span>
<?php } ?>
								</p>
<?php } ?>
							</div>
						</div>
						<!-- /.row -->

<?php } // job_category ?>
<?php if (isset($rs['teaching_level']) && !empty($rs['teaching_level'])) { ?>
						<!-- .row -->
						<div class="row mb-5 mt-n5">
							<div class="col-12">
								<span>Teaching Level</span>
								<p class="mt-1 mb-2">
<?php
	$teaching_levels = array();
	for($i=0; $i<count($CONF['teaching_levels']); $i++){
		$teaching_levels[$i+1] = $CONF['teaching_levels'][$i];
	}
	foreach(explode(',', $rs['teaching_level']) as $teaching_level){
?>
									<span class="small border rounded bg-light d-inline-block mb-2 mr-2 px-2"><?= $teaching_levels[$teaching_level] ?></span>
<?php
	}
?>
								</p>
							</div>
						</div>
						<!-- /.row -->

<?php } // job_category ?>
<?php if(isset($rs['desc']) && !empty($rs['desc'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12">
								<h5>Job Description</h5>
								<div class="cke_published"><?= $rs['desc'] ?></div>
							</div>
						</div>
						<!-- /.row -->

<?php } // description ?>
<?php if(isset($rs['keyword2']) && !empty($rs['keyword2'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12">
								<h5>Specialized Requirements for Candidates</h5>
								<p class="mb-0"><?= nl2br($rs['keyword2']) ?></p>
							</div>
						</div>
						<!-- /.row -->

<?php } // keyword ?>
<?php if(isset($rs['salary']) && !empty($rs['salary']) || isset($rs['benefits']) && !empty($rs['benefits'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12 mb-n3">
								<h5>Salary &amp; Benefits</h5>
<?php if(isset($rs['salary']) && !empty($rs['salary'])) { ?>
								<p class="mb-3"><?= nl2br($rs['salary']) ?></p>
<?php } if(isset($rs['benefits']) && !empty($rs['benefits'])) { ?>
								<p class="mb-3"><?= nl2br($rs['benefits']) ?></p>
<?php } ?>
							</div>
						</div>
						<!-- /.row -->

<?php } // salary ?>
<?php if(isset($rs['housing']) && !empty($rs['housing']) || isset($rs['housing_category']) && !empty($rs['housing_category'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12 mb-n3">
								<h5>Housing</h5>
<?php if(isset($rs['housing_category']) && !empty($rs['housing_category'])) {
	$housing_category = array();
	if (isset($rs['housing_category'])) {
		$housing_category = explode(',', $rs['housing_category']);
	}
?>
								<ul class="row mb-3">
<?php for($i=0; $i<count($CONF['housing_category']); $i++){ if(in_array($i+1, $housing_category)){ ?>
									<li class="col-lg-4 px-0"><?= $CONF['housing_category'][$i] ?></li>
<?php }} ?>
								</ul>
<?php } if(isset($rs['housing']) && !empty($rs['housing'])) { ?>
								<p class="mb-3"><?= nl2br($rs['housing']) ?></p>
<?php } ?>
							</div>
						</div>
						<!-- /.row -->

<?php } //housing ?>
<?php if(isset($rs['appl_questions']) && !empty($rs['appl_questions'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12">
								<h5>Questions</h5>
								<p>고용주가 등록한 사전 질문이 있습니다.</p>
								<div class="card">
									<div class="card-body">
								<ol class="mb-0 pl-3">
<?php foreach(explode('|', $rs['appl_questions']) as $i => $appl_question){ ?>
									<li><?= $appl_question ?></li>
<?php } ?>
								</ol>
									</div>
								</div>
							</div>
						</div>
						<!-- /.row -->
<?php } // appl_questions ?>
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12">
								<h5>Location</h5>
<?php include_once 'pages/common/Detail/address.php'; ?>
								<script>initAutocomplete();</script>
							</div>
						</div>
						<!-- /.row -->

<?php } // addr ?>
<?php if(isset($rs['attachment']) && !empty($rs['attachment'])){ ?>
						<!-- .row -->
						<div class="row mb-5">
							<div class="col-12">
								<h5>Attachments</h5>
								<div><?= $WP->printAttachmentsAsCard($rs); ?></div>
							</div>
						</div>
						<!-- /.row -->

<?php } // attachment ?>
						<p class="mb-0 mt-2">
<?php if(isset($rs['appl_type']) && !empty($rs['appl_type'])){ ?>
							<a class="btn btn-primary" href="<?= $rs['appl_text'] ?>" target="_blank">Visit Website</a>
<?php }else if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-primary<?= $applied?' disabled':'' ?>" data-toggle="modal" data-target="#modalFormApplyJobWithResume"><?= $applied?'Applied Job':'Apply Now' ?></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-primary"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Apply Now</button>
							<span class="ml-2">or</span>
							<button type="button" class="btn btn-link px-1" data-toggle="modal" data-target="#modalFormApplyJobWithFile">Apply without Registration</button>
<?php } if($_SESSION['SEEKER']){ ?>
							<button type="button" class="btn btn-light float-right save<?= $saved?' active':'' ?>" data-toggle="action" data-action="Save" data-table="work_job" data-pk="<?= $rs['no'] ?>"></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-light float-right"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							>Save</button>
<?php } ?>
						</p>

<?php include_once 'pages/3000_Work/3200_Work_Detail_warning.php'; ?>

					</div>
					<!-- /.tab-pane#tabJobDetail -->

					<!-- .tab-pane#tabCompanyJobs -->
					<div class="tab-pane" id="tabCompanyJobs" role="tabpanel">
			<div class="row">
<?php for($i=0; $i<9 && $i<count($articles); $i++){ $article = $articles[$i]; if($article['no']!=$rs['no']){ ?>
				<div class="col-6 mb-3">
<?php include 'pages/3000_Work/3000_Work_article_hot.php'; ?>
				</div>
<?php }} ?>
<?php if(count($articles)>9){ ?>
			<a class="btn btn-light" href="/Work/Search/Job?keyword=<?= $rs['name'] ?>">See all jobs</a>
<?php } ?>
			</div>
					</div>
					<!-- .tab-pane#tabCompanyJobs -->

					<!-- .tab-pane#tabCompanyProfile -->
					<div class="tab-pane" id="tabCompanyProfile" role="tabpanel">

						<!-- .row -->
						<div class="row">
							<div class="col-12">
								<div class="row mb-5">
									<div class="col-12 mb-n3">
								<p><?= substr($WP->stringFilter($company['desc']), 0, 270) ?>...</p>
								<a class="d-block mt-n3 mb-3" href="/Work/<?= $company['domain']?$company['domain']:'Detail/Company/' . $company['no'] ?>" target="_blank">View Company Profile <i class="fas fa-fw fa-external-link-alt small"></i></a>
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-12">
<?php if(isset($company['type_name']) && !empty($company['type_name'])){ ?>
								<p class="mb-0">Company Type: <?= $company['type_name'] ?></p>
<?php } if(isset($company['keyword2']) && !empty($company['keyword2'])){ ?>
								<p class="mb-0">Business Area: <?= str_replace(';', ', ', $company['keyword2']) ?></p>
<?php } if(isset($company['establishment']) && !empty($company['establishment'])){ ?>
								<p class="mb-0">Founded: <?= $company['establishment'] ?></p>
<?php } if(isset($company['employees']) && !empty($company['employees'])){ ?>
								<p class="mb-0">Company Size: <?= $company['employees'] ?> employees</p>
<?php } ?>
									</div>
								</div>
								<div class="row mb-5">
									<div class="col-12">
<?php if(empty($articles) || !count($articles)){ ?>
								<p>이 회사에 관심이 있으십니까? 워크앤플레이 매치업 서비스를 이용하시면 더 좋은 결과를...</p>
								<a class="d-inline-block" href="/design/CompanyBrand">Show Matchup Service »</a>
								<a class="btn btn-primary d-inline-block mt-2" href="javascript:void(0);">Apply</a>
<?php }else if(!$company['contact_private']){ ?>
								<h6 class="mb-0 mt-3">Contact Information</h6>
<?php if(isset($company['contact_phone1']) && !empty($company['contact_phone1'])){ ?>
								<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Primary Phone Number:" title="Primary Phone Number" width="16" height="16" /> <?= $company['contact_phone1'] ?></p>
<?php } if(isset($company['contact_phone2']) && !empty($company['contact_phone2'])){ ?>
								<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Secondary Phone Number:" title="Secondary Phone Number" width="16" height="16" /> <?= $company['contact_phone2'] ?></p>
<?php } if(isset($company['contact_email']) && !empty($company['contact_email'])){ ?>
								<p class="mb-0"><img src="/assets/icons/contact/mail.png" alt="Email:" title="Email" width="16" height="16" /> <?= $company['contact_email'] ?></p>
<?php } if(isset($company['contact_person']) && !empty($company['contact_person'])){ ?>
								<p class="mb-0"><img src="/assets/icons/contact/person.png" alt="Contact Person:" title="Contact Person" width="16" height="16" /> <?= $company['contact_person'] ?></p>
<?php } if(isset($company['contact_messengers']) && !empty($company['contact_messengers'])){ ?>
								<div class="mb-0 mt-1">
									<span>Messengers:</span>
<?php foreach(explode(',', $company['contact_messengers']) as $contact_messenger){ $messenger = explode(';', $contact_messenger); ?>
									<p class="mb-0"><img src="/assets/icons/messengers/<?= strtolower($messenger[0]) ?>.png" alt="<?= $messenger[0] ?>:" title="<?= $messenger[0] ?>" width="16" height="16" /> <?= $messenger[1] ?></p>
<?php } ?>
								</div>
<?php }} if(isset($company['contact_urls']) && !empty($company['contact_urls'])){ ?>
								<p class="mt-2">URL(s): <?= $WP->printUrls($company); ?></p>
<?php }else if($_SESSION['ID']){ ?>
								<h6 class="mb-0 mt-3">Send Message to Company</h6>
								<p class="mb-1">If you have questions to company, please send me a message</p>
								<div class="row">
									<div class="col-lg-8">
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
									</div>
								</div>
<?php }else{ ?>
								<h6 class="mb-0 mt-3">Send Message to Company</h6>
								<p class="mb-1">If you have questions to company, please send me a message</p>
								<div class="row">
									<div class="col-lg-8">
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
									</div>
								</div>
<?php } ?>
									</div>
								</div>
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
			<!-- section : Direction -->
			<section class="row">
				<div class="col">
					<h5 class="border-bottom pb-2 mb-3">Direction</h5>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
							<div id="GoogleMap-map2" style="height:228px;"></div>
							<input type="hidden" id="GoogleMap-lat2" name="addr_lat2" value="<?= $rs['addr_lat'] ?>" />
							<input type="hidden" id="GoogleMap-lng2" name="addr_lng2" value="<?= $rs['addr_lng'] ?>" />
							<script defer>
							$(function(){
								if (document.getElementById('GoogleMap-map2')) {
									GoogleMap.map = new google.maps.Map(document.getElementById('GoogleMap-map2'), {
										center : { lat : parseFloat(document.getElementById('GoogleMap-lat2').value), lng : parseFloat(document.getElementById('GoogleMap-lng2').value) }, zoom : 14,
										zoomControl : true, scaleControl : true, rotateControl : false, mapTypeControl : false, streetViewControl : false, fullscreenControl : false
									});
									if (document.getElementById('GoogleMap-lat2') && document.getElementById('GoogleMap-lng2')) {
										GoogleMap.data.latLng.lat = parseFloat(document.getElementById('GoogleMap-lat2').value);
										GoogleMap.data.latLng.lng = parseFloat(document.getElementById('GoogleMap-lng2').value);
										GoogleMap.setMarker();
									}
								}
							});
							</script>
<?php } ?>
						</div>
					</div>
					<div class="row">
						<div class="col">
<?php if(isset($rs['addr']) && !empty($rs['addr'])){ ?>
							<p class="text-left"><?= $rs['addr'] ?></p>
<?php if(isset($rs['addr2']) && !empty($rs['addr2'])){ ?>
							<p class="text-left"><?= $rs['addr2'] ?></p>
<?php } ?>
<?php $rs['addr_desc'] = strip_tags($rs['addr_desc']); if(isset($rs['addr_desc']) && !empty($rs['addr_desc'])){ ?>
							<div class="text-center<?= strlen($rs['addr_desc'])>150?' float-left':'' ?>" style="width:100%;">
								<hr class="w-25 mb-0" />
								<div class="<?= strlen($rs['addr_desc'])>150?'line-clamp-3 float-left':'' ?>" style="width:100%;">
									<p><?= $rs['addr_desc'] ?></p>
<?php if(isset($rs['addr_lat']) && !empty($rs['addr_lat']) && isset($rs['addr_lng']) && !empty($rs['addr_lng'])){ ?>
									<div class="text-center">
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
			<!-- /section : Direction -->

<?php } //addr ?>
									</div>
								</div>
							</div>
						</div>
						<!-- /.row -->

					</div>
					<!-- /.tab-pane#tabCompanyProfile -->

				</div>
				<!-- /.tab-content -->

				<input type="hidden" id="applCoverLetter" name="appl_cover_letter" value="<?= $rs['appl_cover_letter'] ?>" />
				<input type="hidden" id="applQuestions" name="appl_questions" value="<?= $rs['appl_questions'] ?>" />