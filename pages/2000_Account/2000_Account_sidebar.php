			<!-- nav.sidebar -->
			<nav class="sidebar card bg-light shadow mb-5">
				<div class="card-body px-3 py-2">
<?php if ($_SESSION['EMPLOYER']) {
	if ($_SESSION['CURRENT_COMPANY']) {
		$employer = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
	}
?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['PAGE']=='Employer' && $_GET['MENU']=='Home' ? 'primary' : 'dark' ?> text-decoration-none" href="/Work/Employer/Home">Dashboard</a>
					</h5>
<?php } ?>
<?php if ($_SESSION['SEEKER']) { ?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['MAIN']=='Work' ? 'primary' : 'dark' ?> text-decoration-none<?= $_GET['MAIN']=='Work' && !$WP->isMobileUser()?'':' collapsed' ?>" href="#listSeeker" data-toggle="collapse">Resume<i class="fa fa-chevron-<?= $_GET['MAIN']=='Work' && !$WP->isMobileUser()?'up':'down' ?> fa-fw float-right"></i></a>
					</h5>
					<div class="list-group collapse<?= $_GET['MAIN']=='Work' && !$WP->isMobileUser()?' show':'' ?>" id="listSeeker">
						<a class="list-group-item<?= $_GET['MENU']=='ManageResumes'?' active':'' ?>" href="/Work/Seeker/ManageResumes">My Resumes</a>
						<a class="list-group-item" href="/Work/Edit/ResumeProfile">My Profile</a>
						<a class="list-group-item<?= in_array($_GET['MENU'], array('ManageApplications', 'SavedJobs', 'EmployerViews'))?' active':'' ?>" href="/Work/Seeker/ManageApplications">My Jobs</a>
						<a class="list-group-item<?= $_GET['MENU']=='BoostMyResume'?' active':'' ?>" href="/Work/Seeker/BoostMyResume">Boost My Resume</a>
						<a class="list-group-item<?= $_GET['MENU']=='MessageBox'?' active':'' ?>" href="/Work/Seeker/MessageBox">Message Box</a>
						<a class="list-group-item<?= $_GET['MENU']=='JobAlert'?' active':'' ?> disabled" href="/Work/Seeker/JobAlert">Job Alert</a>
					</div>
<?php } else if ($_SESSION['EMPLOYER']) {
	if ($_SESSION['CURRENT_COMPANY']) {
		$employer = $DB->selectWorkCompany($_SESSION['CURRENT_COMPANY']);
	}
?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['MAIN']=='Work' && $_GET['MENU']!='Home' ? 'primary' : 'dark' ?> text-decoration-none<?= $_GET['MAIN']=='Work' && $_GET['MENU']!='Home' && !$WP->isMobileUser()?'':' collapsed' ?>" href="#listEmployer" data-toggle="collapse">Work<i class="fa fa-chevron-<?= $_GET['MAIN']=='Work' && $_GET['MENU']!='Home' && !$WP->isMobileUser()?'up':'down' ?> fa-fw float-right"></i></a>
					</h5>
					<div class="list-group collapse<?= $_GET['MAIN']=='Work' && $_GET['MENU']!='Home' && !$WP->isMobileUser()?' show':'' ?>" id="listEmployer">
						<a class="list-group-item<?= $_GET['MENU']=='ManageProfiles'?' active':'' ?><?= $employer['no'] && $employer['publ']?'':' disabled' ?>" href="/Work/Employer/ManageProfiles">Company Profile</a>
						<a class="list-group-item<?= $_GET['MENU']=='PostAJob'?' active':'' ?><?= $employer['no'] && $employer['publ']?'':' disabled' ?>" href="/Work/Employer/PostAJob">Post a Job</a>
						<a class="list-group-item<?= $_GET['MENU']=='OrderHistory'?' active':'' ?>" href="/Work/Employer/OrderHistory">My Purchase</a>
						<a class="list-group-item<?= $_GET['MENU']=='ManageJobs' || $_GET['MENU']=='Job'?' active':'' ?>" href="/Work/Employer/ManageJobs">Manage Jobs</a>
						<a class="list-group-item<?= $_GET['MENU']=='CandidateList'?' active':'' ?>" href="/Work/Employer/CandidateList">Candidate List</a>
						<a class="list-group-item" href="/Work/Search/Resume" target="_blank">Search For Resume <i class="fas fa-fw fa-external-link-alt small"></i></a>
						<a class="list-group-item<?= $_GET['MENU']=='SavedResumes'?' active':'' ?><?= $USER['work_credit_res_day'] || $_SESSION['RECRUITER'] || ($employer['no'] && $employer['publ'])?'':' disabled' ?>" href="/Work/Employer/SavedResumes">Saved Resumes</a>
						<a class="list-group-item<?= $_GET['MENU']=='MessageBox'?' active':'' ?>" href="/Work/Employer/MessageBox">Message Box</a>
						<!-- <a class="list-group-item<?= $employer['no'] && $employer['publ']?'':' disabled' ?>" href="/Work/<?= $employer['domain']?$employer['domain']:'Detail/Company/' . $employer['no'] ?>/Events" target="_blank">News &amp; Events <i class="fas fa-fw fa-external-link-alt small"></i></a> -->
						<a class="list-group-item" href="/Work/Employer/Intro" target="_blank">Products <i class="fas fa-fw fa-external-link-alt small"></i></a>
					</div>
<?php } else { ?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['MAIN']=='Work' ? 'primary' : 'dark' ?> text-decoration-none" href="#listWork" data-toggle="collapse">Work<i class="fa fa-chevron-up fa-fw float-right"></i></a>
					</h5>
					<div class="list-group collapse show" id="listWork">
						<a class="list-group-item" href="/Work/Search/Job">Find Jobs</a>
						<a class="list-group-item" href="/Work/Search/Company">Companies</a>
						<a class="list-group-item" href="/Work/Search/Resume">Search Resumes</a>
						<a class="list-group-item" href="/Work/Seeker">Create Resume</a>
						<a class="list-group-item" href="/Work/Employer">EMPLOYER - Post a Job</a>
					</div>
<?php } ?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['MAIN']=='Blogs' ? 'primary' : 'dark' ?> text-decoration-none<?= $_GET['MAIN']=='Blogs' && !$WP->isMobileUser()?'':' collapsed' ?>" href="#listBlogs" data-toggle="collapse">Blogs<i class="fa fa-chevron-<?= $_GET['MAIN']=='Blogs' && !$WP->isMobileUser()?'up':'down' ?> fa-fw float-right"></i></a>
					</h5>
					<div class="list-group collapse<?= $_GET['MAIN']=='Blogs' && !$WP->isMobileUser()?' show':'' ?>" id="listBlogs">
						<a class="list-group-item<?= $_GET['PAGE']=='MyPage'?' active':'' ?>" href="<?= $USER['story_profile_nickname']?'/Blogs/MyPage':'/Blogs/Edit/Article/_NEW' ?>"><?= $USER['story_profile_nickname']?$USER['story_profile_nickname']:'Post a Blog' ?></a>
