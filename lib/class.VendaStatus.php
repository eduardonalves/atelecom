<?php

class VendaStatus extends VentoAdmin{

	private $Venda;
	public $produtoId;
	
	private $statusLabels = array (

								1 => array (
								
									'PRE-ANALISE' => 'Pré-Análise',
									'ANÁLISE' => 'Análise',
									'RESTRIÇÃO' => 'Restrição',
									'APROVADO' => 'Aprovado',
									'INSTALAR' => 'Instalar',
									'CONECTADO' => 'Conectado',
									'CANCELADO' => 'Cancelado',
									'DEVOLVIDO' => 'Devolvido',
									'ESTORNADA' => 'Estornada',
									'AGUARDANDO PAGAMENTO' => 'Aguardando Pagamento'
								),
							
								3 => array(
								
									'PRE-ANALISE' => 'Pré-Análise',
									'APROVADO' => 'Aprovado',
									'SEM COBERTURA' => 'Sem Cobertura',
									'RESTRIÇÃO' => 'Restrição',
									'REDIRECIONADO' => 'Redirecionado',
									'DEVOLVIDO' => 'Devolvido',
									'AGUARDAR DOCUMENTOS' => 'Aguardar Documentos',
									'ANEXAR DOCUMENTOS' => 'Anexar Documentos',
									'DOCUMENTOS ANEXADOS' => 'Documentos Anexados',
									'ENVIAR DOCUMENTOS' => 'Enviar Documentos',
									'DOCUMENTOS ENVIADOS' => 'Documentos Enviados',
									'DOCUMENTOS RECUSADOS' => 'Documento Recusado',
									'CANCELADO' => 'Cancelado',
									'FINALIZADA' => 'Finalizada',
									'ESTORNADA' => 'Estornada'
								
								)
	
							);

	private $fluxo =  array (
	
							1 => array (
							
								'PRE-ANALISE' => array(),
								'ANÁLISE' => array(),
								'RESTRIÇÃO' => array(),
								'APROVADO' => array(),
								'INSTALAR' => array(),
								'CONECTADO' => array(),
								'CANCELADO' => array(),
								'DEVOLVIDO' => array(),
								'ESTORNADA' => array(),
								'AGUARDANDO PAGAMENTO' => array()
							),
						
							3 => array (

								'PRE-ANALISE' => array (),
								'APROVADO' =>  array (),
								'SEM COBERTURA' => array(),
								'RESTRIÇÃO' => array(),
								'REDIRECIONADO' => array(),
								'DEVOLVIDO' => array(),
								'AGUARDAR DOCUMENTOS' => array(),
								'ANEXAR DOCUMENTOS' => array(),
								'DOCUMENTOS ANEXADOS' => array(),
								'ENVIAR DOCUMENTOS' => array(),
								'DOCUMENTOS ENVIADOS' => array(),
								'DOCUMENTOS RECUSADOS' => array(),
								'CANCELADO' => array(),
								'FINALIZADA' => array(),
								'ESTORNADA' => array()
							)
					
						);
						
	private $fluxoExcept = array (
								
								1 => array (

									'PRE-ANALISE' => array (
													
													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('ANÁLISE','RESTRIÇÃO','APROVADO')

													)
									),

									'ANÁLISE' => array (
													
													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('CANCELADO','RESTRIÇÃO','APROVADO','DEVOLVIDO')

													)
									),
								
