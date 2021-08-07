			<!-- form#Sidebar -->
			<form class="card bg-light p-3" id="Sidebar" method="get" action="/Work/<?= $_GET['PAGE']?$_GET['PAGE']:'Search' ?>/<?= $_GET['MENU']?$_GET['MENU']:'Job' ?>">

				<input type="hidden" name="html" value="true" />

				<div class="form-group mb-2">
					<input type="text" class="form-control" name="keyword" value="<?= isset($_GET['keyword'])?$_GET['keyword']:'' ?>" placeholder="Keyword" />
				</div>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-job_category_parent">Industry<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-job_category_parent">
<?php foreach($DB->selectCode('work_job_category') as $job_category_parent){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="job_category_parent-<?= $job_category_parent['no'] ?>" name="job_category_parent[]" value="<?= $job_category_parent['no'] ?>"<?= in_array($job_category_parent['no'], $_GET['job_category_parent'])?' checked':'' ?> />
						<label class="form-check-label" for="job_category_parent-<?= $job_category_parent['no'] ?>"><?= $job_category_parent['name'] ?></label>
					</li>
<?php } ?>
				</ul>
				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-job_category_child" style="display:none;">Industry 2<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-job_category_child">
<?php foreach($DB->selectCode('work_job_category') as $job_category_parent){
	foreach($job_category_parent['children'] as $job_category_child){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small" style="display:none;">
						<input type="checkbox" class="form-check-input" id="job_category_child-<?= $job_category_child['no'] ?>" name="job_category_child[]" value="<?= $job_category_child['no'] ?>" data-parent-value="<?= $job_category_parent['no'] ?>"<?= in_array($job_category_child['no'], $_GET['job_category_child'])?' checked':'' ?> />
						<label class="form-check-label" for="job_category_child-<?= $job_category_child['no'] ?>"><?= $job_category_child['name'] ?></label>
					</li>
<?php }} ?>
				</ul>
				<script defer>
					$('input[name="job_category_parent[]"]').on('change', function() {
						$('input[name="job_category_child[]"]').each(function() {
							if ($('input[name="job_category_parent[]"][value="' + $(this).data('parentValue') + '"]').prop('checked')) {
								$(this).parent('.list-group-item').show();
							} else {
								$(this).prop('checked', false).parent('.list-group-item').hide();
							}
						});
						if ($('input[name="job_category_parent[]"]:checked').length > 0) {
							$('#Sidebar-job_category_child').collapse('show').prev('label').show();
						} else {
							$('#Sidebar-job_category_child').collapse('hide').prev('label').hide();
						}
						$('#Sidebar-job_category_child').sidebarBadgeUpdate();
					});
				</script>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-country">Country<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-country">
