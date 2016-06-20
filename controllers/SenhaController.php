<?php

class Porteiro_SenhaController extends Zend_Controller_Action
{
	
	public function	init(){}

	public function indexAction()
	{
	        // Define a baseUrl para a rotina, utilizado nos links para demais rotinas na view
		$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();

		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
	}
	


	public function cadastrarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar nova senha");
		
		// Parse do arquivo de formulário.
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/cadastro.xml" );

		// Define o título da página, é mostrado automaticamente na view.
	        $this->view->breadcrumb = $this->view->translate("Porteiro » Cadastro");

	        // Cria objeto Snep_Form
	        $form = new Zend_Form($xml);
		$form->setMethod('post');
		$form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
	
        	// Verifica se existe dados sendo enviados via $_POST
        	// Se for verdadeiro, é porqyue o formulário foi submetido.
        	if ($this->_request->getPost()) {

            		// Chama método isValid() é confronta os dados submetidos pelo formulário.
         	   	$isValid = $form->isValid($_POST);

            		// Caso tudo seja válido chama a classe (Model) para inserir o dado.
            		if( $isValid ) {
           
				$senha1 = $_POST['senha'];
				$senha2 = $_POST['senhac'];
                
               		 	// Após remover ou nao dados redireciona para método index
               		 	// Se as senhas forem iguais, ele vai redirecionar ao index
				if ($senha1 == $senha2){
					$this->_redirect($this->getRequest()->getControllerName() . "/confirmado");
				}
           	 	}
			else {
				$this->_redirect($this->getRequest()->getControllerName() . "/errorcadastrar");
			}
        	}
		

        	// Envia form para a view
        	$this->view->form = $form;
	}
}

?>
