<?php

require_once '../classes/Worknplay.php';
$WP = new Worknplay();
$PAGE['title'] = str_replace('.php', '', str_replace('/design/', '', $_SERVER['PHP_SELF']));
$CONF['email_hr'] = 'worknplayhr@gmail.com';
include_once '../pages/common/header.php';
include_once '../pages/3000_Work/3000_Work_header.php';

?>
    <link rel="stylesheet" type="text/css" href="/assets/css/worknplay.design.css?date=<?= date('ymdHis', strtotime('now+9hours')) ?>" />

	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-light">
    <div class="container text-center">

<div class="row justify-content-center mb-4 mb-md-5">
    <div class="col-md-9">
        <div class="row justify-content-center mb-3">
            <div class="col-md-10">
        <h3 class="mb-0">How to Post a Great Job</h3>
            </div>
        </div>
        <p class="mb-0">Some job seekers directly look for jobs themselves. While others get recommendations from recruiters. Writing a well-informed and eye-catching job post can eliminate uncertainities about the job.</p>
    </div>
</div>


			<!-- .row -->
			<div class="row mb-n4">
				<div class="col">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
							<h4><strong>Good Job Post</strong></h4>
							<h5>Specific Job Title</h5>
                            <p>Clear understanding of the position</p>
                            <br>

                            <h5>Informative Description</h5>
                            <p>Know what is expected from the job</p>
                            <br>

                            <h5>Organized Layout</h5>
                            <p>Neat and easy to read</p>
                            <br>
						</div>
					</article>
				</div>
				<div class="col">
					<article class="card bg-white h-100 mb-0">
						<div class="card-body p-3 p-md-4">
                        <h4><strong>Bad Job Post</strong></h4>
							<h5>Long Job Title</h5>
                            <p>Clueless About Description</p>
                            <br>

                            <h5>Lack of Information</h5>
                            <p>Unclear what the position entails</p>
                            <br>

                            <h5>Inconsistent Information</h5>
                            <p>Changes not addressed on the post</p>
                            <br>

                            <h5>Use of Symbols and Different Fonts</h5>
                            <p>Distracting and not visually appealing</p>
                            <br>
						</div>
					</article>
				</div>
			</div>
	</section>
	<!-- /section -->
    <section>
    <div class="container text-center">

    <h3 class="mb-4">Content</h3>

<!-- .row -->
<div class="row mb-n4">
    <div class="col">
        <article class="card bg-white h-100 mb-0">
            <div class="card-body p-3 p-md-4">
                <h4>1. Job Post Template</h4>
            </div>
        </article>
    </div>
    <div class="col">
        <article class="card bg-white h-100 mb-0">
            <div class="card-body p-3 p-md-4">
                <h4>2. Job Description</h4>
            </div>
        </article>
    </div>
</div>
</div>
</div>
</section>
<!-- /section -->

<!-- .row -->
	<!-- section -->
	<section class="py-4 py-md-5 px-1 bg-white">
		<div class="container text-left">

			<h3 class="text-center mb-4 mb-md-5">How To Use The Template</h3>
						<ol>
							<li><strong>Job Title</strong></li>
                            <p>Create a title that clearly identifies what the job entails</p>
							<li><strong>Job Type, Education Level, Career Level</strong></li>
                            <p>Select from the option what kind of position is being offered, level of education is required, and level of experience needed</p>
                            <li><strong>Industry</strong></li>
                            <p>Select which field and specialty this position is in from the options</p>
                            <li><strong>Keywords</strong></li>
                            <p>Select words relating to the job from the given option or enter your own keywords to use to search for this job post. Add up to 10 keywords.</p>
						</ol>
    <br>
    <br>
    <br>
</section>
</div>
                
	
<?php include_once '../pages/common/footer.php'; ?>