<?php
class Porteiro_SenhaController extends Zend_Controller_Action
{
	
       public function createForm($xml)
       {   
                $form = new Snep_Form($xml);
                $form->setMethod('post');
                $form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
                return $form;
       }   

 
	public function indexAction(){
		$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
	}

	public function cadastrarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar nova senha");
        	$xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                              "/modules/porteiro/forms/senha/cadastro.xml" );

	        $form = Porteiro_SenhaController::createForm($xml);
        	
        	if ($this->_request->getPost()){ 
         	   	$isValid = $form->isValid($_POST);
            		if( $isValid ) {
				$senha1 =(int) $_POST['senha'];
				$senha2 = (int) $_POST['senhac'];
                		$usuario = $_POST['nome'];
				$grupo = $_POST['group'];
				if ($senha1 === $senha2)  {
					Senha_Manager::add($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/senha/index");
				}
				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
                       		}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
			}
        	}
        	$this->view->form = $form;
	}
	
	public function errorcadastrarAction(){
	}
	public function editarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Editar senha");
		
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/senha/editar.xml");
                $form = Porteiro_SenhaController::createForm($xml);


        	if ($this->_request->getPost()) {
         	   	$isValid = $form->isValid($_POST);
            		if( $isValid ) {
				$senha1 =(int) $_POST['senha'];
				$senha2 = (int) $_POST['senhac'];
				if ($senha1 === $senha2)  {
					Senha_Manager::edit($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/senha/index");
				}
				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/senha/erroreditar");
                       		}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/senha/erroreditar");
			}
        	}
        	$this->view->form = $form;
	}
	public function removerAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Editar senha");		
                
                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/senha/remover.xml" );
               
                $form = Porteiro_SenhaController::createForm($xml);

		if ($this->_request->getPost()) {
                        $isValid = $form->isValid($_POST);
                        if( $isValid ) {
                                $usuario = (string) $_POST['nome'];
                                if (strlen($usuario) > 0){
                                        Senha_Manager::remove($_POST);
                                        $this->_redirect($this->getRequest()->getModuleName() . "/senha/index");
				}
                        }
                        else {
                                $this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
                        }
                }
                $this->view->form = $form;
        }
}
?>
