<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if($USER->IsAuthorized() || $arParams["ALLOW_AUTO_REGISTER"] == "Y")
{
	if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
	{
		if(strlen($arResult["REDIRECT_URL"]) > 0)
		{
			$APPLICATION->RestartBuffer();
			?>
			<script type="text/javascript">
				window.top.location.href='<?=CUtil::JSEscape($arResult["REDIRECT_URL"])?>';
			</script>
			<?
			die();
		}

	}
}

$APPLICATION->SetAdditionalCSS($templateFolder."/style_cart.css");
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");

CJSCore::Init(array('fx', 'popup', 'window', 'ajax'));
?>

<a name="order_form"></a>

<div id="order_form_div" class="order-checkout">
<NOSCRIPT>
	<div class="errortext"><?=GetMessage("SOA_NO_JS")?></div>
</NOSCRIPT>

<?
if (!function_exists("getColumnName"))
{
	function getColumnName($arHeader)
	{
		return (strlen($arHeader["name"]) > 0) ? $arHeader["name"] : GetMessage("SALE_".$arHeader["id"]);
	}
}

if (!function_exists("cmpBySort"))
{
	function cmpBySort($array1, $array2)
	{
		if (!isset($array1["SORT"]) || !isset($array2["SORT"]))
			return -1;

		if ($array1["SORT"] > $array2["SORT"])
			return 1;

		if ($array1["SORT"] < $array2["SORT"])
			return -1;

		if ($array1["SORT"] == $array2["SORT"])
			return 0;
	}
}
?>

