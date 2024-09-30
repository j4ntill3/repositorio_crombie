///////////////////////////////////////////////////////////////////////////
// C++ code generated with wxFormBuilder (version Jun 17 2015)
// http://www.wxformbuilder.org/
//
// PLEASE DO "NOT" EDIT THIS FILE!
///////////////////////////////////////////////////////////////////////////

#ifndef __WXFB_PROJECT_H__
#define __WXFB_PROJECT_H__

#include <wx/artprov.h>
#include <wx/xrc/xmlres.h>
#include <wx/string.h>
#include <wx/stattext.h>
#include <wx/gdicmn.h>
#include <wx/font.h>
#include <wx/colour.h>
#include <wx/settings.h>
#include <wx/textctrl.h>
#include <wx/button.h>
#include <wx/sizer.h>
#include <wx/grid.h>
#include <wx/frame.h>
#include <wx/choice.h>
#include <wx/valtext.h>
#include <wx/dialog.h>

///////////////////////////////////////////////////////////////////////////


///////////////////////////////////////////////////////////////////////////////
/// Class VentanaPrincipalWx
///////////////////////////////////////////////////////////////////////////////
class VentanaPrincipalWx : public wxFrame 
{
	private:
	
	protected:
		wxStaticText* m_staticText1;
		wxTextCtrl* m_TextoBuscador;
		wxButton* m_BotonBuscar;
		wxGrid* m_grilla;
		wxButton* m_BotonIngreso;
		wxButton* m_BotonEgreso;
		wxButton* m_eliminar;
		wxButton* m_BotonEditar;
		wxButton* m_tarifas;
		wxButton* m_BotonHistorico;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonBuscar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonIngreso( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonEgreso( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonEliminar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonEditar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonTarifas( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonHistorico( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		VentanaPrincipalWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 409,441 ), long style = wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL );
		
		~VentanaPrincipalWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class CuadroIngresoWx
///////////////////////////////////////////////////////////////////////////////
class CuadroIngresoWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText2;
		wxChoice* m_SeleccionadorTipo;
		wxStaticText* m_staticText3;
		wxTextCtrl* m_ValorPatente;
		wxStaticText* m_staticText4;
		wxTextCtrl* m_ValorLugar;
		wxStaticText* m_staticText5;
		wxChoice* m_SeleccionadorLlave;
		wxButton* m_button8;
		wxButton* m_button9;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonAceptar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonCancelar( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		wxString ValiPatente; 
		wxString IdenValiLugar; 
		
		CuadroIngresoWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 194,197 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~CuadroIngresoWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class VentanaCambioTarifaWx
///////////////////////////////////////////////////////////////////////////////
class VentanaCambioTarifaWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText18;
		wxChoice* m_SeleccionadorTipo;
		wxStaticText* m_staticText20;
		wxTextCtrl* m_Valor30min;
		wxStaticText* m_staticText221;
		wxStaticText* m_staticText21;
		wxTextCtrl* m_Valor1hora;
		wxStaticText* m_staticText23;
		wxStaticText* m_staticText22;
		wxTextCtrl* m_Valor15min;
		wxStaticText* m_staticText24;
		wxButton* m_aceptar;
		wxButton* m_cancelar;
		
		// Virtual event handlers, overide them in your derived class
		virtual void SeleccionTipo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonAceptar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonCancelar( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		wxString IdenVali30min; 
		wxString IdenVali1hora; 
		wxString IdenVali15min; 
		
		VentanaCambioTarifaWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 161,208 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~VentanaCambioTarifaWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class SeleccionHistorialWx
///////////////////////////////////////////////////////////////////////////////
class SeleccionHistorialWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText25;
		wxButton* m_Fechas;
		wxButton* m_Patente;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonFechas( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonPatente( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		SeleccionHistorialWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 398,95 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~SeleccionHistorialWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class VentanaHisFechaWx
///////////////////////////////////////////////////////////////////////////////
class VentanaHisFechaWx : public wxDialog 
{
	private:
	
	protected:
		wxGrid* m_GrillaHis;
		wxButton* m_BotonGanacias;
		wxButton* m_BotonArchivo;
		wxButton* m_BotonSalir;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonResumen( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonArchivo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonSalir( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		VentanaHisFechaWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 553,323 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~VentanaHisFechaWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class VenHisX1Wx
///////////////////////////////////////////////////////////////////////////////
class VenHisX1Wx : public wxDialog 
{
	private:
	
	protected:
		wxGrid* m_GrillaHis;
		wxButton* m_BotonGanacias;
		wxButton* m_BotonArchivo;
		wxButton* m_BotonSalir;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonResumen( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonArchivo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonSalir( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		VenHisX1Wx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 555,302 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~VenHisX1Wx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class IngresoFechasWx
///////////////////////////////////////////////////////////////////////////////
class IngresoFechasWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText27;
		wxTextCtrl* m_d1;
		wxStaticText* m_staticText28;
		wxTextCtrl* m_m1;
		wxStaticText* m_staticText29;
		wxTextCtrl* m_a1;
		wxStaticText* m_staticText271;
		wxTextCtrl* m_d2;
		wxStaticText* m_staticText281;
		wxTextCtrl* m_m2;
		wxStaticText* m_staticText291;
		wxTextCtrl* m_a2;
		wxButton* m_button19;
		wxButton* m_button20;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonAceptar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonCancelar( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		wxString vald1; 
		wxString valm1; 
		wxString vala1; 
		wxString vald2; 
		wxString valm2; 
		wxString vala2; 
		
		IngresoFechasWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 223,130 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~IngresoFechasWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class VentanaHisPatenteWx
///////////////////////////////////////////////////////////////////////////////
class VentanaHisPatenteWx : public wxDialog 
{
	private:
	
	protected:
		wxGrid* m_GrillaHisPat;
		wxButton* m_BotonArchivo;
		wxButton* m_BotonSalir;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonArchivo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonSalir( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		VentanaHisPatenteWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 555,331 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~VentanaHisPatenteWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class IngresoPatenteWx
///////////////////////////////////////////////////////////////////////////////
class IngresoPatenteWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText20;
		wxTextCtrl* m_ValorPatente;
		wxButton* m_BotonAceptar;
		wxButton* m_BotonCancelar;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonAceptar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonCancelar( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		IngresoPatenteWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 348,98 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~IngresoPatenteWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class CuadroEditarWx
///////////////////////////////////////////////////////////////////////////////
class CuadroEditarWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_staticText2;
		wxChoice* m_SeleccionadorTipo;
		wxStaticText* m_staticText3;
		wxTextCtrl* m_ValorPatente;
		wxStaticText* m_staticText4;
		wxTextCtrl* m_ValorLugar;
		wxStaticText* m_staticText5;
		wxChoice* m_SeleccionadorLlave;
		wxButton* m_button8;
		wxButton* m_button9;
		
		// Virtual event handlers, overide them in your derived class
		virtual void SeleccionTipo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonAceptar( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonCancelar( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		wxString ValiPatente; 
		wxString IdenValiLugar; 
		
		CuadroEditarWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 205,198 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~CuadroEditarWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class CuadroResumenWx
///////////////////////////////////////////////////////////////////////////////
class CuadroResumenWx : public wxDialog 
{
	private:
	
	protected:
		wxStaticText* m_CantVehiculo;
		wxStaticText* m_TextoVehiculo;
		wxStaticText* m_CantAutos;
		wxStaticText* m_TextoAuto;
		wxStaticText* m_CantCamionetas;
		wxStaticText* m_TextoCamioneta;
		wxStaticText* m_CantMotos;
		wxStaticText* m_TextoMoto;
		wxStaticText* m_CantBicicletas;
		wxStaticText* m_TextoBicicleta;
		wxStaticText* m_CantTotal;
		wxStaticText* m_TextoGanancias;
		wxButton* m_BotonOk;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonOk( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		CuadroResumenWx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 221,223 ), long style = wxDEFAULT_DIALOG_STYLE ); 
		~CuadroResumenWx();
	
};

///////////////////////////////////////////////////////////////////////////////
/// Class HisX1Wx
///////////////////////////////////////////////////////////////////////////////
class HisX1Wx : public wxFrame 
{
	private:
	
	protected:
		wxGrid* m_GrillaHis;
		wxButton* m_BotonGanacias;
		wxButton* m_BotonArchivo;
		wxButton* m_BotonSalir;
		
		// Virtual event handlers, overide them in your derived class
		virtual void ClickBotonResumen( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonArchivo( wxCommandEvent& event ) { event.Skip(); }
		virtual void ClickBotonSalir( wxCommandEvent& event ) { event.Skip(); }
		
	
	public:
		
		HisX1Wx( wxWindow* parent, wxWindowID id = wxID_ANY, const wxString& title = wxEmptyString, const wxPoint& pos = wxDefaultPosition, const wxSize& size = wxSize( 500,300 ), long style = wxDEFAULT_FRAME_STYLE|wxTAB_TRAVERSAL );
		
		~HisX1Wx();
	
};

#endif //__WXFB_PROJECT_H__
