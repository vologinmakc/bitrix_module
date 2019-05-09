<?
// Подгрузим нужные классы
Bitrix\Main\Loader::registerAutoloadClasses(
    "mailchimp.service",
    array(
        "mailchimp\\service\\Test" => "lib/test.php",
        "mailchimp\\service\\RegisterUserEvent" => "lib/register_user.php"
    )
);
?>
