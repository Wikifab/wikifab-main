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

We recommend your to write:

	* navigation
	** Special:WfExplore|Explore
	** Contribute|Contribute
	** http://feedback.wikifab.org|Feedback
	* SEARCH
	* TOOLBOX
	* LANGUAGES

## Updating the categories

Changing the categories isn't 100% customizable. In the future, we will make this easier. Today, here is what you should do:

###1. Change the categories in Wikifab

####1a. Edit your /Property:Area page and modify the category

###2. Edit the dropdown menu links of the Explore's sorting bar

####2a. On your server, open the file /extensions/Explore/includes/WfExploreCore.php
####2b. Search for the line '$categories = array(' and change 'wfexplore-category-name-something' to 'wfexplore-category-name-somethingelse'
####2c. Open the YourLanguage.json file in the /extensions/Explore/i18n/ directory
####2d. Add a new translation for your new 'wfexplore-category-name-somethingelse' 

###3. Edit the Footer



## Add a custom CSS file

Upload your CSS file onto your server. Let's say it ends up as /skins/Custom/css/style.css.

Adding the following lines to LocalSettings.php:

	$egChameleonExternalStyleModules = array(
		__DIR__ . '/skins/wikifabStyleModule/chameleon-wikifab.less' => $wgScriptPath . '/skins/wikifabStyleModule',
		__DIR__ . '/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less' => $wgScriptPath . 	'/skins/wikifabStyleModule/font-awesome-4.4.0/less/font-awesome.less',
 	   __DIR__ . '/skins/Custom/css/style.css' => $wgScriptPath . '/skins/Custom',
	   );

## Enable files upload

By default in Mediawiki, file upload is not enable. This can be change in LocalSettings.php if you set $wgEnableUploads as follow:

	$wgEnableUploads = true; # Enable uploads

## Update your favicon

## Changing the links of the footers



## Enable newsletter signup banner