<div class="bx_order_make">
	<?
	if(!$USER->IsAuthorized() && $arParams["ALLOW_AUTO_REGISTER"] == "N")
	{
		if(!empty($arResult["ERROR"]))
		{
			foreach($arResult["ERROR"] as $v)
				echo ShowError($v);
		}
		elseif(!empty($arResult["OK_MESSAGE"]))
		{
			foreach($arResult["OK_MESSAGE"] as $v)
				echo ShowNote($v);
		}

		include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/auth.php");
	}
	else
	{
		if($arResult["USER_VALS"]["CONFIRM_ORDER"] == "Y" || $arResult["NEED_REDIRECT"] == "Y")
		{
			if(strlen($arResult["REDIRECT_URL"]) == 0)
			{
				include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/confirm.php");
			}
		}
		else
		{
			?>
			<script type="text/javascript">
			$(function(){
			    var idsProps = {
			        select: [26, 29],
                    input: [27, 30]
                };

                $.each(idsProps.select, function (index, value) {
                    var s = value;
                    var i = idsProps.input[index];

                    $('#order_form_div').on('change', `#ORDER_PROP_${s}`, function(event){
                        let self = $(this);
                        if(self.val() == 'CDEK'){
                            $(`#ORDER_PROP_${i}`).val("");
                            showElProp(`#ORDER_PROP_${i}`);
                        }
                        else{
                            $(`#ORDER_PROP_${i}`).val("????????????: " + self.find('option:selected').text());
                            hideElProp(`#ORDER_PROP_${i}`);
                        }
                    });

                    BX.addCustomEvent('onAjaxSuccess', function(){
                        $(`#ORDER_PROP_${s}`).trigger( "change" );
                    });

                    $(`#ORDER_PROP_${s}`).trigger( "change" );
                });

				$( "input[name=ORDER_PROP_15]" ).val($( "input[name=ORDER_PROP_1]" ).val());
				$( "input[name=ORDER_PROP_1]" ).blur(function() {
					var fio = $(this).val();
					$( "input[name=ORDER_PROP_15]" ).val(fio);
				});

				$( "input[name=ORDER_PROP_16]" ).inputmask("9999 999999");
			});
			function hideElProp(id) {
                let inputBlock = $(id).parent();
                inputBlock.hide();
                inputBlock.prev().hide();
            }
            function showElProp(id) {
                let inputBlock = $(id).parent();
                inputBlock.show();
                inputBlock.prev().show();
            }
			function submitForm(val)
			{
				if(val != 'Y')
					BX('confirmorder').value = 'N';

				var orderForm = BX('ORDER_FORM');
				BX.ajax.submitComponentForm(orderForm, 'order_form_content', true);
				BX.submit(orderForm);
				BX.closeWait();

				return true;
			}

			function SetContact(profileId)
			{
				BX("profile_change").value = "Y";
				submitForm();
			}
			</script>

						<?if($_POST["is_ajax_post"] != "Y")
						{
							?><form action="<?=$APPLICATION->GetCurPage();?>" method="POST" name="ORDER_FORM" id="ORDER_FORM" enctype="multipart/form-data">
							<?=bitrix_sessid_post()?>
							<?
						}
						else
						{
							$APPLICATION->RestartBuffer();
						}
						if(!empty($arResult["ERROR"]) && $arResult["USER_VALS"]["FINAL_STEP"] == "Y")
						{
							foreach($arResult["ERROR"] as $v)
								echo ShowError($v);
							?>
							<script type="text/javascript">
								top.BX.scrollToNode(top.BX('ORDER_FORM'));
							</script>
							<?
						}?>

						<div id="order_form_content">
							<div class="orders_side">
								<div class="left_side">
									<div class="style_box">
										<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/person_type.php");
										include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/props.php");
										if ($arParams["DELIVERY_TO_PAYSYSTEM"] == "p2d")
										{
											include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
											include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
										}
										else
										{
											include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/delivery.php");
											include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/related_props.php");
											include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/paysystem.php");
										}
										?>


										<?if(strlen($arResult["PREPAY_ADIT_FIELDS"]) > 0)
											echo $arResult["PREPAY_ADIT_FIELDS"];?>
									</div>
								</div>
								<div class="right_side">
									<?include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/summary.php");?>
								</div>
								<div class="clear"></div>
							</div>
							<?if($_POST["is_ajax_post"] != "Y")
							{
								?>
									</div>
									<div class="fix_input">
										<input type="hidden" name="confirmorder" id="confirmorder" value="Y">
										<input type="hidden" name="profile_change" id="profile_change" value="N">
										<input type="hidden" name="is_ajax_post" id="is_ajax_post" value="Y">
										<div class="req_text">
											* - ???????? ???????????????????????? ?????? ????????????????????
										</div>
										<div class="pay_button"><a href="javascript:void();" onclick="submitForm('Y'); return false;" class="checkout"><?=GetMessage("SOA_TEMPL_BUTTON")?></a></div>
										<div class="clear"></div>
									</div>
									<div class="clear"></div>
									<?if($USER->IsAuthorized())
									{
										$ar_cur_user=CUser::GetByID($USER->GetID());
										if($cur_user=$ar_cur_user->Fetch())
										{
											if($cur_user["UF_LEGAL"]==1)
											{?>
												<script type="text/javascript">
													document.getElementById("PERSON_TYPE_2").checked="checked";
													submitForm();
												</script>
											<?}
										}
									}?>
								</form>
								<?
								if($arParams["DELIVERY_NO_AJAX"] == "N")
								{
									?>
									<div style="display:none;"><?$APPLICATION->IncludeComponent("bitrix:sale.ajax.delivery.calculator", "", array(), null, array('HIDE_ICONS' => 'Y')); ?></div>
									<?
								}
							}
							else
							{
								?>
								<script type="text/javascript">
									top.BX('confirmorder').value = 'Y';
									top.BX('profile_change').value = 'N';
								</script>
								<?
								die();
							}?>


		<?}
	}
	?>
	</div>
</div>
<?if($_REQUEST["pay"]=='user'){?>
<script>
	//$(document).ready(function(){
	$('#s2u-uniteller-payment-form').submit();
	//})
</script>
<?}?>
