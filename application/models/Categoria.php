<?php
/**
 * Application_Model_Categoria
 * 
 * Model responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework referente a entidade Categoria.
 * 
 * @package 	application
 * @subpackage	models
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Model_Categoria extends MeuProjeto_Model_Abstract
{
	/**
	 * Código da categoria
	 * 
	 * @var int
	 */
	protected $idCategoria;
	
	/**
	 * Nome da categoria
	 * 
	 * @var string
	 */
	protected $nome;
	
	/**
	 * Descrição da categoria
	 * 
	 * @var string
	 */
	protected $descricao;
	
	/**
	 * Construtor padrão da classe
	 * 
	 * @see 	MeuProjeto_Model_Abstract::__construct()
	 * @param 	array 		$dados
	 * @return	Application_Model_Categoria
	 */
	public function __construct(array $dados = null)
	{
		parent::__construct($dados);
		
		$this->mapper = new Application_Model_CategoriaMapper($this);
		
		return $this;
	}
	
	/**
	 * Atribui o ID da categoria
	 * 
	 * @param int $idCategoria
	 */
	public function setId($idCategoria)
	{
		$this->idCategoria = $idCategoria;
		
		return $this;
	}
	
	/**
	 * Retorna o ID da categoria
	 * 
	 * @return int
	 */
	public function getId()
	{
		return $this->idCategoria;
	}
	
	/**
	 * Atribui o nome da categoria
	 * 
	 * @param string $nome
	 */
	public function setNome($nome)
	{
		$this->nome = $nome;
		
		return $this;
	}
	
	/**
	 * Retorna o nome da categoria
	 * 
	 * @return string
	 */
	public function getNome()
	{
		return $this->nome;
	}
	
	/**
	 * Atribui a descrição da categoria
	 * 
	 * @param string $descricao
	 */
	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
		
		return $this;
	}
	
	/**
	 * Retorna a descrição da categoria
	 * 
	 * @return string
	 */
	public function getDescricao()
	{
		return $this->descricao;
	}

}