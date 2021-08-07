					<article class="card border-secondary shadow-sm h-100" style="border-color:<?= $_SESSION['CURRENT_COMPANY']==$article['no']?'var(--primary)':'#a2a9ae' ?> !important;">
						<div class="card-body position-relative text-center">
							<figure class="d-flex align-items-center w-50 mx-auto" style="height:60px;line-height:60px;">
								<img class="d-block mx-auto mw-100 mh-100" src="<?= $article['logo_img'] ?>" alt="<?= $article['name'] ?>" title="<?= $article['name'] ?>" onerror="this.src='/assets/images/common-noimage.png'" />
							</figure>
							<hr />
							<h6 class="card-title line-clamp-1"><a class="text-dark stretched-link" href="/Work/Detail/Company/<?= $article['no'] ?>"><?= $article['name'] ?></a></h6>
							<p class="card-text text-muted line-clamp-2"><?= $WP->stringFilter($article['desc']) ?></p>
						</div>
<?php if($_GET['PAGE']=='Employer'){ ?>
						<div class="card-footer dropdown">
							<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
							<div class="dropdown-menu dropdown-menu-right">
<?php if($_SESSION['CURRENT_COMPANY']!=$article['no']){ ?>
								<a class="dropdown-item" data-toggle="action" data-action="CurrentCompany" data-pk="<?= $article['no'] ?>">Select</a>
<?php } ?>
								<a class="dropdown-item" href="/Work/Edit/Company/<?= $article['no'] ?>">Edit</a>
<?php if($article['publ']!=1){ ?>
								<a class="dropdown-item" data-toggle="action" data-action="open" data-table="work_company" data-pk="<?= $article['no'] ?>">Open</a>
<?php }else{ ?>
								<a class="dropdown-item" data-toggle="action" data-action="close" data-table="work_company" data-pk="<?= $article['no'] ?>">Close</a>
<?php } ?>
								<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="work_company" data-pk="<?= $article['no'] ?>">Delete</a>
							</div>
						</div>
<?php } ?>
					</article>
