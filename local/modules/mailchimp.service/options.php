<?php

use Bitrix\Main\Localization\Loc;
use	Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);

# секция описания вкладок и настроек
$aTabs = array(
    array(
        "DIV" 	  => "edit1",
        "TAB" 	  => Loc::getMessage("MAILCHIMP_SERVICE_OPTIONS_TAB_NAME"),
        "TITLE"   => Loc::getMessage("MAILCHIMP_SERVICE_OPTIONS_TAB_NAME"),
        "OPTIONS" => array(
            Loc::getMessage("MAILCHIMP_SERVICE_OPTIONS_TAB_COMMON"),
            array(
                "api_key",
                Loc::getMessage("MAILCHIMP_SERVICE_OPTIONS_TAB_API_KEY"),
                "",
                array("text",20)
            )
        )
    )
);
# секция описания вкладок и настроек
?>

<?php

$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);

$tabControl->Begin();

?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

	<?
	foreach($aTabs as $aTab)
	{

		if($aTab["OPTIONS"])
		{

			$tabControl->BeginNextTab();
			__AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
		}
	}

	$tabControl->Buttons();
	?>

	<input type="submit" name="apply" value="<? echo(Loc::GetMessage("MAILCHIMP_SERVICE_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />

	<?
	echo(bitrix_sessid_post());
	?>

</form>

<?
$tabControl->End();
?>

<?php
/*foreach ($aTabs as $aTab)
{
    foreach ($aTab['OPTIONS'] as $arOption)
    {
        if (!is_array($arOption)) //Строка с подсветкой. Используется для разделения настроек в одной вкладке
            continue;

        $optionName = $arOption[0];

        $optionValue = $request->getPost($optionName);

        echo "<pre>";
        var_dump($request[$optionName]);
        echo "</pre>";
    }
}*/

# Сохранение настроек модуля в файле setting.php

if ($request->isPost() && check_bitrix_sessid())
{

    foreach ($aTabs as $aTab)
    {
        foreach ($aTab['OPTIONS'] as $arOption)
        {
            if (!is_array($arOption)) //Строка с подсветкой. Используется для разделения настроек в одной вкладке
                continue;

            if ($arOption['note']) //Уведомление с подсветкой
                continue;

            $optionName = $arOption[0];

            $optionValue = $request->getPost($optionName);

            Option::set($module_id, $optionName, is_array($optionValue) ? implode(",", $optionValue):$optionValue);
        }
    }
}# Сохранение настроек модуля в файле setting.php

$options = Option::get($module_id, 'api_key');
echo "<pre>";
var_dump($options);
echo "</pre>";
?>