									'APROVADO' => array (

													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),
																										
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('AGUARDANDO PAGAMENTO', 'INSTALAR')

													)
									),

									'INSTALAR' => array (
													
													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('CONECTADO')

													)
									),

									'CONECTADO' => array (
													
													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('ESTORNADA')

													)
									),

									'AGUARDANDO PAGAMENTO' => array (
													
													'Administrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('ADMINISTRADOR')
																		),
																'flux' => array('PRE-ANALISE','ANÁLISE','RESTRIÇÃO','APROVADO','INSTALAR','CONECTADO','CANCELADO','DEVOLVIDO','ESTORNADA','AGUARDANDO PAGAMENTO')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('INSTALAR')

													)
									),
								),
						
								3 => array (
									
									'PRE-ANALISE' => array (
													
													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array ('APROVADO', 'SEM COBERTURA', 'RESTRIÇÃO', 'REDIRECIONADO')

													)
									),
									
									'APROVADO' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),													

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array ('AGUARDAR DOCUMENTOS', 'ANEXAR DOCUMENTOS')

													)
									),
									
									'AGUARDAR DOCUMENTOS' => array (
													
													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('ANEXAR DOCUMENTOS', 'DEVOLVIDO')

													)
									),

									'ANEXAR DOCUMENTOS' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),
																										
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('DOCUMENTOS ANEXADOS')

													)
									),

									'DOCUMENTOS ANEXADOS' => array (
													
													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),
													
													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('ENVIAR DOCUMENTOS')

													)
									),

									'ENVIAR DOCUMENTOS' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),													

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('DOCUMENTOS ENVIADOS')

													)
									),

									'DOCUMENTOS ANEXADOS' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),													

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('ENVIAR DOCUMENTOS')

													)
									),

									'DOCUMENTOS ENVIADOS' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),													

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('DOCUMENTOS RECUSADOS', 'FINALIZADA')

													)
									),

									'DOCUMENTOS RECUSADOS' => array (
													
													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('CANCELADO', 'ANEXAR DOCUMENTOS')

													)
									),
									
									'FINALIZADA' => array (

													'tipouserAdministrador' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('AUDITOR')
																		),
																'flux' => array('PRE-ANALISE','APROVADO','SEM COBERTURA','RESTRIÇÃO','REDIRECIONADO','DEVOLVIDO','AGUARDAR DOCUMENTOS','ANEXAR DOCUMENTOS','DOCUMENTOS ANEXADOS','ENVIAR DOCUMENTOS','DOCUMENTOS ENVIADOS','DOCUMENTOS RECUSADOS','CANCELADO','FINALIZADA','ESTORNADA')

													),													

													'tipouser' => array(
																
																'==' => array (
																	
																		'Usuarios.tipo_usuario' => array('MONITORBO')
																		),
																'flux' => array('ESTORNADA')

													)
									)
									/*
									'PRE-ANALISE' => array (
													
													'except2' => array (
														
														'==' => array(
														
															'Venda.operador' => array('711', '7112', '714'),
															'Venda.monitor' => array('3143'),
															'Venda.tipoVenda' => array('INTERNA')
															),

														'!=' => array(
															
															'Venda.tipoVenda' => array('EXTERNA'),
															'Usuarios.acesso_usuario' => array('INTERNO')
															
															),

														'flux' => array('cancelado')
														
													),
													
													'except111' => array (
														
														'==' => array(
														
															'Venda.produto' => array('3')
														),
														'flux' => array('ESTORNADA')
													)
													
									)*/
								
								)
	
							);


	function __construct(Venda &$venda){
		
		parent::__construct();
		
		$this->Venda =& $venda;

		$this->produtoId = (int) $this->Venda->produto;

	}
	
	private function validaExcept($except)
	{
		
		$validate = true;
		
		foreach( $except as $key=>$value )
		{

			if ( $key != 'flux' ) 
			{
				
				if ( $key == '==' && $validate === true)
				{
					
					foreach( $value as $chave=>$valor )
					{
						
						
						
						foreach($valor as $val)
						{
						$valid = false;
						
						$parseObj = explode(".", $chave);
						
						if ( strtolower($this->$parseObj[0]->$parseObj[1]) == strtolower($val) ) { $valid = true; }
						
						}
						
						if ($validate === true) { $validate = $valid; }
						
					}
					

				}

				if ( $key == '!=' && $validate === true )
				{
					foreach( $value as $chave=>$valor )
					{
						
						
						
						foreach($valor as $val)
						{
						$valid = false;
						
						$parseObj = explode(".", $chave);
						
						if ( strtolower($this->$parseObj[0]->$parseObj[1]) != strtolower($val) ) { $valid = true; }
						
						}
						
						if ($validate === true) { $validate = $valid; }
						
					}
				}

				if ( $key == '>' && $validate === true )
				{
					foreach( $value as $chave=>$valor )
					{
						
						
						
						foreach($valor as $val)
						{
						$valid = false;
						
						$parseObj = explode(".", $chave);
						
						if ( strtolower($this->$parseObj[0]->$parseObj[1]) > strtolower($val) ) { $valid = true; }
						
						}
						
						if ($validate === true) { $validate = $valid; }
						
					}

				}

				if ( $key == '<' && $validate === true )
				{
					foreach( $value as $chave=>$valor )
					{
						
						
						
						foreach($valor as $val)
						{
						$valid = false;
						
						$parseObj = explode(".", $chave);
						
						echo strtolower($this->$parseObj[0]->$parseObj[1]) ." < ".strtolower($val), "<br>";
						if ( strtolower($this->$parseObj[0]->$parseObj[1]) < strtolower($val) ) { $valid = true; }
						
						}
						
						if ($validate === true) { $validate = $valid; }
						
					}

				}
				
			}
			
		}
		
		return $validate;
		
	}
	
	public function getFluxo($status=''){
		
		if($status=='') { $status = $this->Venda->status; }
		
		if( array_key_exists($status, $this->fluxoExcept[$this->produtoId]) )
		{
			
			foreach($this->fluxoExcept[$this->produtoId][$status] as $except)
			{
				
				if( $this->validaExcept($except) )
				{
					
					$fluxo = $except['flux'];

					$fluxoReturn = array();

					foreach( $fluxo as $fluxoId )
					{
						$fluxoReturn[$fluxoId] = $this->getStatusLabel($fluxoId);
					}
					
					asort($fluxoReturn);

					$fluxoReturn = array($this->Venda->status =>$this->getStatusLabel($this->Venda->status) ) + $fluxoReturn;
		
					return $fluxoReturn;
					
				}
				
			}
			
		}
		
		if( array_key_exists($status, $this->fluxo[$this->produtoId]) )
		{

			$fluxo = array();
			
			$fluxo = $this->fluxo[$this->produtoId][$status];

			$fluxoReturn = array();
		
			foreach( $fluxo as $fluxoId )
			{
				$fluxoReturn[$fluxoId] = $this->getStatusLabel($fluxoId);
			}
			
			asort($fluxoReturn);
			
			$fluxoReturn = array($this->Venda->status =>$this->getStatusLabel($this->Venda->status) ) + $fluxoReturn;

			return $fluxoReturn;
		
		}else{

			if( array_key_exists($status, $this->statusLabels[$this->produtoId]) )
			{
				
				$fluxo = array($this->Venda->status);
				
				foreach( $fluxo as $fluxoId )
				{
					$fluxoReturn[$fluxoId] = $this->getStatusLabel($fluxoId);
				}
				
				asort($fluxoReturn);
	
				return $fluxoReturn;
			
			}else{
				
				trigger_error("Este status não pertence ao fluxo desta venda: " . $status, E_USER_ERROR);
				return false;
			}
			
		}
		
	}
	
	public function getStatusLabel($status='')
	{

		if($status=='') { $status = $this->Venda->status; }
		
		if( array_key_exists($status, $this->statusLabels[$this->produtoId]) )
		{
			
			$label = $this->statusLabels[$this->produtoId][$status];
			
			return $label;
		
		}else{
			
			trigger_error("Label de status não encontrado: " . $status, E_USER_ERROR);
			return false;
		}

		
	}
	
	public function getAllStatus()
	{
		$allStatus = $this->statusLabels[$this->produtoId];
		
		asort($allStatus);

		return $allStatus;
	}
	
}

?>
