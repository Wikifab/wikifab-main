<?php

$EXT = "extensions";
wfLoadExtension( 'Babel' );

wfLoadExtension( 'Cldr' );

wfLoadExtension( 'Cleanchanges' );
$wgCCTrailerFilter = true;
$wgCCUserFilter = false;
$wgDefaultUserOptions['usenewrc'] = 1;

wfLoadExtension( 'LocalisationUpdate' );
$wgLocalisationUpdateDirectory = "$IP/cache";

require_once "$EXT/Translate/Translate.php";
$wgGroupPermissions['user']['translate'] = true;
$wgGroupPermissions['user']['translate-messagereview'] = true;
$wgGroupPermissions['user']['translate-groupreview'] = true;
$wgGroupPermissions['user']['translate-import'] = true;
$wgGroupPermissions['sysop']['pagetranslation'] = true;
$wgGroupPermissions['sysop']['translate-manage'] = true;
$wgTranslateDocumentationLanguageCode = 'qqq';
$wgExtraLanguageNames['qqq'] = 'Message documentation'; # No linguistic content. Used for documenting messages

wfLoadExtension( 'UniversalLanguageSelector' );
wfLoadExtension( 'SimpleLanguageSelector' );

wfLoadExtension( 'AutoSetPageLang' );

$wgPageLanguageUseDB = true;
$wgGroupPermissions['user']['pagelang'] = true;
// END INTL


$wgExploreIsLocalized = true;
$smwgQMaxSize = 40;

//$wgULSPosition = 'interlanguage';
$wgULSEnable = true;
$wgULSEnableAnon = true;
$wgULSAnonCanChangeLanguage = true;
$wgULSPosition ='other';


//Set languages using :
$wgSimpleLangageSelectionLangList = ['fr', 'en', 'de', 'es', 'it', 'pt'];