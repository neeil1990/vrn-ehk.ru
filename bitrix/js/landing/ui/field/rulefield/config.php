<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

return [
	'css' => 'dist/rulefield.bundle.css',
	'js' => 'dist/rulefield.bundle.js',
	'rel' => [
		'ui.fonts.opensans',
		'landing.ui.field.basefield',
		'landing.ui.component.actionpanel',
		'ui.design-tokens',
		'main.core',
		'main.core.events',
		'landing.ui.component.internal',
		'landing.ui.component.iconbutton',
		'landing.loc',
		'ui.draganddrop.draggable',
		'landing.pageobject',
		'landing.ui.field.textfield',
		'main.popup',
	],
	'skip_core' => false,
];