# Wikifab Installation

This project document the installation of a wikifab website (empty of tutorials)


## Installation process on empty mediawiki

If you allready have a mediawiki website, simply start at step 3

### 1. download Mediawiki

Here is the latest : https://releases.wikimedia.org/mediawiki/1.26/mediawiki-1.26.3.tar.gz

download it and extract to your website

in bash : 

	wget https://releases.wikimedia.org/mediawiki/1.26/mediawiki-1.26.3.tar.gz
	tar -xzf mediawiki-1.26.3.tar.gz
	mv mediawiki-1.26.3 /var/www/yourwebsite

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
	mv wikifab-main-master/* /var/www/yourwebsite/
	
### 4. download and run composer

Download composer and execute composer.phar update into your website directory. This will get all extensions needed.
As Wikifab has not yet a fully stable version, you need to set "minimum-stability" to "dev" in composer.json

in bash:

	cd /var/www/yourwebsite
	curl http://getcomposer.org/installer | php
	php composer.phar config minimum-stability dev
	php composer.phar update

### 5. download other needed extensions

Some extension are required, but not available with composer for now (comming soon ?), you need to get them and put them in extensions directory.

Here is the list : 
 * Tabber https://github.com/HydraWiki/Tabber/
 * SocialProfile https://www.mediawiki.org/wiki/Extension:SocialProfile

in bash :

	cd /var/www/yourwebsite
	cd extensions
	wget -O tabber.zip  https://github.com/HydraWiki/Tabber/archive/master.zip
	unzip tabber.zip
	mv Tabber-master Tabber

### 6. Install Wikifab extensions

In your "LocalSettings.php" file, add a line to include  file 'LocalSettings.wikifab.php'

	include('LocalSettings.wikifab.php');

and run the php update script 


in bash :

	cd /var/www/yourwebsite
	echo "include('LocalSettings.wikifab.php');" >> LocalSettings.php
	php maintenance/update.php

### 7. Install Wikifab pages and formatting

You need to create all pages and forms to finish installation and have a wikifab like website.
This part is not yet automatised, but will be soon.
	