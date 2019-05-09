<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if ($APPLICATION->GetGroupRight('conversion') == 'D')
{
	return false;
}
else
{
	$menu = array(
		array(
			'parent_menu' => 'global_menu_services',
			'sort' => 100,
			'text' => Loc::getMessage('MAILCHIMP_SERVICE_MENU_TEXT'),
			'title' => Loc::getMessage('MAILCHIMP_SERVICE_MENU_TITLE'),
			'icon' => 'excel_menu_icon',
			'page_icon' => 'excel_menu_icon',
			'items_id' => 'menu_excel',
			'url' => 'mailchimp_service.php?lang='.LANGUAGE_ID,
			'module_id' => 'mailchimp.service'
		),
	);

	return $menu;
}

?>
