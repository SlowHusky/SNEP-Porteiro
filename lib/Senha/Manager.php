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
		$sql = 'SELECT cadastro FROM senha WHERE usuario = ' . $data['nome'];
                $insert_data = array("senha" => $data['senha'], "usuario" => $data['nome'], "grupo" => $data['group'], 'cadastro' => $sql, "atualizado" => $calendario);
		$usuario => $data['nome'];
                $db->beginTransaction();
	
                try{
                        $db->update('senha' ,$insert_data, "usuario = {$usuario}");
                        $db->commit();

                }catch(Exception $e){

                $db->rollback();

                }
        }
        public static function remove($data){
                $db = Zend_Registry::get('db');
		$usuario = $data['nome'];
                $db->beginTransaction();
                try{
			$db->delete('senha', array(
					'usuario = ?' => $usuario));
                        $db->commit();
                }catch(Exception $e){
                $db->rollback();
                }
        }






}
?>
