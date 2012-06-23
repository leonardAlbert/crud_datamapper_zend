<?php
/**
 * MeuProjeto_Controller_Abstract
 * 
 * Controlador genérico responsável pelo processamento das requisições da 
 * entidades que a herdarão.
 * 
 * @package 	MeuProjeto
 * @subpackage	Controller
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
abstract class MeuProjeto_Controller_Abstract extends Zend_Controller_Action
{
	/**
	 * Representa a model a qual este controlador processará as requisições
	 * 
	 * @var	Object
	 */
	protected $model;
	
	/**
	 * Representa o formulário a qual este controlador processará as requisições
	 * 
	 * @var	Object
	 */
	protected $form;
	
	/**
	 * Representa a session da aplicação
	 * 
	 * @var	Zend_Session
	 */
	protected $session;
	
	/**
	 * Primeiro método executado após este controlador ser invocado
	 * 
	 * @see 	Zend_Controller_Action::init()
	 * @return 	void
	 */
    public function init()
    {
        parent::init();
        
        $this->session = Zend_Registry::get('session');
    }

    /**
     * Action padrão deste controlador, por convenção, fará um redirecionamento
     * para a action que irá exibir os dados da entidade que a herdará.
     * 
     * @return void
     */
    public function indexAction()
    {
        $this->_forward('listar');
    }

  	/**
     * Action utilizada para inserir registros no banco de dados referente a
	 * entidade que a herdará.
     * 
     * @return void
     */
    public function cadastrarAction()
    {
        if ($this->getRequest()->isPost()) {
        	
        	$data = $this->getRequest()->getParams();

        	if ($this->form->isValid($data)) {

        		$this->model->__construct($data);
        		
        		try {
        			$this->model->getMapper()->insert();
        			
        			$this->session->success = 'Registro inserido com sucesso!';
        			
        			// Redireciona para a action listar do controlador que a herdou
        			$this->_redirect("/{$data['controller']}/listar");
        		} catch(Exception $e) {
        			$this->session->error = $e->getMessage();
        		}
        	}
        	
        	$this->form->populate($data);
        }
        
        $this->view->form = $this->form;
    }
    
	/**
     * Action utilizada para alterar registros no banco de dados referente a
	 * entidade que a herdará.
     * 
     * @return void
     */
    public function alterarAction()
    {
        if ($this->getRequest()->isPost()) {
        	
        	$data =  $this->getRequest()->getParams();
        	
        	if ($this->form->isValid($data)) {
        		
        		$this->model->__construct($data);
        		
        		try {
        			$this->model->getMapper()->update();
        			
        			$this->session->success = 'Registro alterado com sucesso!';
        			
        			// Redireciona para a action listar do controlador que a herdou
        			$this->_redirect("/{$data['controller']}/listar");
        		} catch(Exception $e) {
        			$this->session->error = $e->getMessage();
        		}	
        	}
        	
        	$this->form->populate($data);
        }
        
        $id = $this->getRequest()->getParam('id');
		
        $this->model->setId($id);
         
        $this->model->getMapper()->find();
        
        if ($this->model->getMapper()->find() == null) {
        	$this->session->error = 'Registro não encontrado!';
        }
        
        $this->form->populate($this->model->toArray());
        
        $this->view->form = $this->form;
    }
    
	/**
     * Action utilizada para listar registros no banco de dadosreferente a
	 * entidade que a herdará.
     * 
     * @return void
     */
    public function listarAction()
    {
        $registros = $this->model->getMapper()->fetchAll();
        
        /**
         * Caso tenha apenas um registro, ele será inserido em um array para
         * que seja percorrido pelo foreach
         */
        if (! is_array($registros)) {
        	$registros = array($registros);
        }
        
        $this->view->registros = $registros;
    }
    
	/**
     * Action utilizada para excluir um registro no banco de dados referente a
	 * entidade que a herdará.
     * 
     * @return void
     */
    public function excluirAction()
    {
     	$id = $this->getRequest()->getParam('id');
     	
     	$controller = $this->getRequest()->getParam('controller');
     	
        $this->model->setId($id);
        
        if ($this->model->getMapper()->find() == null) {
        	$this->session->error = 'Registro não encontrado!';
        }
        
        try {
	        $this->model->getMapper()->delete();
	        
	        $this->session->success = 'Registro excluído com sucesso!';
	        
	        // Redireciona para a action listar do controlador que a herdou
        	$this->_redirect("/{$controller}/listar");
        } catch (Exception $e) {
        	$this->session->error = $e->getMessage();
        }
    }
    
}