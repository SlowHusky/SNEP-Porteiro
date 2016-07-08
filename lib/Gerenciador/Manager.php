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
                        $db->insert('tb_porteiro', $insert_data);
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
                Gerenciador_Manager::editData('tb_porteiro', $data['mac'], $insert_data);
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
		$selectgrupo = $db->select("id")
				  ->from('tb_grupos')
				  ->where('grupo = ?', $data['grupo']);
		foreach($_POST['mac'] as $chave=>$valor){
			$key; //exibe o ID
			$valor; //exibe o value (Sim)
			print_r($valor);
			$selectporteiro = $db->select("id")
				     ->from('tb_porteiros')
				     ->where('mac = ?', $valor);
			print_r($selectporteiro);
		}
		
/*
                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
		$quantidade = num
                $insert_data = array("atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->insert('senha', $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
*/
        }   
}
?>
