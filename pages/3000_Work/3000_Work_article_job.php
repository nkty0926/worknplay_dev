					<article class="card card-hover border-top-0 border-left-0 border-right-0 pb-4 mb-4">
						<div class="card-body position-relative py-0">
							<h5 class="card-title line-clamp-1 mb-1 mb-sm-2"><a class="text-dark stretched-link" href="/Work/Detail/Job/<?= $article['no'] ?>"><?= $article['title'] ?></a></h5>
							<h6 class="line-clamp-1 mb-1 mb-sm-2">
								<span>by <span class="text-primary"><?= $article['company_name'] ?></span></span>
								<span class="d-none d-sm-inline mx-2">|</span>
								<span class="d-none d-sm-inline">Job Type : <span><?= $WP->printJobType($article) ?></span></span>
<?php if(isset($article['location_parent_name']) && !empty($article['location_parent_name']) || isset($article['location_country_name']) && !empty($article['location_country_name'])){ ?>
								<span class="d-none d-sm-inline mx-2">|</span>
								<span class="d-none d-sm-inline">Location : <span><?= $WP->printLocation($article) ?></span></span>
<?php } ?>
							</h6>
							<p class="text-muted line-clamp-2 mb-2 mb-sm-3"><?= $WP->stringFilter($article['desc']) ?></p>
						</div>
						<div class="card-footer py-0 border-0 bg-transparent">
							<span class="text-muted"><?= $WP->printLocation($article) ?></span>
							<br class="d-sm-none" />
							<span class="text-muted d-sm-none"><?= $WP->printPeriod($article) ?></span>
<?php if($_SESSION['SEEKER']){ $saved = $DB->selectSave('work_job', $article['no']); ?>
							<button type="button" class="btn btn-outline-secondary float-right article-btn-bookmark<?= isset($saved)&&!empty($saved)?' active':'' ?>"
								data-toggle="action" data-action="Save" data-table="work_job" data-pk="<?= $article['no'] ?>"
							></button>
<?php }else if(!$_SESSION['EMPLOYER']){ ?>
							<button type="button" class="btn btn-outline-secondary float-right article-btn-bookmark<?= isset($saved)&&!empty($saved)?' active':'' ?>"
								onclick="Confirm(this.dataset.msg, function(){ window.open('/Work/Seeker'); });"
								data-msg="This feature requires a resume.&lt;br/&gt;Click &quot;Yes&quot; to create a resume."
							></button>
<?php } ?>
						</div>
					</article>
