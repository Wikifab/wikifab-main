# Wikifab Installation

This project document the installation of a wikifab website (empty of tutorials)

There are 2 methods to install Wikifab:

* The METHOD #1 use a full package to upload to your server using FTP.

* The METHOD #2 use composer: it enable you to get the latest version of Wikifab. But It requires to have an ssh access to your server, with connectivity to download all the packages. Some web providers doesn't allow it.


## METHOD #1 : Installation process using the full package

### 1. Download package and upload it to you website

Download it here : https://github.com/Wikifab/wikifab-main/releases/download/1.1.0-rc10/wikifab-1.1.0-rc10.zip
Unzip and upload directory on your server.


(check https://github.com/Wikifab/wikifab-main/releases for latest versions)

### 2. Set Up your wiki

Go to your website url, and follow installation instructions.

Note : wikifab is only available in english and french for now. If you select another language, you will have a lot of missing translations.

At the end of the installation, it should give you a file "LocalSettings.php" to put in your website directory.

At this point, your wiki is up, but it does not include the wikifab part.

### 3. Add wikifab extensions and configuration

Edit the 'LocalSettings.php' file and add the following line at the end :

	include('LocalSettings.wikifab.php');
	
Then execute those scripts to install wikifab extensions and pages :

	php maintenance/update.php
	php maintenance/update.php
	php maintenance/initWikifab.php --setWikifabHomePage

Note : In my case, the update.php script returned an error (in a part concerning Flow extension) at first execution, just run it a second time has solved the problem.

## METHOD #2 : Installation process using composer

If you allready have a mediawiki website, simply start at step 3

### requirement

You need a web server with PHP>5.4 with acces to execute php scripts

### 1. download Mediawiki

Here is the latest : https://releases.wikimedia.org/mediawiki/1.31/mediawiki-1.31.0.tar.gz

download it and extract to your website

in bash : 

	wget https://releases.wikimedia.org/mediawiki/1.31/mediawiki-1.31.0.tar.gz
	tar -xzf mediawiki-1.31.0.tar.gz
	mv mediawiki-1.31.0 /var/www/yourwebsite

### 2. install your wiki

Go to your website url, and follow installation instructions.

Note : wikifab is only available in english and french for now. If you select another language, you will have a lot of missing translations.

At the end of the installation, it should give you a file "LocalSettings.php" to put in your website directory.

At this point, your wiki is up, but it does not include the wikifab part.


### 3. download wikifab-main

download this project, and copy content into your website folder

in bash :

	wget https://github.com/Wikifab/wikifab-main/archive/master.zip
	unzip master.zip
	cp -R wikifab-main-master/* /var/www/yourwebsite/
	
### 4. download and run composer

Download composer and execute composer.phar update into your website directory. This will get all extensions needed.
As Wikifab has not yet a fully stable version, you need to set "minimum-stability" to "dev" in composer.json

in bash:

	cd /var/www/yourwebsite
	curl http://getcomposer.org/installer | php
	php composer.phar config minimum-stability dev
	php composer.phar update --no-dev

### 5. download other needed extensions

Some extension are required, but not available with composer for now (comming soon ?), you need to get them and put them in extensions directory.

Here is the list : 
 * Tabber https://github.com/HydraWiki/Tabber/

in bash :

	cd /var/www/yourwebsite
	cd extensions
	wget -O tabber.zip  https://github.com/HydraWiki/Tabber/archive/master.zip
	unzip tabber.zip
	mv Tabber-master Tabber
	
Moreover, the Flow extension installed by composer is not in the good directory, move it to 'extensions/' dir :
	
	cd /var/www/yourwebsite
	mv vendor/mediawiki/flow extensions/Flow
	

### 6. Install Wikifab extensions

In your "LocalSettings.php" file, add a line to include  file 'LocalSettings.wikifab.php'

	include('LocalSettings.wikifab.php');

To enable internationalization support, add the following line 

	include('LocalSettings.i18n.php');

and run the php update script 


in bash :

	cd /var/www/yourwebsite
	echo "include('LocalSettings.wikifab.php');" >> LocalSettings.php
	echo "include('LocalSettings.i18n.php');" >> LocalSettings.php
	php maintenance/update.php

### 7. Install Wikifab pages and formatting

You need to create all pages and forms to finish installation and have a wikifab like website.

You can do id with this script (only available for french for now) :

	php maintenance/initWikifab.php --setWikifabHomePage --int

Warning : this will change the home page of your wiki, if you do not want this, simply execute the command without param "--setWikifabHomePage"

### 8. Permissions

Finaly, make sure that server has write permissions on directories "images/" and "images/avatars/".

Now you should have a wikifab like wiki. Please contact us if you have any difficulties.


## Recommendations

### Recaptcha

To avoid bots to spam your pages, we strongly recommand you to activate captcha.

We recomend you recaptcha : to set it up : 
* go to https://www.google.com/recaptcha/ and after login, click "getrecatpha", and add an entry with your url. This will give you a key and secret key
* Edit LocalSettings.php, add the following lines, and replace with your key and secret key : 
	wfLoadExtensions( array( 'ConfirmEdit', 'ConfirmEdit/ReCaptchaNoCaptcha' ) );
	$wgCaptchaClass = 'ReCaptchaNoCaptcha';
	$wgReCaptchaSiteKey = 'YOUR-KEY';
	$wgReCaptchaSecretKey = 'YOUR-SECRET-KEY';

### Extension:3D

For wiki support for uploading and viewing 3D models, you need to install the 3D extension. To do so, add the following line to your LocalSettings file :

include('LocalSettings.3d.php');

with bash :

echo "include('LocalSettings.3d.php');" >> LocalSettings.php

#### Install 3d2png

3d2png is the thumbnail renderer for 3D files. It will render png thumbnails exactly like this extension will display the objects, using the same JS libraries running in Node.js instead of the browser.

To install, clone and install the 3d2png repository: 

	git clone https://gerrit.wikimedia.org/r/p/3d2png
	cd 3d2png
	npm install

On Linux, you'll also need to install a virtual framebuffer in order for 3d2png to be able to headlessly capture the 3D object.

	apt-get install xvfb

After having successfully installed 3d2png, we'll need to tell Extension:3D how to call this thumbnail generator service. Add this to your LocalSettings.php, and make sure to update the paths to match your configuration: 

$wg3dProcessor = [ '/usr/bin/xvfb-run', '-a', '-s', '-ac -screen 0 1280x1024x24' ,'/path-to-your-repository/3d2png.js' ];

## TroubleShooting

### you have a white page

This can means many differents errors.

To display errors messages, add the following lines on top of the LocalSettings.php file : 

	error_reporting( -1 );
	ini_set( 'display_errors', 1 );
	$wgShowExceptionDetails = true;
