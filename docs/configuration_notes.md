## Upload No-image-yet.jpg and help icons

Go to the /Special:Upload page of your website and upload the files:

* No-image-yet.jpg (You can download it <a href="http://files.wikifab.org/8/89/No-image-yet.jpg">here</a>)
* Dont.jpg (You can download it <a href="http://files.wikifab.org/6/6b/Dont-icon.jpg">here</a>)
* Idea.jpg (You can download it <a href="http://files.wikifab.org/3/37/Icon-idea.jpg">here</a>)
* Info.jpg (You can download it <a href="http://files.wikifab.org/9/9e/Info-icon.jpg">here</a>)
* Pin.jpg (You can download it <a href="http://files.wikifab.org/0/0c/Pin-icon.jpg">here</a>)
* Caution.jpg (You can download it <a href="http://files.wikifab.org/5/53/Caution-icon.jpg">here</a>)

## Update your logo

The logo is expected to be 152 x 50 pixels, but this can be increased by modifying the site CSS. Upload your logo file onto your server. Let say it ends up as /images/mylogo.png. Then you can use it as your site logo by adding this line to LocalSettings.php:

	$wgLogo = $wgScriptPath . '/images/mylogo.png';

## Change top menu links

To update the links of your top menu go to: /MediaWiki:Sidebar

We recommand your to put:

	* navigation
	** Special:WfExplore|Explore
	** Contribute|Contribute
	** http://feedback.wikifab.org|Feedback
	* SEARCH
	* TOOLBOX
	* LANGUAGES


## Add a custom CSS file

Upload your CSS file onto your server. Let's say it ends up as /skins/Custom/css/style.css.

Adding the following lines to LocalSettings.php:

	$egChameleonExternalStyleModules = array(
		__DIR__ . '/skins/wikifabStyleModule/chameleon-wikifab.less' => $wgScriptPath . '/skins/wikifabStyleModule',
		__DIR__ . '/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less' => $wgScriptPath . 	'/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less',
 	   __DIR__ . '/skins/Custom/css/style.css' => $wgScriptPath . '/skins/Custom',
	   );

## Update your favicon

## Enable files upload

## Changing the links of the footers

## Updating the categories

## Enable newsletter signup banner
