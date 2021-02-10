<?php

namespace Casintec\Pagseguro;

class Config {

    const SANDBOX = true;

    const SANDBOX_EMAIL = "lev_wand@hotmail.com";
    const PRODUCTION_EMAIL = "lev_wand@hotmail.com";

    const SANDBOX_TOKEN = "13379AE137EA400B8C38DC59044EA796";
    const PRODUCTION_TOKEN = "F4A2D3F4830C472C9F4EC4084BA4ACB5";

    const SANDBOX_SESSIONS = "https://ws.sandbox.pagseguro.uol.com.br/v2/sessions";
    const PRODUCTION_SESSIONS = "https://ws.pagseguro.uol.com.br/v2/sessions";

    const SANDBOX_URL_JS = "https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";
    const PRODUCTION_URL_JS = "https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js";

    public static function getAuth(){

        if(Config::SANDBOX === true){

            return [
                "email"=>Config::SANDBOX_EMAIL,
                "token"=>Config::SANDBOX_TOKEN
            ];

        } else {

            return [
                "email"=>Config::PRODUCTION_EMAIL,
                "token"=>Config::PRODUCTION_TOKEN
            ];

        }

    }

    public static function getUrlSessions():String{

        return (Config::SANDBOX === true) ? Config::SANDBOX_SESSIONS : Config::PRODUCTION_SESSIONS;

    }

    public static function getUrlJs():String{

        return (Config::SANDBOX === true) ? Config::SANDBOX_URL_JS : Config::PRODUCTION_URL_JS;

    }

}

?>