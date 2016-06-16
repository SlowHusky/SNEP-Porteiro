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
		$this->view->text = "OI!";
		
		// Parse do arquivo de formulário.
	        $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
                                               "/modules/porteiro/forms/cadastro.xml" );

		// Define o título da página, é mostrado automaticamente na view.
	        $this->view->breadcrumb = $this->view->translate("Porteiro » Cadastro");
	        // Cria objeto Snep_Form
	        $form = new Snep_Form( $xml);
	
	        // Verifica se existe dados sendo enviados via $_POST
        	// Se for verdadeiro, é porque o formulário foi submetido.
        	if ($this->_request->getPost()) {

			$form_isValid = true;
			$isValid = $form->isValid($_POST);
			$password = $form->getValue('senha');
			$password2 = $form->getValue('senha2');
/*
			if ($password <> $password2){
				//$this->view->error_message = $this->view->translate('Senhas não conferem');
            			echo '<script language="javascript">';
           			echo 'alert("Senhas não conferem")';
            			echo '</script>';
				//$this->_redirect($this->getRequest()->getControllerName());
				$r = new Zend_Controller_Action_Helper_Redirector;
				$r->gotoUrl('/some/url')->redirectAndExit();
				$form_isValid = false;
				$isValid = false;				
			}
*/
			if ($form_isValid == true){
            			echo '<script language="javascript">';
           			echo 'alert("Senhas não conferem")';
            			echo '</script>';                 		
				$this->view->message = $this->view->translate('Enviado com sucesso!');
	
			//	$this->_redirect($this->getRequest()->getControllerName());
			}
		}

             	$this->view->form = $form;
	}
}

?>
