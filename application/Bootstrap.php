<?php
/**
* Bootstrap
* 
* Responsável pelas configurações iniciais e essenciais para o funcionamento da
* aplicação.
*
 * @package 	datamapper
 * @subpackage	application
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
*/
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/** 
     * Inicia o autoloader do Zend Framework
     *
     * @return  void
     */
    protected function _initAutoload()
    {   
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('MeuProjeto');
        $loader->setFallbackAutoloader(true);
    }
    
	/**
	 * Inicia as configurações da aplicação com base no arquivo application.ini
	 * 
	 * @return void
	 */
	protected function _initConfig()
	{
		$options = $this->getApplication()->getOptions();
		
		$config = new Zend_Config($options);
		
		Zend_Registry::set('config', $config);
	}
	
	/**
	 * Inicia as configurações do banco de dados
	 * 
	 * @return void
	 */
	protected function _initDb()
	{
		$db = $this->getPluginResource('db')->getDbAdapter();
		
		Zend_Db_Table::setDefaultAdapter($db);
		
		Zend_Registry::set('db', $db);
	}
	
	/**
	 * Inicia a sessão da aplicação
	 * 
	 * @return void
	 */
	protected function _initSession()
	{
		$session = new Zend_Session_Namespace('DataMapper');
		
		Zend_Registry::set('session', $session);
	}

}