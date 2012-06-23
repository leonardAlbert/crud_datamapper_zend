<?php
/**
 * Application_Form_Categoria
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
class Application_Form_Categoria extends MeuProjeto_Form_Abstract
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
        
        $this->addElements(array($id, $nome, $descricao));
        
        parent::init();
    }

    /**
     * Retorna um campo hidden que armazena o ID dessa categoria
     * 
     * @return Zend_Form_Element_Hidden
     */
	public function getId()
	{
		$hidden = new Zend_Form_Element_Hidden('idCategoria');
		
		return $hidden;
	}
	
 	/**
     * Retorna um campo do tipo texto que armazena o nome dessa categoria
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
			        'table' => 'categorias',
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
	
}