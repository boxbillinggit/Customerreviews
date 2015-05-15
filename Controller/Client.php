<?php

namespace Box\Mod\Customerreviews\Controller;

class Client implements \Box\InjectionAwareInterface
{

    protected $di;

    /**
     * @param mixed $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    /**
     * @return mixed
     */
    public function getDi()
    {
        return $this->di;
    }
    
    public function register(\Box_App &$app)
    {
        $app->get('/customerreviews',             'get_index', array(), get_class($this));
        $app->get('/customerreviews/add',   'get_protected', array(), get_class($this));
    }

    public function get_index(\Box_App $app)
    {
        $api = $this->di['api_guest'];

		$param['opinieklientow']['title'] = "Opinie Klientów";
		
        $toArray = $this->di['db']->getAll("SELECT * FROM customers_reviews WHERE active='1'");
		
		$param['opinie'] = $toArray;
				
        return $app->render('mod_customerreviews_index',$param);
    }

    public function get_protected(\Box_App $app)
    {
        $api = $this->di['api_client'];
        return $app->render('mod_customerreviews_add', array('show_protected'=>true));
    }

}