<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

Loc::loadMessages(__FILE__);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

if ($APPLICATION->GetGroupRight('conversion') == 'X')
{
	return false;
}

CModule::IncludeModule('mailchimp.service');

$APPLICATION->SetTitle(Loc::getMessage("MAILCHIMP_SERVICE_TITLE"));
?>

<?

echo(\Bitrix\Main\Config\Option::get('mailchimp.service','api_key'));
?>


<?
if (!IsModuleInstalled("mailchimp.service")){
	return false;
}
