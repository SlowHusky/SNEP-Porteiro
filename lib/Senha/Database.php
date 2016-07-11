<?php
class Senha_Database
{
	public function getTabela($tabela)
	{
                $db = Zend_Registry::get('db');
                $select = $db->select()
                             ->from($tabela);
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }   

}
?>
