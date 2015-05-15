<?php

namespace Box\Mod\Customerreviews\Controller;

class Admin implements \Box\InjectionAwareInterface
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
    
    public function fetchNavigation()
    {
        return array(
            'group'  =>  array(
                'index'     => 1511,                // menu sort order
                'location'  =>  'customerreviews',          // menu group identificator for subitems
                'label'     => 'Opinie',    // menu group title
                'class'     => 'iFlag',           // used for css styling menu item
            ),
            'subpages'=> array(
                array(
                    'location'  => 'customerreviews', // place this module in extensions group
                    'label'     => 'Opinie',
                    'index'     => 1511,
                    'uri'       => $this->di['url']->adminLink('customerreviews'),
                    'class'     => 'iFlag',
                ),
            ),
        );
    }

    /**
     * Methods maps admin areas urls to corresponding methods
     * Always use your module prefix to avoid conflicts with other modules
     * in future
     *
     *
     * @example $app->get('/example/test',      'get_test', null, get_class($this)); // calls get_test method on this class
     * @example $app->get('/example/:id',        'get_index', array('id'=>'[0-9]+'), get_class($this));
     * @param Box_App $app
     */
    public function register(\Box_App &$app)
    {
        $app->get('/customerreviews',             'get_index', array(), get_class($this));
    }

    public function get_index(\Box_App $app)
    {
        // always call this method to validate if admin is logged in
        $this->di['is_admin_logged'];
        $api = $this->di['api_admin'];

        $toArray = $this->di['db']->getAll("SELECT * FROM customers_reviews");
        
		$i=1;
		if(empty($toArray)) {
			$param = array();
			} else {
		$param['opinie'] = $toArray;
		}

        return $app->render('mod_customerreviews_index', $param);
    }

}