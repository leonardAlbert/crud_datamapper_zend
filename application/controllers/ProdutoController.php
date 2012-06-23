<?php
/**
 * ProdutoController
 * 
 * Controlador responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework referente a entidade Produto.
 * 
 * @package 	application
 * @subpackage	controllers
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class ProdutoController extends MeuProjeto_Controller_Abstract
{
	/**
	 * Primeiro método executado após este controlador ter sido invocado
	 * 
	 * @return void
	 */
  	public function init()
    {
        parent::init();
        
        $this->form = new Application_Form_Produto();
        
        $this->model = new Application_Model_Produto();
    }

}