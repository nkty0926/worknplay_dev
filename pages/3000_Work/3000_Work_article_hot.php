					<article class="card card-hover border-secondary shadow-sm h-100<?= $_GET['PAGE']!='Employer' && strtotime($article['date'] . '+180day')>strtotime('now')?' card-active':'' ?>">
						<div class="card-body position-relative pb-0 pt-3">
<?php if($_GET['PAGE']=='Search' && $_GET['MENU']=='Job'){ ?>
							<figure class="mb-2 mb-sm-3">
								<img class="mw-100" src="<?= $article['company_logo_img'] ?>" alt="<?= $article['company_name'] ?>" title="<?= $article['company_name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" height="60" />
							</figure>
<?php } ?>
							<h6 class="card-title line-clamp-1 mb-1"><a class="text-dark stretched-link<?= $_GET['PAGE']!='Employer' && strtotime($article['date'] . '+180day')>strtotime('now')?'':' disabled' ?>" href="<?=$_GET['MAIN']=='actions'&&$_GET['PAGE']=='JobDetail'?'javascript:void(0);" onclick="showJobDetail('.$article['no'].')':'/Work/Detail/Job/'.$article['no']?>"><?= $article['title'] ?></a></h6>
<?php if($_GET['PAGE']!='Detail' && $_GET['MENU']!='Company'){ ?>
							<h6 class="line-clamp-1 mb-1">by <span class="text-primary"><?= $article['company_name'] ?></span></h6>
<?php } ?>
							<p class="card-text<?= $_GET['PAGE']!='Detail' && $_GET['MENU']!='Company' ? ' small' : '' ?> line-clamp-3 mb-2"><?= $WP->stringFilter($article['desc']) ?></p>
						<div class="small pb-3">
							<span class="text-muted"><?= $WP->printLocation($article) ?></span><br />
							<span class="text-muted"><?= $WP->printPeriod($article) ?></span>
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
						</div>
					</article>
