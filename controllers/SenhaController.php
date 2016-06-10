<?php

class Porteiro_SenhaController extends Zend_Controller_Action
{
	
	public function	init(){}

	public function indexAction()
	{
	//	$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
		echo "<p>Teste</p>";
	}
	


	public function cadastrarAction(){
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar nova senha");
		$this->view->text = "OI!";
		
		// Parse do arquivo de formulário.
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/cadastro.xml" );
        	// Cria objeto Snep_Form
	        $form = new Snep_Form( $xml);

        	// setButton é um método da classe Snep_Form que inclue o menu padrão de botões.
        	//$form->setButton();

        	// Verifica se existe dados sendo enviados via $_POST
        	// Se for verdadeiro, é porque o formulário foi submetido.
        	if ($this->_request->getPost()) {

            		// Chama método isValid() e confronta os dados submetidos pelo formulário.
            		$isValid = $form->isValid($_POST);

            		// Caso tudo seja válido chama a classe (Model) para inserir o registro.
            		if( $isValid ) {

                		// Chama método estático para adicionar o registro.
                		Example_Manager::add($_POST);

                		// Após inserir dados redireciona para método index
                		$this->_redirect( $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName() );

            		}	
         	}
        	// Envia form para a view
        	$this->view->form = $form;
	}	

	public function editarAction(){
	}

}

?>
