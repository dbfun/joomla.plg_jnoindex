<?php

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

$mainframe->registerEvent('onPrepareContent', 'jnoindex');


function jnoindex(&$row, &$params, $page=0)
{
	if (is_object($row)) {
		return JNdx($row->text, $params);
	}
	return JNdx($row, $params);
}

function JNdx(&$text, &$params)
{

	/*
	 * Check for presence of {noindex} which enable
	 * bot for the item.
	 */
	if (JString::strpos($text, '{noindex}') !== false) {
		$text = JString::str_ireplace('{noindex}', '', $text);
		$menu = &JSite::getMenu();
		if ($menu->getActive() == $menu->getDefault()) return true;
		$document =& JFactory::getDocument();
		$document->setMetaData('ROBOTS', 'NOINDEX, FOLLOW');
	}
	return true;
}

?>