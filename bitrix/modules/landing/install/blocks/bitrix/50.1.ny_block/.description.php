<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use \Bitrix\Main\Localization\Loc;

return array(
	'block' => array(
		'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_NAME'),
		'section' => array('cover'),
		'dynamic' => false,
	),
	'cards' => array(),
	'nodes' => array(
		'.landing-block-node-card-img' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_NODES_LANDINGBLOCKNODECARD_IMG'),
			'type' => 'img',
			'editInStyle' => true,
			'allowInlineEdit' => false,
			'dimensions' => array('width' => 1920, 'height' => 1080),
			'create2xByDefault' => false,
		),
		'.landing-block-node-card-title' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_NODES_LANDINGBLOCKNODECARDTITLE'),
			'type' => 'text',
		),
		'.landing-block-node-card-text' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_NODES_LANDINGBLOCKNODECARDTEXT'),
			'type' => 'text',
		),
		'.landing-block-node-card-button' => array(
			'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_STYLE_LANDINGBLOCKNODECARDBUTTON'),
			'type' => 'link',
		),
	),
	'style' => array(
		'block' => array(
			'type' => array('block-default-wo-background'),
		),
		'nodes' => array(
			'.landing-block-node-card-title' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_STYLE_LANDINGBLOCKNODECARDTITLE'),
				'type' => ['typo', 'animation', 'heading'],
			),
			'.landing-block-node-card-text' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_STYLE_LANDINGBLOCKNODECARDTEXT'),
				'type' => array('typo', 'animation'),
			),
			'.landing-block-node-card-img' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_NODES_LANDINGBLOCKNODECARD_IMG'),
				'type' => ['background', 'height-vh', 'background-attachment'],
			),
			'.landing-block-node-card-button' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_STYLE_LANDINGBLOCKNODECARDBUTTON'),
				'type' => array('background-color', 'animation'),
			),
			'.landing-block-node-card-button-container' => array(
				'name' => Loc::getMessage('LANDING_BLOCK_50.1.NEW_YEAR_STYLE_LANDINGBLOCKNODECARDBUTTON'),
				'type' => array('text-align'),
			),
		),
	),
);