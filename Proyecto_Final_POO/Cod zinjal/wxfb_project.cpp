///////////////////////////////////////////////////////////////////////////
// C++ code generated with wxFormBuilder (version Jun 17 2015)
// http://www.wxformbuilder.org/
//
// PLEASE DO "NOT" EDIT THIS FILE!
///////////////////////////////////////////////////////////////////////////

#include "wxfb_project.h"

///////////////////////////////////////////////////////////////////////////

VentanaPrincipalWx::VentanaPrincipalWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxFrame( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer9;
	bSizer9 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer13;
	bSizer13 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText1 = new wxStaticText( this, wxID_ANY, wxT("Patente:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText1->Wrap( -1 );
	bSizer13->Add( m_staticText1, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_TextoBuscador = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	bSizer13->Add( m_TextoBuscador, 1, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_BotonBuscar = new wxButton( this, wxID_ANY, wxT("Buscar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer13->Add( m_BotonBuscar, 0, wxALL, 5 );
	
	
	bSizer9->Add( bSizer13, 0, wxEXPAND, 5 );
	
	m_grilla = new wxGrid( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, 0 );
	
	// Grid
	m_grilla->CreateGrid( 0, 5 );
	m_grilla->EnableEditing( false );
	m_grilla->EnableGridLines( true );
	m_grilla->EnableDragGridSize( false );
	m_grilla->SetMargins( 0, 0 );
	
	// Columns
	m_grilla->SetColSize( 0, 94 );
	m_grilla->SetColSize( 1, 99 );
	m_grilla->SetColSize( 2, 90 );
	m_grilla->SetColSize( 3, 53 );
	m_grilla->SetColSize( 4, 47 );
	m_grilla->EnableDragColMove( false );
	m_grilla->EnableDragColSize( true );
	m_grilla->SetColLabelSize( 30 );
	m_grilla->SetColLabelValue( 0, wxT("Tipo") );
	m_grilla->SetColLabelValue( 1, wxT("Patente") );
	m_grilla->SetColLabelValue( 2, wxT("Ingreso") );
	m_grilla->SetColLabelValue( 3, wxT("Lugar") );
	m_grilla->SetColLabelValue( 4, wxT("Llave") );
	m_grilla->SetColLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Rows
	m_grilla->EnableDragRowSize( true );
	m_grilla->SetRowLabelSize( 0 );
	m_grilla->SetRowLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Label Appearance
	
	// Cell Defaults
	m_grilla->SetDefaultCellAlignment( wxALIGN_LEFT, wxALIGN_TOP );
	bSizer9->Add( m_grilla, 1, wxALL|wxEXPAND, 5 );
	
	wxBoxSizer* bSizer14;
	bSizer14 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonIngreso = new wxButton( this, wxID_ANY, wxT("Ingreso"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_BotonIngreso, 1, wxALL, 5 );
	
	m_BotonEgreso = new wxButton( this, wxID_ANY, wxT("Egreso"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_BotonEgreso, 1, wxALL, 5 );
	
	m_eliminar = new wxButton( this, wxID_ANY, wxT("Eliminar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_eliminar, 1, wxALL, 5 );
	
	m_BotonEditar = new wxButton( this, wxID_ANY, wxT("Editar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_BotonEditar, 1, wxALL, 5 );
	
	m_tarifas = new wxButton( this, wxID_ANY, wxT("Tarifas"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_tarifas, 1, wxALL, 5 );
	
	m_BotonHistorico = new wxButton( this, wxID_ANY, wxT("Historico"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer14->Add( m_BotonHistorico, 1, wxALL, 5 );
	
	
	bSizer9->Add( bSizer14, 0, wxEXPAND, 5 );
	
	
	this->SetSizer( bSizer9 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonBuscar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonBuscar ), NULL, this );
	m_BotonIngreso->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonIngreso ), NULL, this );
	m_BotonEgreso->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEgreso ), NULL, this );
	m_eliminar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEliminar ), NULL, this );
	m_BotonEditar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEditar ), NULL, this );
	m_tarifas->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonTarifas ), NULL, this );
	m_BotonHistorico->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonHistorico ), NULL, this );
}

VentanaPrincipalWx::~VentanaPrincipalWx()
{
	// Disconnect Events
	m_BotonBuscar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonBuscar ), NULL, this );
	m_BotonIngreso->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonIngreso ), NULL, this );
	m_BotonEgreso->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEgreso ), NULL, this );
	m_eliminar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEliminar ), NULL, this );
	m_BotonEditar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonEditar ), NULL, this );
	m_tarifas->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonTarifas ), NULL, this );
	m_BotonHistorico->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaPrincipalWx::ClickBotonHistorico ), NULL, this );
	
}

