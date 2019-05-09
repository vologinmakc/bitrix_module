<?php

namespace Mailchimp\Service;

use	Bitrix\Main\HttpApplication;

class Test
{
    public function get()
    {
        $request = HttpApplication::getInstance()->getContext()->getRequest();
        echo "<pre>";
        var_dump(htmlspecialcharsbx($request['mid']));
        echo "</pre>";
    }
}

?>
