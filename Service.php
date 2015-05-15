<?php
/**
 * BoxBilling.com.pl
 */

namespace Box\Mod\Customerreviews;

class Service
{
    
    protected $di;

    /**
     * @param mixed $di
     */
    public function setDi($di)
    {
        $this->di = $di;
    }

    public function install()
    {
        //Install Script DB
        $this->di['db']->exec("CREATE TABLE IF NOT EXISTS `customers_reviews` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `imie_nazwisko` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
				  `text` text,
				  `date` datetime NOT NULL DEFAULT '00:00:00 00-00-0000',
				  `active` int(11) NOT NULL DEFAULT '0',
				  PRIMARY KEY (`id`)
				);");	
		
        return true;
    }
    

    public function uninstall()
    {
        //Uninstall
        $this->di['db']->exec("DROP TABLE customers_reviews");

        return true;
    }
    
    public function update($manifest)
    {
        throw new Box_Exception("Throw exception to terminate module update process with a message", array(), 125);
        return true;
    }
    

}