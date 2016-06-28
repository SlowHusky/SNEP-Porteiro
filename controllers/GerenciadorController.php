<?php
class Porteiro_GerenciadorController extends Zend_Controller_Action
{

	        public function init(){}



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
		                                Gerenciador_Manager::addporteiro($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
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
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/removerporteiro.xml" );
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
		                                Gerenciador_Manager::rmporteiro($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorremoverporteiro");
		                        }
		                }
		                
		                // Envia form para a view
		                $this->view->form = $form;
		 
		
		}
		
		public function editarporteiroAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Editar Porteiro");
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/editarporteiro.xml" );
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
		                                Gerenciador_Manager::editporteiro($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/erroreditarporteiro");
		                        }
		                }
		                
		                // Envia form para a view
		                $this->view->form = $form;
		        
		
		}

		public function cadastrargrupoAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Cadastrar Grupo");
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/cadastrargrupo.xml" );
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
		                                Gerenciador_Manager::addgrupo($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/senha/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorcadastrargrupo");
		                        }
		                }
		                
		                // Envia form para a view
		                $this->view->form = $form;
		       
		}
		
		public function removergrupoAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Remover Grupo");
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/gerenciador/removergrupo.xml" );
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
		                                Gerenciador_Manager::rmgrupo($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorremovergrupo");
		                        }
		                }
		                
		                // Envia form para a view
		                $this->view->form = $form;
		        
		
		}		

		
		public function permissoesAction(){
		                $this->view->breadcrumb = $this->view->translate("Porteiro >> Permissões");
		                
		                // Parse do arquivo de formulário
		                $xml = new Zend_Config_Xml( Zend_Registry::get("config")->system->path->base .
		                                              "/modules/porteiro/forms/permissoes.xml" );
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
		                                Gerenciador_Manager::permissoes($_POST);
		                                $this->_redirect($this->getRequest()->getModuleName() . "/gerenciador/index");
		                        }
		                        else {
		                                $this->_redirect($this->getRequest()->getModuleName(). "/gerenciador/errorpermissoes");
		                        }
		                }
		                
		                // Envia form para a view
		                $this->view->form = $form;
		 
		}
}

?>

