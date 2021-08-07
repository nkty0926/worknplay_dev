<?php

/**
 * Database : theworknplay
 */
class Database {

	/* Database Properties */
	public $conn = null;
	private $host = "localhost";
	private $dbname = "theworknplay";
	private $username = "theworknplay";
	private $password = "dnal82*@";
	private $query = "";
	private $values = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		try {
			$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8;", $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			exit();
		}
	}

	/**
	 * Print Status
	 *
	 * @param array $values
	 * @param mixed $message
	 */
	private function printStatus($values = null, $message = null) {
		if ($_SESSION['DEBUG_MODE']) {
			echo '<div class="row" style="margin:0;">';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>VALUES:</label>';
			print_r($values);
			echo '</pre>';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_POST:</label>';
			print_r($_POST);
			echo '</pre>';
			echo '<pre class="col-3" style="height:300px;margin:0;overflow-y:scroll;"><label>_GET:</label>';
			print_r($_GET);
			echo '</pre>';
			echo '<pre class="col-3" style="height:150px;margin:0;overflow-y:scroll;"><label>_FILES:</label>';
			print_r($_FILES);
			echo '</pre>';
			echo '<pre class="col-3" style="height:150px;margin:0;overflow-y:scroll;"><label>_SESSION:</label>';
			print_r($_SESSION);
			echo '</pre>';
			if ($message) {
				echo '<pre class="col-12" style="margin:0;">';
				print_r($message);
				echo '</pre>';
			}
			if ($this->query) {
				echo '<pre class="col-12" style="margin:0;">';
				print_r($this->query);
				echo '</pre>';
			}
			echo '</div>';
		}
	}

	/* ***************************************************************************************** */
	/* ***************************************** Common **************************************** */
	/* ***************************************************************************************** */

	/**
	 * Select Page
	 *
	 * @param int $pk
	 * @return mixed $rs
	 */
	public function selectPage($pk = null) {
		try {
			if ($pk) {
				$this->query = "select * from common_page_view where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from common_page_view where main = :main and page = :page and menu = :menu and sub = :sub";
				if (isset($_GET['PK']) && !empty($_GET['PK']) && !is_numeric($_GET['PK']) && $_GET['PK'] != '_NEW') {
					$this->query .= " and pk = :pk";
				}
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":main", $_GET['MAIN']);
				$stmt->bindParam(":page", $_GET['PAGE']);
				$stmt->bindParam(":menu", $_GET['MENU']);
				$stmt->bindParam(":sub", $_GET['SUB']);
				if (isset($_GET['PK']) && !empty($_GET['PK']) && !is_numeric($_GET['PK']) && $_GET['PK'] != '_NEW') {
					$stmt->bindParam(":pk", $_GET['PK']);
				}
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Select Ads
	 *
	 * @param int $pk
	 * @param string $fk
	 * @return mixed|array $rs
	 */
	public function selectAds($page = null, $name = null) {
		try {
			if ($page && $name) {
				$this->query = "select * from common_ads where page = :page and name = :name";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":page", $page);
				$stmt->bindParam(":name", $name);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from common_ads order by page asc, name asc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Select Question
	 *
	 * @param int $pk
	 * @param string $fk
	 * @return mixed|array $rs
	 */
	public function selectQuestion($pk = null, $fk = null) {
		try {
			if ($pk) {
				$this->query = "select * from common_question where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($fk) {
				$this->query = "select * from common_question where page = :page";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":page", $fk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from common_question order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Select Code
	 *
	 * @param string $table
	 * @param int $pk
	 * @param string $ak
	 * @return array $rs
	 */
	public function selectCode($table, $pk = null, $ak = null, $parent = null) {
		try {
			if (isset($table) && !empty($table) && in_array($table, array(
				'country',
				'country_city',
				'country_phone',
				'location',
				'location_subw',
				'location_tag',
				'personal_language',
				'personal_nationality',
				'tefl_course_type',
				'work_company_type',
				'work_job_category',
				'work_job_industry',
				'work_job_type'
			))) {
				if ($pk) {
					$this->query = "select * from code_" . $table . " where no = :no";
					$stmt = $this->conn->prepare($this->query);
					$stmt->bindParam(":no", $pk);
					$stmt->execute();
					$rs = $stmt->fetch(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					return $rs;
				} else if ($ak) {
					$this->query = "select * from code_" . $table . " where name = :name";
					$stmt = $this->conn->prepare($this->query);
					$stmt->bindParam(":name", $ak);
					$stmt->execute();
					$rs = $stmt->fetch(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					return $rs;
				} else if ($parent) {
					if ($table == 'work_job_category') {
						$this->query = "select * from code_" . $table . " where parent = :parent order by name";
					} else {
						$this->query = "select * from code_" . $table . " where parent = :parent order by no";
					}
					$stmt = $this->conn->prepare($this->query);
					$stmt->bindParam(":parent", $parent);
					$stmt->execute();
					$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					for ($i = 0; $i < count($rs); $i++) {
						if (!empty($rs[$i]['no']) && isset($rs[$i]['parent'])) {
							$rs[$i]['children'] = $this->selectCode($table, null, null, $rs[$i]['no']);
						}
					}
					return $rs;
				} else {
					global $PAGE;
					if ($table == 'country' && in_array($PAGE['no'], array(
						'0000',
						'3110',
						'3120',
						'3130'
					))) {
						$this->query = "";
						$this->query .= "select location_country, code.no, ifnull(city.country_name, code.name) as name, count(*)";
						$this->query .= "  from work_job";
						$this->query .= "  left join code_country code on work_job.location_country = code.no";
						$this->query .= "  left join code_country_city city on city.country_code = code.no";
						$this->query .= " where location_country != '0' and location_country != '' and location_country is not null";
						$this->query .= "   and work_job.publ = 1 and work_job.appr = 1";
						$this->query .= "   and left(date_add(work_job.date, interval 90 day), 10) > left(now(), 10)";
						$this->query .= " group by location_country";
						$this->query .= " order by count(*) desc";
					} else if ($table == 'personal_language' && in_array($PAGE['no'], array(
						'0000',
						'3120',
						'3130'
					))) {
						$this->query = "";
						$this->query .= "select substring_index(language_others,';',1) as name, count(*)";
						$this->query .= "  from work_job";
						$this->query .= " where language_others != '' and language_others is not null";
						$this->query .= "   and work_job.publ = 1 and work_job.appr = 1";
						$this->query .= "   and left(date_add(work_job.date, interval 90 day), 10) > left(now(), 10)";
						$this->query .= " group by substring_index(language_others,';',1)";
						$this->query .= " order by count(*) desc";
					} else if (in_array($table, array(
						'location',
						'location_tag',
						'work_job_category'
					))) {
						$this->query = "select * from code_" . $table . " where parent = 0 order by no";
					} else if ($table == 'country') {
						$this->query = "";
						$this->query .= "select code.no, ifnull(city.country_name, code.name) as name";
						$this->query .= "  from code_country code";
						$this->query .= "  left join code_country_city city on city.country_code = code.no";
						$this->query .= " where code.no != 'KP'";
						$this->query .= " group by code.no";
						$this->query .= " order by name";
					} else if ($table == 'country_city') {
						$this->query = "select * from code_" . $table . " order by country_code, city_name";
					} else if ($table == 'country_phone') {
						$this->query = "select * from code_country where phone_code != '' order by phone_code";
					} else {
						$this->query = "select * from code_" . $table . " order by no";
					}
					$stmt = $this->conn->prepare($this->query);
					$stmt->execute();
					$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					for ($i = 0; $i < count($rs); $i++) {
						if (!empty($rs[$i]['no']) && isset($rs[$i]['parent'])) {
							$rs[$i]['children'] = $this->selectCode($table, null, null, $rs[$i]['no']);
						}
					}
					return $rs;
				}
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Select Save
	 *
	 * @param string $table
	 * @param int $pk
	 * @return int|array $rs
	 */
	public function selectSave($table, $pk = null) {
		try {
			if (isset($table) && !empty($table) && in_array($table, array(
				'work_job',
				'work_resume'
			))) {
				if ($pk) {
					$this->query = "select no from save_" . $table . " where member = :member and " . $table . " = :" . $table;
					$stmt = $this->conn->prepare($this->query);
					$stmt->bindParam(":member", $_SESSION['ID']);
					$stmt->bindParam(":" . $table, $pk);
					$stmt->execute();
					$rs = $stmt->fetchColumn();
					$stmt->closeCursor();
					return $rs;
				} else {
					$this->query = "select * from save_" . $table . " where member = :member order by no desc";
					$stmt = $this->conn->prepare($this->query);
					$stmt->bindParam(":member", $_SESSION['ID']);
					$stmt->execute();
					$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
					return $rs;
				}
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Pagination Query
	 */
	private function queryPagination() {
		global $CONF;
		if (isset($CONF['pagination_articles'])) {
			$query = "select count(*) " . substr($this->query, strpos($this->query, '  from'));
			$stmt = $this->conn->prepare($query);
			$stmt->execute($this->values);
			$CONF['pagination_total'] = $stmt->fetchColumn();
			if (!isset($_GET['page']) || empty($_GET['page'])) {
				$_GET['page'] = 1;
			}
			$page = $_GET['page'];
			$pagination_articles = $CONF['pagination_articles'];
			if (!isset($pagination_articles) || empty($pagination_articles)) {
				$pagination_articles = 12;
			}
			$this->query .= " limit " . (($page - 1) * $pagination_articles) . ", " . $pagination_articles;
		}
	}

	/**
	 * Update Hits
	 *
	 * @param string $table
	 * @param int $pk
	 * @return boolean
	 */
	private function updateHits($table, $pk) {
		try {
			if (isset($table) && !empty($table) && isset($pk) && !empty($pk) && in_array($table, array(
				'work_company',
				'work_job',
				'work_event',
				'work_resume',
				'story_profile',
				'story_article'
			))) {
				$this->query = "update " . $table . " set hits = hits + 1 where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$stmt->closeCursor();
				return true;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/**
	 * Common Edit
	 *
	 * @param string $table
	 * @param array $columns
	 * @param array $values
	 * @return int $pk
	 */
	public function edit($table, $columns, $values) {
		try {
			if (!empty($table) && !empty($columns) && !empty($values)) {
				if (!isset($values[':no']) || empty($values[':no'])) {
					unset($values[':no']);
					$this->query = "insert into " . $table . "(`" . join('`, `', $columns) . "`) values (:" . join(', :', $columns) . ")";
					$stmt = $this->conn->prepare($this->query);
					$stmt->execute($values);
					$stmt->closeCursor();
					return $this->conn->lastInsertId();
				} else {
					foreach ($columns as $i => $column) {
						$columns[$i] = '`' . $column . '` = :' . $column;
					}
					$this->query = "update " . $table . " set `mod` = now(), " . join(', ', $columns) . " where no = :no";
					$stmt = $this->conn->prepare($this->query);
					$stmt->execute($values);
					$stmt->closeCursor();
					return $values[':no'];
				}
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus($values, $e->getMessage());
			return null;
		}
	}

	/* ***************************************************************************************** */
	/* ***************************************** Member **************************************** */
	/* ***************************************************************************************** */
	public function selectUser($pk = null) {
		try {
			if ($pk) {
				$member = $this->selectMember($pk);
				$work_credit = $this->selectWorkCredit(null, $pk);
				$work_company = array_reverse($this->selectWorkCompany(null, $pk));
				$work_resume = $this->selectWorkResumeProfile($pk);
				$story_profile = $this->selectStoryProfile(null, $pk);
				return array(
					'nickname' => $member['nickname'],
					'work_credit' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $work_credit,
					'work_credit_hot' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $this->selectWorkCredit(1),
					'work_credit_hot_day' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $this->selectWorkCredit(11),
					'work_credit_job' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $this->selectWorkCredit(2),
					'work_credit_res' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $this->selectWorkCredit(3),
					'work_credit_res_day' => $member['recruiter'] || $_GET['MAIN'] == 'Tefl' ? '∞' : $this->selectWorkCredit(31),
					'work_company' => isset($work_company[0]) ? $work_company[0]['no'] : 0,
					'work_company_name' => isset($work_company[0]) ? $work_company[0]['name'] : '',
					'work_resume' => $work_credit ? 0 : $work_resume['no'],
					'work_resume_name' => $work_resume['fullname'],
					'work_message' => $this->selectWorkMessage(),
					'story_profile' => isset($story_profile[0]) ? $story_profile[0]['no'] : 0,
					'story_profile_nickname' => isset($story_profile[0]) ? $story_profile[0]['nickname'] : ''
				);
			} else {
				return array(
					'nickname' => '',
					'work_credit' => 0,
					'work_credit_hot' => 0,
					'work_credit_hot_day' => 0,
					'work_credit_job' => 0,
					'work_credit_res' => 0,
					'work_credit_res_day' => 0,
					'work_company' => 0,
					'work_company_name' => '',
					'work_resume' => 0,
					'work_resume_name' => '',
					'work_message' => 0,
					'story_profile' => 0,
					'story_profile_name' => ''
				);
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function register($email = null, $pw = null) {
		try {
			$this->query = "select count(*) from member where email = :email";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			$rs = $stmt->fetchColumn();
			$stmt->closeCursor();
			if ($rs == 0) {
				$this->query = "insert into member (email, pw) values(:email, :pw)";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":pw", md5($pw));
				$stmt->execute();
				$stmt->closeCursor();
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function login($email = null, $pw = null) {
		try {
			$this->query = "select * from member where email = :email";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":email", $email);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if ($rs['pw'] == $pw || $rs['pw'] == md5($pw)) {
				return $rs;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectMember($pk = null, $email = null, $auth = null) {
		try {
			if ($auth) {
				$this->query = "select * from member where auth = :auth";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":auth", $auth);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($email) {
				$this->query = "select * from member where email = :email";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":email", $email);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from member where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectMemberEmailDomains() {
		try {
			$this->query = "select count(*) as count, substring_index(email, '@', -1) as host from member group by host having count(*)>1 order by count(*) desc";
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function editMember($values = null) {
		try {
			$this->query = "update member set nickname = :nickname, logo_img = :logo_img where email = :email";
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute($values);
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus($values, $e->getMessage());
			return null;
		}
	}

	public function updateMemberLastLoginDate($pk = null) {
		try {
			$this->query = "update member set date_lastlogin = now() where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function updateMemberAuth($pk = null) {
		$chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$auth = "";
		try {
			$this->query = "select auth from member where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$auth = $stmt->fetchColumn();
			$stmt->closeCursor();
			if ($auth)
				return $auth;
			do {
				$auth = "";
				for ($i = 0; $i < 64; $i++)
					$auth .= $chars[rand(0, strlen($chars) - 1)];
				$this->query = "select count(*) from member where auth like :auth";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":auth", $auth);
				$stmt->execute();
				$cnt = $stmt->fetchColumn();
				$stmt->closeCursor();
			} while ($cnt);
			$this->query = "update member set auth = :auth where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":auth", $auth);
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$stmt->closeCursor();
			return $auth;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function updateMemberAppr($auth = null) {
		try {
			$this->query = "select no from member where auth like :auth";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":auth", $auth);
			$stmt->execute();
			$pk = $stmt->fetchColumn();
			$stmt->closeCursor();
			if ($pk) {
				$this->query = "update member set auth = null, appr = 1 where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$stmt->closeCursor();
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function updateMemberEmail($pk = null, $email = null) {
		try {
			$this->query = "update member set email = :email, appr = 0, email_log = ifnull(concat(email_log, ';', email), email) where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":email", $email);
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function updateMemberPw($pk = null, $pw = null) {
		try {
			$this->query = "update member set pw = :pw where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":pw", md5($pw));
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function deleteMember($pk = null) {
		try {
			$this->query = "delete from member where no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":no", $pk ? $pk : $_SESSION['ID']);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function blockMember() {
		if ($_SESSION['ID']) {
			try {
				$message = "해킹 시도 (" . date('Y년m월d일H시i분s초', strtotime('now+9hours')) . " / " . str_replace(':', '', $_SERVER['REMOTE_ADDR']) . ")";
				$this->query = "update member set appr = 2, email_log = ifnull(concat(email_log, ';', '" . $message . "'), '" . $message . "') where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $_SESSION['ID']);
				$stmt->execute();
				$stmt->closeCursor();
			} catch (Exception $e) {
				$this->printStatus(null, $e->getMessage());
			}
		}
		session_destroy();
		session_start();
		$_SESSION['dialog'] = '차단되었습니다.';
		header('Location: /');
		exit();
	}

	/* ***************************************************************************************** */
	/* ****************************************** Work ***************************************** */
	/* ***************************************************************************************** */
	public function selectWorkCompany($pk = null, $member = null, $domain = null, $keyword = null) {
		$keyword_columns = array(
			"work_company.name" => ":name",
			"work_company.name_kor" => ":name_kor"
		);
		try {
			$this->query = "";
			$this->query .= "select work_company.*";
			$this->query .= "     , code_work_company_type.name as type_name";
			$this->query .= "     , job_category_parent_code.name as job_category_parent_name";
			$this->query .= "     , job_category_child_code.name as job_category_child_name";
			$this->query .= "     , location_parent_code.name as location_parent_name";
			$this->query .= "     , location_child_code.name as location_child_name";
			$this->query .= "     , code_country.name as location_country_name";
			$this->query .= "  from work_company";
			$this->query .= "  left join code_work_company_type on work_company.company_type = code_work_company_type.no";
			$this->query .= "  left join code_work_job_category job_category_parent_code on work_company.job_category_parent = job_category_parent_code.no";
			$this->query .= "  left join code_work_job_category job_category_child_code on work_company.job_category_child = job_category_child_code.no";
			$this->query .= "  left join code_location location_parent_code on work_company.location_parent = location_parent_code.no";
			$this->query .= "  left join code_location location_child_code on work_company.location_child = location_child_code.no";
			$this->query .= "  left join code_country on work_company.location_country = code_country.no";
			if ($pk) {
				$this->query .= " where work_company.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if (($rs['publ'] != 1 || $rs['appr'] != 1) && $rs['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN'])
					return null;
				global $PAGE;
				if ($PAGE['no'] == '3210')
					$this->updateHits('work_company', $rs['no']);
				return $rs;
			} else if ($member) {
				$this->query .= " where work_company.member = :member";
				$this->values['member'] = $member;
				if ($keyword) {
					$this->query .= " and ( 1 != 1";
					foreach (explode(' ', $keyword) as $i => $value) {
						foreach ($keyword_columns as $column => $name) {
							$this->query .= " or " . $column . " like " . $name . $i;
							$this->values[$name . $i] = '%' . $value . '%';
						}
					}
					$this->query .= " )";
				}
				$this->query .= " order by work_company.date desc";
				$this->queryPagination();
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($domain) {
				$this->query .= " where work_company.domain = :domain";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":domain", $domain);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if (($rs['publ'] != 1 || $rs['appr'] != 1) && $rs['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN'])
					return null;
				$this->updateHits('work_company', $rs['no']);
				return $rs;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function searchWorkCompany($top = null, $keyword = null, $company_type = null, $char = null) {
		$keyword_columns = array(
			"work_company.name" => ":name",
			"work_company.name_kor" => ":name_kor",
			"work_company.keyword" => ":keyword",
			"work_company.keyword2" => ":keyword2"
		);
		try {
			$this->values = array();
			$this->query = "";
			$this->query .= "select no, date, `mod`, 1 as publ, 1 as appr, member, domain, name, left(`desc`, 1000) as `desc`, logo_img";
			$this->query .= "  from work_company";
			$this->query .= " where publ = 1 and appr = 1";
			if (isset($_GET['MAIN']) && $_GET['MAIN'] == 'Tefl') {
				$this->query .= " and (select count(*) from tefl_course where work_company = work_company.no) > 0";
			}
			if ($top) {
				$this->query .= " and top = 1";
			} else {
				$this->query .= " and top != 1";
			}
			if ($keyword) {
				$this->query .= " and ( 1 != 1";
				foreach (explode(' ', $keyword) as $i => $value) {
					foreach ($keyword_columns as $column => $name) {
						$this->query .= " or " . $column . " like " . $name . $i;
						$this->values[$name . $i] = '%' . $value . '%';
					}
				}
				$this->query .= " )";
			}
			if ($company_type) {
				$this->query .= " and ( 1 != 1";
				foreach ($company_type as $i => $value) {
					$this->query .= " or work_company.company_type like :company_type" . $i;
					$this->values[':company_type' . $i] = '%' . $value . '%';
				}
				$this->query .= " )";
			}
			if ($_GET['location_country']) {
				$this->query .= " and ( 1 != 1";
				foreach ($_GET['location_country'] as $i => $value) {
					$this->query .= " or work_company.location_country like :location_country" . $i;
					$this->values[':location_country' . $i] = '%' . $value . '%';
				}
				$this->query .= " )";
			}
			if ($char && $char != 'Etc') {
				$this->query .= " and name like :name";
				$this->values[':name'] = $char . '%';
			} else if ($char == 'Etc') {
				$this->query .= " and name regexp '^[^a-zA-Z]'";
			}
			global $PAGE;
			if ($PAGE['no'] == '3110' && !$top) {
				$this->query .= " order by work_company.name asc";
			} else {
				$this->query .= " order by work_company.date desc";
			}
			$this->queryPagination();
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute($this->values);
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkJob($pk = null, $fk = null, $member = null, $keyword = null) {
		try {
			$this->query = "";
			$this->query .= "select work_job.*";
			$this->query .= "     , ifnull(work_company.member, work_credit.member) as member";
			$this->query .= "     , work_company.name as company_name";
			$this->query .= "     , work_company.logo_img as company_logo_img";
			$this->query .= "     , job_category_parent_code.name as job_category_parent_name";
			$this->query .= "     , job_category_child_code.name as job_category_child_name";
			$this->query .= "     , location_parent_code.name as location_parent_name";
			$this->query .= "     , location_child_code.name as location_child_name";
			$this->query .= "     , code_country.name as location_country_name";
			$this->query .= "     , (select count(*) from save_work_job where save_work_job.work_job = work_job.no) as save";
			$this->query .= "     , (select count(*) from work_job_application where work_job_application.work_job = work_job.no and work_job_application.deleted is null) as applications";
			$this->query .= "  from work_job";
			$this->query .= "  left join work_company on work_job.work_company = work_company.no";
			$this->query .= "  left join work_credit on work_job.work_credit = work_credit.no";
			$this->query .= "  left join code_work_job_category job_category_parent_code on work_job.job_category_parent = job_category_parent_code.no";
			$this->query .= "  left join code_work_job_category job_category_child_code on work_job.job_category_child = job_category_child_code.no";
			$this->query .= "  left join code_location location_parent_code on work_job.location_parent = location_parent_code.no";
			$this->query .= "  left join code_location location_child_code on work_job.location_child = location_child_code.no";
			$this->query .= "  left join code_country on work_job.location_country = code_country.no";
			$this->query .= " where work_job.publ != 2";
			if ($_GET['MAIN'] == 'actions' || $_GET['PAGE'] == 'Search' || ($_GET['PAGE'] == 'Detail' && $_GET['MENU']!='Job')) {
				$this->query .= " and (work_job.hot = 1 and left(date_add(work_job.date, interval ifnull(work_credit.credit, 7) day), 10) >= left(now(), 10)";
				$this->query .= " or left(date_add(work_job.date, interval 90 day), 10) > left(now(), 10))";
			}
			if ($pk) {
				$this->query .= "   and work_job.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if (($rs['publ'] != 1 || $rs['appr'] != 1) && $rs['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN'])
					return null;
				global $PAGE;
				if ($PAGE['no'] == '3220' || $_GET['MAIN'] == 'actions' && $_GET['PAGE'] == 'JobDetail')
					$this->updateHits('work_job', $rs['no']);
				return $rs;
			} else if ($fk) {
				$this->query .= "   and work_job.publ = 1";
				$this->query .= "   and work_job.work_company = :work_company";
				$this->query .= " order by work_job.date desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":work_company", $fk);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($member) {
				$this->query .= "   and (work_company.member = :member_company or work_credit.member = :member_credit)";
				if ($fk) {
					$this->query .= "   and work_job.work_company = :work_company";
				}
				if ($keyword) {
					$this->query .= "   and work_job.title like :keyword";
				}
				$this->query .= " order by work_job.date desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member_company", $member);
				$stmt->bindParam(":member_credit", $member);
				if ($keyword) {
					$stmt->bindValue(":keyword", '%' . $keyword . '%');
				}
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function searchWorkJob($hot = null, $keyword = null, $params = array()) {
		$keyword_columns = array(
			"work_job.title" => ":title",
			"work_job.keyword" => ":keyword",
			"work_job.keyword2" => ":keyword2",
			"work_company.name" => ":name",
			"work_company.name_kor" => ":name_kor",
			"work_company.keyword" => ":keyword",
			"work_company.keyword2" => ":keyword2"
		);
		try {
			$this->values = array();
			$this->query = "";
			$this->query .= "select work_job.no, work_job.date, work_job.`mod`/*, work_job.hot*/, work_job.title, work_job.job_type, work_job.period, left(work_job.`desc`, 1000) as `desc`";
			$this->query .= "     , '" . ($hot ? '1' : '0') . "' as hot";
			$this->query .= "     , work_job.location_country, work_job.location_parent, work_job.location_child";
			$this->query .= "     , code_country.name as location_country_name";
			$this->query .= "     , location_parent_code.name as location_parent_name";
			$this->query .= "     , location_child_code.name as location_child_name";
			$this->query .= "     , work_company.member, work_company.name as company_name, work_company.logo_img as company_logo_img";
			$this->query .= "     , (select count(*) from save_work_job where save_work_job.work_job = work_job.no) as save";
			$this->query .= "  from work_job";
			$this->query .= "  left join work_company on work_job.work_company = work_company.no";
			$this->query .= "  left join work_credit on work_job.work_credit = work_credit.no";
			$this->query .= "  left join code_country on work_job.location_country = code_country.no";
			$this->query .= "  left join code_location location_parent_code on work_job.location_parent = location_parent_code.no";
			$this->query .= "  left join code_location location_child_code on work_job.location_child = location_child_code.no";
			$this->query .= " where work_job.work_company is not null";
			$this->query .= "   and work_job.publ = 1 and work_job.appr = 1";
			if ($hot) {
				$this->query .= " and work_job.hot = 1 and left(date_add(work_job.date, interval ifnull(work_credit.credit, 7) day), 10) >= left(now(), 10)";
			} else {
				$this->query .= " and (work_job.hot != 1 or left(date_add(work_job.date, interval ifnull(work_credit.credit, 7) day), 10) < left(now(), 10))";
				$this->query .= " and left(date_add(work_job.date, interval 90 day), 10) > left(now(), 10)";
			}
			if ($keyword) {
				$this->query .= " and ( 1 != 1";
				foreach (explode(' ', $keyword) as $i => $value) {
					foreach ($keyword_columns as $column => $name) {
						$this->query .= " or " . $column . " like " . $name . $i;
						$this->values[$name . $i] = '%' . $value . '%';
					}
				}
				$this->query .= " )";
			}
			foreach ($params as $param) {
				if ($param['name'] == 'job_industry') {
					$this->query .= " and ( work_company." . $param['name'] . " like ''";
				} else {
					$this->query .= " and ( work_job." . $param['name'] . " like ''";
				}
				foreach ($param['values'] as $i => $value) {
					if ($param['name'] == 'job_industry')
						$this->query .= " or work_company." . $param['name'] . " like :" . $param['name'] . $i;
					else
						$this->query .= " or work_job." . $param['name'] . " like :" . $param['name'] . $i;
					$this->values[':' . $param['name'] . $i] = '%' . $value . '%';
				}
				$this->query .= " )";
			}
			if (isset($_GET['outkor'])) {
				$this->query .= " and work_job.location_country != '' and work_job.location_country != 'KR'";
			}
			if (isset($_GET['period_type'])) {
				if ($_GET['period_type'] == 1) {
					$this->query .= " and (work_job.period = 2 or work_job.period = 3 or left(work_job.period, 10) between :period_from and :period_to)";
					$this->values[':period_from'] = $_GET['period_from'] ? $_GET['period_from'] : '2000-00-00';
					$this->values[':period_to'] = $_GET['period_to'] ? $_GET['period_to'] : '9999-99-99';
				} else {
					$this->query .= " and work_job.period = :period_type";
					$this->values[':period_type'] = $_GET['period_type'];
				}
			}
			$this->query .= " order by work_job.date desc";
			$this->queryPagination();
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute($this->values);
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkJobLanguages() {
		try {
			$this->query = "";
			$this->query .= "select count(*) as count";
			$this->query .= "     , substring_index(language_others, ';', 1) as name";
			$this->query .= "  from work_job";
			$this->query .= " where language_others not like ''";
			$this->query .= "   and language_others not like 'English%'";
			$this->query .= "   and language_others not like 'Korean%'";
			$this->query .= "   and work_job.work_company is not null";
			$this->query .= "   and work_job.publ = 1";
			$this->query .= "   and left(date_add(work_job.date, interval 90 day), 10) > left(now(), 10)";
			$this->query .= " group by substring_index(language_others, ';', 1)";
			$this->query .= " order by count desc";
			return $this->conn->query($this->query);
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkEvent($pk = null, $fk = null, $member = null, $hashtag = null) {
		try {
			$this->query = "";
			$this->query .= "select work_event.*";
			$this->query .= "     , work_company.member, work_company.name as company_name, work_company.logo_img as company_logo_img";
			$this->query .= "     , location_parent_code.name as location_parent_name";
			$this->query .= "     , location_child_code.name as location_child_name";
			$this->query .= "     , code_country.name as location_country_name";
			$this->query .= "  from work_event";
			$this->query .= "  left join work_company on work_event.work_company = work_company.no";
			$this->query .= "  left join code_location location_parent_code on work_event.location_parent = location_parent_code.no";
			$this->query .= "  left join code_location location_child_code on work_event.location_child = location_child_code.no";
			$this->query .= "  left join code_country on work_event.location_country = code_country.no";
			if ($pk) {
				$this->query .= " where work_event.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if (($rs['publ'] != 1 || $rs['appr'] != 1) && $rs['member'] != $_SESSION['ID'] && !$_SESSION['ADMIN'])
					return null;
				global $PAGE;
				if ($PAGE['no'] == '3230')
					$this->updateHits('work_event', $rs['no']);
				return $rs;
			} else if ($fk) {
				$this->query .= " where (work_event.publ = 1 or work_company.member = :member)";
				$this->query .= "   and work_event.work_company = :work_company";
				$this->query .= " order by work_event.no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->bindParam(":work_company", $fk);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($member) {
				$this->query .= " where work_company.member = :member";
				$this->query .= " order by work_event.no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member", $member);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($hashtag) {
				$this->query .= " where work_event.publ = 1";
				$this->query .= "   and work_event.hashtag like :hashtag";
				$this->query .= " order by work_event.no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":hashtag", '%' . $hashtag . '%');
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query .= " where work_event.publ = 1";
				$this->query .= " order by work_event.no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkResume($pk = null, $member = null) {
		try {
			$this->query = "";
			$this->query .= "select work_resume.*";
			$this->query .= "     , code_personal_nationality.name as nationality_name";
			$this->query .= "     , job_category_parent_code.name as job_category_parent_name";
			$this->query .= "     , job_category_child_code.name as job_category_child_name";
			$this->query .= "     , current_location_parent_code.name as current_location_parent_name";
			$this->query .= "     , current_location_child_code.name  as current_location_child_name";
			$this->query .= "     , current_location_country_code.name as current_location_country_name";
			$this->query .= "     , desired_location_parent_code.name as desired_location_parent_name";
			$this->query .= "     , desired_location_child_code.name  as desired_location_child_name";
			$this->query .= "     , desired_location_country_code.name as desired_location_country_name";
			$this->query .= "     , (select count(*) from save_work_resume where save_work_resume.work_resume = work_resume.no) as save";
			$this->query .= "  from work_resume_view work_resume";
			$this->query .= "  left join code_personal_nationality on work_resume.personal_nationality = code_personal_nationality.no";
			$this->query .= "  left join code_work_job_category job_category_parent_code on work_resume.job_category_parent = job_category_parent_code.no";
			$this->query .= "  left join code_work_job_category job_category_child_code on work_resume.job_category_child = job_category_child_code.no";
			$this->query .= "  left join code_location current_location_parent_code on work_resume.current_location_parent = current_location_parent_code.no";
			$this->query .= "  left join code_location current_location_child_code  on work_resume.current_location_child  = current_location_child_code.no";
			$this->query .= "  left join code_country current_location_country_code on work_resume.current_location_country = current_location_country_code.no";
			$this->query .= "  left join code_location desired_location_parent_code on work_resume.desired_location_parent = desired_location_parent_code.no";
			$this->query .= "  left join code_location desired_location_child_code  on work_resume.desired_location_child  = desired_location_child_code.no";
			$this->query .= "  left join code_country desired_location_country_code on work_resume.desired_location_country = desired_location_country_code.no";
			if ($pk) {
				$this->query .= " where work_resume.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if ($rs['personal_firstname'] || $rs['personal_lastname'])
					$rs['fullname'] = $rs['personal_firstname'] . ' ' . $rs['personal_lastname'];
				if (($rs['publ'] != 1 || $rs['appr'] != 1) && $rs['member'] != $_SESSION['ID'] && !$_SESSION['RECRUITER'] && !$USER['work_credit_hot_day'] && !$USER['work_credit_res_day'] && !$USER['work_company'])
					return null;
				global $PAGE;
				if ($PAGE['no'] == '3240')
					$this->updateHits('work_resume', $rs['no']);
				try {
					if ($_SESSION['CURRENT_COMPANY']) {
						$this->query = "insert into work_resume_hit (work_company, work_resume) values(:work_company, :work_resume)";
						$stmt = $this->conn->prepare($this->query);
						$stmt->bindParam(":work_company", $_SESSION['CURRENT_COMPANY']);
						$stmt->bindParam(":work_resume", $rs['no']);
						$stmt->execute();
						$stmt->closeCursor();
					}
				} catch (PDOException $e) {
					if ($e->getCode() != '23000') {
						$this->printStatus(null, $e->getMessage());
					}
				}
				return $rs;
			} else if ($member) {
				$this->query .= " where work_resume.member = :member";
				$this->query .= " order by work_resume.date desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member", $member);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function searchWorkResume($keyword = null, $params = array()) {
		$keyword_columns = array(
			"work_resume.title" => ":title"
		);
		try {
			$this->values = array();
			$this->query = "";
			$this->query .= "select work_resume.no, work_resume.date, work_resume.mod, work_resume.member, work_resume.title";
			$this->query .= "     , work_resume.job_type, work_resume.job_industry, work_resume.logo_img";
			$this->query .= "     , work_resume.personal_firstname, work_resume.personal_lastname";
			$this->query .= "     , work_resume.personal_nationality, work_resume.personal_birthday";
			$this->query .= "     , career_level, education_level, education_desc";
			$this->query .= "     , code_personal_nationality.name as nationality_name";
			$this->query .= "     , job_category_parent_code.name as job_category_parent_name";
			$this->query .= "     , job_category_child_code.name as job_category_child_name";
			$this->query .= "     , desired_location_parent_code.name as desired_location_parent_name";
			$this->query .= "     , desired_location_child_code.name  as desired_location_child_name";
			$this->query .= "     , desired_location_country_code.name as desired_location_country_name";
			$this->query .= "     , (select count(*) from save_work_resume where save_work_resume.work_resume = work_resume.no) as save";
			$this->query .= "  from work_resume_view work_resume";
			$this->query .= "  left join code_personal_nationality on work_resume.personal_nationality = code_personal_nationality.no";
			$this->query .= "  left join code_work_job_category job_category_parent_code on work_resume.job_category_parent = job_category_parent_code.no";
			$this->query .= "  left join code_work_job_category job_category_child_code on work_resume.job_category_child = job_category_child_code.no";
			$this->query .= "  left join code_location desired_location_parent_code on work_resume.desired_location_parent = desired_location_parent_code.no";
			$this->query .= "  left join code_location desired_location_child_code  on work_resume.desired_location_child  = desired_location_child_code.no";
			$this->query .= "  left join code_country desired_location_country_code on work_resume.desired_location_country = desired_location_country_code.no";
			$this->query .= " where work_resume.publ = 1";
			if ($keyword) {
				$this->query .= " and ( 1 != 1";
				foreach (explode(' ', $keyword) as $i => $value) {
					foreach ($keyword_columns as $column => $name) {
						$this->query .= " or " . $column . " like " . $name . $i;
						$this->values[$name . $i] = '%' . $value . '%';
					}
				}
				$this->query .= " )";
			}
			foreach ($params as $param) {
				if (strpos($param['name'], 'location_') !== false)
					$param['name'] = "desired_" . $param['name'];
				$this->query .= " and ( work_resume." . $param['name'] . " like ''";
				foreach ($param['values'] as $i => $value) {
					$this->query .= " or work_resume." . $param['name'] . " like :" . $param['name'] . $i;
					$this->values[':' . $param['name'] . $i] = '%' . $value . '%';
				}
				$this->query .= " )";
			}
			if (isset($_GET['outkor'])) {
				$this->query .= " and work_resume.location_country != '' and work_resume.location_country != 'KR'";
			}
			if (isset($_GET['period_type'])) {
				if ($_GET['period_type'] == 1) {
					$this->query .= " and (work_resume.period > 3 and left(work_resume.period, 10) between :period_from and :period_to)";
					$this->values[':period_from'] = $_GET['period_from'] ? $_GET['period_from'] : '2000-00-00';
					$this->values[':period_to'] = $_GET['period_to'] ? $_GET['period_to'] : '9999-99-99';
				} else {
					$this->query .= " and work_resume.period = :period_type";
					$this->values[':period_type'] = $_GET['period_type'];
				}
			}
			$this->query .= " order by work_resume.date desc";
			$this->queryPagination();
			$stmt = $this->conn->prepare($this->query);
			$stmt->execute($this->values);
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkResumeProfile($member = null) {
		try {
			$this->query = "";
			$this->query .= "select no, publ, member";
			$this->query .= "     , personal_firstname, personal_lastname, personal_nationality";
			$this->query .= "     , personal_gender, personal_marital, personal_birthday, personal_visa";
			$this->query .= "     , contact_private, contact_phone1, contact_phone2";
			$this->query .= "     , contact_email, contact_person, contact_messengers, contact_urls, logo_img";
			$this->query .= "  from work_resume_profile";
			$this->query .= " where member = :member";
			$this->query .= " order by no asc";
			$this->query .= " limit 1";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if ($rs['personal_firstname'] || $rs['personal_lastname'])
				$rs['fullname'] = $rs['personal_firstname'] . ' ' . $rs['personal_lastname'];
			if ($rs['member'])
				return $rs;
			$this->query = "";
			$this->query .= "select null as no, 0 as publ, member";
			$this->query .= "     , personal_firstname, personal_lastname, personal_nationality";
			$this->query .= "     , personal_gender, personal_marital, personal_birthday, personal_visa";
			$this->query .= "     , contact_private, contact_phone1, contact_phone2";
			$this->query .= "     , contact_email, contact_person, contact_messengers, contact_urls, logo_img";
			$this->query .= "  from work_resume_view work_resume";
			$this->query .= " where member = :member";
			$this->query .= " order by no asc";
			$this->query .= " limit 1";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
			$stmt->execute();
			$rs = $stmt->fetch(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			if ($rs['personal_firstname'] || $rs['personal_lastname'])
				$rs['fullname'] = $rs['personal_firstname'] . ' ' . $rs['personal_lastname'];
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkJobApplication($pk = null, $fk = null, $member = null, $company = null, $keyword = null) {
		try {
			$this->values = array();
			$this->query = "";
			$this->query .= "select application.*";
			$this->query .= "     , job.date as job_date";
			$this->query .= "     , job.mod as job_mod";
			$this->query .= "     , company.member as job_member";
			$this->query .= "     , job.title as job_title";
			$this->query .= "     , company.no as work_company";
			$this->query .= "     , company.name as company_name";
			$this->query .= "     , resume.date as resume_date";
			$this->query .= "     , resume.mod as resume_mod";
			$this->query .= "     , resume.member as resume_member";
			$this->query .= "     , resume.title as resume_title";
			$this->query .= "     , ifnull(resume.personal_firstname, application.personal_firstname) as personal_firstname";
			$this->query .= "     , ifnull(resume.personal_lastname, application.personal_lastname) as personal_lastname";
			$this->query .= "     , ifnull(resume.personal_nationality, application.personal_nationality) as personal_nationality";
			$this->query .= "     , resume.personal_gender";
			$this->query .= "     , resume.personal_marital";
			$this->query .= "     , resume.personal_birthday";
			$this->query .= "     , ifnull(resume.contact_private, 0) as contact_private";
			$this->query .= "     , ifnull(resume.contact_email, application.contact_email) as contact_email";
			$this->query .= "     , resume.logo_img";
			$this->query .= "     , code_personal_nationality.name as nationality_name";
			$this->query .= "  from work_job_application application";
			$this->query .= "  left join work_job job on application.work_job = job.no";
			$this->query .= "  left join work_company company on job.work_company = company.no";
			$this->query .= "  left join work_resume_view resume on application.work_resume = resume.no";
			$this->query .= "  left join code_personal_nationality";
			$this->query .= "         on ifnull(resume.personal_nationality, application.personal_nationality) = code_personal_nationality.no";
			if ($pk) {
				$this->query .= " where application.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if ($rs['personal_firstname'] || $rs['personal_lastname'])
					$rs['fullname'] = $rs['personal_firstname'] . ' ' . $rs['personal_lastname'];
				return $rs;
			} else if ($fk) {
				$this->query .= " where application.work_job = :work_job";
				$this->values[':work_job'] = $fk;
				if ($member) {
					$this->query .= "   and application.member = :member";
					$this->values[':member'] = $member;
				}
				$this->query .= "   and application.deleted is null";
				$this->query .= " order by application.date desc";
				global $PAGE;
				if ($PAGE['no'] == '3520' || $PAGE['no'] == '3570') {
					$this->queryPagination();
				}
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				foreach ($rs as $i => $application) {
					if ($rs[$i]['personal_firstname'] || $rs[$i]['personal_lastname'])
						$rs[$i]['fullname'] = $rs[$i]['personal_firstname'] . ' ' . $rs[$i]['personal_lastname'];
				}
				return $rs;
			} else {
				$this->query .= " where (application.member = :application_member or company.member = :company_member)";
				$this->query .= "   and job.no is not null";
				global $PAGE;
				if ($PAGE['no'] == '3520' || $PAGE['no'] == '3570') {
					$this->query .= "   and application.deleted is null";
				} else {
					$this->query .= "   and application.canceled is null";
				}
				if ($company) {
					$this->query .= "   and company.no like :company";
					$this->values[':company'] = $company;
				}
				if ($keyword) {
					$this->query .= "   and resume.title like :title";
					$this->query .= "   and resume.personal_firstname like :firstname";
					$this->query .= "   and resume.personal_lastname like :lastname";
					$this->values[':title'] = '%' . $keyword . '%';
					$this->values[':firstname'] = '%' . $keyword . '%';
					$this->values[':lastname'] = '%' . $keyword . '%';
				}
				$this->query .= " order by application.date desc";
				$this->values[':application_member'] = $member ? $member : $_SESSION['ID'];
				$this->values[':company_member'] = $member ? $member : $_SESSION['ID'];
				if ($PAGE['no'] == '3520' || $PAGE['no'] == '3570') {
					$this->queryPagination();
				}
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				foreach ($rs as $i => $application) {
					if ($rs[$i]['personal_firstname'] || $rs[$i]['personal_lastname'])
						$rs[$i]['fullname'] = $rs[$i]['personal_firstname'] . ' ' . $rs[$i]['personal_lastname'];
				}
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkResumeHit($member = null) {
		try {
			$this->query = "";
			$this->query .= "select work_resume_hit.*";
			$this->query .= "     , work_resume.title as resume_title";
			$this->query .= "     , work_company.name as company_name";
			$this->query .= "  from work_resume_hit";
			$this->query .= "  left join work_resume_view work_resume on work_resume_hit.work_resume = work_resume.no";
			$this->query .= "  left join work_company on work_resume_hit.work_company = work_company.no";
			$this->query .= " where work_resume.member = :member";
			$this->query .= " order by work_resume_hit.date desc";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
			$stmt->execute();
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkResumeFolder($pk = null, $member = null) {
		try {
			if ($pk) {
				$this->query = "select * from save_work_resume_folder where member = :member and no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				$this->query = "select * from save_work_resume where save_work_resume_folder = :save_work_resume_folder order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":save_work_resume_folder", $rs['no']);
				$stmt->execute();
				$rs['saves'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from save_work_resume_folder where member = :member order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				$this->query = "select * from save_work_resume where save_work_resume_folder = :save_work_resume_folder order by no desc";
				$stmt = $this->conn->prepare($this->query);
				foreach ($rs as $i => $folder) {
					$stmt->bindParam(":save_work_resume_folder", $folder['no']);
					$stmt->execute();
					$rs[$i]['saves'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
					$stmt->closeCursor();
				}
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkCredit($product = null, $member = null) {
		try {
			if ($product == 1) { // Hot Job Posting (Remaining Credits)
				$this->query = "";
				$this->query .= "select count(no)";
				$this->query .= "  from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and appr = 1";
				$this->query .= "   and product = 1";
				$this->query .= "   and date > '2015-03-22 00:00:00'";
				$this->query .= "   and used is null";
				// $this->query .= " and left(date_add(date, interval 90 day), 10) > left(now(), 10)"; // Expiry
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				return $rs;
			} else if ($product == 11) { // Hot Job Posting (Remaining Days)
				$this->query = "";
				$this->query .= "select to_days(date_add(used, interval credit+1 day)) - to_days(now())";
				$this->query .= "  from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and appr = 1";
				$this->query .= "   and product = 1";
				$this->query .= "   and left(date_add(used, interval credit+1 day), 10) > left(now(), 10)";
				$this->query .= " order by used desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				if ($rs)
					return $rs;
				else
					return 0;
			} else if ($product == 2) { // Standard Job Posting (Remaining Credits)
				$this->query = "";
				$this->query .= "select ifnull(sum(work_credit.credit), 0)";
				$this->query .= "   - ( select count(work_job.no)";
				$this->query .= "         from work_job";
				$this->query .= "         left join work_credit on work_job.work_credit = work_credit.no";
				$this->query .= "        where work_credit.member = :job_member";
				$this->query .= "          and work_credit.date > '2015-03-22 00:00:00'";
				$this->query .= "          and work_job.hot = 0 )";
				$this->query .= "   - ( select count(work_credit_job.no)";
				$this->query .= "         from work_credit_job";
				$this->query .= "         left join work_credit on work_credit_job.work_credit = work_credit.no";
				$this->query .= "        where work_credit.member = :credit_member";
				$this->query .= "          and work_credit.date > '2015-03-22 00:00:00' )";
				$this->query .= "  from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and appr = 1";
				$this->query .= "   and product = 2";
				$this->query .= "   and date > '2015-03-22 00:00:00'";
				// $this->query .= " and left(date_add(date, interval 90 day), 10) > left(now(), 10)"; // Expiry
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":job_member", $member ? $member : $_SESSION['ID']);
				$stmt->bindValue(":credit_member", $member ? $member : $_SESSION['ID']);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				return $rs;
			} else if ($product == 3) { // Resume Search (Remaining Credits)
				$this->query = "";
				$this->query .= "select * from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and appr = 1";
				$this->query .= "   and product = 3";
				$this->query .= "   and used is null";
				// $this->query .= " and left(date_add(date, interval 90 day), 10) > left(now(), 10)"; // Expiry
				$this->query .= " order by date asc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if (empty($rs))
					return null;
				return $rs;
			} else if ($product == 31) { // Resume Search (Remaining Days)
				$this->query = "";
				$this->query .= "select to_days(date_add(used, interval credit+1 day)) - to_days(now())";
				$this->query .= "  from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and appr = 1";
				$this->query .= "   and product = 3";
				$this->query .= "   and left(date_add(used, interval credit+1 day), 10) > left(now(), 10)";
				$this->query .= " order by used desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				if (empty($rs))
					return 0;
				else
					return $rs;
			} else { // Has Credit
				$this->query = "select count(*) from work_credit where member = :member";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkPurchase($product = null, $member = null) {
		try {
			if ($product) {
				$this->query = "";
				$this->query .= "select *";
				$this->query .= "  from work_credit";
				$this->query .= " where member = :member";
				$this->query .= "   and product = :product";
				$this->query .= "   and date > '2015-03-22 00:00:00'";
				$this->query .= " order by date desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->bindParam(":product", $product);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if ($product == 2) {
					$this->query = "";
					$this->query .= "select no, date from work_credit_job where work_credit = :job_credit";
					$this->query .= " union select no, date from work_job where work_credit = :work_credit";
					$this->query .= " order by date desc";
					$stmt = $this->conn->prepare($this->query);
					foreach ($rs as $i => $purchase) {
						$stmt->bindParam(":job_credit", $purchase['no']);
						$stmt->bindParam(":work_credit", $purchase['no']);
						$stmt->execute();
						$rs[$i]['jobs'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
						$stmt->closeCursor();
					}
				}
				return $rs;
			} else {
				$this->query = "select * from work_credit where member = :member order by date desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function updateWorkCreditUsed($pk = null, $member = null, $product = null) {
		try {
			$this->query = "update work_credit set used = now() where used is null and appr = 1 and product = :product and member = :member and no = :no";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":no", $pk);
			$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
			$stmt->bindParam(":product", $product);
			$stmt->execute();
			$stmt->closeCursor();
			return true;
		} catch (PDOException $e) {
			$this->printStatus(array('pk' => $pk, 'member' => $member, 'product' => $product), $e->getMessage());
			exit();
		}
	}

	public function selectWorkJobalert($email = null, $member = null) {
		try {
			if ($email) {
				$this->query = "select * from work_jobalert where email = :email";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":email", $email);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from work_jobalert where member = :member";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindValue(":member", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkMessage($pk = null, $member = null, $work_company = null, $work_resume = null, $work_job_application = null, $group = false) {
		try {
			if ($pk) {
				$this->query = "";
				$this->query .= "select *";
				$this->query .= "  from work_message";
				$this->query .= " where no = :no";
				$this->query .= "   and (member_send = :member_send or member_receive = :member_receive)";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->bindValue(":member_send", $member ? $member : $_SESSION['ID']);
				$stmt->bindValue(":member_receive", $member ? $member : $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				if ($rs['member_send'] == $_SESSION['ID']) {
					$tmp = $rs['member_send'];
					$rs['member_send'] = $rs['member_receive'];
					$rs['member_receive'] = $tmp;
					$tmp = $rs['member_send_email'];
					$rs['member_send_email'] = $rs['member_receive_email'];
					$rs['member_receive_email'] = $tmp;
				}
				return $rs;
			} else if ($member) {
				$this->values = array();
				$this->query = "";
				$this->query .= "select work_message.*";
				$this->query .= "     , ifnull(work_company.member, case when work_resume.member = work_message.member_send then work_message.member_receive else work_message.member_send end) as company_member";
				$this->query .= "     , ifnull(work_resume.member, case when work_company.member = work_message.member_send then work_message.member_receive else work_message.member_send end) as resume_member";
				$this->query .= "     , work_job.no as work_job";
				if ($group) {
					$this->query .= "     , count(*) as cnt, max(work_message.date) as date_max";
				}
				$this->query .= "  from work_message";
				$this->query .= "  left join work_job_application on work_message.work_job_application = work_job_application.no";
				$this->query .= "  left join work_job on work_job_application.work_job = work_job.no";
				$this->query .= "  left join work_resume on ifnull(work_job_application.work_resume, work_message.work_resume) = work_resume.no";
				$this->query .= "  left join work_company on ifnull(work_job.work_company, work_message.work_company) = work_company.no";
				$this->query .= " where (work_message.work_company is not null or work_message.work_resume is not null or work_message.work_job_application is null)";
				$this->query .= "   and (work_message.member_send = :member_send or work_message.member_receive = :member_receive)";
				if ($group) {
					$this->values[':member_send'] = $member;
					$this->values[':member_receive'] = $member;
					$this->query .= " group by company_member, resume_member, work_message.work_company, work_message.work_resume, work_message.work_job_application";
					$this->query .= " order by date_max desc";
				} else {
					$this->values[':member_send'] = $_SESSION['ID'];
					$this->values[':member_receive'] = $_SESSION['ID'];
					if ($work_company) {
						$this->query .= "   and work_message.work_company = :work_company";
						$this->values[':work_company'] = $work_company;
					} else {
						$this->query .= "   and work_message.work_company is null";
					}
					if ($work_resume) {
						$this->query .= "   and work_message.work_resume = :work_resume";
						$this->values[':work_resume'] = $work_resume;
					} else {
						$this->query .= "   and work_message.work_resume is null";
					}
					if ($work_job_application) {
						$this->query .= "   and work_message.work_job_application = :work_job_application";
						$this->values[':work_job_application'] = $work_job_application;
					} else {
						$this->query .= "   and work_message.work_job_application is null";
					}
					$this->query .= " having company_member = :company_member and resume_member = :resume_member";
					if ($_GET['PAGE']=='Employer') {
						$this->values[':company_member'] = $_SESSION['ID'];
						$this->values[':resume_member'] = $member;
					} else {
						$this->values[':company_member'] = $member;
						$this->values[':resume_member'] = $_SESSION['ID'];
					}
					$this->query .= " order by work_message.date desc";
				}
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($_SESSION['ID']) {
				$this->query = "";
				$this->query .= "select count(*) as cnt";
				$this->query .= "  from work_message";
				$this->query .= " where member_receive = :member_receive";
				$this->query .= "   and `read` = 0";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member_receive", $_SESSION['ID']);
				$stmt->execute();
				$rs = $stmt->fetchColumn();
				$stmt->closeCursor();
				return $rs;
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	/* ***************************************************************************************** */
	/* ***************************************** Blogs ***************************************** */
	/* ***************************************************************************************** */
	public function selectStoryProfile($pk = null, $member = null) {
		try {
			if ($pk) {
				$this->query = "select * from story_profile where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				$this->updateHits('story_profile', $rs);
				return $rs;
			} else if ($member) {
				$this->query = "select * from story_profile where member = :member order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member", $member);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select *  from story_profile order by no desc";
				$this->queryPagination();
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectStoryArticle($pk = null, $fk = null, $series = null, $category = null, $hashtag = null) {
		try {
			$this->values = array();
			$this->query = "";
			$this->query .= "select story_article.*";
			$this->query .= "     , story_profile.nickname, story_profile.member, story_series.series_title";
			$this->query .= "  from story_article";
			$this->query .= "  left join story_profile on story_article.story_profile = story_profile.no";
			$this->query .= "  left join story_series on story_article.story_series = story_series.no";
			if ($pk) {
				$this->query .= " where story_article.no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				$this->updateHits('story_article', $rs);
				return $rs;
			} else if ($fk) {
				$this->query .= " where story_article.story_profile = :story_profile";
				$this->values[':story_profile'] = $fk;
				if ($series) {
					$this->query .= " and story_article.story_series = :story_series";
					$this->values[':story_series'] = $series;
				}
				if ($_GET['PAGE'] != 'MyPage') {
					$this->query .= " and story_article.publ = 1";
				}
				$this->query .= " order by story_article.no desc";
				$this->queryPagination();
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($series) {
				$this->query .= " where story_article.story_series = :story_series";
				$this->query .= " order by story_article.no desc";
				$this->values[':story_series'] = $series;
				$this->queryPagination();
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query .= " where story_article.publ = 1 and story_article.appr = 1";
				if ($category) {
					if ($category == 'Others') {
						global $CONF;
						$this->query .= " and ( story_article.story_category is null or story_article.story_category like '' or 1 = 1";
						foreach ($CONF['story_category'] as $i => $story_category) {
							$this->query .= " and story_article.story_category not like :story_category" . $i;
							$this->values[':story_category' . $i] = $story_category;
						}
						$this->query .= " )";
					} else {
						$this->query .= "   and story_article.story_category like :story_category";
						$this->values[':story_category'] = $category;
					}
				}
				if ($hashtag) {
					$this->query .= "   and (story_article.hashtag like :hashtag";
					$this->values[':hashtag'] = '%' . $hashtag . '%';
					global $PAGE;
					if ($PAGE['no'] == '4000') {
						$this->query .= " or story_article.title like :keyword";
						$this->values[':keyword'] = '%' . $hashtag . '%';
					}
					$this->query .= ")";
				}
				$this->query .= " order by story_article.no desc";
				$this->queryPagination();
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute($this->values);
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectStorySeries($pk = null, $member = null) {
		try {
			if ($pk) {
				$this->query = "select * from story_series where no = :no";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":no", $pk);
				$stmt->execute();
				$rs = $stmt->fetch(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else if ($member) {
				$this->query = "select * from story_series where member = :member order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->bindParam(":member", $member);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			} else {
				$this->query = "select * from story_series order by no desc";
				$stmt = $this->conn->prepare($this->query);
				$stmt->execute();
				$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
				$stmt->closeCursor();
				return $rs;
			}
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}

	public function selectWorkStory($fk = null, $hashtag = null) {
		try {
			$this->query = "";
			$this->query .= "select story_article.*";
			$this->query .= "     , story_profile.nickname, story_profile.member, story_series.series_title";
			$this->query .= "  from story_article";
			$this->query .= "  left join story_profile on story_article.story_profile = story_profile.no";
			$this->query .= "  left join story_series on story_article.story_series = story_series.no";
			$this->query .= " where story_article.publ = 1";
			$this->query .= "   and (work_company = :work_company or story_article.hashtag like :hashtag)";
			$this->query .= " order by story_article.no desc";
			$stmt = $this->conn->prepare($this->query);
			$stmt->bindParam(":work_company", $fk);
			$stmt->bindValue(":hashtag", '%' . $hashtag . '%');
			$stmt->execute();
			$rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
			$stmt->closeCursor();
			return $rs;
		} catch (PDOException $e) {
			$this->printStatus(null, $e->getMessage());
			return null;
		}
	}
}
