#include "VentanaCambioTarifaCod.h"
#include "string_conv.h"
#include "Tarifa.h"
#include <wx/msgdlg.h>

VentanaCambioTarifaCod::VentanaCambioTarifaCod(wxWindow *parent, Estacionamiento *est) : VentanaCambioTarifaWx(parent),
	estVentanaCambioTarifa(est){
	RefrescarCampos();
}

void VentanaCambioTarifaCod::RefrescarCampos(){
	string t = wx_to_std(m_SeleccionadorTipo->GetStringSelection());
	wxString v1,v2,v3;
	v1=(std_to_wx(long_to_str(estVentanaCambioTarifa->VerTar(t).VerM_Hora())));
	v2=(std_to_wx(long_to_str(estVentanaCambioTarifa->VerTar(t).VerHora())));
	v3=(std_to_wx(long_to_str(estVentanaCambioTarifa->VerTar(t).VerFraccion())));
	m_Valor30min->SetValue(v1);IdenVali30min=v1;
	m_Valor1hora->SetValue(v2);IdenVali1hora=v2;
	m_Valor15min->SetValue(v3);IdenVali15min=v3;
}

VentanaCambioTarifaCod::~VentanaCambioTarifaCod() {
	
}

void VentanaCambioTarifaCod::ClickBotonAceptar( wxCommandEvent& event )  {
	string t = wx_to_std(m_SeleccionadorTipo->GetStringSelection());
	if(t=="Moto/Bicicleta"){
		t="Moto";
	}
	long x30min,x1hora,x15min;  
	m_Valor30min->GetValue().ToLong(&x30min);
	m_Valor1hora->GetValue().ToLong(&x1hora);
	m_Valor15min->GetValue().ToLong(&x15min);
	Tarifa x(x30min,x1hora,x15min);
	string errores=x.ValidarDatos(t,x30min,x1hora,x15min);
	if(errores.size()==0){
		estVentanaCambioTarifa->VerTar(t).CargarM_Hora(x30min);
		estVentanaCambioTarifa->VerTar(t).CargarHora(x1hora);
		estVentanaCambioTarifa->VerTar(t).CargarFraccion(x15min);
		EndModal(1);
	}else{
		wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
		cout<<errores;
	}
	estVentanaCambioTarifa->Guardar();
}

void VentanaCambioTarifaCod::ClickBotonCancelar( wxCommandEvent& event )  {
	EndModal(0);
}

void VentanaCambioTarifaCod::SeleccionTipo( wxCommandEvent& event )  {
	RefrescarCampos();
}

