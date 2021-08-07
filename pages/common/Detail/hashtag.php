<?php if(isset($rs['hashtag']) && !empty($rs['hashtag'])){ ?>
			<!-- .row : Hash Tag -->
			<div class="row mb-4">
				<div class="col">

					<h5>TAGS</h5>
		
					<div class="row">
						<div class="col-12">
<?php foreach(explode('#', $rs['hashtag']) as $hashtag){ if(trim($hashtag)){ ?>
							<a class="btn btn-light btn-sm rounded-pill mb-2 mr-2" href="/<?= $_GET['MAIN'] ?>/Search/<?= $_GET['MENU'] ?>?keyword=<?= urlencode(trim($hashtag)) ?>">#<?= trim($hashtag) ?></a>
<?php }} ?>
						</div>
					</div>

				</div>
			</div>
			<!-- /.row : Hash Tag -->

<?php } //hashtag ?>