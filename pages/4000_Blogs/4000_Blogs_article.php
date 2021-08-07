<?php if($_GET['list']){ ?>
					<article class="card<?= $_GET['PAGE']=='MyPage'?'':' card-hover border-top-0 border-left-0 border-right-0' ?> pb-4 mb-4">
						<div class="card-body py-0<?= $_GET['PAGE']=='MyPage' && empty($article['list_img'])?'':' pl-0' ?>">
							<div class="form-row">
								<div class="col-<?= $article['list_img']?'4':'12' ?><?= $_GET['PAGE']=='MyPage'?'':' mt-1' ?>">
<?php if($article['list_img']){ ?>
									<a class="embed-responsive embed-responsive-16by9" href="/Blogs/Detail/Article/<?= $article['no'] ?>" title="<?= $article['title'] ?>"<?= $_GET['MAIN']!='Blogs'?' target="_blank"':'' ?>>
										<figure class="embed-responsive-item d-flex align-items-center<?= $_GET['PAGE']=='MyPage'?' mb-0':''?>">
											<img class="mw-100" src="<?= $article['list_img'] ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" style="min-height:100%;" />
										</figure>
									</a>
<?php } ?>
								</div>
								<div class="col-<?= $article['list_img']?'8':'12' ?><?= $_GET['PAGE']=='MyPage'?' pt-2':'' ?>">
									<h5 class="line-clamp-1">
										<a class="text-dark stretched-link" href="/Blogs/Detail/Article/<?= $article['no'] ?>" title="<?= $article['title'] ?>"<?= $_GET['MAIN']!='Blogs'?' target="_blank"':'' ?>><?= $article['title'] ?></a>
									</h5>
									<h6 class="line-clamp-1">by <span class="text-primary"><?= $article['nickname'] ?></span></h6>
<?php if(strip_tags($article['desc'])){ ?>
									<p class="<?= $_GET['PAGE']=='MyPage'?'line-clamp-2':'line-clamp-3'?>"><?= substr($WP->stringFilter($article['desc']), 0, 150) ?>... <strong>>> Read more</strong></p>
<?php } ?>
									<footer class="line-clamp-1 text-right"><?= date($CONF['date_format'], strtotime($article['date'])) ?></footer>
								</div>
							</div>
						</div>
<?php if($_GET['PAGE']=='MyPage'){ ?>
						<div class="card-footer mb-n4 dropdown">
							<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="/Blogs/Edit/Article/<?= $article['no'] ?>">Edit</a>
<?php if(isset($article['publ']) && !empty($article['publ'])){ ?>
								<a class="dropdown-item" data-toggle="action" data-action="<?= $article['publ']==1?'close':'open' ?>" data-table="story_article" data-pk="<?= $article['no'] ?>"><?= $article['publ']==1?'Close':'Open' ?></a>
<?php } ?>
								<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="story_article" data-pk="<?= $article['no'] ?>">Delete</a>
							</div>
						</div>
<?php } ?>
					</article>
<?php }else{ ?>
					<article class="card<?= $_GET['PAGE']=='MyPage'?'':' card-hover' ?> mb-4">
						<a class="card-img-top embed-responsive embed-responsive-16by9" href="/Blogs/Detail/Article/<?= $article['no'] ?>" title="<?= $article['title'] ?>"<?= $_GET['MAIN']!='Blogs'?' target="_blank"':'' ?>>
							<figure class="embed-responsive-item d-flex align-items-center">
								<img class="mw-100" src="<?= $article['list_img'] ?>" alt="<?= $article['title'] ?>" title="<?= $article['title'] ?>" onerror="this.src='/assets/images/common-noimage.png'" style="min-height:100%;" />
							</figure>
						</a>
						<div class="card-body position-relative">
							<small class="line-clamp-1">by <span class="text-primary"><?= $article['nickname'] ?></span></small>
							<h6 class="card-title line-clamp-1 font-weight-bold">
								<a class="text-dark stretched-link" href="/Blogs/Detail/Article/<?= $article['no'] ?>" title="<?= $article['title'] ?>"<?= $_GET['MAIN']!='Blogs'?' target="_blank"':'' ?>><?= $article['title'] ?></a>
							</h6>
							<p class="line-clamp-2"><?= strip_tags($article['desc']) ?></p>
							<footer class="line-clamp-1"><?= date($CONF['date_format'], strtotime($article['date'])) ?></footer>
						</div>
<?php if($_GET['PAGE']=='MyPage'){ ?>
						<div class="card-footer dropdown">
							<button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle float-right" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="/Blogs/Edit/Article/<?= $article['no'] ?>">Edit</a>
<?php if(isset($article['publ']) && !empty($article['publ'])){ ?>
								<a class="dropdown-item" data-toggle="action" data-action="<?= $article['publ']==1?'close':'open' ?>" data-table="story_article" data-pk="<?= $article['no'] ?>"><?= $article['publ']==1?'Close':'Open' ?></a>
<?php } ?>
								<a class="dropdown-item" data-toggle="action" data-action="delete" data-table="story_article" data-pk="<?= $article['no'] ?>">Delete</a>
							</div>
						</div>
<?php } ?>
					</article>
<?php } ?>