<?php if($USER['story_profile_nickname']){ ?>
						<a class="list-group-item" href="/Blogs/Edit/Article/_NEW?category=<?= 'Work_and_Business&company=' . $_SESSION['CURRENT_COMPANY'] ?>#<?= $_SESSION['CURRENT_COMPANY_NAME'] ?>">Post a Blog</a>
						<a class="list-group-item<?= $_GET['PAGE']=='MySeries'?' active':'' ?>" href="/Blogs/MySeries">My Blog Series</a>
						<a class="list-group-item<?= $_GET['PAGE']=='Edit' && $_GET['MENU']=='Profile'?' active':'' ?>" href="/Blogs/Edit/Profile/<?= $USER['story_profile'] ?>">My Blog Profile</a>
<?php } ?>
					</div>
<?php $account = $DB->selectMember(); ?>
					<h5 class="card-header">
						<a class="text-<?= $_GET['MAIN']=='Account' ? 'primary' : 'dark' ?> text-decoration-none<?= $_GET['MAIN']=='Account' && !$WP->isMobileUser()?'':' collapsed' ?>" href="#listAccount" data-toggle="collapse">Account<i class="fa fa-chevron-<?= $_GET['MAIN']=='Account' && !$WP->isMobileUser()?'up':'down' ?> fa-fw float-right"></i></a>
					</h5>
					<div class="list-group collapse<?= $_GET['MAIN']=='Account' && !$WP->isMobileUser()?' show':'' ?>" id="listAccount">
						<a class="list-group-item<?= $_GET['PAGE']=='MyInfo'?' active':'' ?>" href="/Account/MyInfo">Contact Information</a>
<?php if(!$account['type']){ ?>
						<a class="list-group-item<?= $_GET['PAGE']=='ChangePassword'?' active':'' ?>" href="/Account/ChangePassword">Change Password</a>
<?php } ?>
						<a class="list-group-item<?= $_GET['PAGE']=='DeleteAccount'?' active':'' ?>" href="/Account/DeleteAccount">Delete Account</a>
					</div>
				</div>
			</nav>
			<!-- /nav.sidebar -->
