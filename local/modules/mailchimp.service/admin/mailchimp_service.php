<?php

use Bitrix\Main\ModuleManager;
use Bitrix\Main\Localization\Loc;
use Mailchimp\Service;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");

# Добавим стили
//CJSCore::RegisterExt('partner_css', array(
//    'css' => array(
//        '/bitrix/css/main/bootstrap.css',
//    )
//));
//CJSCore::Init(array("partner_css"));

# Языковые файлы
Loc::loadMessages(__FILE__);

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

# Прорверим прова пользователя
if ($APPLICATION->GetGroupRight('conversion') == 'X')
{
	return false;
}

# Если модуль не установлен прекращаем активность
if (!IsModuleInstalled("mailchimp.service")){
    return false;
}

# Подключаем модуль
CModule::IncludeModule('mailchimp.service');



# Устанавливаем заголовок
$APPLICATION->SetTitle(Loc::getMessage("MAILCHIMP_SERVICE_TITLE"));
?>

<?
$api_key = \Bitrix\Main\Config\Option::get('mailchimp.service', 'api_key');
$mailchimp = new Service\ApiMailchimp($api_key, 'us20');

$list_id = 'c8cc1cfd27';
$plain = "От админа с любовью!";
$html = "<h1>Привет Народ!!!</h1>";
$res = $mailchimp->createCamping($list_id, 'Новая вакансия на AppJobs.ru', 'AppJobs', 'vologinmakc@gmail.com');

# Получим id новой компании
$camp_id = $res->id;

// Добавлем к ней контент
$res = $mailchimp->createCampingContent($plain, $html, $camp_id);

# Отправка рассылки
$res = $mailchimp->sendCamping($camp_id);

/*$company_account = $mailchimp->getCampaigns();
foreach ($company_account->campaigns as $campaign)
{
    echo "<pre>";
    var_dump($campaign->settings->title);
    echo "</pre>";
}*/?>
<pre>
<?
var_dump($camp_id);
?>
</pre>
