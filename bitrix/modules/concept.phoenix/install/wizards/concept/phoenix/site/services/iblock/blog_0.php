<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

set_time_limit(0);

if(!CModule::IncludeModule("iblock"))
	return;

$lang = "ru";
WizardServices::IncludeServiceLang("lang_blog.php", $lang);

$iblockXMLFile = WIZARD_SERVICE_RELATIVE_PATH."/xml/ru/blog_0.xml";

$iblockCode = "concept_phoenix_blog";
$iblockCode1 = $iblockCode."_".WIZARD_SITE_ID;
$iblockType = "concept_phoenix"."_".WIZARD_SITE_ID;

$iblockID = false; 

$rsIBlock = CIBlock::GetList(array(), array("CODE" => $iblockCode1, "TYPE" => $iblockType));

if($arIBlock = $rsIBlock->Fetch())
	CIBlock::Delete($arIBlock["ID"]); 


$permissions = Array(
	"1" => "X",
	"2" => "R"
);

$dbGroup = CGroup::GetList($by = "", $order = "", Array("STRING_ID" => "content_editor"));
if($arGroup = $dbGroup -> Fetch())
{
	$permissions[$arGroup["ID"]] = 'W';
};

$iblockID = WizardServices::ImportIBlockFromXML(
	$iblockXMLFile,
	$iblockCode,
	$iblockType,
	WIZARD_SITE_ID,
	$permissions
);

if ($iblockID < 1)
	return;



// iblock user fields


$arProperty = array();
$dbProperty = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $iblockID));
while($arProp = $dbProperty->Fetch())
	$arProperty[$arProp["CODE"]] = $arProp["ID"];

$rsData = CUserTypeEntity::GetList(Array(), Array("ENTITY_ID"=>"IBLOCK_".$iblockID."_SECTION"));
while($arRes = $rsData->Fetch())
    $arUF[$arRes["FIELD_NAME"]] = $arRes["ID"];


// edit form user options
$tabs = 'edit1--#--'.GetMessage("PHOENIX_SECTION_1").'--,--'.'ACTIVE--#--'.GetMessage("PHOENIX_SECTION_2").'--,--'.'UF_PHX_MAIN_MENU--#--'.GetMessage("PHOENIX_SECTION_3").'--,--'.'UF_PHX_MAIN_BLG--#--'.GetMessage("PHOENIX_SECTION_4").'--,--'.'NAME--#--'.GetMessage("PHOENIX_SECTION_5").'--,--'.'CODE--#--'.GetMessage("PHOENIX_SECTION_6").'--,--'.'UF_PHX_BLG_TMPL--#--'.GetMessage("PHOENIX_SECTION_7").'--,--'.'UF_PHX_BLG_T_ID--#--'.GetMessage("PHOENIX_SECTION_8").'--,--'.'SORT--#--'.GetMessage("PHOENIX_SECTION_9").'--,--'.'edit1_csection1--#----'.GetMessage("PHOENIX_SECTION_10").'--,--'.'UF_SIDEMENU_HTML--#--'.GetMessage("PHOENIX_SECTION_11").'--;--'.'cedit1--#--'.GetMessage("PHOENIX_SECTION_12").'--,--'.'PICTURE--#--'.GetMessage("PHOENIX_SECTION_13").'--,--'.'UF_PHX_BLG_PRTXT--#--'.GetMessage("PHOENIX_SECTION_14").'--,--'.'UF_PIC_IN_HEAD--#--'.GetMessage("PHOENIX_SECTION_15").'--,--'.'cedit1_csection1--#----'.GetMessage("PHOENIX_SECTION_16").'--,--'.'UF_PHX_MENU_PICT--#--'.GetMessage("PHOENIX_SECTION_17").'--;--'.'edit5--#--SEO--,--'.'UF_PHX_BLG_H1--#--H1--,--'.'UF_PHX_BLG_TITLE--#--Title--,--'.'UF_PHX_BLG_KWORD--#--Keywords--,--'.'UF_PHX_BLG_DSCR--#--Description--,--'.'DESCRIPTION--#--'.GetMessage("PHOENIX_SECTION_18").'--,--'.'UF_PHX_TXT_P--#--'.GetMessage("PHOENIX_SECTION_19").'--,--'.'UF_PHX_SEO_TOP--#--'.GetMessage("PHOENIX_SECTION_20").'--;--'.'cedit2--#--'.GetMessage("PHOENIX_SECTION_21").'--,--'.'UF_PHX_BNRS_VIEW--#--'.GetMessage("PHOENIX_SECTION_22").'--,--'.'UF_PHX_BLG_BNNRS--#--'.GetMessage("PHOENIX_SECTION_23").'--;--'.'';
     
CUserOptions::SetOption("form", "form_section_".$iblockID, 
    array(
        "tabs" => $tabs
    ),
    true
);


CUserOptions::SetOption("list", "tbl_iblock_list_".md5($iblockType.".".$iblockID), array ( 'columns' => 'NAME,SORT,ACTIVE,ID', 'by' => 'sort', 'order' => 'asc', 'page_size' => '20', ),
    true
);

foreach($arProperty as $key=>$propID)
{        
    if(strlen(GetMessage("PHOENIX_ELEMENT_HINT_$key")) > 0)
    {
        $arFields = Array("HINT"=>GetMessage("PHOENIX_ELEMENT_HINT_$key"));
        $ibp = new CIBlockProperty;
        $ibp->Update($propID, $arFields);
    }
}

foreach($arUF as $key=>$UFid)
{
    $oUserTypeEntity = new CUserTypeEntity();;
    $oUserTypeEntity->Update($UFid, 
        array(
            'EDIT_FORM_LABEL' => array('ru' => GetMessage("PHOENIX_SECTION_NAME_$key")),
            'HELP_MESSAGE'=> array('ru' => GetMessage("PHOENIX_SECTION_HELP_$key"))
        ) 
    );
}

CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.'/blog/index.php', array("IBLOCK_BLOG" => $iblockID));
CWizardUtil::ReplaceMacros(WIZARD_SITE_PATH.'/blog/index.php', array("IBLOCK_TYPE" => $iblockType));

?>
