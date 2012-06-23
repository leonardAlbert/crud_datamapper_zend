<?php
/**
 * MeuProjeto_Model_Abstract
 * 
 * Classe abstrata responsável pelas funções que serão utilizadas por todas
 * as models, como por exemplo, construir o objeto automaticamente com os dados
 * vindos do controlador.
 * 
 * @package 	MeuProjeto
 * @subpackage	Controller
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
abstract class MeuProjeto_Model_Abstract
{
	/**
	 * Construtor padrão da classe setando automaticamente seus devidos atributos
	 * 
	 * @param	array	$dados		Dados vindos do formulário
	 */
	public function __construct(array $dados = null)
	{
		if ($dados != null) {
			foreach ($dados as $atributo => $valor) {
				if (! property_exists($this, $atributo)) {
					continue;
				}
				
				$this->$atributo = $valor;
			}
		}
		
		return $this;
	}
	
	/**
	 * Atribui o código de identificação único a este objeto
	 * 
	 * @param int $id
	 */
	abstract public function setId($id);
	
	/**
	 * Retorna o código de identificação único a este objeto
	 * 
	 * @return int
	 */
	abstract public function getId();
	
	/**
	 * Função utilizada para transformar essa classe em um array.
	 * 
	 * Útil para trabalhar com Zend_Form e Zend_Db_Table
	 * 
	 * @return 	array
	 */
	public function toArray()
	{
		$dados = get_object_vars($this);
		
		foreach ($dados as $atributo => $valor) {
			if ($dados[$atributo] == null) {
				unset($dados[$atributo]);		
			}
		}
		
		unset($dados['mapper']);
		
		return $dados;
	}
	
	/**
	 * Função utilizada para transformar essa classe em um array.
	 * 
	 * Útil para trabalhar com webservices
	 * 
	 * @return 	json
	 */
	public function toJson()
	{
		$dados = $this->toArray();
		
		unset($dados['mapper']);
		
		return json_encode($dados);
	}
	
	/**
	 * Retorna o mapper que dessa model
	 * 
	 * @return Object
	 */
	public function getMapper()
	{
		return $this->mapper;
	}

}