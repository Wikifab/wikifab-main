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
		$this->addOption ( 'int', "use internationnalized pages", false, false );
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

		$lang = $this->getOption ( 'int' ) ? 'int' : $wgContLang->getCode();

		$homePageFile = [
				'fr' => 'Accueil.txt',
				'en' => 'Main_Page.txt',
				'int' => 'Accueil.txt'
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
	protected function getPage($titleName) {
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
	protected function getAdminUser() {
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
	protected function createPage($pageName, $text, $force = false) {

		global $wgmaintenanceNotOverwrite;

		$wikipage = $this->getPage ( $pageName );

		if ($wikipage->exists () && ! $force) {
			echo "page $pageName allready exists.\n";
			return false;
		}

		if ( in_array( $wikipage->getTitle()->getPrefixedDBKey(), $wgmaintenanceNotOverwrite) ) {
			return false;
		}

		$user = $this->getAdminUser ();

		$content = ContentHandler::makeContent( $text, $wikipage->getTitle() );
		$result = $wikipage->doEditContent( $content, 'init wikifab pages', $flags = 0, $baseRevId = false, $user );

		if ($result->isOK ()) {
			echo "page $pageName successfully created.\n";
			return true;
		} else {
			echo $result->getWikiText ();
		}

		return false;
	}
	protected function getPageName($page) {
		$page = str_replace ( 'Form_', 'Form:', $page );
		$page = str_replace ( 'Property_', 'Property:', $page );
		if (strpos($page,'Template_') == 0) {
			$page = str_replace ( 'Template_', 'Template:', $page );
		}
		$page = str_replace ( 'Module_', 'Module:', $page );
		$page = str_replace ( 'Category_', 'Category:', $page );
		$page = str_replace ( 'MediaWiki_', 'Mediawiki:', $page );
		$page = str_replace ( 'Widget_', 'Widget:', $page );
		$page = str_replace ( 'Help_', 'Help:', $page );
		$page = str_replace ( 'Dokit_', 'Dokit:', $page );
		$page = str_replace ( '_', ' ', $page );
		$page = str_replace ( '.txt', '', $page );

		return $page;
	}
	protected function getPagesDirs($lang) {
		return [
				__DIR__ . '/wikifabPages/' . $lang
		];
	}
	protected function getPageContent($page, $lang = 'en') {
		$dirs = $this->getPagesDirs($lang);

		foreach ($dirs as $dir) {
			if (file_exists($dir . '/' . $page)) {
				return file_get_contents ( $dir . '/' . $page );
			}
		}

		throw new Exception('File not found : ' . $page);
	}
	protected function getPageListToCreate( $lang = 'en') {
		$result = [ ];

		$dirs = $this->getPagesDirs($lang);
		foreach ($dirs as $dir) {
			$files = scandir ( $dir );
			foreach ( $files as $file ) {
				if (preg_match ( '/^([a-zA-Z_0-9\-àéèç])+\.txt$/', $file )) {
					$result[$file] = $file;
				}
			}
		}

		return $result;
	}
}

