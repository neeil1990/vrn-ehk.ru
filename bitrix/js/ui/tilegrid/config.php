<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

return array(
	"css" => array(
		"/bitrix/js/ui/tilegrid/css/style.css"
	),
	"js" => array(
		"/bitrix/js/ui/tilegrid/grid.js",
		"/bitrix/js/ui/tilegrid/item.js",
		"/bitrix/js/ui/tilegrid/dragdrop.js"
	),
	"bundle_js" => "ui_tilegrid",
	"bundle_css" => "ui_tilegrid",
	"rel" => [
		"ui.design-tokens",
	],
);