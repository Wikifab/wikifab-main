<?php

# Tell MediaWiki that it can handle STL uploads

$wgTrustedMediaFormats[] = 'application/sla';
$wgFileExtensions[] = 'stl';

# Load the extension 

wfLoadExtension( '3D' );

# associating the STL file type with the correct viewer extension

$wgMediaViewerExtensions['stl'] = 'mmv.3d';

# tell Extension:3D how to call this thumbnail generator service

$wg3dProcessor = [ '/usr/bin/xvfb-run', '-a', '-s', '-ac -screen 0 1280x1024x24' ,'lib/3d2png.js' ];
