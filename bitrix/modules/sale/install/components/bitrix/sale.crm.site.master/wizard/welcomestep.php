<?php

namespace Bitrix\Sale\CrmSiteMaster\Steps;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

/**
 * Class WelcomeStep
 * Step with welcome information
 *
 * @package Bitrix\Sale\CrmSiteMaster\Steps
 */
class WelcomeStep extends \CWizardStep
{
	private $currentStepName = __CLASS__;

	/** @var \SaleCrmSiteMaster */
	private $component = null;

	/**
	 * Check step errors
	 */
	private function setStepErrors()
	{
		$errors = $this->component->getWizardStepErrors($this->currentStepName);
		if ($errors)
		{
			foreach ($errors as $error)
			{
				$this->SetError($error);
			}
		}
	}

	/**
	 * Prepare next/prev buttons
	 *
	 * @throws \ReflectionException
	 */
	private function prepareButtons()
	{
		$steps = $this->component->getSteps($this->currentStepName);

		$shortClassName = (new \ReflectionClass($this))->getShortName();

		if (isset($steps["NEXT_STEP"]))
		{
			$this->SetNextStep($steps["NEXT_STEP"]);
			$this->SetNextCaption(Loc::getMessage("SALE_CSM_WIZARD_".mb_strtoupper($shortClassName)."_NEXT"));
		}
		if (isset($steps["PREV_STEP"]))
		{
			$this->SetPrevStep($steps["PREV_STEP"]);
			$this->SetPrevCaption(Loc::getMessage("SALE_CSM_WIZARD_".mb_strtoupper($shortClassName)."_PREV"));
		}
	}

	/**
	 * Initialization step id, title and next step
	 *
	 * @throws \ReflectionException
	 */
	public function initStep()
	{
		$this->component = $this->GetWizard()->GetVar("component");

		$this->SetStepID($this->currentStepName);
		$this->SetTitle(Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_TITLE"));

		$this->prepareButtons();

		$this->setStepErrors();
	}

	/**
	 * Show step content
	 */
	public function showStep()
	{
		if ($this->GetErrors())
		{
			return false;
		}

		ob_start();
		?>
		<img class="adm-crm-site-master-attention" src="<?=$this->component->getPath()?>/wizard/images/attention.svg" alt="">
		<div class="adm-crm-site-master-paragraph"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DESCR1")?></div>
		<div class="adm-crm-site-master-paragraph"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_ITEMS")?></div>

		<ul class="adm-crm-site-master-list">
			<li class="adm-crm-site-master-list-item step-list-item-1"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DESCR_ITEM1")?></li>
			<li class="adm-crm-site-master-list-item step-list-item-2"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DESCR_ITEM2")?></li>
			<li class="adm-crm-site-master-list-item step-list-item-3"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DESCR_ITEM3")?></li>
		</ul>

		<div class="adm-crm-site-master-paragraph"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DESCR_DESCR2")?></div>

		<div class="adm-crm-site-master-paragraph">
			<a class="adm-crm-site-popup-documentation-link" onclick="BX.Helper.show('redirect=detail&code=10412476');"><?=Loc::getMessage("SALE_CSM_WIZARD_WELCOMESTEP_DOCUMENTATION_LINK")?></a>
		</div>
		<?
		$content = ob_get_contents();
		ob_end_clean();

		$this->content = $content;

		return true;
	}

	/**
	 * @return array
	 */
	public function showButtons()
	{
		ob_start();
		if ($this->GetNextStepID() !== null)
		{
			?>
			<input type="hidden" name="<?=$this->GetWizard()->nextStepHiddenID?>" value="<?=$this->GetNextStepID()?>">
			<button type="submit" class="ui-btn ui-btn-primary" name="<?=$this->GetWizard()->nextButtonID?>">
				<?=$this->GetNextCaption()?>
			</button>
			<?
		}
		$content = ob_get_contents();
		ob_end_clean();

		return [
			"CONTENT" => $content,
			"NEED_WRAPPER" => true,
			"CENTER" => true,
		];
	}
}