<?php

use Bitrix\Main\Loader;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}
$currencyId = '';
$currencySymbol = '';
if (\Bitrix\Main\Loader::includeModule('currency'))
{
	$currencyId = \Bitrix\Currency\CurrencyManager::getBaseCurrency();
	$format = \CCurrencyLang::GetFormatDescription($currencyId);
	$currencySymbol = isset($format['FORMAT_STRING']) ? trim(\CCurrencyLang::applyTemplate('', $format['FORMAT_STRING'])) : '';
}

$basePriceId = null;
$hasLandingStore = false;
$isEnabledLanding = false;
$isLimitedLanding = false;
$isCatalogAccess = false;
$isCatalogSettingAccess = false;
$isCatalogPriceEditEnabled = false;
$isCatalogPriceSaveEnabled = false;
$isCatalogDiscountSetEnabled = false;

if (Loader::includeModule('catalog'))
{
	$baseGroup = \CCatalogGroup::GetBaseGroup();
	$basePriceId = (is_array($baseGroup) && isset($baseGroup['ID'])) ? (int)$baseGroup['ID'] : null;

	if (\Bitrix\Main\Loader::includeModule('landing'))
	{
		$isEnabledLanding = true;
		$hasLandingStore = Bitrix\Catalog\v2\Integration\Landing\StoreV3Master::hasStore();
		$isLimitedLanding = !$hasLandingStore && !Bitrix\Catalog\v2\Integration\Landing\StoreV3Master::canCreate();
	}

	$accessController = \Bitrix\Catalog\Access\AccessController::getCurrent();

	$isCatalogPriceEditEnabled = $accessController->check(\Bitrix\Catalog\Access\ActionDictionary::ACTION_PRICE_ENTITY_EDIT);
	$isCatalogPriceSaveEnabled = $accessController->check(\Bitrix\Catalog\Access\ActionDictionary::ACTION_PRICE_EDIT);
	$isCatalogDiscountSetEnabled = $accessController->check(\Bitrix\Catalog\Access\ActionDictionary::ACTION_PRODUCT_DISCOUNT_SET);
	$isCatalogSettingAccess = $accessController->check(\Bitrix\Catalog\Access\ActionDictionary::ACTION_CATALOG_SETTINGS_ACCESS);
	$isCatalogAccess = $accessController->check(\Bitrix\Catalog\Access\ActionDictionary::ACTION_CATALOG_READ);
}

return [
	'css' => 'dist/product-form.bundle.css',
	'js' => 'dist/product-form.bundle.js',
	'rel' => [
		'ui.design-tokens',
		'ui.fonts.opensans',
		'currency',
		'ui.layout-form',
		'ui.forms',
		'ui.buttons',
		'ui.common',
		'ui.alerts',
		'catalog.product-selector',
		'ui.entity-selector',
		'catalog.product-model',
		'ui.vue.vuex',
		'ui.vue',
		'main.popup',
		'main.core',
		'main.loader',
		'ui.label',
		'ui.messagecard',
		'ui.vue.components.hint',
		'ui.notification',
		'ui.info-helper',
		'main.qrcode',
		'clipboard',
		'helper',
		'catalog.store-use',
		'ui.hint',
		'main.core.events',
		'currency.currency-core',
		'catalog.product-calculator',
	],
	'settings' => [
		'warehouseOption' => \Bitrix\Catalog\Component\UseStore::isUsed(),
		'showDiscountBlock' => \CUserOptions::GetOption('catalog.product-form', 'showDiscountBlock', 'Y'),
		'showTaxBlock' => 'N',
		'taxIncluded' => 'N',
		'currency' => $currencyId,
		'currencySymbol' => $currencySymbol,
		'isEnabledLanding' => $isEnabledLanding,
		'hasLandingStore' => $hasLandingStore,
		'isLimitedLandingStore' => $isLimitedLanding,
		'basePriceId' => $basePriceId,
		'isCatalogDiscountSetEnabled' => $isCatalogDiscountSetEnabled,
		'isCatalogPriceEditEnabled' => $isCatalogPriceEditEnabled,
		'isCatalogPriceSaveEnabled' => $isCatalogPriceSaveEnabled,
		'isCatalogSettingAccess' => $isCatalogSettingAccess,
		'isCatalogAccess' => $isCatalogAccess,
		'fieldHints' => [],
		'hiddenCompilationInfoMessage' => \CUserOptions::GetOption('catalog.product-form', 'hiddenCompilationInfoMessage') === 'Y',
	],
	'skip_core' => false,
];
