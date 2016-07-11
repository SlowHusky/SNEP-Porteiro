<?php

class Gerenciador_Database 
{

	public static function oi($data){
		print_r($data);	
	}

	public static function getTabela($tabela)
	{
                $db = Zend_Registry::get('db');
                $select = $db->select()
                             ->from($tabela);
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
	}

	public static function porteiroGetAllAtivo()
	{
	        // Recupera instancia do Banco de dados no Zend_Registry
        	$db = Zend_Registry::get('db');

	        // Cria um objeto select
        	$select = $db->select()
                     // Tabela do select e indices que deverão ser retornados.
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'));

        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();

		return $result;
	}

	public static function porteiroGetByID($id) 
	{
	        // Recupera instancia do Banco de dados no Zend_Registry
        	$db = Zend_Registry::get('db');

	        // Cria um objeto select
        	$select = $db->select()
                     // Tabela do select e indices que deverão ser retornados.
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'))
                     // Método Where, estabelece critérios pra consulta.
                     ->where("id = $id")
                     // Método Limit, limita o número de registros.
                     ->limit('1');

        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}
	
	public static function porteiroGetByMAC($mac) 
	{
	        // Recupera instancia do Banco de dados no Zend_Registry
        	$db = Zend_Registry::get('db');

	        // Cria um objeto select
        	$select = $db->select()
                     // Tabela do select e indices que deverão ser retornados.
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'))
		     // Método Where, estabelece critérios pra consulta.
		     ->where("mac = '$mac'");

        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}

	public static function grupoGetByID($id) 
	{
	        // Recupera instancia do Banco de dados no Zend_Registry
        	$db = Zend_Registry::get('db');

	        // Cria um objeto select
        	$select = $db->select()
                     // Tabela do select e indices que deverão ser retornados.
                     ->from('tb_grupos', array('id', 'grupo', 'cadastro', 'atualizado'))
                     // Método Where, estabelece critérios pra consulta.
                     ->where("id = $id")
                     // Método Limit, limita o número de registros.
                     ->limit('1');

        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}
	
	public static function grupoGetByNome($grupo) 
	{
	        // Recupera instancia do Banco de dados no Zend_Registry
        	$db = Zend_Registry::get('db');

	        // Cria um objeto select
        	$select = $db->select()
                     // Tabela do select e indices que deverão ser retornados.
                     ->from('tb_grupos', array('id', 'grupo', 'cadastro', 'atualizado'))
                     // Método Where, estabelece critérios pra consulta.
                     ->where("grupo = '$grupo'");

        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}
}
