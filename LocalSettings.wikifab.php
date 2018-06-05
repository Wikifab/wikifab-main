<?php

$wgEnableUploads = true;

$wgDefaultSkin = "chameleon";


require_once "$IP/extensions/SemanticMediaWiki/SemanticMediaWiki.php";
enableSemantics( $wgServer );
require_once "$IP/extensions/PageForms/PageForms.php";
require_once "$IP/extensions/Stepnumber/StepNumber.php";
require_once "$IP/extensions/WfSearch/WfSearch.php";
require_once "$IP/extensions/Explore/WfExplore.php";
require_once "$IP/extensions/AuthorDiv/WfAuthorDiv.php";
require_once "$IP/extensions/Carousel/Carousel.php";
require_once "$IP/extensions/Cite/Cite.php";
require_once "$IP/extensions/Drafts/Drafts.php";
require_once "$IP/extensions/UserFunctions/UserFunctions.php";
require_once "$IP/extensions/SocialProfile/SocialProfile.php";
require_once "$IP/extensions/Echo/Echo.php";
require_once "$IP/extensions/UsersWatchlist/UsersWatchList.php";
require_once "$IP/extensions/WfextStyle/wikifabstyle.php";
require_once "$IP/extensions/ParserFunctions/ParserFunctions.php";
require_once "$IP/extensions/UsersWatchlist/UsersWatchList.php";
require_once "$IP/extensions/UsersWatchButton/UsersWatchButton.php";
require_once "$IP/extensions/MmsUpload/MsUpload.php";
require_once "$IP/extensions/Flow/Flow.php";
require_once("$IP/extensions/GroupsPage/GroupsPage.php");
require_once("$IP/extensions/UsersPagesLinks/UsersPagesLinks.php");
require_once "$IP/extensions/Scribunto/Scribunto.php";
wfLoadExtension( 'CheckPageTitle' );
wfLoadExtension( 'EmbedVideo' );
wfLoadExtension( 'FlowCounterTalks' );
wfLoadExtension( 'PageMediaGallery' );
wfLoadExtension( 'PageLoadingSpinner' );
wfLoadExtension( 'PdfExportRequest' );
wfLoadExtension( 'ImageAnnotator' );
wfLoadExtension( 'InputBox' );
wfLoadExtension( 'RandomSelection' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'SimpleEmbedVideo' );
wfLoadExtension( 'Tabber');
wfLoadExtension( 'CustomProperties' );

$wgScribuntoDefaultEngine = 'luastandalone';


$egDraftsAutoSaveWait = 10;
$egDraftsAutoSaveTimeout = 30;


$wgNamespaceContentModels[NS_TALK] = 'flow-board';
$wgNamespaceContentModels[NS_USER_TALK] = 'flow-board';

$egChameleonLayoutFile= __DIR__ . '/skins/wikifabStyleModule/layout-wikifab.xml';
$egChameleonLayoutFileSearchResult= __DIR__ . '/skins/wikifabStyleModule/layout-wikifab-search-result-int.php';
$egChameleonLayoutFileSearchResultUserPage = __DIR__ . '/skins/wikifabStyleModule/layout-wikifab-search-result-userpage.html';

$egChameleonExternalStyleModules = array(
    __DIR__ . '/skins/wikifabStyleModule/chameleon-wikifab.less' => $wgScriptPath . '/skins/wikifabStyleModule',
    __DIR__ . '/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less' => $wgScriptPath . '/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less',
);

$wgMessagesDirs['WikifabOrg'] = __DIR__ . "/i18n"; # Location of localisation files (Tell MediaWiki to load them)



$wgFooterIcons['poweredby']['wikifab']['src'] = "http://files.wikifab.org/logo/poweredby_wikifab_88x31.png";
$wgFooterIcons['poweredby']['wikifab']['alt'] = "Powered by wikifab";
$wgFooterIcons['poweredby']['wikifab']['url'] = "http://wikifab.org/w/index.php/Wikifab:Developers";


$wgUploadSizeWarning = '2097152';

$wgFileExtensions = array(
    //image
    'png', 'gif', 'jpg', 'jpeg', 'doc',
    'xls', 'mpp', 'pdf', 'ppt', 'tiff', 'bmp', 'docx', 'xlsx',
    'pptx', 'ps', 'odt', 'ods', 'odp', 'odg', 'svg',
	// CAO
	'dxf',
    // fichier 3D
	'3dc','3ds','ac','asc','bvh','blend','geo','dae','dwf','dw','x','fbx',
	'gta','mu','kmz','lwo','lws','flt','iv','osg','osgt','osgb','ive',
	'ply','shp','stl','vpk','wrl','wrz','obj',
    '3dm','dxf','stl','sldprt'
);

$smwgLinksInValues = true;

$wgUFAllowedNamespaces[NS_MAIN] = true;
$wgUFAllowedNamespaces[SF_NS_FORM] = true;


// Use this line ONLY if your MediaWiki version is 1.25 or newer:
/*
wfLoadExtensions( array( 'ConfirmEdit', 'ConfirmEdit/ReCaptchaNoCaptcha' ) );
$wgCaptchaClass = 'ReCaptchaNoCaptcha';
$wgReCaptchaSiteKey = '';
$wgReCaptchaSecretKey = '';
$wgCaptchaTriggers['edit']          = false;
$wgCaptchaTriggers['create']        = false;
$wgCaptchaTriggers['addurl']        = true;
$wgCaptchaTriggers['createaccount'] = true;
$wgCaptchaTriggers['badlogin']      = true;
$wgGroupPermissions['user']['skipcaptcha'] = true;
// */

$wgGroupPermissions['*']['viewedittab'] = false;
$wgPageFormsRenameEditTabs = true;
$wgUsersWatchListAllowAll = true;

$wgExploreUseThumbs = true;


$wgUserBoard = true;
$wgGroupPermissions ['user'] ['userboard-sendMessage'] = true;
$wgUserProfileDisplay['friends'] = true;
$wgUserProfileDisplay['foes'] = true;
$wgUserProfileDisplay['board'] = true;
$wgUserProfileDisplay['stats'] = false;
$wgUserProfileDisplay['userswatchlist'] = true;
$wgUserProfileDisplay['userspageslinks'] = true;


// ajoute certains type MIME manquant pour permettre l'upload de ces fichiers
$wgHooks['MimeMagicInit'][] = 'wfAddMimeTypes';
function wfAddMimeTypes( $mimeMagic ) {
	$mimeMagic->addExtraTypes( "text/plain dxf" );
	$mimeMagic->addExtraTypes( "text/plain stl" );
	$mimeMagic->addExtraTypes( "application/pdf ai" );
}

//Set languages using :
$wgSimpleLangageSelectionLangList = ['fr', 'en', 'de', 'es', 'it', 'pt'];