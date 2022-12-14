<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $PHOENIX_TEMPLATE_ARRAY;


if($PHOENIX_TEMPLATE_ARRAY["ITEMS"]["RATING"]["ITEMS"]["USE_VOTE"]["VALUE"]["ACTIVE"] == "Y" && $PHOENIX_TEMPLATE_ARRAY["ITEMS"]["RATING"]["ITEMS"]["USE_REVIEW"]["VALUE"]["ACTIVE"] == "Y" && !empty($arResult["ITEMS_ID"]))
        
{
    CPhoenix::setMess(array("rating"));
    
    $arReview = CPhoenix::getReviewsInfo(array("PRODUCT_ID"=>$arResult["ITEMS_ID"], "SITE_ID"=> SITE_ID, "select"=> array("PRODUCT_ID", "VOTE_SUM", "VOTE_COUNT", "REVIEWS_COUNT")));


    foreach ($arResult["ITEMS_ID"] as $itemID)
    {
        $reviewCount = 0;

        if(!empty($arReview[$itemID]))
        {

            if($arReview[$itemID]["VOTE_SUM"] && $arReview[$itemID]["VOTE_COUNT"])
                $arResult["rating"][$itemID] = round($arReview[$itemID]["VOTE_SUM"] / $arReview[$itemID]["VOTE_COUNT"]);
            else
                $arResult["rating"][$itemID] = 0;


            $reviewCount = $arReview[$itemID]["REVIEWS_COUNT"];
        }

        $arResult["reviews"][$itemID] = $reviewCount."&nbsp;".CPhoenix::getTermination(
            $reviewCount, 
            array(
                $PHOENIX_TEMPLATE_ARRAY["MESS"]["RATING"]["CONTAINER_DESC_CNT_1"],
                $PHOENIX_TEMPLATE_ARRAY["MESS"]["RATING"]["CONTAINER_DESC_CNT_2"],
                $PHOENIX_TEMPLATE_ARRAY["MESS"]["RATING"]["CONTAINER_DESC_CNT_3"],
                $PHOENIX_TEMPLATE_ARRAY["MESS"]["RATING"]["CONTAINER_DESC_CNT_4"]
            )
        );
    }

    
}
?>

<?\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID("area");?>
<?if(!empty($arResult["rating"]) || !empty($arResult["reviews"])):?>
<script>
    $(document).ready(function(){
        <?if(!empty($arResult["rating"])):?>
            <?foreach ($arResult["rating"] as $key => $value){?>
                setRatingProduct(<?=$key?>, <?=$value?>);
            <?}?>
        <?endif;?>

        <?if(!empty($arResult["reviews"])):?>

            <?foreach ($arResult["reviews"] as $key => $value){?>
                setReviewsCountProduct(<?=$key?>, "<?=$value?>");
            <?}?>

        <?endif;?>
    });
</script>
<?endif;?>

<?

    $arProductsAmountByStore=array();

    if($PHOENIX_TEMPLATE_ARRAY["ITEMS"]["STORE"]["ITEMS"]["SHOW_RESIDUAL"]["VALUE"]["ACTIVE"] === "Y" && !empty($PHOENIX_TEMPLATE_ARRAY["ITEMS"]["CATALOG"]["ITEMS"]["STORES_ID"]))
    {
        $arProductsAmountByStore = CPhoenix::getProductsAmountByStore($arResult['ITEMS']);
    }

    if(!empty($arProductsAmountByStore))
    {
        foreach ($arResult['ITEMS'] as $keyItem => $arItem)
        {
            if($arItem['CONFIG']["SHOW_OFFERS"] && $arItem['HAVEOFFERS'])
            {
                foreach ($arItem['OFFERS'] as $keyOffer => $arOffer)
                    CPhoenix::parseProductByAmount($arOffer, $arProductsAmountByStore[$arOffer["ID"]]);
                
            }
            else
            {
                CPhoenix::parseProductByAmount($arItem, $arProductsAmountByStore[$arItem["ID"]]);
            }
        }
        
    }
?>

<?if(!empty($arResult['ITEMS'])):?>

<?foreach ($arResult['ITEMS'] as $keyItem => $arItem):?>
    <?
        unset($arItem["FIRST_ITEM"], $arItem["SKU_PROPS"]);
    ?>
    <script>
      var <?=$arItem['VISUAL']['ID']?> = new JCCatalogItem(<?=CUtil::PhpToJSObject($arItem, false, true)?>);
    </script>

<?endforeach;?>
<?endif;?>

<?\Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID("area");?>