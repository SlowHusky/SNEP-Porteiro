<?php
 
class Rfid_ManagerRfid {
 
	public static function add($data){
	        $db = Zend_Registry::get('db');
		$calendario =  date("Y-m-d H:i");
	        $insert_data = array("rfid" => $data['senha'], "grupo" => $data['group'], "cadastro" => $calendario, "atualizado" => $calendario);
        	$db->beginTransaction();
        	try{
            		$db->insert('rfid', $insert_data);
            		$db->commit();
        	}catch(Exception $e){
            	$db->rollback();
        	}

	}

        public static function edit($data){
                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("rfid" => $data['senha'],  "grupo" => $data['group'], "atualizado" => $calendario);
                $db->beginTransaction();
                try{
                        $db->update('rfid' , $insert_data, "rfid = '" . $data['senha'] . "'");
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }
        }

        public static function remove($data) {

	        $db = Zend_Registry::get('db');
		$nome = $data['senha'];
        	$db->beginTransaction();

        	try {
            		$db->delete('rfid', "rfid = '". $nome."'");
            		$db->commit();

        	} catch (Exception $e) {
            		//$db->rollBack();

        	}	

    	}



}
?>
