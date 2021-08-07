			<!-- fieldset : Photos -->
			<fieldset class="mb-5" id="fieldset-photos">
				<legend>Photos</legend>
				<div class="form-row" id="photos-img-target">
<?php if(isset($rs['photos']) && !empty($rs['photos'])){ foreach(explode(',', $rs['photos']) as $photo){ ?>
					<article class="col-12 col-sm-6 col-md-3 mb-3">
						<a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a>
						<figure><img src="<?= explode('" title="', $photo)[0] ?>" onerror="this.src='/assets/images/common-noimage.png'" /></figure>
						<input type="text" class="form-control form-control-sm" value="<?= explode('" title="', $photo)[1] ?>" placeholder="Caption" />
					</article>
<?php }} ?>
				</div>
				<label class="btn btn-secondary mb-0 px-4" for="photos"><i class="fa fa-plus-square"></i> Browse</label>
				<input type="file" accept="image/gif, image/jpeg, image/png" id="photos" data-name="photos" data-target="#photos-img-target" multiple />
				<input type="hidden" name="photos" />
<?php if($_GET['MENU']=='Resume'){ ?>
				<style>#fieldset-photos article>figure+input{display:none;}</style>
<?php } ?>
				<script defer>
					$(function() {
						$('#photos-img-target').sortable({
							placeholder : 'ui-state-highlight col-12 col-sm-6 col-md-3'
						});
					});
					$('#fieldset-photos').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#photos-img-target>article').each(function() {
							if ($(this).find('img').attr('src')) {
								arr.push($(this).find('img').attr('src') + '" title="' + $(this).find('input').val() + '" alt="' + $(this).find('input').val());
							}
						});
						$('input[type="hidden"][name="photos"]').val(arr.toString());
					});
				</script>
			</fieldset>
			<!-- /fieldset : Photos -->

			<!-- fieldset : Videos -->
			<fieldset class="mb-5" id="fieldset-videos">
				<legend>Videos</legend>
				<div class="form-row" id="videos-target">
<?php if(isset($rs['videos']) && !empty($rs['videos'])){ foreach(explode(',', $rs['videos']) as $video){ ?>
					<div class="col-12 col-sm-6 col-md-6 mb-2">
						<a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a>
						<figure class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" src="<?= $video ?>"></iframe>
						</figure>
					</div>
<?php }} ?>
				</div>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Youtube / Vimeo URL" />
					<div class="input-group-append">
						<button type="button" class="btn btn-light" data-toggle="videos" data-target="#videos-target" multiple>ADD</button>
					</div>
				</div>
				<input type="hidden" name="videos" />
				<script defer>
					$('[data-toggle="videos"]').on('click', function() {
						var input = $(this).parents('.input-group').find('input[type="text"]');
						var target = $(this).attr('data-target');
						var target_collapse = $(this).attr('data-target-collapse');
						var target_collapse_in = $(this).attr('data-target-collapse-in');
						var multiple = $(this).attr('multiple') == 'multiple';
						var value = $(input).val();
						if (value.indexOf('www.youtube.com/watch?v=') != -1)
							value = value.replace('www.youtube.com/watch?v=', 'www.youtube.com/embed/');
						else if (value.indexOf('youtu.be/') != -1)
							value = value.replace('youtu.be/', 'www.youtube.com/embed/');
						else if (value.indexOf('vimeo.com/channels/staffpicks/') != -1)
							value = value.replace('vimeo.com/channels/staffpicks/', 'player.vimeo.com/video/');
						else if (value.indexOf('vimeo.com/') != -1)
							value = value.replace('vimeo.com/', 'player.vimeo.com/video/');
						else
							value = '';
						if (value.indexOf('?') == -1 && value.indexOf('&') != -1)
							value = value.replace('&', '?');
						if (value) {
							$(input).val('');
							if (!multiple)
								$(target).find('figure').remove();
							$(target).append('<div class="col-12 col-sm-6 col-md-6 mb-2"><a class="form-remove" href="javascript:void(0);" data-toggle="remove">&times;</a><figure class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="' + value + '"></iframe></figure></div>');
							if (target_collapse)
								$(target_collapse).removeClass('in');
							if (target_collapse_in)
								$(target_collapse_in).addClass('in');
						} else
							Alert("Invalid URL. Please try again.");
					});
					$('#fieldset-videos').parents('form').on('click', 'button[type="submit"]', function() {
						var arr = [];
						$('#videos-target>div>figure>iframe').each(function() {
							if ($(this).attr('src')) {
								arr.push($(this).attr('src'));
							}
						});
						$('input[type="hidden"][name="videos"]').val(arr.toString());
					});
				</script>
			</fieldset>
			<!-- /fieldset : Videos -->
