<?php
 
class Gerenciador_Manager { 
	
        static $db = Zend_Registry::get('db');

	public static function insertData($tabela, $insert_data)
	{
                $db->beginTransaction();
                try{
                        $db->insert($tabela, $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
	}
	
	public static function editData($tabela, $mac, $insert_data);
	{
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

                Gerenciador_Manager::insertData('tb_porteiro', $insert_data);
	}     

        public static function porteiroEdit($data)
	{
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
                $calendario = date("Y-m-d H:i");
                $insert_data = array("grupo" => $data['grupo'],
				     "cadastro" => $calendario,
				     "atualizado" => $calendario);
		Gerenciador_Manager::insertData('tb_grupos', $insert_data);
        } 

        public static function grupoRemove($data)
	{
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

		print_r($data);
/*
                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("ip" => $data['ip'], "porta" => $data['porta'], "transporte" => $data['transporte'], "mac" => $data['mac'], "nome" => $data['nome'], "rele1" => $data['rele1'], "rele2" => $data['rele2'], "cadastro" => $calendario, "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->insert('senha', $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
        }   
*/
}
?>
