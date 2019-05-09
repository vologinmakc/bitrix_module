<?php

namespace Mailchimp\Service;

use Bitrix\Main\Config\Option;

class RegisterUser
{
    function createOptions(&$arFields)
    {
        if ($arFields["USER_ID"] > 0)
        {
            Option::set('mailchimp.service', 'api_key', is_array($arFields["USER_ID"]) ? implode(",", $arFields["USER_ID"]) : $arFields["USER_ID"]);
        }
    }
}

?>
