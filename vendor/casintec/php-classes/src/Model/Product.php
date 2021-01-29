<?php 

namespace Casintec\Model;

use \Casintec\DB\Sql;
use \Casintec\Model;
use \Casintec\Mailer;

class Product extends Model {

	public static function listAll(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_products ORDER BY desproduct");

    }

    public static function checkList($list){

		foreach ($list as &$row) {
			
			$p = new Product();
			$p->setData($row);
			$row = $p->getValues();

		}

		return $list;

	}
    
    public function save(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_products_save(:idproduct, :desproduct, :vlprice, :vlwidth, :vlheight, :vllength, :vlweight, :desurl)", array(
			":idproduct"=>$this->getidproduct(),
			":desproduct"=>$this->getdesproduct(),
			":vlprice"=>$this->getvlprice(),
			":vlwidth"=>$this->getvlwidth(),
			":vlheight"=>$this->getvlheight(),
			":vllength"=>$this->getvllength(),
			":vlweight"=>$this->getvlweight(),
			":desurl"=>$this->getdesurl()
		));

        $this->setData($results[0]);

	}

    public function get($idproduct){
        
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_products WHERE idproduct = :idproduct", [
            ':idproduct'=>$idproduct
        ]);

        $this->setData($results[0]);
    
    }

    public function delete(){
        
        $sql = new Sql();

        $sql->query("DELETE FROM tb_product WHERE idproduct = :idproduct", [
            ':idproduct'=>$this->getidproduct()
        ]);

        Category::updateFile();
    
    }

}

 ?>