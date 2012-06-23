<?php
/**
 * Application_Model_CategoriaMapper
 * 
 * Mapper responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework referente a entidade Categoria.
 * 
 * @package 	application
 * @subpackage	models
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Model_CategoriaMapper extends MeuProjeto_Mapper_Abstract
{
	/**
	 * Construtor padrão da classe
	 * 
	 * @param 	Application_Model_Categoria 		$categoria
	 * @return	Application_Model_CategoriaMapper
	 */
	public function __construct(Application_Model_Categoria $categoria)
	{
		parent::__construct($categoria);
		
		$this->dbTable = new Application_Model_DbTable_Categoria();
		
		return $this;
	}
	
	/**
	 * Efetua uma listagem completa e genérica.
	 * 
	 * Outros métodos poderão chamar esta função passando os devidos parâmetros
	 * para retornar o resultado desejado e personalizar da maneira que melhor
	 * achar. 
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
			
			$this->model->__construct($row->toArray());
			
			return $this->model;
		}
		
		$categorias = array();
		
		foreach ($rowset as $row) {
			$categorias[] = new Application_Model_Categoria($row->toArray());
		}
		
		return $categorias;
	}
	
	/**
	 * Lista as categorias ordenando-as pelo seu nome
	 * 
	 * @param	boolean		$desc		Informa se mostrará de forma decrescente
	 * @return	null|Categoria|array
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