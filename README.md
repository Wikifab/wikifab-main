# Wikifab Installation

This project document the installation of a wikifab website (empty of tutorials)


## Installation process on empty mediawiki

### download Mediawiki

Here is the latest : https://releases.wikimedia.org/mediawiki/1.26/mediawiki-1.26.3.tar.gz

download it and extract to your website

in bash : 
	wget https://releases.wikimedia.org/mediawiki/1.26/mediawiki-1.26.3.tar.gz
	tar -wzf mediawiki-1.26.3.tar.gz
	mv mediawiki-1.26.3 /var/www/yourwebsite


### download wikifab-main

download this project, and copy content into your website folder

in bash :
	wget https://github.com/Wikifab/wikifab-main/archive/master.zip
	mv wikifab-main-master/* /var/www/yourwebsite/