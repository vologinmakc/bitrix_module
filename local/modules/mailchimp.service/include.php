<?
// Подгрузим нужные классы
Bitrix\Main\Loader::registerAutoloadClasses(
    "mailchimp.service",
    array(
        "mailchimp\\service\\Test" => "lib/test.php",
    )
);
?>
