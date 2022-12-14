<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\UI\Extension;

Extension::load(['ui.fonts.opensans', 'ui.hint']);

$requestDomainName = $this->getComponent()->request('param');
?>
<div id="landing-domain-block-b24" class="landing-domain-block">
	<div class="landing-domain-block-title"><?= Loc::getMessage('LANDING_TPL_BITRIX24_SUBTITLE', ['#POSTFIX#' => '*' . $arResult['POSTFIX']]);?></div>
	<div class="landing-domain-block-label">
		<?= Loc::getMessage('LANDING_TPL_BITRIX24_DOMAIN_NAME') ?>
		<span data-hint="<?= Loc::getMessage('LANDING_TPL_DOMAIN_RULES_B24') ?>" data-hint-html></span>
	</div>
	<div class="landing-domain-block-bitrix24-wrap">
		<div class="landing-domain-block-bitrix24">
			<span class="landing-domain-block-prefix">https://</span>
			<div class="ui-ctl ui-ctl-textbox ui-ctl-w100">
				<div class="ui-ctl-ext-after ui-ctl-icon-loader" id="domain-edit-loader" hidden></div>
				<div class="domain-edit-length" id="domain-edit-length" hidden></div>
				<input type="text" name="param" value="<?= \htmlspecialcharsbx($requestDomainName ? $requestDomainName : $arResult['B24_DOMAIN_NAME']);?>" <?
					?>id="domain-edit-name" class="ui-ctl-element" placeholder="mydomain">
			</div>
			<span class="landing-domain-block-postfix"><?= $arResult['POSTFIX'];?></span>
		</div>
		<div class="landing-domain-alert" id="domain-edit-message" hidden></div>
	</div>
</div>
<button type="submit" class="ui-btn ui-btn-primary" id="domain-edit-submit">
	<?= Loc::getMessage('LANDING_TPL_SAVE');?>
</button>

<script>
	BX.ready(function()
	{
		new BX.Landing.SiteDomain.Bitrix24({
			domainId: <?= $arResult['DOMAIN_ID'];?>,
			domainName: '<?= \CUtil::jsEscape($arResult['~DOMAIN_NAME']);?>',
			domainPostfix: '<?= $arResult['POSTFIX']?>',
			idDomainName: BX('domain-edit-name'),
			idDomainMessage: BX('domain-edit-message'),
			idDomainLoader: BX('domain-edit-loader'),
			idDomainLength: BX('domain-edit-length'),
			idDomainSubmit: BX('domain-edit-submit'),
			idDomainErrorAlert: BX('domain-error-alert'),
			tld: <?= \CUtil::phpToJSObject($arResult['TLD'][0])?>,
		});

		BX.UI.Hint.init(BX('landing-domain-block-b24'));
	});
</script>