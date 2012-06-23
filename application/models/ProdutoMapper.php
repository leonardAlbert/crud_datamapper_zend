<?php
/**
 * Application_Model_ProdutoMapper
 * 
 * Mapper responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework.
 * 
 * @package 	application
 * @subpackage	models
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Model_ProdutoMapper extends MeuProjeto_Mapper_Abstract
{
	/**
	 * Construtor padrão da classe
	 * 
	 * @param 	Application_Model_Produto 		$categoria
	 * @return	Application_Model_ProdutoMapper
	 */
	public function __construct(Application_Model_Produto $produto)
	{
		parent::__construct($produto);
		
		$this->dbTable = new Application_Model_DbTable_Produto();
		
		return $this;
	}
	
	/**
	 * Efetua uma listagem completa e genérica.
	 * 
	 * Outros métodos poderão chamar esta função passando os devidos parâmetros
	 * para retornar o resultado desejado e personalizar da maneira que melhor
	 * achar. Este método sempre retornará o mesmo tipo de objeto a qual a
	 * invocou, exceto quando nada for encontrado, retornará nulo. 
	 * 
	 * @see		MeuProjeto_Mapper_Abstract::fetchAll()
	 * @param 	string|array|Zend_Db_Table_Select $where
     * @param 	string|array                      $order
     * @param 	int                               $count
     * @param 	int                               $offset
     * @return 	null|Categoria|array
     */
	public function fetchAll($where=null, $order=null, $count=null, $offset=null)
	{
		$rowset = $this->dbTable->fetchAll($where, $order, $count, $offset);
		
		if ($rowset->count() == 0) {
			return null;
		}
		
		if ($rowset->count() == 1) {
			$row = $rowset->current();
			
			/** 
			 * Tendo encontrado apenas um registro, a model que instanciou
			 * esta mapper receberá os valores encontrados. 
			 */
			$this->model->__construct($row->toArray());
			
			return $this->model;
		}
		
		$produtos = array();
		
		foreach ($rowset as $row) {
			$produtos[] = new Application_Model_Produto($row->toArray());
		}
		
		return $produtos;
	}
	
	/**
	 * Lista os produtos ordenando-os pelo seu nome
	 * 
	 * @param	boolean		$desc		Informa se mostrará de forma decrescente
	 * @return	null|Produto|array
	 */
	public function listarPorNome($desc=false)
	{
		$order = 'nome';
		
		if ($desc) {
			$order .= ' DESC';
		}
		
		return $this->fetchAll(null, $order);
	}

}