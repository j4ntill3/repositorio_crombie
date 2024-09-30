#include "IngresoPatenteCod.h"
#include "VentanaHisPatenteCod.h"
#include <string>
#include "string_conv.h"
#include <wx/msgdlg.h>
using namespace std;

IngresoPatenteCod::IngresoPatenteCod(wxWindow *parent, Estacionamiento *est) : IngresoPatenteWx(parent)
	, estHisPat(est) {
	
}

void IngresoPatenteCod::ClickBotonAceptar( wxCommandEvent& event )  {
	string a=wx_to_std(m_ValorPatente->GetValue());
	Vehiculo x("auto",a,"Si");
	string errores=x.ValidarDatos();
	if(errores.empty()){
		vector<Vehiculo> pat=estHisPat->RetornarHistoricoPorPatente(a);
		if(pat.empty()){
			wxMessageBox("No se encontraron registros","error",wxOK|wxICON_ERROR);
		}else{
			VentanaHisPatenteCod win(this,estHisPat,pat);
			win.ShowModal();
			EndModal(1);
		}
	}else{
		wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
	}
}

void IngresoPatenteCod::ClickBotonCancelar( wxCommandEvent& event )  {
	EndModal(0);
}

IngresoPatenteCod::~IngresoPatenteCod() {
	
}

