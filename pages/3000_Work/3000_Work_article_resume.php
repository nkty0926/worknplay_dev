					<article class="card card-hover border-top-0 border-left-0 border-right-0 pb-4 mb-4">
						<div class="card-body p-0">
							<div class="row">
								<div class="col-sm-3 d-none d-sm-block text-center">
									<a class="text-dark stretched-link"
<?php if(isset($article['member']) && $article['member']==$_SESSION['ID'] || $USER['work_credit_res_day'] || $USER['work_credit_res']){ ?>
										href="/Work/Detail/Resume/<?= $article['no'] ?>"
<?php }else if($_SESSION['SEEKER']){ ?>
										onclick="Alert('You are using an email address registered for an Employee Account. If you want to browse the resume database, please register as an Employer.');"
<?php }else{ ?>
										onclick="Confirm('This feature requires payment.&lt;br/&gt;Click &quot;Yes&quot; to go to the instruction page.', function(){ window.open('/Work/Employer/Intro'); });"
<?php } ?>
										title="<?= $article['title'] ?>"
									><img class="mw-100" src="<?= isset($article['member']) && $article['member']==$_SESSION['ID'] || $USER['work_credit_res_day'] || $USER['work_credit_res'] ? $article['logo_img'] : '/assets/images/common-profile.png' ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-profile.png'" width="110" style="max-height:147px;" /></a>
								</div>
								<div class="col-sm-9">
									<div class="card-body position-relative py-0">
										<h5 class="card-title line-clamp-1">
											<a class="text-dark stretched-link"
<?php if(isset($article['member']) && $article['member']==$_SESSION['ID'] || $USER['work_credit_res_day'] || $USER['work_credit_res']){ ?>
												href="/Work/Detail/Resume/<?= $article['no'] ?>"
<?php }else if($_SESSION['SEEKER']){ ?>
												onclick="Alert('You are using an email address registered for an Employee Account. If you want to browse the resume database, please register as an Employer.');"
<?php }else{ ?>
												onclick="Confirm('This feature requires payment.&lt;br/&gt;Click &quot;Yes&quot; to go to the instruction page.', function(){ window.open('/Work/Employer/Intro'); });"
<?php } ?>
												title="<?= $article['title'] ?>"
											><?= $article['title'] ?></a>
										</h5>
										<h6 class="line-clamp-1">
											<span class="text-primary"><?= $USER['work_credit_res_day']?$article['personal_firstname']:'***' ?> <?= $article['personal_lastname'] ?></span>
<?php if($article['personal_birthday'] || $article['nationality_name'] || $article['job_type']){ ?>
											<span class="ml-2">
											(
<?php if(isset($article['personal_birthday']) && !empty($article['personal_birthday'])){ ?>
											<span class="border-after pr-1"><span><?= explode('-', $article['personal_birthday'])[0] ?></span></span>
<?php } if(isset($article['personal_nationality']) && !empty($article['personal_nationality'])){ ?>
											<span class="border-after pr-1"><span><?= $WP->printNationality($article) ?></span></span>
<?php } if(isset($article['job_type']) && !empty($article['job_type'])){ ?>
											<span class="border-after pr-1"><span><?= $WP->printJobType($article) ?></span></span>
<?php } ?>
											)
											</span>
<?php } ?>
										</h6>
										<p class="mb-0"><?= $CONF['education_levels'][$article['education_level']] ?>
<?php if(strpos($article['education_desc'], '¶')){ $education_desc = explode('§', $article['education_desc']); $edu = explode('¶', $education_desc[0]); ?>
											: <?= $edu[0] ?> <?= $edu[1] ?>
<?php } ?>
										</p>
										<p class="mb-0"><?= $CONF['career_levels'][$article['career_level']] ?></p>
<?php if (isset($article['job_category_parent_name']) && !empty($article['job_category_parent_name'])) { ?>
										<p class="mb-0"><?= $WP->printJobCategory($article) ?>
											<?php if(isset($article['job_category_tag']) && !empty($article['job_category_tag'])){ ?>
											<span>>
											<?php foreach(explode(',', $article['job_category_tag']) as $category_tag){ ?>
											<span class="comma-after"><?= $category_tag ?></span>
											<?php } ?>
											</span>
											<?php } ?>
										</p>
<?php } if(isset($article['desired_location_parent_name']) && !empty($article['desired_location_parent_name']) || isset($article['desired_location_country_name']) && !empty($article['desired_location_country_name'])){ ?>
										<p class="text-break mb-0"><?= $WP->printLocation($article, 'desired_') ?></p>
<?php } ?>
									</div>
									<div class="card-footer pb-0 border-0 bg-transparent">
										<span class="text-muted"><?= substr($article['date'], 0, 10)==substr($article['mod'], 0, 10)?'Date Posted':'Last Modified' ?> : <time><?= date($CONF['date_format'], strtotime($article['mod'])) ?></time></span>
<?php if($USER['work_credit_res_day'] || $USER['work_credit_res']){ $saved = $DB->selectSave('work_resume', $article['no']); ?>
										<a class="btn btn-outline-secondary float-right article-btn-bookmark<?= $saved?' active':'' ?>"
											data-toggle="modal" data-target="#modalFormSaveResume" data-pk="<?= $article['no'] ?>"
										></a>
<?php }else if($_SESSION['SEEKER']){ ?>
										<button type="button" class="btn btn-outline-secondary float-right article-btn-bookmark<?= isset($saved)&&!empty($saved)?' active':'' ?>"
											onclick="Alert(this.dataset.msg);"
											data-msg="You are using an email address registered for an Employee Account. If you want to browse the resume database, please register as an Employer."
										></button>
<?php }else{ ?>
										<button type="button" class="btn btn-outline-secondary float-right article-btn-bookmark<?= isset($saved)&&!empty($saved)?' active':'' ?>"
											onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Employer/Intro'); });"
											data-msg="This feature requires payment.&lt;br/&gt;Click &quot;Yes&quot; to go to the instruction page."
										></button>
<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</article>
