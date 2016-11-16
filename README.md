# Wikifab Installation

This project document the installation of a wikifab website (empty of tutorials)

There are 2 methods to install Wikifab:

* The METHOD #1 use a full package to upload to your server using FTP.

* The METHOD #2 use composer: it enable you to get the latest version of Wikifab. But It requires to have an ssh access to your server, with connectivity to download all the packages. Some web providers doesn't allow it.


## METHOD #1 : Installation process using the full package

### 1. Set Up your Mediawiki

If your Mediawiki is already installed and up to date, go to point 2. If you need to set up a new Mediawiki or update an existing one, follow the instructions here: https://www.mediawiki.org/wiki/Manual:Installing_MediaWiki

Note : wikifab is only available in english and french for now. If you select another language, you will have a lot of missing translations. At the end of the installation, it will propose you to generate the file "LocalSettings.php", generate it and upload it to your website directory.

At this point, your wiki is up, but it does not include the wikifab part.

We will assume going forward that your mediawiki folder is located in /usr/share/mediawiki/

In some installations the permissions or the owner is not set correctly, you can execute the following chown:

	-R root:root /usr/share/mediawiki/ find /usr/share/mediawiki/ -type f -exec chmod 644 {} \; find /usr/share/mediawiki/ -type d -exec chmod 755 {} \;

### 2. Download package and upload it to you website

Download it here : http://releases.wikifab.org/wikifab/wikifabFullPackage-0.1.1.zip
Unzip and upload directory on your server.

Here the commands line by line (supposing your mediawiki install is located in /usr/share/mediawiki/)

	mkdir ~/temp cd ~/temp wget http://releases.wikifab.org/wikifab/wikifabFullPackage-0.1.0.zip unzip wikifabFullPackage-0.1.0.zip cp -R wikifab/* /usr/share/mediawiki/

### 3. Set Up your wiki

Go to your website url, and follow installation instructions.

Note : wikifab is only available in english and french for now. If you select another language, you will have a lot of missing translations.

At the end of the installation, it should give you a file "LocalSettings.php" to put in your website directory.

At this point, your wiki is up, but it does not include the wikifab part.

### 4. Add wikifab extensions and configuration

Edit the 'LocalSettings.php' file and add the following line at the end :

	include('LocalSettings.wikifab.php');
	
Then execute those scripts to install wikifab extensions and pages :

	php maintenance/update.php
	php maintenance/initWikifab.php --setWikifabHomePage

The installation is now done and you will be able to access it correctly. If you see any issue or warning, please let us know on the forum : http://feedback.wikifab.org/

Please, make your wiki famous by adding your URL on this page: http://beta.wikifab.org/index.php/D%C3%A9veloppeurs

## METHOD #2 : Installation process using composer

If you allready have a mediawiki website, simply start at step 3

### requirement

You need a web server with PHP>5.4 with acces to execute php scripts

### 1. download Mediawiki

Here is the latest : https://releases.wikimedia.org/mediawiki/1.27/mediawiki-1.27.1.tar.gz

download it and extract to your website

in bash : 

	wget https://releases.wikimedia.org/mediawiki/1.27/mediawiki-1.27.1.tar.gz
	tar -xzf mediawiki-1.27.1.tar.gz
	mv mediawiki-1.27.1 /var/www/yourwebsite

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
	php composer.phar update

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

and run the php update script 


in bash :

	cd /var/www/yourwebsite
	echo "include('LocalSettings.wikifab.php');" >> LocalSettings.php
	php maintenance/update.php

### 7. Install Wikifab pages and formatting

You need to create all pages and forms to finish installation and have a wikifab like website.

You can do id with this script (only available for french for now) :

	php maintenance/initWikifab.php --setWikifabHomePage

Warning : this will change the home page of your wiki, if you do not want this, simply execute the command without param "--setWikifabHomePage"

### 8. Permissions

Finaly, make sure that server has write permissions on directories "images/" and "images/avatars/".

Now you should have a wikifab like wiki. Please contact us if you have any difficulties.
