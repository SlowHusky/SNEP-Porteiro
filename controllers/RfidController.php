<?php
class Porteiro_RfidController extends Zend_Controller_Action
{
	
	public function	init(){}

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

	public function cadastrarrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar novo RFID");
        	$xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                              "/modules/porteiro/forms/rfid/cadastrorfid.xml" );
		$form = Porteiro_RfidController::createForm($xml);

        	if ($this->_request->getPost()) {
         	   	$isValid = $form->isValid($_POST);
            		if( $isValid ) {
				$senha1 =(string) $_POST['senha'];
				if (strlen($senha1) > 0)  {
					Rfid_ManagerRfid::add($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/rfid/index");
				}
				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/rfid/errorcadastrar");
                       		}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/rfid/errorcadastrar");
			}
        	}
        	$this->view->form = $form;
	}
	
	public function errorcadastrarAction(){}

	public function editarrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Editar RFID");
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/rfid/editarrfid.xml");
                $form = Porteiro_RfidController::createForm($xml);

        	if ($this->_request->getPost()) {
         	   	$isValid = $form->isValid($_POST);
            		if( $isValid ) {
				$senha1 =(string) $_POST['senha'];
				if (strlen($senha1) > 0)  {
					Rfid_ManagerRfid::edit($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/rfid/index");
				}
				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/rfid/erroreditar");
                       		}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/rfid/erroreditar");
			}
        	}
        	$this->view->form = $form;
	}

	public function removerrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Remover RFID");		
                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/rfid/removerrfid.xml" );
                $form = Porteiro_RfidController::createForm($xml);
                
		if ($this->_request->getPost()) {
                        $isValid = $form->isValid($_POST);
                        if( $isValid ) {
                                $usuario = (string) $_POST['senha'];
                                if (strlen($usuario) > 0){
                                        Rfid_ManagerRfid::remove($_POST);
                                        $this->_redirect($this->getRequest()->getModuleName() . "/rfid/index");
				}
                        }
                        else {
                                $this->_redirect($this->getRequest()->getModuleName(). "/rfid/errorcadastrar");
                        }
                }
                $this->view->form = $form;
        }
}
?>
