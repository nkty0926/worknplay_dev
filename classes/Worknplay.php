<?php

/**
 * Worknplay
 */
class Worknplay {

	/* Web Properties */
	private $startTime = null;
	private $mobileUser = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->startTime = $this->getCurrentTime();

		$this->mobileUser = false;
		foreach (array(
			"iPhone",
			"iPod",
			"Android",
			"Blackberry",
			"Opera Mini",
			"Windows ce",
			"Nokia",
			"sony"
		) as $mobileAgent) {
			if (strpos($_SERVER['HTTP_USER_AGENT'], $mobileAgent) !== false) {
				$this->mobileUser = true;
			}
		}

		// $_SESSION
		session_start();
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' || $_SERVER['REQUEST_SCHEME'] == 'https')
			header('Set-Cookie: PHPSESSID='.$_COOKIE['PHPSESSID'].'; path=/; httpOnly; SameSite=None; Secure');
		if (!isset($_SESSION['ID']))
			$_SESSION['ID'] = null;
		if (!isset($_SESSION['EMAIL']))
			$_SESSION['EMAIL'] = null;
		if (!isset($_SESSION['ADMIN']))
			$_SESSION['ADMIN'] = null;
		if (!isset($_SESSION['RECRUITER']))
			$_SESSION['RECRUITER'] = null;
		if (!isset($_SESSION['EMPLOYER']))
			$_SESSION['EMPLOYER'] = null;
		if (!isset($_SESSION['EMPLOYER_TEFL']))
			$_SESSION['EMPLOYER_TEFL'] = null;
		if (!isset($_SESSION['SEEKER']))
			$_SESSION['SEEKER'] = null;
		if (!isset($_SESSION['CURRENT_COMPANY']))
			$_SESSION['CURRENT_COMPANY'] = null;
		if (!isset($_SESSION['CURRENT_COMPANY_NAME']))
			$_SESSION['CURRENT_COMPANY_NAME'] = null;
		if (isset($_GET['MAIN']) && !empty($_GET['MAIN']) && $_GET['MAIN'] != 'ADMIN' && $_GET['MAIN'] != 'actions')
			$_SESSION['PREV_URL'] = $_SERVER['REQUEST_URI'];
		else if (!isset($_SESSION['PREV_URL']))
			$_SESSION['PREV_URL'] = '/';
		if (!isset($_SESSION['PROD_MODE']))
			$_SESSION['PROD_MODE'] = $_SERVER['HTTP_HOST'] == 'theworknplay.com' || $_SERVER['HTTP_HOST'] == 'dev.theworknplay.com';
		if (!isset($_SESSION['TEST_MODE']))
			$_SESSION['TEST_MODE'] = !$_SESSION['PROD_MODE'];
		if (!isset($_SESSION['DEBUG_MODE']))
			$_SESSION['DEBUG_MODE'] = strpos($_SERVER['HTTP_HOST'], 'localhost') !== false;
		// if (!isset($_SESSION['EXCHANGE_USD']))
		// $_SESSION['EXCHANGE_USD'] = $this->getExchangeUsd();
	}

	/**
	 * is the User Agent Mobile ?
	 *
	 * @return boolean
	 */
	public function isMobileUser() {
		return $this->mobileUser;
	}

	/* ***************************************************************************************** */
	/* ***************************************** Filter **************************************** */
	/* ***************************************************************************************** */

	/**
	 * XSS Filter
	 *
	 * @param mixed $article
	 * @return mixed $article
	 */
	public function xssFilter($article) {
		foreach ($article as $key => $val) {
			$article[$key] = str_replace('\'', '&apos;', $article[$key]);
			$article[$key] = str_replace('"', '&quot;', $article[$key]);
			$article[$key] = str_replace('<', '&lt;', $article[$key]);
			$article[$key] = str_replace('>', '&gt;', $article[$key]);
			$article[$key] = str_replace('&', '&amp;', $article[$key]);
		}
		return $article;
	}

	/**
	 * String Filter
	 *
	 * @param string $str
	 * @return string $str
	 */
	public function stringFilter($str = null) {
		if (isset($str) && !empty($str)) {
			$str = preg_replace('/<style((\s|\t|\r|\n|.)*?)<\/style>/', '', preg_replace('/<script((\s|\t|\r|\n|.)*?)<\/script>/', '', $str));
			return trim(preg_replace('/([\s]{2,})/', ' ', preg_replace('/\r\n\t/', ' ', str_replace('&nbsp;', ' ', strip_tags($str)))));
		} else {
			return '';
		}
	}

	/* ***************************************************************************************** */
	/* ***************************************** Getter **************************************** */
	/* ***************************************************************************************** */

	/**
	 * Get Current Time
	 *
	 * @return number
	 */
	public function getCurrentTime() {
		list ($usec, $sec) = explode(" ", microtime());
		return floor(($sec + $usec) * 1000);
	}

	/**
	 * Get Excution Time
	 *
	 * @return string $excutionTime
	 */
	public function getExcutionTime() {
		return 'Execution Time: ' . number_format($this->getCurrentTime() - $this->startTime, 4) . 's';
	}

	/**
	 * Get Current Host
	 *
	 * @return string $currentHost
	 */
	public function getCurrentHost() {
		return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
	}

	/**
	 * Get Current Url
	 *
	 * @return string $currentUrl
	 */
	public function getCurrentUrl() {
		return $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	}

	/**
	 * Get Exchange Usd
	 *
	 * @return mixed $exchangeUsd
	 */
	public function getExchangeUsd() {
		$koreaexim = json_decode(file_get_contents("https://www.koreaexim.go.kr/site/program/financial/exchangeJSON?authkey=9EPK7Dqa1AYH10fAZIRNOOu1VItFrh3U&data=AP01"));
		foreach ($koreaexim as $exchange) {
			if ($exchange->cur_unit == 'USD') {
				return $exchange->deal_bas_r;
			}
		}
	}

	/**
	 * Get Html Head
	 *
	 * @param mixed $rs
	 * @return string[] $htmlHead
	 */
	public function getHtmlHead() {
		global $PAGE;
		global $rs;
		$htmlHead = array(
			'title' => '',
			'description' => '',
			'keywords' => '',
			'image' => ''
		);

		// title
		if (isset($rs['name'])) {
			$htmlHead['title'] = htmlspecialchars(trim($rs['name']));
			if (isset($rs['name_kor']) && !empty($rs['name_kor'])) {
				$htmlHead['title'] .= ' (' . htmlspecialchars(trim($rs['name_kor'])) . ')';
			}
		} else if (isset($rs['title'])) {
			$htmlHead['title'] = htmlspecialchars(trim($rs['title']));
		}
		if ($htmlHead['title']) {
			$htmlHead['title'] .= ' | ';
		}
		if (isset($PAGE['title']) && !empty($PAGE['title'])) {
			$htmlHead['title'] .= $PAGE['title'];
		} else if ($_GET['PAGE']) {
			$htmlHead['title'] .= $_GET['MAIN'] . ' - ';
			if (!$_GET['MENU']) {
				$htmlHead['title'] .= preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['PAGE']);
			} else if (in_array($_GET['PAGE'], array(
				'Search',
				'Detail'
			))) {
				$htmlHead['title'] .= preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['MENU']) . ' ' . preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['PAGE']);
			} else if (in_array($_GET['PAGE'], array(
				'Edit'
			))) {
				$htmlHead['title'] .= preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['PAGE']) . ' ' . preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['MENU']);
			} else {
				$htmlHead['title'] .= preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['PAGE']) . ' - ' . preg_replace('/([a-z])([A-Z])/', '$1 $2', $_GET['MENU']);
			}
		}
		if ($htmlHead['title']) {
			$htmlHead['title'] .= ' : ';
		}
		$htmlHead['title'] .= 'TheWorknPlay';

		// description
		if (isset($rs['desc'])) {
			$htmlHead['description'] = trim(preg_replace('/\n/', ' ', strip_tags($rs['desc'])));
			if (strlen($htmlHead['description']) > 200) {
				$htmlHead['description'] = substr($htmlHead['description'], 0, 197) . '...';
			}
		} else if (isset($PAGE['description']) && !empty($PAGE['description'])) {
			$htmlHead['description'] = $PAGE['description'];
		}

		// keywords
		if (isset($rs['hashtag'])) {
			foreach (explode('#', $rs['hashtag']) as $hashtag) {
				if (htmlspecialchars(trim($hashtag))) {
					$htmlHead['keywords'] .= ',' . htmlspecialchars(trim($hashtag));
				}
			}
		}
		if (isset($rs['keyword'])) {
			foreach (explode(';', $rs['keyword']) as $keyword) {
				if (htmlspecialchars(trim($keyword))) {
					$htmlHead['keywords'] .= ',' . htmlspecialchars(trim($keyword));
				}
			}
		}
		if (isset($rs['keywords'])) {
			foreach (explode(',', $rs['keywords']) as $keyword) {
				if (htmlspecialchars(trim($keyword))) {
					$htmlHead['keywords'] .= ',' . htmlspecialchars(trim($keyword));
				}
			}
		}
		if (isset($rs['keywords_travel'])) {
			foreach (explode('§', $rs['keywords_travel']) as $keywords_travel) {
				if (htmlspecialchars(trim(explode('¶', $keywords_travel)[1]))) {
					$htmlHead['keywords'] .= ',' . htmlspecialchars(trim(explode('¶', $keywords_travel)[1]));
				}
			}
		}
		if (isset($PAGE['keywords']) && !empty($PAGE['keywords'])) {
			foreach (explode(',', $PAGE['keywords']) as $keyword) {
				if (htmlspecialchars(trim($keyword))) {
					$htmlHead['keywords'] .= ',' . htmlspecialchars(trim($keyword));
				}
			}
		}
		$htmlHead['keywords'] = substr($htmlHead['keywords'], 1);

		// image
		if (isset($rs['header_img'])) {
			$htmlHead['image'] = htmlspecialchars(trim($rs['header_img']));
		} else if (isset($rs['logo_img'])) {
			$htmlHead['image'] = htmlspecialchars(trim($rs['logo_img']));
		} else {
			$htmlHead['image'] = '/images/wnp-logo.png';
		}

		return $htmlHead;
	}

	/* ***************************************************************************************** */
	/* ***************************************** Print ***************************************** */
	/* ***************************************************************************************** */

	/**
	 * Print Excution Time
	 */
	public function printExcutionTime() {
		echo "<script>console.log('" . $this->getExcutionTime() . "');</script>";
	}

	/**
	 * Print Status
	 *
	 * @param mixed $message
	 */
	public function printStatus($message = null) {
		if ($_SESSION['DEBUG_MODE']) {
			echo '<div class="row" style="margin:0;">';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_POST:</label>';
			print_r($_POST);
			echo '</pre>';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_GET:</label>';
			print_r($_GET);
			echo '</pre>';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_FILES:</label>';
			print_r($_FILES);
			echo '</pre>';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_SESSION:</label>';
			print_r($_SESSION);
			echo '</pre>';
			if ($message) {
				echo '<pre class="col-12" style="margin:0;">';
				print_r($message);
				echo '</pre>';
			}
			echo '</div>';
		}
	}

	/**
	 * Print beforeShowDay
	 *
	 * @param array $dates
	 */
	public function printBeforeShowDay($dates) {
		if (isset($dates) && !empty($dates)) {
			echo ', beforeShowDay: function(date){ return [ $.inArray($.datepicker.formatDate(\'yy-mm-dd\', date), [ ';
			foreach ($dates as $i => $date) {
				echo '\'' . trim($date) . '\'';
				if ($i != count($dates) - 1)
					echo ', ';
			}
			echo ' ])!=-1 ]; } ';
		}
	}

	/**
	 * Print Job Type
	 *
	 * @param mixed $rs
	 */
	public function printJobType($rs) {
		global $DB;
		if (isset($rs['job_type']) && !empty($rs['job_type'])) {
			foreach (explode(',', $rs['job_type']) as $type) {
				$type = $DB->selectCode('work_job_type', $type);
				if (isset($type['name']) && !empty($type['name'])) {
					echo '<span class="comma-after">' . $type['name'] . '</span>';
				}
			}
		} else {
			echo 'All';
		}
	}

	/**
	 * Print Job Category
	 *
	 * @param mixed $rs
	 */
	public function printJobCategory($rs) {
		if (isset($rs['job_category_parent_name']) && !empty($rs['job_category_parent_name'])) {
			if (isset($rs['job_category_child_name']) && !empty($rs['job_category_child_name'])) {
				return $rs['job_category_parent_name'] . ' > ' . $rs['job_category_child_name'];
			} else {
				return $rs['job_category_parent_name'];
			}
		}
	}

	/**
	 * Print Training Type
	 *
	 * @param mixed $rs
	 */
	public function printTrainingType($rs) {
		global $DB;
		if (isset($rs['course_type']) && !empty($rs['course_type'])) {
			foreach (explode(',', $rs['course_type']) as $type) {
				$type = $DB->selectCode('tefl_course_type', $type);
				if (isset($type['name']) && !empty($type['name'])) {
					echo '<span class="comma-after">' . $type['name'] . '</span>';
				}
			}
		}
	}

	/**
	 * Print Location
	 *
	 * @param mixed $rs
	 */
	public function printLocation($rs, $prifix = '') {
		if (isset($rs[$prifix . 'location_country']) && !empty($rs[$prifix . 'location_country']) && $rs[$prifix . 'location_country'] != 'KR') {
			if (isset($rs[$prifix . 'location_city']) && !empty($rs[$prifix . 'location_city'])) {
				return $rs[$prifix . 'location_country_name'] . ' > ' . $rs[$prifix . 'location_city'];
			} else {
				return $rs[$prifix . 'location_country_name'];
			}
		} else if (isset($rs[$prifix . 'location_country']) && !empty($rs[$prifix . 'location_country']) && $rs[$prifix . 'location_country'] == 'KR') {
			if (isset($rs[$prifix . 'location_child_name']) && !empty($rs[$prifix . 'location_child_name'])) {
				return $rs[$prifix . 'location_country_name'] . ' > ' . $rs[$prifix . 'location_parent_name'] . ' > ' . $rs[$prifix . 'location_child_name'];
			} else if (isset($rs[$prifix . 'location_parent_name']) && !empty($rs[$prifix . 'location_parent_name'])) {
				return $rs[$prifix . 'location_country_name'] . ' > ' . $rs[$prifix . 'location_parent_name'];
			} else {
				return $rs[$prifix . 'location_country_name'];
			}
		} else if (isset($rs[$prifix . 'location_parent_name']) && !empty($rs[$prifix . 'location_parent_name'])) {
			if (isset($rs[$prifix . 'location_child_name']) && !empty($rs[$prifix . 'location_child_name'])) {
				return $rs[$prifix . 'location_parent_name'] . ' > ' . $rs[$prifix . 'location_child_name'];
			} else {
				return $rs[$prifix . 'location_parent_name'];
			}
		} else if (isset($rs[$prifix . 'location_country_name']) && !empty($rs[$prifix . 'location_country_name'])) {
			return $rs[$prifix . 'location_country_name'];
		} else {
			return 'All Area';
		}
	}

	/**
	 * Print Nationality
	 *
	 * @param mixed $rs
	 */
	public function printNationality($rs) {
		global $DB;
		if (isset($rs['personal_nationality']) && !empty($rs['personal_nationality'])) {
			foreach (explode(',', $rs['personal_nationality']) as $type) {
				$type = $DB->selectCode('personal_nationality', $type);
				if (isset($type['name']) && !empty($type['name'])) {
					echo '<span class="comma-after">' . $type['name'] . '</span>';
				}
			}
		}
	}

	/**
	 * Print Urls
	 *
	 * @param mixed $rs
	 */
	public function printUrls($rs) {
		if (isset($rs['contact_urls']) && !empty($rs['contact_urls'])) {
			foreach (explode(',', $rs['contact_urls']) as $url) {
				$url_type = explode(';', $url)[0];
				$url_href = explode(';', $url)[1];
				echo '<a class="d-print-none" href="' . $url_href . '" title="' . $url_href . '" target="_blank" style="display:inline-block;width:1.25rem;height:1.25rem;margin-right:.25rem;background:url(/assets/icons/urls/' . strtolower($url_type) . '.png) center/contain no-repeat;"></a>';
			}
		}
	}

	/**
	 * Print Gender
	 *
	 * @param mixed $rs
	 */
	public function printGender($rs) {
		$personal_marital = '';
		if (isset($rs['personal_marital']) && !empty($rs['personal_marital'])) {
			if ($rs['personal_marital'] == 1) {
				$personal_marital = " (Single)";
			} else if ($rs['personal_marital'] == 2) {
				$personal_marital = " (Married)";
			} else if ($rs['personal_marital'] == 3) {
				$personal_marital = " (Couple)";
			}
		}
		if (isset($rs['personal_gender']) && !empty($rs['personal_gender'])) {
			if ($rs['personal_gender'] == 1) {
				return "Male" . $personal_marital;
			} else if ($rs['personal_gender'] == 2) {
				return "Female" . $personal_marital;
			} else {
				return "Other";
			}
		} else {
			return "Other";
		}
	}

	/**
	 * Print Period
	 *
	 * @param mixed $rs
	 */
	public function printPeriod($rs) {
		global $CONF;
		if (isset($rs['period']) && !empty($rs['period'])) {
			if (strlen($rs['period']) > 1) {
				if (strpos($rs['period'], ' ~ ')) {
					if ($_GET['MENU'] != 'Resume' && $_GET['MENU'] != 'Event') {
						return 'Start Date : <time>' . date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0])) . '</time> <br class="d-lg-none" /><span class="d-none d-lg-inline">/</span> Deadline : <time>' . date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[1])) . '</time>';
					} else {
						return date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0])) . ' ~ ' . date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[1]));
					}
				} else {
					if ($_GET['MENU'] != 'Resume' && $_GET['MENU'] != 'Event') {
						return 'Start Date : <time>' . date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0])) . '</time>';
					} else {
						return date($CONF['date_format'], strtotime(explode(' ~ ', $rs['period'])[0]));
					}
				}
			} else if ($rs['period'] == 2) {
				return 'ASAP';
			} else if ($rs['period'] == 3) {
				if ($_GET['MENU'] == 'Job' || strpos($_GET['PAGE'], 'Job') !== false) {
					return 'Open Until Filled';
				} else {
					return 'Any Time';
				}
			}
		} else {
			return 'Any Time';
		}
	}

	/**
	 * Print Attachments
	 *
	 * @param mixed $rs
	 */
	public function printAttachments($rs) {
		if (isset($rs['attachment']) && !empty($rs['attachment'])) {
			foreach (explode('|', $rs['attachment']) as $attachment) {
				if (trim($attachment)) {
					$attachment_path = substr($attachment, 0, strpos($attachment, ':'));
					$attachment_name = substr($attachment, strpos($attachment, ':') + 1);
					if ($attachment_name && $attachment_path) {
						echo '<a class="text-dark comma-after" title="' . $attachment_name . '" data-toggle="download" data-path="' . $attachment_path . '">' . $attachment_name . '</a>';
					}
				}
			}
		}
	}

	/**
	 * Print Attachments
	 *
	 * @param mixed $rs
	 */
	public function printAttachmentsAsCard($rs) {
		if (isset($rs['attachment']) && !empty($rs['attachment'])) {
?>
								<div class="form-row mb-n2">
<?php
			if ($_SESSION['DEBUG_MODE']) {
				$real_path = 'D:/workspace/_uploads/';
			} else {
				$real_path = '/data/worknplay/uploads/';
			}
			foreach (explode('|', $rs['attachment']) as $attachment) {
				if (trim($attachment)) {
					$attachment_path = substr($attachment, 0, strpos($attachment, ':'));
					$attachment_name = substr($attachment, strpos($attachment, ':') + 1);
					if (!empty($attachment_name) && !empty($attachment_path)) {
						$attachment_ext = strtoupper(array_pop(explode('.', $attachment_name)));
						$attachment_real = $real_path . str_replace('/uploads/', '', $attachment_path);
						$attachment_size = filesize($real_path . str_replace('/uploads/', '', $attachment_path));
						if ($attachment_size > 1024) {
							$attachment_size = round($attachment_size / 1024, 1);
							if ($attachment_size > 1024) {
								$attachment_size = round($attachment_size / 1024, 1);
								$attachment_size .= "MB";
							} else {
								$attachment_size .= "KB";
							}
						}
?>
									<div class="col-lg-6 mb-2">
										<div class="card bg-light">
											<div class="card-body p-2">
												<a href="javascript:void(0);" title="<?= $attachment_name ?>" data-toggle="download" data-path="<?= $attachment_path ?>">
													<i class="far fa-file fa-fw"></i>
													<span class="mr-2"><?= $attachment_name ?></span>
													<span class="text-dark float-right"><?= $attachment_ext ?>, <?= $attachment_size ?></span>
												</a>
											</div>
										</div>
									</div>
<?php
					}
				}
			}
?>
								</div>
<?php
		}
	}
}
