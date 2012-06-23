<?php
/**
 * Application_Form_Produto
 * 
 * Formulário responsável pela validação dos dados referente a essa entidade
 * Categoria.
 * 
 * @package 	application
 * @subpackage	forms
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Form_Produto extends MeuProjeto_Form_Abstract
{
	/**
	 * Método que constroi este formulário
	 * 
	 * @see Zend_Form::init()
	 */
    public function init()
    {
        $id   		= $this->getId();
        $nome 		= $this->getNome();
        $descricao  = $this->getDescricao();
        $categoria  = $this->getCategoria(); 
        
        $this->addElements(array($id, $nome, $descricao, $categoria));
        
        parent::init();
    }

	/**
     * Retorna um campo hidden que armazena o código deste produto
     * 
     * @return Zend_Form_Element_Hidden
     */
	public function getId()
	{
		$hidden = new Zend_Form_Element_Hidden('idProduto');
		
		return $hidden;
	}
	
 	/**
     * Retorna um campo do tipo texto que armazena o nome deste produto
     * 
     * @return Zend_Form_Element_Text
     */
	public function getNome()
	{
		$text = new Zend_Form_Element_Text('nome');
		$text->setLabel('Nome')
			->setRequired(true)
			->setAllowEmpty(false)
			->addFilter('StringTrim')
			->addValidator('StringLength', false, array('max' => 80));
			/*
			->addValidator(
				'Db_NoRecordExists',
				false,
				array(
			        'table' => 'produtos',
			        'field' => 'nome'
			    )
			);
			*/
		
		return $text;
	}
	
	/**
     * Retorna um campo do tipo textarea que armazena a descrição da categoria
     * 
     * @return Zend_Form_Element_Textarea
     */
	public function getDescricao()
	{
		$textarea = new Zend_Form_Element_Textarea('descricao');
		$textarea->setLabel('Descrição')
			->setAttrib('rows', 10)
			->setAttrib('cols', 50);
		
		return $textarea;
	}
	
	/**
	 * Retorna um campo do tipo select contendo todas as possíveis categorias
	 * que este produto pode ter.
	 * 
	 * @return Zend_Form_Element_Select
	 */
	public function getCategoria()
	{
		$select = new Zend_Form_Element_Select('idCategoria');
		$select->setLabel('Categoria')
			->setRequired(true)
			->setAllowEmpty(false)
			->addMultiOption('', '');
			
		$categoriaModel = new Application_Model_Categoria();
		
		foreach ($categoriaModel->getMapper()->fetchAll() as $categoria) {
			$select->addMultiOption($categoria->getId(), $categoria->getNome()); 
		}
		
		return $select;
	}

}