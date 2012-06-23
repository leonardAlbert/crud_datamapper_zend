<?php
/**
 * MeuProjeto_Controller_Abstract
 * 
 * Formulário genérico que irá conter os elementos padrão a todos os formulários
 * 
 * @package 	MeuProjeto
 * @subpackage	Form
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
abstract class MeuProjeto_Form_Abstract extends Zend_Form
{
	/**
	 * Primeiro método executado após este controlador ser invocado
	 * 
	 * @see 	Zend_Controller_Action::init()
	 * @return 	void
	 */
    public function init()
    {
        $submit = $this->getSubmit();
        
        $this->addElement($submit);
        
        return $this;
    }

    /**
     * Retorna um campo do tipo submit
     * 
     * @return Zend_Form_Element_Select
     */
	public function getSubmit()
	{
		$submit = new Zend_Form_Element_Submit('Enviar');
		$submit->setAttrib('class', 'btn-large btn-primary');
		
		return $submit;
	}
    
}