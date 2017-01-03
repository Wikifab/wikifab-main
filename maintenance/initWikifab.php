<?php
/**
 * scritp to initialise specifics wikifab pages, such as forms, properties, and home page
 *
 * @file
 * @ingroup Maintenance
 */
require_once __DIR__ . '/Maintenance.php';

/**
 * Maintenance script to init Wikifab Site (create all forms)
 *
 * @ingroup Maintenance
 */
class InitWikifab extends Maintenance {

	public function __construct() {
		parent::__construct ();
		$this->mDescription = "Init Wikifab pages";
		$this->addOption ( 'setWikifabHomePage', "Set the wiki home page", false, false );
		$this->addOption ( 'force', "force edit of existing pages", false, false );
	}

	protected function getUpdateKey() {
		return 'initialise_Wikifab_Pages';
	}

	protected function updateSkippedMessage() {
		return 'Wikifab pages are allready setup';
	}

	public function execute() {
		global $wgContLang;

		$setWikifabHomePage = $this->getOption ( 'setWikifabHomePage' );
		$force = $this->getOption ( 'force' ) ? true : false;

		$lang = $wgContLang->getCode();

		$homePageFile = [
				'fr' => 'Accueil.txt',
				'en' => 'Main_Page.txt'
		];

		$pagelist = $this->getPageListToCreate ($lang);

		echo "Setting Up wikifab pages ...\n";


		if ($setWikifabHomePage) {
			echo "Setting wiki home page $setWikifabHomePage\n";

			$ret = Title::newMainPage();
			$pageTitle = $ret->getText();
			$title = $this->getPageName ( $pageTitle );
			$content = $this->getPageContent ( $homePageFile[$lang], $lang);
			$this->createPage ( $title, $content, true);

		} else {
			echo "No Setting wiki home page\n";
		}

		foreach ( $pagelist as $page ) {
			if ($page == $homePageFile) {
				continue;
			}
			$title = $this->getPageName ( $page );
			$content = $this->getPageContent ($page, $lang);
			$this->createPage ( $title, $content , $force);
		}
	}

	/**
	 * Get a WikiPage object from a title string, if possible.
	 *
	 * @param string $titleName
	 * @param bool|string $load
	 *        	Whether load the object's state from the database:
	 *        	- false: don't load (if the pageid is given, it will still be loaded)
	 *        	- 'fromdb': load from a slave database
	 *        	- 'fromdbmaster': load from the master database
	 * @return WikiPage
	 */
	private function getPage($titleName) {
		$titleObj = Title::newFromText ( $titleName );
		if (! $titleObj || $titleObj->isExternal ()) {
			trigger_error ( 'Fail to get title ' . $titleName, E_USER_WARNI );
			return false;
		}
		if (! $titleObj->canExist ()) {
			trigger_error ( 'Title cannot be created ' . $titleName, E_USER_WARNING );
			return false;
		}
		$pageObj = WikiPage::factory ( $titleObj );

		return $pageObj;
	}
	private function getAdminUser() {
		// get Admin user : (take the first user created)
		$dbr = wfGetDB ( DB_SLAVE );
		$res = $dbr->select ( 'user', User::selectFields (), array (), __METHOD__, array (
				'LIMIT' => 1,
				'ORDER BY' => 'user_id'
		) );
		$users = UserArray::newFromResult ( $res );
		$user = $users->current ();

		return $user;
	}
	private function createPage($pageName, $content, $force = false) {
		$wikipage = $this->getPage ( $pageName );

		if ($wikipage->exists () && ! $force) {
			echo "page $pageName allready exists.\n";
			return false;
		}

		$user = $this->getAdminUser ();

		$result = $wikipage->doEdit ( $content, $content, $flags = 0, $baseRevId = false, $user );

		if ($result->isOK ()) {
			echo "page $pageName successfully created.\n";
			return true;
		} else {
			echo $result->getWikiText ();
		}

		return false;
	}
	private function getPageName($page) {
		$page = str_replace ( 'Form_', 'Form:', $page );
		$page = str_replace ( 'Property_', 'Property:', $page );
		$page = str_replace ( 'Template_', 'Template:', $page );
		$page = str_replace ( 'Category_', 'Catégorie:', $page );
		$page = str_replace ( '_', ' ', $page );
		$page = str_replace ( '.txt', '', $page );

		return $page;
	}
	private function getPageContent($page, $lang = 'en') {
		$dir = __DIR__ . '/wikifabPages/' . $lang;

		return file_get_contents ( $dir . '/' . $page );
	}
	private function getPageListToCreate( $lang = 'en') {
		$dir = __DIR__ . '/wikifabPages/'  .$lang;

		$files = scandir ( $dir );

		$result = [ ];
		foreach ( $files as $file ) {
			if (preg_match ( '/^([a-zA-Z_0-9\-])+\.txt$/', $file )) {
				$result [] = $file;
			}
		}
		return $result;
	}
}

$maintClass = "InitWikifab";
require_once RUN_MAINTENANCE_IF_MAIN;
