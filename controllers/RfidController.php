<?php
class Porteiro_RfidController extends Zend_Controller_Action
{
	
	public function	init(){}
	public function indexAction(){
	        // Define a baseUrl para a rotina, utilizado nos links para demais rotinas na view
		$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
	}
	public function cadastrarrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar novo RFID");
		
		// Parse do arquivo de formulário
        	$xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                              "/modules/porteiro/forms/rfid/cadastrorfid.xml" );
	        // Cria objeto Snep_Form
	        $form = new Snep_Form($xml);
		$form->setMethod('post');
		$form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
	
        	// Verifica se existe dados sendo enviados via $_POST
        	// Se for verdadeiro, é porqyue o formulário foi submetido.
        	if ($this->_request->getPost()) {
            		// Chama método isValid() é confronta os dados submetidos pelo formulário.
         	   	$isValid = $form->isValid($_POST);
            		// Caso tudo seja válido chama a classe (Model) para inserir o dado.
            		if( $isValid ) {
           
				$senha1 =(string) $_POST['senha'];
               		 	// Após remover ou nao dados redireciona para método index
               		 	// Se as senhas forem iguais, ele vai redirecionar ao index
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
		
        	// Envia form para a view
        	$this->view->form = $form;
	}
	
	public function errorcadastrarAction(){
	}
	public function editarrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Editar RFID");
		
		// Parse do arquivo de formulário.
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/rfid/editarrfid.xml");
	        // Cria objeto Snep_Form
	        $form = new Snep_Form($xml);
		$form->setMethod('post');
		$form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
	
        	// Verifica se existe dados sendo enviados via $_POST
        	// Se for verdadeiro, é porqyue o formulário foi submetido.
        	if ($this->_request->getPost()) {
            		// Chama método isValid() é confronta os dados submetidos pelo formulário.
         	   	$isValid = $form->isValid($_POST);
            		// Caso tudo seja válido chama a classe (Model) para inserir o dado.
            		if( $isValid ) {
           
				$senha1 =(string) $_POST['senha'];
				
               		 	// Após remover ou nao dados redireciona para método index
               		 	// Se as senhas forem iguais, ele vai redirecionar ao index
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
		
        	// Envia form para a view
        	$this->view->form = $form;
	}
	public function removerrfidAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Remover RFID");		
                // Parse do arquivo de formulário.
                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/rfid/removerrfid.xml" );
                // Cria objeto Snep_Form
                $form = new Snep_Form($xml);
                $form->setMethod('post');
                $form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
                // Verifica se existe dados sendo enviados via $_POST
                // Se for verdadeiro, é porque o formulário foi submetido.
                
		if ($this->_request->getPost()) {
                        // Chama método isValid() é confronta os dados submetidos pelo formulário.
                        $isValid = $form->isValid($_POST);
                        // Caso tudo seja válido chama a classe (Model) para inserir o dado.
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
                // Envia form para a view
                $this->view->form = $form;
        }
}
?>
