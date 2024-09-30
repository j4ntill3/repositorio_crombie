#include "CuadroIngresoCod.h"
#include "string_conv.h"
#include <wx/msgdlg.h>

CuadroIngresoCod::CuadroIngresoCod(wxWindow *parent,Estacionamiento *est) : CuadroIngresoWx(parent), 
	estacionamientoCuadroIngreso(est) {
	
}

CuadroIngresoCod::~CuadroIngresoCod() {
	
}

void CuadroIngresoCod::ClickBotonAceptar( wxCommandEvent& event )  {
	string t = wx_to_std(m_SeleccionadorTipo->GetStringSelection());
	string p = wx_to_std(m_ValorPatente->GetValue());
	string l = wx_to_std(m_ValorLugar->GetValue());
	string lla = wx_to_std(m_SeleccionadorLlave->GetStringSelection());
	if(l.empty()){
		Vehiculo x(t,p,lla);
		string errores=x.ValidarDatos();
		string repetido;
		for(int i=0;i<estacionamientoCuadroIngreso->CantidadVehiculos();i++){
			if(p==estacionamientoCuadroIngreso->VerVehiculo(i).VerPatente()){
				repetido="La Patente "+estacionamientoCuadroIngreso->VerVehiculo(i).VerPatente()
					+" ya se encuentra registrada.";
				wxMessageBox(repetido,"error",wxOK|wxICON_ERROR);
			}
		}
		if(errores.empty()){
			if(repetido.empty()){
				estacionamientoCuadroIngreso->IngresoVehiculo(x);
				EndModal(1);
			}		
		}
		else{
			wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
		}
	}
	else{
		Vehiculo x(t,p,l,lla);
		string errores=x.ValidarDatos();
		string repetido;
		for(int i=0;i<estacionamientoCuadroIngreso->CantidadVehiculos();i++){
			if(p==estacionamientoCuadroIngreso->VerVehiculo(i).VerPatente()){
				repetido="La Patente "+estacionamientoCuadroIngreso->VerVehiculo(i).VerPatente()
					+" ya se encuentra registrada.";
				wxMessageBox(repetido,"error",wxOK|wxICON_ERROR);
			}
		}
		if(errores.empty()){
			if(repetido.empty()){
				estacionamientoCuadroIngreso->IngresoVehiculo(x);
				EndModal(1);
			}		
		}
		else{
			wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
		}
	}
}

void CuadroIngresoCod::ClickBotonCancelar( wxCommandEvent& event )  {
	EndModal(0);
}

