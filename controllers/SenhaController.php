<?php

class Porteiro_SenhaController extends Zend_Controller_Action
{
	
	public function	init(){}

	public function indexAction(){
	        // Define a baseUrl para a rotina, utilizado nos links para demais rotinas na view
		$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
	}

	public function cadastrarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar nova senha");
		
		// Parse do arquivo de formulário
        	$xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                              "/modules/porteiro/forms/cadastro.xml" );

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
           
				$senha1 =(int) $_POST['senha'];
				$senha2 = (int) $_POST['senhac'];
                		$usuario = $_POST['nome'];
				$grupo = $_POST['group'];
				
               		 	// Após remover ou nao dados redireciona para método index
               		 	// Se as senhas forem iguais, ele vai redirecionar ao index
				if ($senha1 === $senha2)  {

					Senha_Manager::add($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/index");
				}


				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
                       		}

           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
			}
        	}
		

        	// Envia form para a view
        	$this->view->form = $form;
	}
	
	public function errorcadastrarAction(){
	}

	public function editarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Editar senha");
		
		// Parse do arquivo de formulário.
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/editar.xml");
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
           
				$senha1 =(int) $_POST['senha'];
				$senha2 = (int) $_POST['senhac'];
                		$usuario = $_POST['nome'];
				$grupo = $_POST['group'];
				
               		 	// Após remover ou nao dados redireciona para método index
               		 	// Se as senhas forem iguais, ele vai redirecionar ao index
				if ($senha1 === $senha2)  {
					Senha_Manager::edit($_POST);
					$this->_redirect($this->getRequest()->getModuleName() . "/index");
				}
				else {
                                	$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
                       		}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getModuleName(). "/senha/errorcadastrar");
			}
        	}
		
        	// Envia form para a view
        	$this->view->form = $form;
	}

}

?>
