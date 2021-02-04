<?php

namespace Casintec\Model;

use \Casintec\DB\Sql;
use \Casintec\Model;

class Address extends Model{

    const SESSION_ERROR = "AddressError";

    public static function getCep($nrcep){

        $nrcep = str_replace("-", "", $nrcep);

        $ch = curl_init();

        CURL_SETOPT($ch, CURLOPT_URL, "https://viacep.com.br/ws/$nrcep/json/");

        CURL_SETOPT($ch, CURLOPT_RETURNTRANSFER, true);
        CURL_SETOPT($ch, CURLOPT_SSL_VERIFYPEER, false);

        $data = json_decode(CURL_EXEC($ch), true);

        curl_close($ch);

        return $data;


    }

    public function loadFromCep($nrcep){

        $data = Address::getCep($nrcep);

        if(isset($data['logradouro']) && $data['logradouro']){

            $this->setdesaddress($data['logradouro']);
            $this->setdescomplement($data['complemento']);
            $this->setdesdistrict($data['bairro']);
            $this->setdescity($data['localidade']);
            $this->setdesstate($data['uf']);
            $this->setdescountry('Brasil');
            $this->setdeszipcode($nrcep);

        }

    }

    public function save(){

        $sql = new Sql();
        
        $results = $sql->select("CALL sp_addresses_save(:idaddress, :idperson, :desaddress, :descomplement, :descity, :desstate, :descountry, :deszipcode, :desdistrict)", [
            ':idaddress'=>$this->getidaddress(),
            ':idperson'=>$this->getidperson(),
            ':desaddress'=>utf8_decode($this->getdesaddress()),
            ':descomplement'=>utf8_decode($this->getdescomplement()),
            ':descity'=>utf8_decode($this->getdescity()),
            ':desstate'=>utf8_decode($this->getdesstate()),
            ':descountry'=>utf8_decode($this->getdescountry()),
            ':deszipcode'=>$this->getdeszipcode(),
            ':desdistrict'=>$this->getdesdistrict()
        ]);

        if (count($results) > 0){
            $this->setData($results[0]);
        }

    }

    public static function setMsgError($msg){

        $_SESSION[Address::SESSION_ERROR] = $msg;

    }

    public static function getMsgError(){
        
        return (isset($_SESSION[Address::SESSION_ERROR])) ? $_SESSION[Address::SESSION_ERROR] : "";

        Address::clearMsgError();

        return $msg;

    }

    public static function clearMsgError(){

        $_SESSION[Address::SESSION_ERROR] = NULL;

    }


}

?>