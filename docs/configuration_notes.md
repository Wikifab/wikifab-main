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

## Enable/disable full-width page layout

For esthetic reasons, some pages of Wikifab (like the homepage) are full-width.

You might want to disable or enable the full-width layout to make your pages fit your own design. To do that, you need to over-write and edit the Wikifab Layout. Here is how to do this:

1. Download the file skins/wikifabStyleModule/layout-wikifab.xml and rename it (ie. layout-something.xml)

2. Upload it to the same folder (so you now have skins/wikifabStyleModule/layout-something.xml)

3. Add this line to your Localsetting.php:

	$egChameleonLayoutFile= __DIR__ . '/skins/lowtechlab-skin/layout-lowtechlab.xml';

4. Edit the file. You  will find 4 components. Each of them define if the `wiki-bar` and the `grid` (the `grid` will add a `container` to the page (so it disable the full-width)) will be enable for a list of pages and criterias:
  - On line 38 `wiki-nav` is `HideFor` the pages `Main_Page, Accueil, etc.`
  - On line 50 `wiki-nav` is `ShowOnlyFor` the pages `Main_Page, Accueil, etc.` and for `group=admin,sysop`
  - On line 67 you decide for which pages the full-width (or `grid`) is disable
  - On line 83 you decide for which pages the full-width (or `grid`) is enable

Simply add or remove the name of the pages you want to change the layout.

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
* 1a. Edit your /Property:Area page and modify the category

Note : to edit the page, in your browser got to the url (change it for your website) :  yourwebsite.com/index.php/Property:Area?action=edit 

###2. Edit the dropdown menu links of the Explore's sorting bar
* 2a. On your server, open the file /extensions/Explore/includes/WfExploreCore.php
* 2b. Search for the terms '$categories = array(' and change 'wfexplore-category-name-something' to 'wfexplore-category-name-somethingelse'
* 2c. Open the file /extensions/Explore/i18n/YourLanguage.json
* 2d. Add a new translation for your new 'wfexplore-category-name-somethingelse' 

###3. Edit the Footer

* 3a. On your server, open the file /skins/chameleon/src/Components/WikifabFooterLinks.php
* 3b. Search for the terms 'wffooter-categoriename-something' and change it to 'wffooter-categoriename-somethingelse'
* 3c. Search for the terms 'wffooterlinks-categoriename-something' and change it to 'wffooterlinks-categoriename-somethingelse'
* 3d. Open the file /skins/chameleon/resources/i18n/YourLanguage.json
* 3e. Add a new translation for your new 'wffooter-categoriename-somethingelse' and 'wffooterlinks-categoriename-somethingelse'. Be careful: the links are case sensitive (a space becomes %20, a & become %26, etc.)

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


## Enable newsletter signup banner
