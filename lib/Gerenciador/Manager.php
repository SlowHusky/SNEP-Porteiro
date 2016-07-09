<?php

class Gerenciador_Manager { 
	

	public static function oi($data){
		print_r($data);	
	}

        
	public static function getDatabase($tabela)
	{
        	$db = Zend_Registry::get('db');
		$select = $db->select()
                	     ->from($tabela);
        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}	

	public static function insertData($tabela, $insert_data)
	{
		$db = Zend_Registry::get('db');
                $db->beginTransaction();
                try{
                        $db->insert($tabela, $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
	}
	
	public static function editData($tabela, $mac, $insert_data)
	{
		$db = Zend_Registry::get('db');
                $db->beginTransaction();
                try{
                        $db->update('tb_porteiro' , $insert_data, "mac = '" . $mac . "'");
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }
	}
	
        public static function porteiroAdd($data)
	{
		$db = Zend_Registry::get('db');
                $calendario = date("Y-m-d H:i");
                $insert_data = array("ip" => $data['ip'],
				     "porta" => $data['porta'],
				     "transporte" => $data['transporte'],
				     "mac" => $data['mac'],
				     "nome" => $data['nome'],
				     "rele1" => $data['rele1'],
				     "rele2" => $data['rele2'],
 				     "cadastro" => $calendario,
			             "atualizado" => $calendario);
		$tabela = 'tb_porteiro';
                $db->beginTransaction();
                try{
                        $db->insert($tabela, $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }

	}     

        public static function porteiroEdit($data)
	{	
		$db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("ip" => $data['ip'],
				     "porta" => $data['porta'],
				     "transporte" => $data['transporte'],
				     "mac" => $data['mac'],
				     "nome" => $data['nome'],
				     "rele1" => $data['rele1'],
				     "rele2" => $data['rele2'],
				     "atualizado" => $calendario);
		$mac = $data['mac'];
                $db->beginTransaction();
                try{
                        $db->update('tb_porteiro' , $insert_data, "mac = '" . $mac . "'");
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }
  
        }   

        public static function porteiroRemove($data)
	{
		$db = Zend_Registry::get('db');
                $mac = $data['mac'];
                $db->beginTransaction();

                try {
                        $db->delete('tb_porteiro', "mac = '". $mac."'");
                        $db->commit();

                } catch (Exception $e) {
                        $db->rollBack();

                }

        }

        public static function grupoAdd($data)
        {   
		$db = Zend_Registry::get('db');
                $calendario = date("Y-m-d H:i");
                $insert_data = array("grupo" => $data['grupo'],
				     "cadastro" => $calendario,
				     "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->insert('tb_grupos', $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }

        } 

        public static function grupoRemove($data)
	{
		$db = Zend_Registry::get('db');
                $grupo = $data['grupo'];
                $db->beginTransaction();

                try {
                        $db->delete('tb_grupos', "grupo = '". $grupo."'");
                        $db->commit();

                } catch (Exception $e) {
                        $db->rollBack();

                }

        }

	public static function permissoes($data)
	{	
		
		$db = Zend_Registry::get('db');
		//print_r(Gerenciador_Database::oi($data));
		$grupo = Gerenciador_Database::grupoGetByNome($data['grupo']);
		foreach($_POST['mac'] as $chave=>$valor)
		{
			//print_r($valor);
			$porteiro = Gerenciador_Database::porteiroGetByMAC($valor);

			echo "ID Grupo: " . $grupo[0]['id'];
			echo "ID Porteiro: " . $porteiro[0]['id'];
		}
		

        }   
}
?>
