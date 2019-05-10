<?php

namespace Mailchimp\Service;

use Bitrix\Main\Config\Option;
use CJSCore;
use Mailchimp\Service\ApiMailchimp;

class RegisterUser
{
    # при регистрации нового пользователя добавим его в лист рассылки
    function addToListMailchimp(&$arFields)
    {
        if ($arFields["USER_ID"] > 0)
        {
            # получим необходимые данные для работы list_id, api_key, us-преффикс
            $list_id = Option::get('mailchimp.service', 'list_id');
            $us_site = Option::get('mailchimp.service', 'us');
            $api_key = Option::get('mailchimp.service', 'api_key');

            # если данные не пустые добавим пользователя к рассылки
            if(!empty($list_id ) and !empty($us_site) and !empty($api_key))
            {
                $mailchimp = new ApiMailchimp($api_key, $us_site);
                $mailchimp->addSubscriber($list_id, $arFields["EMAIL"], $arFields["NAME"], $arFields["LAST_NAME"]);
                # Добавим js
                CJSCore::RegisterExt('success_js', array(
                    'js' => array(
                        '\local\modules\mailchimp.service\asset\js\register_success.js',
                    )
                ));
                CJSCore::Init(array("success_js"));
            }

        }
    }# при регистрации нового пользователя добавим его в лист рассылки
}

?>