CuadroIngresoWx::CuadroIngresoWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer4;
	bSizer4 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer5;
	bSizer5 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText2 = new wxStaticText( this, wxID_ANY, wxT("Tipo:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText2->Wrap( -1 );
	bSizer5->Add( m_staticText2, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	wxString m_SeleccionadorTipoChoices[] = { wxT("Auto"), wxT("Camioneta"), wxT("Moto"), wxT("Bicicleta") };
	int m_SeleccionadorTipoNChoices = sizeof( m_SeleccionadorTipoChoices ) / sizeof( wxString );
	m_SeleccionadorTipo = new wxChoice( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, m_SeleccionadorTipoNChoices, m_SeleccionadorTipoChoices, 0 );
	m_SeleccionadorTipo->SetSelection( 0 );
	bSizer5->Add( m_SeleccionadorTipo, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer5, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer6;
	bSizer6 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText3 = new wxStaticText( this, wxID_ANY, wxT("Patente:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText3->Wrap( -1 );
	bSizer6->Add( m_staticText3, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_ValorPatente = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	m_ValorPatente->SetValidator( wxTextValidator( wxFILTER_ALPHANUMERIC, &ValiPatente ) );
	
	bSizer6->Add( m_ValorPatente, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer6, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer7;
	bSizer7 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText4 = new wxStaticText( this, wxID_ANY, wxT("Lugar:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText4->Wrap( -1 );
	bSizer7->Add( m_staticText4, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_ValorLugar = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	m_ValorLugar->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &IdenValiLugar ) );
	
	bSizer7->Add( m_ValorLugar, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer7, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer8;
	bSizer8 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText5 = new wxStaticText( this, wxID_ANY, wxT("Llave:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText5->Wrap( -1 );
	bSizer8->Add( m_staticText5, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	wxString m_SeleccionadorLlaveChoices[] = { wxT("Si"), wxT("No") };
	int m_SeleccionadorLlaveNChoices = sizeof( m_SeleccionadorLlaveChoices ) / sizeof( wxString );
	m_SeleccionadorLlave = new wxChoice( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, m_SeleccionadorLlaveNChoices, m_SeleccionadorLlaveChoices, 0 );
	m_SeleccionadorLlave->SetSelection( 0 );
	bSizer8->Add( m_SeleccionadorLlave, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer8, 1, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer9;
	bSizer9 = new wxBoxSizer( wxHORIZONTAL );
	
	m_button8 = new wxButton( this, wxID_ANY, wxT("Aceptar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer9->Add( m_button8, 0, wxALL, 5 );
	
	m_button9 = new wxButton( this, wxID_ANY, wxT("Cancelar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer9->Add( m_button9, 0, wxALL, 5 );
	
	
	bSizer4->Add( bSizer9, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer4 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_button8->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroIngresoWx::ClickBotonAceptar ), NULL, this );
	m_button9->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroIngresoWx::ClickBotonCancelar ), NULL, this );
}

CuadroIngresoWx::~CuadroIngresoWx()
{
	// Disconnect Events
	m_button8->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroIngresoWx::ClickBotonAceptar ), NULL, this );
	m_button9->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroIngresoWx::ClickBotonCancelar ), NULL, this );
	
}

VentanaCambioTarifaWx::VentanaCambioTarifaWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer16;
	bSizer16 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer17;
	bSizer17 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText18 = new wxStaticText( this, wxID_ANY, wxT("Tipo:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText18->Wrap( -1 );
	bSizer17->Add( m_staticText18, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	wxString m_SeleccionadorTipoChoices[] = { wxT("Auto"), wxT("Camioneta"), wxT("Moto"), wxT("Bicicleta") };
	int m_SeleccionadorTipoNChoices = sizeof( m_SeleccionadorTipoChoices ) / sizeof( wxString );
	m_SeleccionadorTipo = new wxChoice( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, m_SeleccionadorTipoNChoices, m_SeleccionadorTipoChoices, 0 );
	m_SeleccionadorTipo->SetSelection( 0 );
	bSizer17->Add( m_SeleccionadorTipo, 1, wxALL, 5 );
	
	
	bSizer16->Add( bSizer17, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer19;
	bSizer19 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText20 = new wxStaticText( this, wxID_ANY, wxT("30 min"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText20->Wrap( -1 );
	bSizer19->Add( m_staticText20, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_Valor30min = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 50,-1 ), 0 );
	m_Valor30min->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &IdenVali30min ) );
	
	bSizer19->Add( m_Valor30min, 1, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_staticText221 = new wxStaticText( this, wxID_ANY, wxT("$"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText221->Wrap( -1 );
	bSizer19->Add( m_staticText221, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	
	bSizer16->Add( bSizer19, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer20;
	bSizer20 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText21 = new wxStaticText( this, wxID_ANY, wxT("1 hora"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText21->Wrap( -1 );
	bSizer20->Add( m_staticText21, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_Valor1hora = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 50,-1 ), 0 );
	m_Valor1hora->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &IdenVali1hora ) );
	
	bSizer20->Add( m_Valor1hora, 1, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_staticText23 = new wxStaticText( this, wxID_ANY, wxT("$"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText23->Wrap( -1 );
	bSizer20->Add( m_staticText23, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	
	bSizer16->Add( bSizer20, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer21;
	bSizer21 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText22 = new wxStaticText( this, wxID_ANY, wxT("Fraccion\n15 min:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText22->Wrap( -1 );
	bSizer21->Add( m_staticText22, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_Valor15min = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 50,-1 ), 0 );
	m_Valor15min->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &IdenVali15min ) );
	
	bSizer21->Add( m_Valor15min, 1, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_staticText24 = new wxStaticText( this, wxID_ANY, wxT("$"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText24->Wrap( -1 );
	bSizer21->Add( m_staticText24, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	
	bSizer16->Add( bSizer21, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer211;
	bSizer211 = new wxBoxSizer( wxHORIZONTAL );
	
	m_aceptar = new wxButton( this, wxID_ANY, wxT("Aceptar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer211->Add( m_aceptar, 0, wxALL, 5 );
	
	m_cancelar = new wxButton( this, wxID_ANY, wxT("Cancelar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer211->Add( m_cancelar, 0, wxALL, 5 );
	
	
	bSizer16->Add( bSizer211, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer16 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_SeleccionadorTipo->Connect( wxEVT_COMMAND_CHOICE_SELECTED, wxCommandEventHandler( VentanaCambioTarifaWx::SeleccionTipo ), NULL, this );
	m_aceptar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaCambioTarifaWx::ClickBotonAceptar ), NULL, this );
	m_cancelar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaCambioTarifaWx::ClickBotonCancelar ), NULL, this );
}

VentanaCambioTarifaWx::~VentanaCambioTarifaWx()
{
	// Disconnect Events
	m_SeleccionadorTipo->Disconnect( wxEVT_COMMAND_CHOICE_SELECTED, wxCommandEventHandler( VentanaCambioTarifaWx::SeleccionTipo ), NULL, this );
	m_aceptar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaCambioTarifaWx::ClickBotonAceptar ), NULL, this );
	m_cancelar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaCambioTarifaWx::ClickBotonCancelar ), NULL, this );
	
}

SeleccionHistorialWx::SeleccionHistorialWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer22;
	bSizer22 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer23;
	bSizer23 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText25 = new wxStaticText( this, wxID_ANY, wxT("¿Por cual metodo desea generar un nuevo historico?"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText25->Wrap( -1 );
	bSizer23->Add( m_staticText25, 0, wxALL, 5 );
	
	
	bSizer22->Add( bSizer23, 0, wxALIGN_CENTER_HORIZONTAL, 5 );
	
	wxBoxSizer* bSizer24;
	bSizer24 = new wxBoxSizer( wxHORIZONTAL );
	
	m_Fechas = new wxButton( this, wxID_ANY, wxT("Fechas"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer24->Add( m_Fechas, 0, wxALL|wxALIGN_BOTTOM, 5 );
	
	m_Patente = new wxButton( this, wxID_ANY, wxT("Patente"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer24->Add( m_Patente, 0, wxALL|wxALIGN_BOTTOM, 5 );
	
	
	bSizer22->Add( bSizer24, 0, wxALIGN_CENTER_HORIZONTAL, 5 );
	
	
	this->SetSizer( bSizer22 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_Fechas->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( SeleccionHistorialWx::ClickBotonFechas ), NULL, this );
	m_Patente->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( SeleccionHistorialWx::ClickBotonPatente ), NULL, this );
}

SeleccionHistorialWx::~SeleccionHistorialWx()
{
	// Disconnect Events
	m_Fechas->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( SeleccionHistorialWx::ClickBotonFechas ), NULL, this );
	m_Patente->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( SeleccionHistorialWx::ClickBotonPatente ), NULL, this );
	
}

VentanaHisFechaWx::VentanaHisFechaWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer25;
	bSizer25 = new wxBoxSizer( wxVERTICAL );
	
	m_GrillaHis = new wxGrid( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, 0 );
	
	// Grid
	m_GrillaHis->CreateGrid( 0, 8 );
	m_GrillaHis->EnableEditing( true );
	m_GrillaHis->EnableGridLines( true );
	m_GrillaHis->EnableDragGridSize( false );
	m_GrillaHis->SetMargins( 0, 0 );
	
	// Columns
	m_GrillaHis->SetColSize( 0, 78 );
	m_GrillaHis->SetColSize( 1, 80 );
	m_GrillaHis->SetColSize( 2, 80 );
	m_GrillaHis->SetColSize( 3, 80 );
	m_GrillaHis->SetColSize( 4, 46 );
	m_GrillaHis->SetColSize( 5, 44 );
	m_GrillaHis->SetColSize( 6, 45 );
	m_GrillaHis->SetColSize( 7, 80 );
	m_GrillaHis->EnableDragColMove( false );
	m_GrillaHis->EnableDragColSize( true );
	m_GrillaHis->SetColLabelSize( 30 );
	m_GrillaHis->SetColLabelValue( 0, wxT("Tipo") );
	m_GrillaHis->SetColLabelValue( 1, wxT("Patente") );
	m_GrillaHis->SetColLabelValue( 2, wxT("Ingreso") );
	m_GrillaHis->SetColLabelValue( 3, wxT("Egreso") );
	m_GrillaHis->SetColLabelValue( 4, wxT("Lugar") );
	m_GrillaHis->SetColLabelValue( 5, wxT("Llave") );
	m_GrillaHis->SetColLabelValue( 6, wxT("Tarifa") );
	m_GrillaHis->SetColLabelValue( 7, wxT("Fecha") );
	m_GrillaHis->SetColLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Rows
	m_GrillaHis->EnableDragRowSize( true );
	m_GrillaHis->SetRowLabelSize( 1 );
	m_GrillaHis->SetRowLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Label Appearance
	
	// Cell Defaults
	m_GrillaHis->SetDefaultCellAlignment( wxALIGN_LEFT, wxALIGN_TOP );
	bSizer25->Add( m_GrillaHis, 1, wxALL, 5 );
	
	wxBoxSizer* bSizer27;
	bSizer27 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonGanacias = new wxButton( this, wxID_ANY, wxT("Resumen"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonGanacias, 0, wxALL, 5 );
	
	m_BotonArchivo = new wxButton( this, wxID_ANY, wxT("Gen Archivo"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonArchivo, 0, wxALL, 5 );
	
	m_BotonSalir = new wxButton( this, wxID_ANY, wxT("Salir"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonSalir, 0, wxALL, 5 );
	
	
	bSizer25->Add( bSizer27, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer25 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonGanacias->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonSalir ), NULL, this );
}

VentanaHisFechaWx::~VentanaHisFechaWx()
{
	// Disconnect Events
	m_BotonGanacias->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisFechaWx::ClickBotonSalir ), NULL, this );
	
}

VenHisX1Wx::VenHisX1Wx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer25;
	bSizer25 = new wxBoxSizer( wxVERTICAL );
	
	m_GrillaHis = new wxGrid( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, 0 );
	
	// Grid
	m_GrillaHis->CreateGrid( 0, 8 );
	m_GrillaHis->EnableEditing( true );
	m_GrillaHis->EnableGridLines( true );
	m_GrillaHis->EnableDragGridSize( false );
	m_GrillaHis->SetMargins( 0, 0 );
	
	// Columns
	m_GrillaHis->SetColSize( 0, 78 );
	m_GrillaHis->SetColSize( 1, 80 );
	m_GrillaHis->SetColSize( 2, 80 );
	m_GrillaHis->SetColSize( 3, 80 );
	m_GrillaHis->SetColSize( 4, 46 );
	m_GrillaHis->SetColSize( 5, 44 );
	m_GrillaHis->SetColSize( 6, 45 );
	m_GrillaHis->SetColSize( 7, 80 );
	m_GrillaHis->EnableDragColMove( false );
	m_GrillaHis->EnableDragColSize( true );
	m_GrillaHis->SetColLabelSize( 30 );
	m_GrillaHis->SetColLabelValue( 0, wxT("Tipo") );
	m_GrillaHis->SetColLabelValue( 1, wxT("Patente") );
	m_GrillaHis->SetColLabelValue( 2, wxT("Ingreso") );
	m_GrillaHis->SetColLabelValue( 3, wxT("Egreso") );
	m_GrillaHis->SetColLabelValue( 4, wxT("Lugar") );
	m_GrillaHis->SetColLabelValue( 5, wxT("Llave") );
	m_GrillaHis->SetColLabelValue( 6, wxT("Tarifa") );
	m_GrillaHis->SetColLabelValue( 7, wxT("Fecha") );
	m_GrillaHis->SetColLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Rows
	m_GrillaHis->EnableDragRowSize( true );
	m_GrillaHis->SetRowLabelSize( 1 );
	m_GrillaHis->SetRowLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Label Appearance
	
	// Cell Defaults
	m_GrillaHis->SetDefaultCellAlignment( wxALIGN_LEFT, wxALIGN_TOP );
	bSizer25->Add( m_GrillaHis, 1, wxALL, 5 );
	
	wxBoxSizer* bSizer27;
	bSizer27 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonGanacias = new wxButton( this, wxID_ANY, wxT("Resumen"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonGanacias, 0, wxALL, 5 );
	
	m_BotonArchivo = new wxButton( this, wxID_ANY, wxT("Gen Archivo"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonArchivo, 0, wxALL, 5 );
	
	m_BotonSalir = new wxButton( this, wxID_ANY, wxT("Salir"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonSalir, 0, wxALL, 5 );
	
	
	bSizer25->Add( bSizer27, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer25 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonGanacias->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonSalir ), NULL, this );
}

VenHisX1Wx::~VenHisX1Wx()
{
	// Disconnect Events
	m_BotonGanacias->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VenHisX1Wx::ClickBotonSalir ), NULL, this );
	
}

IngresoFechasWx::IngresoFechasWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer27;
	bSizer27 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer28;
	bSizer28 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText27 = new wxStaticText( this, wxID_ANY, wxT("De:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText27->Wrap( -1 );
	bSizer28->Add( m_staticText27, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_d1 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_d1->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &vald1 ) );
	
	bSizer28->Add( m_d1, 0, wxALL, 5 );
	
	m_staticText28 = new wxStaticText( this, wxID_ANY, wxT("/"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText28->Wrap( -1 );
	bSizer28->Add( m_staticText28, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_m1 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_m1->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &valm1 ) );
	
	bSizer28->Add( m_m1, 0, wxALL, 5 );
	
	m_staticText29 = new wxStaticText( this, wxID_ANY, wxT("/"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText29->Wrap( -1 );
	bSizer28->Add( m_staticText29, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_a1 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_a1->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &vala1 ) );
	
	bSizer28->Add( m_a1, 0, wxALL, 5 );
	
	
	bSizer27->Add( bSizer28, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer281;
	bSizer281 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText271 = new wxStaticText( this, wxID_ANY, wxT("Hasta:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText271->Wrap( -1 );
	bSizer281->Add( m_staticText271, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_d2 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_d2->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &vald2 ) );
	
	bSizer281->Add( m_d2, 0, wxALL, 5 );
	
	m_staticText281 = new wxStaticText( this, wxID_ANY, wxT("/"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText281->Wrap( -1 );
	bSizer281->Add( m_staticText281, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_m2 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_m2->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &valm2 ) );
	
	bSizer281->Add( m_m2, 0, wxALL, 5 );
	
	m_staticText291 = new wxStaticText( this, wxID_ANY, wxT("/"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText291->Wrap( -1 );
	bSizer281->Add( m_staticText291, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_a2 = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxSize( 35,-1 ), 0 );
	m_a2->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &vala2 ) );
	
	bSizer281->Add( m_a2, 0, wxALL, 5 );
	
	
	bSizer27->Add( bSizer281, 0, 0, 5 );
	
	wxBoxSizer* bSizer35;
	bSizer35 = new wxBoxSizer( wxHORIZONTAL );
	
	m_button19 = new wxButton( this, wxID_ANY, wxT("Aceptar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer35->Add( m_button19, 0, wxALL, 5 );
	
	m_button20 = new wxButton( this, wxID_ANY, wxT("Cancelar"), wxDefaultPosition, wxSize( 55,-1 ), 0 );
	bSizer35->Add( m_button20, 0, wxALL, 5 );
	
	
	bSizer27->Add( bSizer35, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer27 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_button19->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoFechasWx::ClickBotonAceptar ), NULL, this );
	m_button20->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoFechasWx::ClickBotonCancelar ), NULL, this );
}

IngresoFechasWx::~IngresoFechasWx()
{
	// Disconnect Events
	m_button19->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoFechasWx::ClickBotonAceptar ), NULL, this );
	m_button20->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoFechasWx::ClickBotonCancelar ), NULL, this );
	
}

VentanaHisPatenteWx::VentanaHisPatenteWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer25;
	bSizer25 = new wxBoxSizer( wxVERTICAL );
	
	m_GrillaHisPat = new wxGrid( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, 0 );
	
	// Grid
	m_GrillaHisPat->CreateGrid( 0, 8 );
	m_GrillaHisPat->EnableEditing( true );
	m_GrillaHisPat->EnableGridLines( true );
	m_GrillaHisPat->EnableDragGridSize( false );
	m_GrillaHisPat->SetMargins( 0, 0 );
	
	// Columns
	m_GrillaHisPat->SetColSize( 0, 78 );
	m_GrillaHisPat->SetColSize( 1, 80 );
	m_GrillaHisPat->SetColSize( 2, 80 );
	m_GrillaHisPat->SetColSize( 3, 80 );
	m_GrillaHisPat->SetColSize( 4, 46 );
	m_GrillaHisPat->SetColSize( 5, 44 );
	m_GrillaHisPat->SetColSize( 6, 45 );
	m_GrillaHisPat->SetColSize( 7, 80 );
	m_GrillaHisPat->EnableDragColMove( false );
	m_GrillaHisPat->EnableDragColSize( true );
	m_GrillaHisPat->SetColLabelSize( 30 );
	m_GrillaHisPat->SetColLabelValue( 0, wxT("Tipo") );
	m_GrillaHisPat->SetColLabelValue( 1, wxT("Patente") );
	m_GrillaHisPat->SetColLabelValue( 2, wxT("Ingreso") );
	m_GrillaHisPat->SetColLabelValue( 3, wxT("Egreso") );
	m_GrillaHisPat->SetColLabelValue( 4, wxT("Lugar") );
	m_GrillaHisPat->SetColLabelValue( 5, wxT("Llave") );
	m_GrillaHisPat->SetColLabelValue( 6, wxT("Tarifa") );
	m_GrillaHisPat->SetColLabelValue( 7, wxT("Fecha") );
	m_GrillaHisPat->SetColLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Rows
	m_GrillaHisPat->EnableDragRowSize( true );
	m_GrillaHisPat->SetRowLabelSize( 1 );
	m_GrillaHisPat->SetRowLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Label Appearance
	
	// Cell Defaults
	m_GrillaHisPat->SetDefaultCellAlignment( wxALIGN_LEFT, wxALIGN_TOP );
	bSizer25->Add( m_GrillaHisPat, 1, wxALL, 5 );
	
	wxBoxSizer* bSizer27;
	bSizer27 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonArchivo = new wxButton( this, wxID_ANY, wxT("Gen Archivo"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonArchivo, 0, wxALL, 5 );
	
	m_BotonSalir = new wxButton( this, wxID_ANY, wxT("Salir"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonSalir, 0, wxALL, 5 );
	
	
	bSizer25->Add( bSizer27, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer25 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonArchivo->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisPatenteWx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisPatenteWx::ClickBotonSalir ), NULL, this );
}

VentanaHisPatenteWx::~VentanaHisPatenteWx()
{
	// Disconnect Events
	m_BotonArchivo->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisPatenteWx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( VentanaHisPatenteWx::ClickBotonSalir ), NULL, this );
	
}

IngresoPatenteWx::IngresoPatenteWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer30;
	bSizer30 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer32;
	bSizer32 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText20 = new wxStaticText( this, wxID_ANY, wxT("Pantente:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText20->Wrap( -1 );
	bSizer32->Add( m_staticText20, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_ValorPatente = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	bSizer32->Add( m_ValorPatente, 1, wxALL, 5 );
	
	
	bSizer30->Add( bSizer32, 1, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer33;
	bSizer33 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonAceptar = new wxButton( this, wxID_ANY, wxT("Aceptar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer33->Add( m_BotonAceptar, 0, wxALL, 5 );
	
	m_BotonCancelar = new wxButton( this, wxID_ANY, wxT("Cancelar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer33->Add( m_BotonCancelar, 0, wxALL, 5 );
	
	
	bSizer30->Add( bSizer33, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer30 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonAceptar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoPatenteWx::ClickBotonAceptar ), NULL, this );
	m_BotonCancelar->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoPatenteWx::ClickBotonCancelar ), NULL, this );
}

IngresoPatenteWx::~IngresoPatenteWx()
{
	// Disconnect Events
	m_BotonAceptar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoPatenteWx::ClickBotonAceptar ), NULL, this );
	m_BotonCancelar->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( IngresoPatenteWx::ClickBotonCancelar ), NULL, this );
	
}

CuadroEditarWx::CuadroEditarWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer33;
	bSizer33 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer35;
	bSizer35 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer4;
	bSizer4 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer5;
	bSizer5 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText2 = new wxStaticText( this, wxID_ANY, wxT("Tipo:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText2->Wrap( -1 );
	bSizer5->Add( m_staticText2, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	wxString m_SeleccionadorTipoChoices[] = { wxT("Auto"), wxT("Camioneta"), wxT("Moto"), wxT("Bicicleta") };
	int m_SeleccionadorTipoNChoices = sizeof( m_SeleccionadorTipoChoices ) / sizeof( wxString );
	m_SeleccionadorTipo = new wxChoice( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, m_SeleccionadorTipoNChoices, m_SeleccionadorTipoChoices, 0 );
	m_SeleccionadorTipo->SetSelection( 0 );
	bSizer5->Add( m_SeleccionadorTipo, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer5, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer6;
	bSizer6 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText3 = new wxStaticText( this, wxID_ANY, wxT("Patente:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText3->Wrap( -1 );
	bSizer6->Add( m_staticText3, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_ValorPatente = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	m_ValorPatente->SetValidator( wxTextValidator( wxFILTER_NONE, &ValiPatente ) );
	
	bSizer6->Add( m_ValorPatente, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer6, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer7;
	bSizer7 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText4 = new wxStaticText( this, wxID_ANY, wxT("Lugar:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText4->Wrap( -1 );
	bSizer7->Add( m_staticText4, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	m_ValorLugar = new wxTextCtrl( this, wxID_ANY, wxEmptyString, wxDefaultPosition, wxDefaultSize, 0 );
	m_ValorLugar->SetValidator( wxTextValidator( wxFILTER_NUMERIC, &IdenValiLugar ) );
	
	bSizer7->Add( m_ValorLugar, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer7, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer8;
	bSizer8 = new wxBoxSizer( wxHORIZONTAL );
	
	m_staticText5 = new wxStaticText( this, wxID_ANY, wxT("Llave:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_staticText5->Wrap( -1 );
	bSizer8->Add( m_staticText5, 0, wxALL|wxALIGN_CENTER_VERTICAL, 5 );
	
	wxString m_SeleccionadorLlaveChoices[] = { wxT("Si"), wxT("No") };
	int m_SeleccionadorLlaveNChoices = sizeof( m_SeleccionadorLlaveChoices ) / sizeof( wxString );
	m_SeleccionadorLlave = new wxChoice( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, m_SeleccionadorLlaveNChoices, m_SeleccionadorLlaveChoices, 0 );
	m_SeleccionadorLlave->SetSelection( 0 );
	bSizer8->Add( m_SeleccionadorLlave, 1, wxALL, 5 );
	
	
	bSizer4->Add( bSizer8, 1, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer9;
	bSizer9 = new wxBoxSizer( wxHORIZONTAL );
	
	m_button8 = new wxButton( this, wxID_ANY, wxT("Aceptar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer9->Add( m_button8, 0, wxALL, 5 );
	
	m_button9 = new wxButton( this, wxID_ANY, wxT("Cancelar"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer9->Add( m_button9, 0, wxALL, 5 );
	
	
	bSizer4->Add( bSizer9, 0, wxALIGN_RIGHT, 5 );
	
	
	bSizer35->Add( bSizer4, 1, wxEXPAND, 5 );
	
	
	bSizer33->Add( bSizer35, 0, 0, 5 );
	
	
	this->SetSizer( bSizer33 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_SeleccionadorTipo->Connect( wxEVT_COMMAND_CHOICE_SELECTED, wxCommandEventHandler( CuadroEditarWx::SeleccionTipo ), NULL, this );
	m_button8->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroEditarWx::ClickBotonAceptar ), NULL, this );
	m_button9->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroEditarWx::ClickBotonCancelar ), NULL, this );
}

CuadroEditarWx::~CuadroEditarWx()
{
	// Disconnect Events
	m_SeleccionadorTipo->Disconnect( wxEVT_COMMAND_CHOICE_SELECTED, wxCommandEventHandler( CuadroEditarWx::SeleccionTipo ), NULL, this );
	m_button8->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroEditarWx::ClickBotonAceptar ), NULL, this );
	m_button9->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroEditarWx::ClickBotonCancelar ), NULL, this );
	
}

CuadroResumenWx::CuadroResumenWx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxDialog( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer38;
	bSizer38 = new wxBoxSizer( wxVERTICAL );
	
	wxBoxSizer* bSizer39;
	bSizer39 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantVehiculo = new wxStaticText( this, wxID_ANY, wxT("Cantidad Vehiculos: "), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantVehiculo->Wrap( -1 );
	bSizer39->Add( m_CantVehiculo, 0, wxALL, 5 );
	
	m_TextoVehiculo = new wxStaticText( this, wxID_ANY, wxT("llll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoVehiculo->Wrap( -1 );
	bSizer39->Add( m_TextoVehiculo, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer39, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer391;
	bSizer391 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantAutos = new wxStaticText( this, wxID_ANY, wxT("Cantidad Autos: "), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantAutos->Wrap( -1 );
	bSizer391->Add( m_CantAutos, 0, wxALL, 5 );
	
	m_TextoAuto = new wxStaticText( this, wxID_ANY, wxT("lll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoAuto->Wrap( -1 );
	bSizer391->Add( m_TextoAuto, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer391, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer392;
	bSizer392 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantCamionetas = new wxStaticText( this, wxID_ANY, wxT("Cantidad Camionetas: "), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantCamionetas->Wrap( -1 );
	bSizer392->Add( m_CantCamionetas, 0, wxALL, 5 );
	
	m_TextoCamioneta = new wxStaticText( this, wxID_ANY, wxT("lll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoCamioneta->Wrap( -1 );
	bSizer392->Add( m_TextoCamioneta, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer392, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer393;
	bSizer393 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantMotos = new wxStaticText( this, wxID_ANY, wxT("Cantidad Motos: "), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantMotos->Wrap( -1 );
	bSizer393->Add( m_CantMotos, 0, wxALL, 5 );
	
	m_TextoMoto = new wxStaticText( this, wxID_ANY, wxT("lll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoMoto->Wrap( -1 );
	bSizer393->Add( m_TextoMoto, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer393, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer394;
	bSizer394 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantBicicletas = new wxStaticText( this, wxID_ANY, wxT("Cantidad Bicicletas:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantBicicletas->Wrap( -1 );
	bSizer394->Add( m_CantBicicletas, 0, wxALL, 5 );
	
	m_TextoBicicleta = new wxStaticText( this, wxID_ANY, wxT("lll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoBicicleta->Wrap( -1 );
	bSizer394->Add( m_TextoBicicleta, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer394, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer395;
	bSizer395 = new wxBoxSizer( wxHORIZONTAL );
	
	m_CantTotal = new wxStaticText( this, wxID_ANY, wxT("Total Ganancias:"), wxDefaultPosition, wxDefaultSize, 0 );
	m_CantTotal->Wrap( -1 );
	bSizer395->Add( m_CantTotal, 0, wxALL, 5 );
	
	m_TextoGanancias = new wxStaticText( this, wxID_ANY, wxT("lll"), wxDefaultPosition, wxDefaultSize, 0 );
	m_TextoGanancias->Wrap( -1 );
	bSizer395->Add( m_TextoGanancias, 1, wxALL, 5 );
	
	
	bSizer38->Add( bSizer395, 0, wxEXPAND, 5 );
	
	wxBoxSizer* bSizer53;
	bSizer53 = new wxBoxSizer( wxVERTICAL );
	
	m_BotonOk = new wxButton( this, wxID_ANY, wxT("OK"), wxDefaultPosition, wxSize( 60,-1 ), 0 );
	bSizer53->Add( m_BotonOk, 0, wxALL, 5 );
	
	
	bSizer38->Add( bSizer53, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer38 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonOk->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroResumenWx::ClickBotonOk ), NULL, this );
}

CuadroResumenWx::~CuadroResumenWx()
{
	// Disconnect Events
	m_BotonOk->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( CuadroResumenWx::ClickBotonOk ), NULL, this );
	
}

HisX1Wx::HisX1Wx( wxWindow* parent, wxWindowID id, const wxString& title, const wxPoint& pos, const wxSize& size, long style ) : wxFrame( parent, id, title, pos, size, style )
{
	this->SetSizeHints( wxDefaultSize, wxDefaultSize );
	
	wxBoxSizer* bSizer25;
	bSizer25 = new wxBoxSizer( wxVERTICAL );
	
	m_GrillaHis = new wxGrid( this, wxID_ANY, wxDefaultPosition, wxDefaultSize, 0 );
	
	// Grid
	m_GrillaHis->CreateGrid( 0, 8 );
	m_GrillaHis->EnableEditing( true );
	m_GrillaHis->EnableGridLines( true );
	m_GrillaHis->EnableDragGridSize( false );
	m_GrillaHis->SetMargins( 0, 0 );
	
	// Columns
	m_GrillaHis->SetColSize( 0, 78 );
	m_GrillaHis->SetColSize( 1, 80 );
	m_GrillaHis->SetColSize( 2, 80 );
	m_GrillaHis->SetColSize( 3, 80 );
	m_GrillaHis->SetColSize( 4, 46 );
	m_GrillaHis->SetColSize( 5, 44 );
	m_GrillaHis->SetColSize( 6, 45 );
	m_GrillaHis->SetColSize( 7, 80 );
	m_GrillaHis->EnableDragColMove( false );
	m_GrillaHis->EnableDragColSize( true );
	m_GrillaHis->SetColLabelSize( 30 );
	m_GrillaHis->SetColLabelValue( 0, wxT("Tipo") );
	m_GrillaHis->SetColLabelValue( 1, wxT("Patente") );
	m_GrillaHis->SetColLabelValue( 2, wxT("Ingreso") );
	m_GrillaHis->SetColLabelValue( 3, wxT("Egreso") );
	m_GrillaHis->SetColLabelValue( 4, wxT("Lugar") );
	m_GrillaHis->SetColLabelValue( 5, wxT("Llave") );
	m_GrillaHis->SetColLabelValue( 6, wxT("Tarifa") );
	m_GrillaHis->SetColLabelValue( 7, wxT("Fecha") );
	m_GrillaHis->SetColLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Rows
	m_GrillaHis->EnableDragRowSize( true );
	m_GrillaHis->SetRowLabelSize( 1 );
	m_GrillaHis->SetRowLabelAlignment( wxALIGN_CENTRE, wxALIGN_CENTRE );
	
	// Label Appearance
	
	// Cell Defaults
	m_GrillaHis->SetDefaultCellAlignment( wxALIGN_LEFT, wxALIGN_TOP );
	bSizer25->Add( m_GrillaHis, 1, wxALL, 5 );
	
	wxBoxSizer* bSizer27;
	bSizer27 = new wxBoxSizer( wxHORIZONTAL );
	
	m_BotonGanacias = new wxButton( this, wxID_ANY, wxT("Resumen"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonGanacias, 0, wxALL, 5 );
	
	m_BotonArchivo = new wxButton( this, wxID_ANY, wxT("Gen Archivo"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonArchivo, 0, wxALL, 5 );
	
	m_BotonSalir = new wxButton( this, wxID_ANY, wxT("Salir"), wxDefaultPosition, wxDefaultSize, 0 );
	bSizer27->Add( m_BotonSalir, 0, wxALL, 5 );
	
	
	bSizer25->Add( bSizer27, 0, wxALIGN_RIGHT, 5 );
	
	
	this->SetSizer( bSizer25 );
	this->Layout();
	
	this->Centre( wxBOTH );
	
	// Connect Events
	m_BotonGanacias->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Connect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonSalir ), NULL, this );
}

HisX1Wx::~HisX1Wx()
{
	// Disconnect Events
	m_BotonGanacias->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonResumen ), NULL, this );
	m_BotonArchivo->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonArchivo ), NULL, this );
	m_BotonSalir->Disconnect( wxEVT_COMMAND_BUTTON_CLICKED, wxCommandEventHandler( HisX1Wx::ClickBotonSalir ), NULL, this );
	
}
