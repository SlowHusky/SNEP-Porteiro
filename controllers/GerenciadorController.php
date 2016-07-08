<?php
class Porteiro_GerenciadorController extends Zend_Controller_Action
{

	        public function init(){}
		
		public function createForm($xml)
		{
                       $form = new Snep_Form($xml);
                       $form->setMethod('post');
                       $form->setEnctype(Zend_Form::ENCTYPE_URLENCODED);
		       return $form;
		}


	        public function indexAction(){
	                // Define a baseUrl para a rotina, utilizado nos links para demais rotinas na view
	                $this->view->url = $this->getRequest()->getModuleName() .'/'. $this->getRequest()->getControllerName();
	                $this->view->breadcrumb = $this->view->translate("Porteiro >> Grupos");
	        }



		public function cadastrarporteiroAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar Porteiro");
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/cadastrarporteiro.xml" );
		                // Cria objeto Snep_Form
				$form = Porteiro_GerenciadorController::createForm($xml);
		                	
                		// Verifica se existe dados sendo enviados via $_POST
                		// Se for verdadeiro, é porque o formulário foi submetido.
                		if ($this->_request->getPost()) {
                        		// Chama método isValid() é confronta os dados submetidos pelo formulário.
                        		$isValid = $form->isValid($_POST);
                        		// Caso tudo seja válido chama a classe (Model) para inserir o dado.
                        		if( $isValid ) { 
                                        	Gerenciador_Manager::porteiroAdd($_POST);
                                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
                                                print_r($_POST);

                        		}   
                        		else {
                                		$this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorcadastrarporteiro");
                      			}   
                		}		
                		// Envia form para a view
                		$this->view->form = $form;
        	}	
		
		public function removerporteiroAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Remover Porteiro");
		            
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/removerporteiro.xml");
                                $form = Porteiro_GerenciadorController::createForm($xml);
		                if ($this->_request->getPost()) {
		                        $isValid = $form->isValid($_POST);
		                        if( $isValid ) {
		                                Gerenciador_Manager::porteiroRemove($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorremoverporteiro");
		                        }
		                }
		                $this->view->form = $form;
		}
		
		public function editarporteiroAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Editar Porteiro");
		      
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/editarporteiro.xml" );
                                $form = Porteiro_GerenciadorController::createForm($xml);
		                if ($this->_request->getPost()) {
		                        $isValid = $form->isValid($_POST);
		                        if( $isValid ) {
		                                Gerenciador_Manager::porteiroEdit($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/erroreditarporteiro");
		                        }
		                }
		                $this->view->form = $form;
		}


		public function cadastrargrupoAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar Grupo");
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/cadastrargrupo.xml" );
                                $form = Porteiro_GerenciadorController::createForm($xml);
		                if ($this->_request->getPost()) {
		                        $isValid = $form->isValid($_POST);
		                        if( $isValid ) {
		                                Gerenciador_Manager::grupoAdd($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorcadastrargrupo");
		                        }
		                }
		                $this->view->form = $form;
		}
		
		public function removergrupoAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Remover Grupo");
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/removergrupo.xml" );
                                $form = Porteiro_GerenciadorController::createForm($xml);
		                if ($this->_request->getPost()) {
		                        $isValid = $form->isValid($_POST);
		                        if( $isValid ) {
		                                Gerenciador_Manager::grupoRemove($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorremovergrupo");
		                        }
		                }
		                $this->view->form = $form;
		}		

		
		public function permissoesAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Permissões");
				$grupoid = $this->_getParam('grupo');
				$this->view->status = $this->_getParam('grupo');
				print_r($grupoid);
				if ($this->_request->isPost()) {
					$data = $this->_request->getPost();
					print_r($data);
					Gerenciador_Manager::permissoes($data);
				}
		}
}
?>

