<?php $dropdownmenu = $_GET['PAGE']=='Employer' || ($_GET['SUB']=='Events' && $_SESSION['ID'] && $article['member']==$_SESSION['ID']); if($_GET['list']){ ?>
					<article class="article article-list<?= $dropdownmenu?'':' article-hover' ?><?= $article['publ']!=1?' closed':'' ?>">
						<a class="row" href="/Work/Detail/Event/<?= $article['no'] ?>" title="<?= $article['title'] ?><?= $article['publ']!=1?' (Closed)':'' ?>">
							<div class="col-4 article-img">
								<figure style="background-image:url(<?= $article['header_img']?$article['header_img']:'/assets/images/common-noimage.png' ?>);"></figure>
							</div>
							<div class="col-8 article-body">
								<h4 class="line-clamp-1"><?= $article['title'] ?></h4>
								<!-- <h5 class="line-clamp-1"><?= $article['company_name'] ?></h5> -->
								<p class="line-clamp-3"><?= $WP->stringFilter($article['desc']) ?></p>
								<footer class="line-clamp-1<?= $dropdownmenu?'':' text-right' ?>"><?= $WP->printPeriod($article) ?></footer>
							</div>
						</a>
<?php if(isset($dropdownmenu) && !empty($dropdownmenu)){ ?>
						<div class="dropdown float-right">
							<a class="btn btn-light btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="/Work/Edit/Event/<?= $article['no'] ?>">Edit</a></li>
<?php if(isset($article['publ']) && $article['publ']!=1){ ?>
								<li><a data-toggle="action" data-action="open" data-table="work_event" data-pk="<?= $article['no'] ?>">Open</a></li>
<?php }else{ ?>
								<li><a data-toggle="action" data-action="close" data-table="work_event" data-pk="<?= $article['no'] ?>">Close</a></li>
<?php } ?>
								<li><a data-toggle="action" data-action="delete" data-table="work_event" data-pk="<?= $article['no'] ?>">Delete</a></li>
							</ul>
						</div>
<?php } ?>
					</article>
<?php }else{ ?>
					<article class="card card-hover h-100">
						<a class="card-img-top embed-responsive embed-responsive-16by9" href="/Work/Detail/Event/<?= $article['no'] ?>" title="<?= $article['title'] ?>">
							<figure class="embed-responsive-item stretched-link d-flex align-items-center">
								<img class="mw-100" src="<?= $article['header_img'] ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
							</figure>
						</a>
						<div class="card-body position-relative">
							<h6 class="card-title line-clamp-1"><a class="text-dark stretched-link" href="/Work/Detail/Event/<?= $article['no'] ?>"><?= $article['title'] ?></a></h6>
							<span class="text-muted"><?= $WP->printPeriod($article) ?></span>
						</div>
<?php if(isset($dropdownmenu) && !empty($dropdownmenu)){ ?>
						<div class="card-footer dropdown">
							<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="/Work/Edit/Event/<?= $article['no'] ?>">Edit</a>
<?php if(isset($article['publ']) && $article['publ']!=1){ ?>
								<a class="dropdown-item" data-toggle="action" data-action="open" data-table="work_event" data-pk="<?= $article['no'] ?>">Open</a>
<?php }else{ ?>
								<a class="dropdown-item" data-toggle="action" data-action="close" data-table="work_event" data-pk="<?= $article['no'] ?>">Close</a>
<?php } ?>
								<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="work_event" data-pk="<?= $article['no'] ?>">Delete</a>
							</div>
						</div>
<?php } ?>
					</article>
<?php } ?>
