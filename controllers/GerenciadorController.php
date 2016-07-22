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

		public function errorcadastrarporteiroAction(){}

		public function cadastrarporteiroAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar Porteiro");
		          
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/cadastrarporteiro.xml" );
				$form = Porteiro_GerenciadorController::createForm($xml);
		                	
        
                		if ($this->_request->getPost()) {
        
                        		$isValid = $form->isValid($_POST);
        
                        		if( $isValid ) { 
                                        	Gerenciador_Manager::porteiroAdd($_POST);
                                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");

                        		}   
                        		else {
                                		$this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorcadastrarporteiro");
						print_r("Um erro foi encontrado, por favor revise os campos.");
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
		                                $this->_redirect($this->getRequest()->getModuleName() . 
											"/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName().
											"/gerenciador/errorremoverporteiro");
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
		                                $this->_redirect($this->getRequest()->getModuleName() .
										 "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName().
										 "/gerenciador/erroreditarporteiro");
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
					
						$existeGrupoMesmoNome = Gerenciador_Manager::verificarGrupo($_POST['grupo']); 
						if ( $existeGrupoMesmoNome == false){						
		                                	Gerenciador_Manager::grupoAdd($_POST);
		                               	 	$this->_redirect($this->getRequest()->getModuleName() .
								 "/gerenciador/index");
		                       		}
						else{
							$this->_redirect($this->getRequest()->getModuleName() . 
								"/gerenciador/errogruponomeigual");
						}

					}
		                        else {
		                        	        $this->_redirect($this->getRequest()->getModuleName().
											 "/gerenciador/errorcadastrargrupo");
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
		                                $this->_redirect($this->getRequest()->getModuleName() .
											 "/gerenciador/index");
		                        }  
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName().
											 "/gerenciador/errorremovergrupo");
		                        }
		                }
		                $this->view->form = $form;
		}		

		
		public function permissoesAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Permissões");
				$grupoid = $this->_getParam('grupo');
				$this->view->status = $this->_getParam('grupo');
				if ($this->_request->isPost()) {
					$data = $this->_request->getPost();
					Gerenciador_Manager::permissoes($data);
					$this->_redirect($this->getRequest()->getModuleName() .
										 "/gerenciador/index");
				}
		}
		
		public function errorcadastrargrupoAction(){}
		public function errogruponomeigualAction(){}
}
?>

