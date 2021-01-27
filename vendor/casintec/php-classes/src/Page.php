<?php

namespace Casintec;

use Rain\Tpl;

class Page{

    private $tpl;
    private $options = [];
    private $defaults = [
        "data" => []
    ];

    public function __CONSTRUCT($opts = array()){

        $this->options = array_merge($this->defaults, $opts);

        $config = array(
            "tpl_dir" => $_SERVER["DOCUMENT_ROOT"]."/views/",
            "cache_dir" => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
            "debug" => false
        );

        Tpl::configure($config);

        $this->tpl = new Tpl;

        $this->setData($this->options["data"]);

        $this->tpl->draw("header");

    }

    private function setData($data = array()){
        
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }

    }

    public function setTpl($name, $data = array(), $returnHTML = false){

        $this->setData();

        return $this->tpl->draw($name, $returnHTML);

    }

    public function __DESTRUCT(){
        
        $this->tpl->draw("footer");


    }

}

?>