<?php

namespace Box\Mod\Customerreviews\Api;

class Admin extends \Api_Abstract
{    
    public function active($data) {
		$this->di['db']->exec("UPDATE `customers_reviews` SET `active`='1' WHERE `id`='".$data['id']."'");
		
		return true;
	}
	
	public function delete($data) {
        $this->di['db']->exec("DELETE FROM `customers_reviews` WHERE `id`='".$data['id']."'");

		return true;
	}
	
	public function deactive($data) {
        $this->di['db']->exec("UPDATE `customers_reviews` SET `active`='0' WHERE `id`='".$data['id']."'");

		return true;
	}
}