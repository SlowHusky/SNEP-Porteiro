<?php
 
class Gerenciador_Manager {
 

        public static function addporteiro($data)
	{
                $db = Zend_Registry::get('db');
                $calendario = date("Y-m-d H:i");
                $insert_data = array("ip" => $data['ip'], "porta" => $data['porta'], "transporte" => $data['transporte'], "mac" => $data['mac'], "nome" => $data['nome'], "rele1" => $data['rele1'], "rele2" => $data['rele2'], "cadastro" => $calendario, "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->insert('tb_porteiro', $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
        	}
	}     

        public static function editporteiro($data){
                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("ip" => $data['ip'], "porta" => $data['porta'], "transporte" => $data['transporte'], "mac" => $data['mac'], "nome" => $data['no    me'], "rele1" => $data['rele1'], "rele2" => $data['rele2'], "cadastro" => $calendario, "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->update('tb_porteiro' , $insert_data, "mac = '" . $data['mac'] . "'");
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
        }   

        public static function rmporteiro($data) {

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

        public static function addgrupo($data){

                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("grupo" => $data['grupo'], "cadastro" => $calendario, "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->insert('tb_grupo', $insert_data);
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }   
        }   


        public static function rmgrupo($data) {

                $db = Zend_Registry::get('db');
                $grupo = $data['grupo'];
                $db->beginTransaction();

                try {
                        $db->delete('tb_grupo', "grupo = '". $grupo."'");
                        $db->commit();

                } catch (Exception $e) {
                        $db->rollBack();

                }

        }

        public static function permissoes($data){

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

}
?>
