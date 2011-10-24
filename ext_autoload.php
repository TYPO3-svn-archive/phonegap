<?php

$extensionClassesPath = t3lib_extMgm::extPath('phonegap', 'Classes/');
$extensionPath = t3lib_extMgm::extPath('phonegap');
$extbaseClassesPath = t3lib_extMgm::extPath('extbase', 'Classes/');
return array(
	'tx_phonegap_viewhelpers_cameraviewhelper' => $extensionClassesPath . '/ViewHelper/camera.php',
	'tx_phonegap_viewhelpers_compassviewhelper' =>$extensionClassesPath . '/ViewHelper/compass.php',
	'tx_phonegap_viewhelpers_successviewhelper' => $extensionClassesPath . '/ViewHelper/success.php',
	'tx_phonegap_viewhelpers_errorviewhelper' => $extensionClassesPath . '/ViewHelper/error.php',

);