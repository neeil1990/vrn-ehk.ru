<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)
{
	die();
}

/**
 * @global \CMain $APPLICATION
 */

if (defined('SITE_TEMPLATE_ID') && SITE_TEMPLATE_ID === 'bitrix24')
{
	\Bitrix\Main\UI\Extension::load('ui.icons.disk');
}

\Bitrix\Main\UI\Extension::load([
	'ui.buttons',
	'ui.icons',
	'ui.buttons.icons',
	'ui.alerts',
	'ui.notification',
	'ui.stepprocessing',
]);
