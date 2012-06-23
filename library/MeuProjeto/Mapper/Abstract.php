<?php
/**
 * MeuProjeto_Mapper_Abstract
 * 
 * Classe abstrata responsável pelas funções que serão utilizadas por todas
 * os mappers, como por exemplo, construir persistir o objeto no banco de dados e
 * obtê-los.
 * 
 * @package 	MeuProjeto
 * @subpackage	Mapper
 * @author 	Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
*/
abstract class MeuProjeto_Mapper_Abstract
{
	/**
	 * Armazena o DbTable do respectivo mapper
	 * 
	 * @var Object
	 */
	protected $dbTable;
	
	/**
	 * Armazena a model que este mapper irá utilizar
	 * 
	 * @var Object
	 */
	protected $model;
	
	/**
	 * Construtor padrão da classe
	 * 
	 * @param	Object|null		$model
	 * @return	MapperAbstract
	 */
	public function __construct($model)
	{
		$this->model = $model;
		
		return $this;
	}
	
	/**
	 * Insere um registro no banco de dados
	 * 
	 * @throws	Exception	Caso ocorra algum problema durante a transação
	 * @return 	MeuProjeto_Mapper_Abstract
	 */
	public function insert()
	{
		// Converte os dados da model em array para ser persistido
		$data = $this->model->toArray();
		
		try {
			// Inicia a transação com o banco de dados
			$this->dbTable->getAdapter()->beginTransaction();
			
			// Obtem o id do registro cadastrado
			$id = $this->dbTable->insert($data);
			
			// Atribui o valor da chave primária recém cadastrada
			$this->model->setId($id);
			
			// Efetua o commit das alteração
			$this->dbTable->getAdapter()->commit();
		} catch(Exception $e) {
			// Havendo algum erro basta desfazer as operações
			$this->dbTable->getAdapter()->rollback();
			
			return $e->getMessage();
		}
		
		return $this;
	}
	
	/**
	 * Atualiza um registro no banco de dados
	 * 
	 * @throws	Exception	Caso ocorra algum problema durante a transação
	 * @return 	MeuProjeto_Mapper_Abstract
	 */
	public function update()
	{
		// Obtem o nome da coluna que é a chave primária da tabela
		$primaryKey = $this->dbTable->getPrimary();
		
		// Obtém o id do registro que será utilizado na clausula where
		$id = $this->model->getId();
		
		// Obtem a cláusula where
		$where = $this->dbTable->getAdapter()->quoteInto("{$primaryKey} = ?", $id);
		
		try {
			// Inicia a transação com o banco de dados
			$this->dbTable->getAdapter()->beginTransaction();
			
			// Converte os dados da model em array para ser persistido
			$data = $this->model->toArray();
			
			// Obtem o número de linhas alteradas no banco de dados
			$this->dbTable->update($data, $where);
			
			// Efetua o commit das alteração
			$this->dbTable->getAdapter()->commit();
		} catch(Exception $e) {
			// Havendo algum erro basta desfazer as operações
			$this->dbTable->getAdapter()->rollback();
		}
		
		return $this;
	}
	
	/**
	 * Exclui um registro do banco de dados de acordo com a sua chave primária
	 * 
	 * @throws	Exception	Caso ocorra algum problema durante a transação
	 * @return	int
	 */
	public function delete()
	{
		// Obtem o nome da coluna que é a chave primária da tabela
		$primaryKey = $this->dbTable->getPrimary();
		
		// Obtém o id do registro que será utilizado na clausula where
		$id = $this->model->getId();
		
		// Obtem a cláusula where para limitar o que será excluido na tabela
		$where = $this->dbTable->getAdapter()->quoteInto("{$primaryKey} = ?", $id);
		
		try {
			// Inicia a transação com o banco de dados
			$this->dbTable->getAdapter()->beginTransaction();
			
			// Exclui o registro no banco de dados
			$this->dbTable->delete($where);
			
			// Efetua o commit das alteração
			$this->dbTable->getAdapter()->commit();
		} catch(Exception $e) {
			// Havendo algum erro basta desfazer as operações
			$this->dbTable->getAdapter()->rollback();
		}
		
		return $this;
	}
	
	/**
	 * Obtém um registro no banco de dados de acordo com sua chave primária
	 * 
	 * A model que invocou este mapper receberá o resultado desta consulta
	 * e será retornada.
	 * 
	 * @return null|Object
	 */
	public function find()
	{
		$id = $this->model->getId();
		
		$rowset = $this->dbTable->find($id);
		
		if ($rowset->current() == null) {
			return null;
		}
		
		$data = $rowset->current()->toArray();
		
		$this->model->__construct($data);
		
		return $this->model;
	}
	
	/**
	 * Efetua uma listagem completa e genérica.
	 * 
	 * Outros métodos poderão chamar esta função passando os devidos parâmetros
	 * para retornar o resultado desejado e personalizar da maneira que melhor
	 * achar. Este método sempre retornará o mesmo tipo de objeto a qual a
	 * invocou, exceto quando nada for encontrado, retornará nulo. 
	 * 
	 * @see		Zend_Db_Table_Abstract::fetchAll
	 * @param 	string|array|Zend_Db_Table_Select $where  OPTIONAL An SQL WHERE clause or Zend_Db_Table_Select object.
     * @param 	string|array                      $order  OPTIONAL An SQL ORDER clause.
     * @param 	int                               $count  OPTIONAL An SQL LIMIT count.
     * @param 	int                               $offset OPTIONAL An SQL LIMIT offset.
     * @return 	Zend_Db_Table_Rowset
     */
	public abstract  function fetchAll($where=null, $order=null, $count=null, $offset=null);

}