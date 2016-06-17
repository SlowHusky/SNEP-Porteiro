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
	
		$request = $this->getRequest();

    		
        	if (getInstance()->getRequest()->isPost()) {
        		$this->view->form = $form;
        		$values = $form->getValues();
			$senha1 = $form['senha'];
			$senha2 = $form['senhac'];
			if ($senha1 === $senha2) {
				$this->_redirect($this->getRequest()->getControllerName() . "/confirmado");
			}   
          	} 
 
		else {
           		echo 'Invalid Form'; 
      		}
				
	}
}

?>
