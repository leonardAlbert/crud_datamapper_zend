<?php
/**
 * Application_Model_Produto
 * 
 * Model responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework referente a entidade Produto.
 * 
 * @package 	application
 * @subpackage	models
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Model_Produto extends MeuProjeto_Model_Abstract
{
	/**
	 * Código da produto
	 * 
	 * @var int
	 */
	protected $idProduto;
	
	/**
	 * Nome da produto
	 * 
	 * @var string
	 */
	protected $nome;
	
	/**
	 * Descrição da produto
	 * 
	 * @var string
	 */
	protected $descricao;
	
	/**
	 * Categoria da produto
	 * 
	 * @var int|Application_Model_Categoria
	 */
	protected $idCategoria;
	
	/**
	 * Construtor padrão da classe
	 * 
	 * @see 	MeuProjeto_Model_Abstract::__construct()
	 * @param 	array 		$dados
	 * @return	Application_Model_Produto
	 */
	public function __construct(array $dados = null)
	{
		parent::__construct($dados);
		
		$this->mapper = new Application_Model_ProdutoMapper($this);
		
		return $this;
	}
	
	/**
	 * Atribui o ID da produto
	 * 
	 * @param int $idCategoria
	 */
	public function setId($idProduto)
	{
		$this->idProduto = $idProduto;
		
		return $this;
	}
	
	/**
	 * Retorna o ID da produto
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->idProduto;
	}
	
	/**
	 * Atribui o nome da produto
	 * 
	 * @param string $nome
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
		
		return $this;
	}
	
	/**
	 * Retorna o nome da produto
	 * 
	 * @return string
	 */
	public function getNome()
	{
		return $this->nome;
	}
	
	/**
	 * Atribui a descrição do produto
	 * 
	 * @param string $descricao
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
		
		return $this;
	}
	
	/**
	 * Retorna a descrição do produto
	 * 
	 * @return string
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}
	
	/**
	 * Atribui a categoria a qual pertence este produto
	 * 
	 * @param int $idCategoria
	 */
	public function setCategoria($idCategoria)
	{
		$this->idCategoria = $idCategoria;
		
		return $this;
	}
	
	/**
	 * Retorna a categoria a qual pertence este produto
	 * 
	 * @param boolean $show Flag para exibir o objeto Application_Model_Categoria
	 * @return int|Application_Model_Categoria
	 */
	public function getCategoria($show = false)
	{
		if ($show) {
			$categoria = new Application_Model_Categoria();
			$categoria->setId($this->idCategoria);
			
			return $categoria->getMapper()->find();
		}
		
		
		return $this->idCategoria;
	}

}