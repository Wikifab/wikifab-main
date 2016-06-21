## Upload the No-image-yet.jpg

Go to /Special:Upload and upload the file No-image-yet.jpg

## Update your logo

The logo is expected to be 152 x 50 pixels, but this can be increased by modifying the site CSS. Upload your logo file onto your server. Let's say it ends up as /images/mylogo.png. Then you can use it as your site logo by adding this line to LocalSettings.php:

	$wgLogo = $wgScriptPath . '/images/mylogo.png';

## Change top menu links

To update the links of your top menu go to: /MediaWiki:Sidebar

## Add a custom CSS file

Upload your CSS file onto your server. Let's say it ends up as /skins/Custom/css/style.css.

Adding the following lines to LocalSettings.php:

	$egChameleonExternalStyleModules = array(
		__DIR__ . '/skins/wikifabStyleModule/chameleon-wikifab.less' => $wgScriptPath . '/skins/wikifabStyleModule',
		__DIR__ . '/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less' => $wgScriptPath . 	'/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less',
 	   __DIR__ . '/skins/Custom/css/style.css' => $wgScriptPath . '/skins/Custom',
	   );


## Enable files upload

## Changing the links of the footers

## Updating the categories

## Enable newsletter signup banner
