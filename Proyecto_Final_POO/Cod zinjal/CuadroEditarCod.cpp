#include "CuadroEditarCod.h"
#include "string_conv.h"
#include <string>
#include <wx/msgdlg.h>

CuadroEditarCod::CuadroEditarCod(wxWindow *parent, Estacionamiento *est, int i, Vehiculo aux) : CuadroEditarWx(parent)
	,estEditar(est),p(i), vei(aux) {
	if(vei.VerTipo()=="Auto"){
		m_SeleccionadorTipo->SetSelection(0);
	}
	if(vei.VerTipo()=="Camioneta"){
		m_SeleccionadorTipo->SetSelection(1);
	}
	if(vei.VerTipo()=="Moto"){
		m_SeleccionadorTipo->SetSelection(2);
	}
	if(vei.VerTipo()=="Bicicleta"){
		m_SeleccionadorTipo->SetSelection(3);
	}
	wxString v1=(std_to_wx(vei.VerLugar()));
	m_ValorLugar->SetValue(v1);IdenValiLugar=v1;
	wxString v2=(std_to_wx(vei.VerPatente()));
	m_ValorPatente->SetValue(v2);ValiPatente=v2;
	m_SeleccionadorLlave->SetStringSelection(std_to_wx(vei.VerLlave()));
}

void CuadroEditarCod::ClickBotonAceptar( wxCommandEvent& event )  {
	string t = wx_to_std(m_SeleccionadorTipo->GetStringSelection());
	string pa = wx_to_std(m_ValorPatente->GetValue());
	string l = wx_to_std(m_ValorLugar->GetValue());
	string lla = wx_to_std(m_SeleccionadorLlave->GetStringSelection());
	Vehiculo x(t,pa,l,lla);
	string errores=x.ValidarDatos();
	string repetido;	
	if(l!="-"){
		for(int i=0;i<p;i++){
			if(estEditar->VerVehiculo(i).VerLugar()==x.VerLugar()){
				repetido=repetido+"El lugar "+estEditar->VerVehiculo(i).VerLugar()
					+" ya se encuentra ocupado.";
				wxMessageBox(repetido,"error",wxOK|wxICON_ERROR);
			}
		}
		int poss =estEditar->CantidadVehiculos()-p; 
		for(int i=p+1;i<p+poss;i++){
			if(estEditar->VerVehiculo(i).VerLugar()==x.VerLugar()){
				repetido=repetido+"El lugar "+estEditar->VerVehiculo(i).VerLugar()
					+" ya se encuentra ocupado.";
				wxMessageBox(repetido,"error",wxOK|wxICON_ERROR);
			}
		}
	}
	if(errores.empty()){
		if(repetido.empty()){
			if(t!="-"){
				estEditar->EditarVehiculo(p,t,pa,l,lla);
				EndModal(1);
			}
			else{
				l="-";
				estEditar->EditarVehiculo(p,t,pa,l,lla);
				EndModal(1);
			}
		}		
	}
	else{
		wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
	}
}

void CuadroEditarCod::ClickBotonCancelar( wxCommandEvent& event )  {
	EndModal(0);
}

CuadroEditarCod::~CuadroEditarCod() {
	
}


void CuadroEditarCod::SeleccionTipo( wxCommandEvent& event )  {
	event.Skip();
}

