			<!-- acticle.card -->
			<article class="card<?= $rs['brand']?'':' sticky-top' ?>" style="<?= $rs['brand']?'':'top:5rem;z-index:999;' ?>">
				<div class="card-header">
					<h5 class="text-center mb-0"><?= $rs['name'] ?><?php if(isset($rs['name_kor']) && !empty($rs['name_kor'])){ ?><div class="mt-1"><?= $rs['name_kor'] ?></div><?php } ?></h5>
				</div>
				<div class="card-body">
<?php if(empty($articles) || $expired){ ?>
					<p>이 회사에 관심이 있으십니까? 워크앤플레이 매치업 서비스를 이용하시면 더 좋은 결과를...</p>
					<a class="d-inline-block" href="/design/CompanyBrand">Show Matchup Service »</a>
					<a class="btn btn-primary d-inline-block mt-2" href="/design/JobFinder">Apply</a>
<?php }else if(!$rs['contact_private']){ ?>
					<h6>Contact Information</h6>
<?php if(isset($rs['contact_phone1']) && !empty($rs['contact_phone1'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Primary Phone Number:" title="Primary Phone Number" width="16" height="16" /> <?= $rs['contact_phone1'] ?></p>
<?php } if(isset($rs['contact_phone2']) && !empty($rs['contact_phone2'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/phone.png" alt="Secondary Phone Number:" title="Secondary Phone Number" width="16" height="16" /> <?= $rs['contact_phone2'] ?></p>
<?php } if(isset($rs['contact_email']) && !empty($rs['contact_email'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/mail.png" alt="Email:" title="Email" width="16" height="16" /> <?= $rs['contact_email'] ?></p>
<?php } if(isset($rs['contact_person']) && !empty($rs['contact_person'])){ ?>
					<p class="mb-0"><img src="/assets/icons/contact/person.png" alt="Contact Person:" title="Contact Person" width="16" height="16" /> <?= $rs['contact_person'] ?></p>
<?php } if(isset($rs['contact_messengers']) && !empty($rs['contact_messengers'])){ ?>
					<div class="mb-0 mt-1">
						<span>Messengers:</span>
<?php foreach(explode(',', $rs['contact_messengers']) as $contact_messenger){ $messenger = explode(';', $contact_messenger); ?>
						<p class="mb-0"><img src="/assets/icons/messengers/<?= strtolower($messenger[0]) ?>.png" alt="<?= $messenger[0] ?>:" title="<?= $messenger[0] ?>" width="16" height="16" /> <?= $messenger[1] ?></p>
<?php } ?>
					</div>
<?php }}else if($_SESSION['ID']){ ?>
					<form class="needs-validation d-print-none" id="formMessage">
						<div class="form-group">
							<input type="text" class="form-control" name="title" placeholder="Title*" maxlength="255" required />
						</div>
						<div class="form-group">
							<textarea class="form-control" name="content" rows="5" placeholder="Message*" required></textarea>
						</div>
						<p>If you have questions to company, please send me a message</p>
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
<?php }else{ ?>
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
<?php } ?>
				</div>
			</article>
			<!-- /acticle.card -->
