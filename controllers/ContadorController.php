<?php
class Porteiro_ContadorController extends Zend_Controller_Action
{
	
       public function createForm($xml)
       {   
                $form = new Snep_Form($xml);
                $form->setMethod('post');
                $form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
                return $form;
       }   

 
	public function indexAction()
	{
		$this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
		$this->view->breadcrumb = $this->view->translate("Porteiro >> Inicio");
	}

	public function contadorrfidAction()
	{

		$this->view->breadcrumb = $this->view->translate("Porteiro >> Contabilizador >> Contabilizar dados de RFID.");

	}

	public function contadorsenhaAction()
	{

                $this->view->breadcrumb = $this->view->translate("Porteiro >> Contabilizador >> Contabilizar dados de uso da senha.");

	}

	public function contadorgeralAction()
	{

                $this->view->breadcrumb = $this->view->translate("Porteiro >> Contabilizador >> Contabilizar todos os dados.");

        }
}
?>
