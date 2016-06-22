<?php
 
class Senha_Manager {
 
	public static function add($data){

	        $db = Zend_Registry::get('db');
		$calendario =  date("Y-m-d H:i");
	        $insert_data = array("senha" => $data['senha'], "usuario" => $data['nome'], "grupo" => $data['group'], "cadastro" => $calendario, "atualizado" => $calendario);

        	$db->beginTransaction();

        	try{
            		$db->insert('senha', $insert_data);
            		$db->commit();

        	}catch(Exception $e){

            	$db->rollback();

        	}
	}


        public static function edit($data){

                $db = Zend_Registry::get('db');
                $calendario =  date("Y-m-d H:i");
                $insert_data = array("senha" => $data['senha'], "usuario" => $data['nome'], "grupo" => $data['group'], "cadastro" => $calendario, "atualizado" => $cal$

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
