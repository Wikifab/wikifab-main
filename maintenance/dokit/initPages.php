<?php
/**
 * script to initialise specifics lowtechlab pages, such as forms, properties, and home page
 *
 * @file
 * @ingroup Maintenance
 */
require_once __DIR__ . '/../initWikifabClass.php';


/**
 * Maintenance script to init Wikifab Site (create all forms)
 *
 * @ingroup Maintenance
 */
class InitPages extends InitWikifab {

	protected function getPagesDirs($lang) {

		global $wgInitPages;


		if(isset($wgInitPages)) {
			return array_reverse($wgInitPages);
		}
		return [
				__DIR__ . '/../wikifabPages/' . $lang
		];
	}


}

$maintClass = "InitPages";
require_once RUN_MAINTENANCE_IF_MAIN;
