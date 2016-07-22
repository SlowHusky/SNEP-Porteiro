<?php

class Gerenciador_Manager { 


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
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'));
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }   
        public static function porteiroGetByID($id)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'))
                     ->where("id = $id")
                     ->limit('1');
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }

        public static function porteiroGetByMAC($mac)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip', 'transporte', 'mac','nome', 'rele1', 'rele2', 'cadastro', 'atualizado'))
                     ->where("mac = '$mac'");
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }

        public static function grupoGetByID($id)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_grupos', array('id', 'grupo', 'cadastro', 'atualizado'))
                     ->where("id = $id")
                     ->limit('1');
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }

        public static function grupoGetByNome($nome)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_grupos', array('id', 'grupo', 'cadastro', 'atualizado'))
                     ->where("grupo = '$nome'")
                     ->limit('1');
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
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

        public static function getTableByIdGrupo($tabela, $idGrupo)
        {   
                $db = Zend_Registry::get('db');
                $select = $db->select()
                             ->from($tabela)
	                     ->where("grupo = '$idGrupo'");
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
	
	public function verificarGrupo($nomeGrupo)
	{	
		$db = Zend_Registry::get('db');
                $relacao = self::getDatabase('tb_grupos');
		print_r($nomeGrupo);
		$existe = false;
                foreach($relacao as $row)
                {
			if($row['grupo'] == $nomeGrupo){
				$existe = true;
				break;
                        }
                
		
                }
		return $existe;
	
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
		$macId = self::porteiroGetByMAC($mac);
		$macId = $macId['id'];
                $db->beginTransaction();

                try {
			$db->delete('tb_porteirogrupos', "porteiro = '$macId'");
                        $db->delete('tb_porteiro', "mac = '$mac'");
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
		$grupoId = self::grupoGetByNome($grupo);
		$db->beginTransaction();
		
                try {
			$db->delete('tb_porteirogrupos', "grupo = '$grupoId'");
                        $db->delete('tb_grupos', "grupo = '$grupo'");
                        $db->commit();

                } catch (Exception $e) {
                        $db->rollBack();

                }

        }

	public static function verificaSeExiste($idGrupo, $idPorteiro, $tabela)
	{
		$relacao = self::getTableByIdGrupo($tabela, $idGrupo);
		$existe = false;
		foreach($relacao as $row)
		{
			if($row['porteiro'] == $idPorteiro){
				$existe = true;
				break;
			}
		}
		return $existe;		
	}

	public static function permissoes($data)
	{	
		
		$db = Zend_Registry::get('db');
		$grupo = self::grupoGetByNome($data['grupo']);
		$porteiroId = array();
		foreach($_POST['mac'] as $chave=>$valor)
		{
			$porteiro = self::porteiroGetByMAC($valor);
			array_push($porteiroId, $porteiro[0]['id']);
	                $status = self::verificaSeExiste($grupo[0]['id'], $porteiro[0]['id'], 'tb_porteirogrupos');
			if ($status == false){ 
     		   	        $insert_data = array("grupo" => $grupo[0]['id'], "porteiro" => $porteiro[0]['id']);
	                	$tabela = 'tb_porteirogrupos';
	                	$db->beginTransaction();
               		 	try{
                    	   	 	$db->insert($tabela, $insert_data);
                	        	$db->commit();
                		}catch(Exception $e){
        	        		$db->rollback();
	                	}   
			}
		}
		$grupoId = $grupo[0]['id'];
		$delete = $db->delete('tb_porteirogrupos', "grupo = '$grupoId' AND porteiro NOT IN (". implode(",", $porteiroId) . ")");    	     
        }  
}
?>
