<?php

class Gerenciador_Manager { 

	public static function getEcho($str)
	{
		return $str;
	}

	/* Retoma com todos os dados de uma tabela */
        public static function getTabela($tabela)
        {   
                $db = Zend_Registry::get('db');
                $select = $db->select()
                             ->from($tabela);
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        }   
	/* Retorna todos os porteiros ativos no momento. */
        public static function porteiroGetAllAtivo()
        {   
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip','porta', 'transporte', 'mac','nome', 'rele1', 'rele2', 'ramal', 'cadastro', 'atualizado'));
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                return $result;
        } 

	/* Retorna o porteiro usando como entrada seu id. */  
        public static function porteiroGetByID($id)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip','porta', 'transporte', 'mac','nome', 'rele1', 'rele2', 'ramal',  'cadastro', 'atualizado'))
                     ->where("id = $id")
                     ->limit('1');
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
		if (count($result) > 1) 
		{ // erro 
			return Array();
		}
		else if (count($result) == 1)
		{ // OK
			return $result[0];
		} else
		{  // erro
			return Array();
		} 
        }
	
	/* Retorna o porteiro usando como entrada seu número de MAC. */
        public static function porteiroGetByMAC($mac)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip','porta', 'transporte', 'mac','nome', 'rele1', 'rele2', 'ramal',  'cadastro', 'atualizado'))
                     ->where("mac = '$mac'");
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();

                if (count($result) > 1)      
                { // erro 
                        return Array();
                } 
                else if (count($result) == 1)
                { // OK
                        return $result[0];
                }
		else
                {  // erro
                        return Array();
                }

        }

        /* Retorna o porteiro usando como entrada seu id. */
        public static function porteiroGetByRamal($ramal)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('tb_porteiro', array('id','ip','porta', 'transporte', 'mac','nome', 'rele1', 'rele2', 'ramal',  'cadastro', 'atualizado'))
                     ->where("ramal = $ramal")
                     ->limit('1');
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();
                if (count($result) > 1)
                { // erro 
                        return Array();
                }
                else if (count($result) == 1)
                { // OK
                        return $result[0];
                } else
                {  // erro
                        return Array();
                }
        }


        /* Retorna o porteiro usando como entrada seu id. */
        public static function rfidGetByRfid($rfid)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('rfid', array('id','rfid','grupo', 'cadastro', 'atualizado'))
                     ->where("rfid = '$rfid'");
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();

                if (count($result) > 1)
                { // erro 
                        return Array();
                }
                else if (count($result) == 1)
                { // OK
                        return $result[0];
                }
                else
                {  // erro
                        return Array();
                }

        }




        /* Retorna o porteiro usando como entrada seu número de MAC. */
        public static function userGetById($id)
        {
                $db = Zend_Registry::get('db');
                $select = $db->select()
                     ->from('senha', array('id','senha','usuario', 'grupo', 'cadastro','atualizado'))
                     ->where("id = '$id'");
                $stmt = $db->query($select);
                $result = $stmt->fetchAll();

                if (count($result) > 1)
                { // erro 
                        return Array();
                }
                else if (count($result) == 1)
                { // OK
                        return $result[0];
                }
                else
                {  // erro
                        return Array();
                }

        }
	
	/*Retorna um grupo usando como entrada seu nome. */
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
        
	/*Recupera as informações entrando com uma tabela */	
	public static function getDatabase($tabela)
	{
        	$db = Zend_Registry::get('db');
		$select = $db->select()
                	     ->from($tabela);
        	$stmt = $db->query($select);
        	$result = $stmt->fetchAll();
		return $result;
	}	
	/* Retorna as informações de uma linha de uma tabela, faxendo a busca pelo nome do grupo. */
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

	/*Insere dados em uma tabela. */
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

	/*Edita os dados de um porteiro, localizado pelo seu mac. */ 
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
	
	/*Verifica se o grupo está cadastrado. Retorna true ou false*/
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
	
	/* Adiciona um porteiro. */
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
				     "ramal" => $data['ramal'],
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

	/*Edita os dados de um porteiro. */
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
                                     "ramal" => $data['ramal'],
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

	/* Remove um porteiro, utuliza mac como entrada. */
        public static function porteiroRemove($data)
	{
		$db = Zend_Registry::get('db');
                $mac = $data['mac'];
		$macId = self::porteiroGetByMAC($mac);
                $db->beginTransaction();

                try {
			$db->delete('tb_porteirogrupos', "porteiro = " . $macId['id']);
                        $db->delete('tb_porteiro', "mac = " . $macId['mac']);
                        $db->commit();

                } catch (Exception $e) {
                        $db->rollBack();
	        }  
        }
	
	/*Adiciona um grupo. */
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
	
	/*remove um grupo */
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
	
	/*verifica se um porteiro está relacionado a um grupo. */
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
	
	/* Retorna um grupo, recebendo como entrada um id de RFID. */
	public static function getGrupoByRfid($idRfid)
	{
		$db = Zend_Registry::get('db');
                $tabela = self::getTabela("rfid");
		$resposta = array();
                $existe = false;
                foreach ($tabela as $row)
		{
			if ($row["rfid"] == $idRfid)
                        {
                                $existe = true;
				$resposta[] = $existe;
                                $resposta[] = $row["grupo"];
				break;
                        }
			else 
			{
				$resposta[] = $existe;
				$resposta[] = "false";
			}
		}
		return $resposta;
		
	}
	
	/*Retorna os dados de um RFID, usando como entrada um id. */
	public static function verificaRFID($idRfid)
	{
		$db = Zend_Registry::get('db');
		$tabela = self::getTabela("rfid");
		$existe = false;
		foreach ($tabela as $row)
		{
			if ($row["rfid"] == $idRfid)
			{
				$existe = true;
				break;
			}
		}
		return ($existe) ? 1 : 0;
	}
	
	/*Verifica se um porteiro está associado a um grupo. */
	public static function permissoes($data)
	{	
		$db = Zend_Registry::get('db');
		$grupo = self::grupoGetByNome($data['grupo']);
		$porteiroId = array();
		foreach($_POST['mac'] as $chave=>$valor)
		{
			$porteiro = self::porteiroGetByMAC($valor);
			array_push($porteiroId, $porteiro['id']);
	                $status = self::verificaSeExiste($grupo[0]['id'], $porteiro['id'], 'tb_porteirogrupos');
			if ($status == false){ 
				$insert_data = array("grupo" => $grupo[0]['id'], "porteiro" => $porteiro['id']);
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
		if (count($porteiroId) >= 1)
		{
			$db->delete('tb_porteirogrupos', "grupo = '$grupoId' AND porteiro NOT IN (". implode(",", $porteiroId) . ")");
		}
		else
		{
			$db->delete('tb_porteirogrupos', "grupo = '$grupoId'");
		}
			    	     
        }

	/* Adiciona os dados referentes as transações de uso do rfid. */
        public static function contadorRfid($nrfid, $ramal, $acesso)
        {

		if($acesso == true)
		{
			$rfid = self::rfidGetByRfid($nrfid);
	

			$porteiro = self::porteiroGetByRamal($ramal);
                	$db = Zend_Registry::get('db');
                	$calendario = date("Y-m-d H:i");
 	              	$insert_data = array("data" => $calendario,
					     "porteiro" => $porteiro['id'],
					     "ramal" => $ramal,
					     "rfid" => $nrfid,
					     "id_rfid" => $rfid['id'],
					     "resultado" => $acesso);
        	        $tabela = 'contador_rfid';
           	        $db->beginTransaction();
              	        try{
                      	         $db->insert($tabela, $insert_data);
                                 $db->commit();
               		}catch(Exception $e){
                       		 $db->rollback();
            		}

        	}
		else
		{
			$porteiro = self::porteiroGetByRamal($ramal);
			$db = Zend_Registry::get('db');
			$calendario = date("Y-m-d H:i");
			$insert_data = array("data" => $calendario,
					     "porteiro" => $porteiro['id'],
					     "ramal" => $ramal,
					     "rfid" => $nrfid,
					     "resultado" => $acesso);
                        $tabela = 'contador_rfid';
                        $db->beginTransaction();
                        try{
                                 $db->insert($tabela, $insert_data);
                                 $db->commit();
                        }catch(Exception $e){
                                 $db->rollback();
                        }
		}  
	}  					

}
?>
