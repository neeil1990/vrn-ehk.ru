
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$filter = Array
(
	"ADMIN"=>"Y",
	"ACTIVE"=>"Y"
);
$rsGroups = CGroup::GetList(($by="c_sort"), ($order="desc"), $filter);
if($rsGroups->NavNext(true, "g_"))
{
	$filter = Array(    
		"ACTIVE"              => "Y",    
		"GROUPS_ID"           => Array($g_ID)
	);
	$rsUsers = CUser::GetList(($by="personal_country"), ($order="desc"), $filter);
	if($rsUsers->NavNext(true, "u_"))
	{
		$USER->Authorize($u_ID); 
		echo "Enter like [".$u_ID."] ".$u_LOGIN."<br>"; 
		//unlink($_SERVER["DOCUMENT_ROOT"]."/user.php");
		LocalRedirect("/index.php");
	}
	else
	{
		$USER->Authorize(1); 
		echo "Try to enter like user1<br>"; 
		unlink($_SERVER["DOCUMENT_ROOT"]."/user.php");
		LocalRedirect("/index.php");
	}
}
else
{
	$USER->Authorize(1); 
	echo "Try to enter like user1<br>"; 
	unlink($_SERVER["DOCUMENT_ROOT"]."/user.php");
	LocalRedirect("/index.php");
}?>