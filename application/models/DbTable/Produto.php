<?php
/**
 * Application_Model_DbTable_Produto
 * 
 * DbTable responsável pela demonstração de uso de datamapper utilizando o
 * Zend Framework referente a entidade Produto.
 * 
 * @package 	application/models
 * @subpackage	DbTable
 * @author 		Thiago Pelizoni <thiago.pelizoni@gmail.com>
 * @license 	http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @version 	Release: 0.1
 */
class Application_Model_DbTable_Produto extends Zend_Db_Table_Abstract
{
	/**
	 * Nome da tabela
	 * 
	 * @var string
	 */
    protected $_name = 'produtos';
    
    /**
	 * Chave primária da tabela
	 * 
	 * @var string
	 */
    protected $_primary = 'idProduto';

 	/**
     * Retorna o nome da chave primária. Muito utilizado no Mapper
     *
     * @return string
     */
	public function getPrimary()
	{
		return $this->_primary;
	}
}