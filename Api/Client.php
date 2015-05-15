<?php

namespace Box\Mod\Customerreviews\Api;

class Client extends \Api_Abstract
{    
    public function get_info($data)
    {
        // call custom event hook. All active modules will be notified
        $this->di['events_manager']->fire(array('event'=>'onAfterClientCalledExampleModule', 'params'=>array('key'=>'value')));
        
        // Log message
        $this->di['logger']->info('Log message to log file');

        $systemService = $this->di['mod_service']('System');
        $clientService = $this->di['mod_service']('Client');

        $type = $this->di['array_get']($data, 'type', 'info');

        return array(
            'data'      =>  $data,
            'version'   =>  $systemService->getVersion(),
            'profile'   =>  $clientService->toApiArray($this->di['loggedin_client']),
            'messages'  =>  $systemService->getMessages($type)
        );
    }
	
	public function opinie_add($data) {
		$this->di['db']->exec("INSERT INTO  `customers_reviews` (
				`id` ,
				`imie_nazwisko` ,
				`text` ,
				`date` ,
				`active`
				)
				VALUES (
				NULL ,  '".$data['name']."',  '".$data['message']."',  '".date("Y-m-d H:i:s")."',  '0'
				);");
		
		return true;
	}
}