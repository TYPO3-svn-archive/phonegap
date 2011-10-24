<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Tim Wentzlau <tim.wentzlau@auxilior.com>, Auxilior Technology PF
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 3 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
                                                                      */

/* This view helper implements Phonegap camera class.
 * 
 *
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_Phonegap_ViewHelpers_CameraViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper implements Tx_Fluid_Core_ViewHelper_Facets_ChildNodeAccessInterface {

	public function __construct() {
		$this->registerArgument('success', 'mixed', 'Value to be returned if the condition if met.', FALSE);
		$this->registerArgument('error', 'mixed', 'Value to be returned if the condition if not met.', FALSE);
	}
	
	/**
	 * An array of Tx_Fluid_Core_Parser_SyntaxTree_AbstractNode
	 * @var array
	 */
	private $childNodes = array();

	/**
	 * Setter for ChildNodes - as defined in ChildNodeAccessInterface
	 *
	 * @param array $childNodes Child nodes of this syntax tree node
	 * @return void
	 */
	public function setChildNodes(array $childNodes) {
		$this->childNodes = $childNodes;
	}
	
	
	/**
	 * renders <f:then> child if $condition is true, otherwise renders <f:else> child.
	 *
	 * 
	 * @return string the rendered string
	 */
	public function render() {
		$file=t3lib_extMgm::extPath('phonegap').'Public/phonegap.js';
		$code='<script type="text/javascript" src="' . $file . '"></script>';
		$GLOBALS['TSFE']->additionalHeaderData[$key] = $code;
		
		$output='<script>';
		$output.='function capturePhoto(){navigator.camera.getPicture(onSuccess, onFail, { quality: 50, destinationType: Camera.DestinationType.FILE_URI });}'; 
		$output.='function onSuccess(imageURI) {'.$this->renderSuccessChild().'}';
		$output.='function onFail(message) {'.$this->renderSuccessChild().'}';
		$output.='</script>';
		return $output;
	}
	
	protected function renderSuccessChild() {
		if ($this->arguments->hasArgument('success')) {
			return $this->arguments['success'];
		}

		foreach ($this->childNodes as $childNode) {

			
			if ($childNode instanceof Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode
				&& $childNode->getViewHelperClassName() === 'Tx_Phonegap_ViewHelpers_SuccessViewHelper') {
				$data = $childNode->evaluate($this->getRenderingContext());
				return $data;
			}
		}
		
	}
	
	protected function renderErrorChild() {
		if ($this->arguments->hasArgument('error')) {
			return $this->arguments['error'];
		}

		foreach ($this->childNodes as $childNode) {

			
			if ($childNode instanceof Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode
				&& $childNode->getViewHelperClassName() === 'Tx_Phonegap_ViewHelpers_ErrorViewHelper') {
				$data = $childNode->evaluate($this->getRenderingContext());
				return $data;
			}
		}
		
	}
	
}
?>