<?php foreach($DB->selectCode('country') as $country){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="country-<?= $country['no'] ?>" name="location_country[]" value="<?= $country['no'] ?>"<?= in_array($country['no'], $_GET['location_country'])?' checked':'' ?> />
						<label class="form-check-label" for="country-<?= $country['no'] ?>"><?= $country['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom mb-1 pb-1 collapse" data-toggle="collapse" data-target="#Sidebar-location">Location<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-location">
<?php foreach($DB->selectCode('location') as $location){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="location-<?= $location['no'] ?>" name="location_parent[]" value="<?= $location['no'] ?>"<?= in_array($location['no'], $_GET['location_parent'])?' checked':'' ?> />
						<label class="form-check-label" for="location-<?= $location['no'] ?>"><?= $location['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom mb-1 pb-1 collapse" data-toggle="collapse" data-target="#Sidebar-city">City<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-city">
<?php foreach($DB->selectCode('country_city') as $i => $city){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="city-<?= $i+1 ?>" name="location_city[]" value="<?= $city['city_name'] ?>" data-parent-value="<?= $city['country_code'] ?>"<?= in_array($city['city_name'], $_GET['location_city'])?' checked':'' ?> />
						<label class="form-check-label" for="city-<?= $i+1 ?>"><?= $city['city_name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-type">Job Type<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-type">
<?php foreach($DB->selectCode('work_job_type') as $type){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="type-<?= $type['no'] ?>" name="job_type[]" value="<?= $type['no'] ?>"<?= in_array($type['no'], $_GET['job_type'])?' checked':'' ?> />
						<label class="form-check-label" for="type-<?= $type['no'] ?>"><?= $type['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-education_level">Education Level<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-education_level">
<?php foreach($CONF['education_levels'] as $i => $education_level){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="education_level-<?= $i+1 ?>" name="education_level[]" value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['education_level'])?' checked':'' ?> />
						<label class="form-check-label" for="education_level-<?= $i+1 ?>"><?= $education_level ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-career_level">Career Level<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-career_level">
<?php foreach($CONF['career_levels'] as $i => $career_level){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="career_level-<?= $i+1 ?>" name="career_level[]" value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['career_level'])?' checked':'' ?> />
						<label class="form-check-label" for="career_level-<?= $i+1 ?>"><?= $career_level ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-language_eng">English<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-language_eng">
<?php foreach($CONF['language_levels'] as $i => $language_level){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="language_eng_<?= $i+1 ?>" name="language_eng[]" value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['language_eng'])?' checked':'' ?> />
						<label class="form-check-label" for="language_eng_<?= $i+1 ?>"><?= $language_level ?></label>
					</li>
<?php } ?>
				</ul>

<?php if(false){ ?>
				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-language_kor">Korean<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-language_kor">
<?php foreach($CONF['language_levels'] as $i => $language_level){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="language_kor_<?= $i+1 ?>" name="language_kor[]" value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['language_kor'])?' checked':'' ?> />
						<label class="form-check-label" for="language_kor_<?= $i+1 ?>"><?= $language_level ?></label>
					</li>
<?php } ?>
				</ul>
<?php } ?>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-language_others">Other Language<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-language_others">
<?php foreach($DB->selectCode('personal_language') as $i => $language){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="language_others-<?= $i+1 ?>" name="language_others[]" value="<?= $language['name'] ?>"<?= in_array($language['name'], $_GET['language_others'])?' checked':'' ?> />
						<label class="form-check-label" for="language_others-<?= $i+1 ?>"><?= $language['name'] ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-teaching_level">Teaching Level<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-teaching_level">
<?php foreach($CONF['teaching_levels'] as $i => $teaching_level){ ?>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="checkbox" class="form-check-input" id="teaching_level-<?= $i+1 ?>" name="teaching_level[]" value="<?= $i+1 ?>"<?= in_array($i+1, $_GET['teaching_level'])?' checked':'' ?> />
						<label class="form-check-label" for="teaching_level-<?= $i+1 ?>"><?= $teaching_level ?></label>
					</li>
<?php } ?>
				</ul>

				<label class="border-bottom w-100 mb-1 pb-1" data-toggle="collapse" data-target="#Sidebar-period"><?= $_GET['MENU']=='Resume'?'Available ':'' ?>Start Date<span class="badge badge-primary ml-1"></span><span class="float-right"><i class="fa fa-angle-down"></i></span></label>
				<ul class="list-group border-bottom mb-2 collapse" id="Sidebar-period">
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="radio" class="form-check-input" id="period_type_1" name="period_type" value="1"<?= isset($_GET['period_type']) && $_GET['period_type']==1?' checked':'' ?> />
						<label class="form-check-label" for="period_type_1">Choose a Date</label>
					</li>
					<div class="form-inline mr-3 <?= isset($_GET['period_type']) && $_GET['period_type']==1?'d-inline-flex':'d-none' ?>">
						<input type="text" class="form-control form-control-sm" id="period_from" name="period_from" value="<?= isset($_GET['period_from'])?$_GET['period_from']:'' ?>" autocomplete="off" style="max-width:92px;" />
						<script defer>$(function(){ $('#period_from').datepicker({ <?= $_SESSION['RECRUITER']?'':'minDate: 0, ' ?>dateFormat: 'yy-mm-dd' }); });</script>
						<strong>&nbsp;~&nbsp;</strong>
						<input type="text" class="form-control form-control-sm" id="period_to" name="period_to" value="<?= isset($_GET['period_to'])?$_GET['period_to']:'' ?>" autocomplete="off" style="max-width:92px;" />
						<script defer>$(function(){ $('#period_to').datepicker({ minDate: '<?= isset($_GET['period_from'])?$_GET['period_from']:0 ?>', dateFormat: 'yy-mm-dd' }); });</script>
					</div>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="radio" class="form-check-input" id="period_type_2" name="period_type" value="2"<?= isset($_GET['period_type']) && $_GET['period_type']==2?' checked':'' ?> />
						<label class="form-check-label" for="period_type_2">ASAP</label>
					</li>
					<li class="list-group-item form-check mb-1 py-0 pr-0 border-0 bg-transparent small">
						<input type="radio" class="form-check-input" id="period_type_3" name="period_type" value="3"<?= isset($_GET['period_type']) && $_GET['period_type']==3?' checked':'' ?> />
						<label class="form-check-label" for="period_type_3"><?= $_GET['MENU']=='Job'?'Open Until Filled':'Any Time' ?></label>
					</li>
					<script defer>
						$('#Sidebar input[type="radio"][name="period_type"]').on('change', function() {
							if ($('#Sidebar input[type="radio"][name="period_type"]:checked').val() == '1')
								$('#Sidebar .form-inline').addClass('d-inline-flex').removeClass('d-none').find('input').prop('disabled', false);
							else $('#Sidebar .form-inline').addClass('d-none').removeClass('d-inline-flex').find('input').prop('disabled', true);
						});
						$('#period_from').on('change', function() {
							if ($('#period_from').val()) {
								$('#period_to').datepicker('option', 'minDate', $('#period_from').val());
							}
						});
					</script>
				</ul>

				<div class="text-center">
<?php if($_GET['MENU']=='JobAlert'){ ?>
					<button type="submit" class="btn btn-primary" name="action" value="jobalert" disabled>SET JOB ALERT</button>
<?php if(isset($jobalert)){ ?>
					<button type="submit" class="btn btn-light border-secondary" name="action" value="delete" disabled>CLEAR</button>
<?php } ?>
<?php }else{ ?>
					<button type="submit" class="btn btn-primary">SEARCH</button>
<?php } ?>
				</div>

				<script defer>
					$.fn.sidebarBadgeUpdate = function() {
						$(this).data('selected', $(this).find('input[type="checkbox"]:checked').length);
						if ($(this).data('selected') > 0) {
							$(this).prev('label[data-toggle="collapse"]').find('.badge').html($(this).data('selected'));
						} else {
							$(this).prev('label[data-toggle="collapse"]').find('.badge').empty();
						}
						return this;
					};
					$(function() {
						$('#Sidebar ul.collapse').each(function() {
							$(this).sidebarBadgeUpdate();
						});
						if ($('input[type="checkbox"][name="location_country[]"][value="KR"]').prop('checked')) {
							$('label[data-toggle="collapse"][data-target="#Sidebar-location"]').collapse('show');
						}
					});
					$('#Sidebar input[type="checkbox"]').on('change', function() {
						$(this).parents('ul.collapse').sidebarBadgeUpdate();
					});
					$('label[data-toggle="collapse"][data-target^="#Sidebar-"]').on('click', function() {
						$($(this).data('target')).siblings('ul.collapse.show').collapse('hide');
					});
					$('input[type="checkbox"][name="location_country[]"]').on('change', function() {
						if ($('input[type="checkbox"][name="location_country[]"][value="KR"]').prop('checked')) {
							$('label[data-toggle="collapse"][data-target="#Sidebar-location"]').collapse('show');
							$('label[data-toggle="collapse"][data-target="#Sidebar-city"]').collapse('hide');
							$('input[type="checkbox"][name="location_city[]"]').prop('checked', false);
							$('#Sidebar-city').sidebarBadgeUpdate();
						} else if ($('input[type="checkbox"][name="location_country[]"]:checked').length > 0) {
							$('label[data-toggle="collapse"][data-target="#Sidebar-city"]').collapse('show');
							$('label[data-toggle="collapse"][data-target="#Sidebar-location"]').collapse('hide');
							$('input[type="checkbox"][name="location_parent[]"]').prop('checked', false);
							$('#Sidebar-location').sidebarBadgeUpdate();
							$('input[name="location_city[]"]').each(function() {
								if ($('input[name="location_country[]"][value="' + $(this).data('parentValue') + '"]').prop('checked')) {
									$(this).parent('.list-group-item').show();
								} else {
									$(this).prop('checked', false).parent('.list-group-item').hide();
								}
							});
						} else {
							$('label[data-toggle="collapse"][data-target="#Sidebar-city"]').collapse('hide');
							$('input[type="checkbox"][name="location_city[]"]').prop('checked', false);
							$('#Sidebar-city').sidebarBadgeUpdate();
							$('label[data-toggle="collapse"][data-target="#Sidebar-location"]').collapse('hide');
							$('input[type="checkbox"][name="location_parent[]"]').prop('checked', false);
							$('#Sidebar-location').sidebarBadgeUpdate();
						}
					});
				</script>

			</form>
			<!-- /form#Sidebar -->
