#include "VentanaPrincipalCod.h"
#include "CuadroIngresoCod.h"
#include <wx/msgdlg.h>
#include <sstream>
#include "SeleccionHistorialCod.h"
#include "string_conv.h"
#include "CuadroEditarCod.h"
#include "VentanaCambioTarifaCod.h"
using namespace std;


VentanaPrincipalCod::VentanaPrincipalCod(Estacionamiento *est) : VentanaPrincipalWx(nullptr), m_estacionamiento(est) {
	for(int i=0;i<m_estacionamiento->CantidadVehiculos();i++){
		Vehiculo &v = m_estacionamiento->VerVehiculo(i);
		m_grilla->AppendRows();
		m_grilla->SetCellValue(i,0,v.VerTipo());
		m_grilla->SetCellValue(i,1,v.VerPatente());
		string x,y,aux;
		x=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_hour);
		y=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_min);
		aux=x+":"+y;
		m_grilla->SetCellValue(i,2,aux);
		m_grilla->SetCellValue(i,3,v.VerLugar());
		m_grilla->SetCellValue(i,4,v.VerLlave());
	}
}

VentanaPrincipalCod::~VentanaPrincipalCod() {
	
}

void VentanaPrincipalCod::RefrescarGrilla(){
	if(m_grilla->GetNumberRows()!=0){
	m_grilla->DeleteRows(0,m_grilla->GetNumberRows());
		for(int i=0;i<m_estacionamiento->CantidadVehiculos();i++){
			Vehiculo &v = m_estacionamiento->VerVehiculo(i);
			m_grilla->AppendRows();
			m_grilla->SetCellValue(i,0,v.VerTipo());
			m_grilla->SetCellValue(i,1,v.VerPatente());
			string x,y,aux;
			x=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_hour);
			y=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_min);
			aux=x+":"+y;
			m_grilla->SetCellValue(i,2,aux);
			m_grilla->SetCellValue(i,3,v.VerLugar());
			m_grilla->SetCellValue(i,4,v.VerLlave());
			m_estacionamiento->Guardar();
		}
	}else{
		for(int i=0;i<m_estacionamiento->CantidadVehiculos();i++){
			Vehiculo &v = m_estacionamiento->VerVehiculo(i);
			m_grilla->AppendRows();
			m_grilla->SetCellValue(i,0,v.VerTipo());
			m_grilla->SetCellValue(i,1,v.VerPatente());
			string x,y,aux;
			x=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_hour);
			y=m_estacionamiento->inTOstr(v.VerIngresoTM().tm_min);
			aux=x+":"+y;
			m_grilla->SetCellValue(i,2,aux);
			m_grilla->SetCellValue(i,3,v.VerLugar());
			m_grilla->SetCellValue(i,4,v.VerLlave());
			m_estacionamiento->Guardar();
		}
	};
}

void VentanaPrincipalCod::ClickBotonIngreso( wxCommandEvent& event )  {
	CuadroIngresoCod win(this,m_estacionamiento);
	if(win.ShowModal()==0){
		RefrescarGrilla();
	}
	m_estacionamiento->Guardar();
	RefrescarGrilla();
}

void VentanaPrincipalCod::ClickBotonEgreso( wxCommandEvent& event )  {
	int i = m_grilla->GetGridCursorRow();
	stringstream sr;
	sr<<"¿Esta seguro que desea egresar el vehiculo "<<m_estacionamiento->VerVehiculo(i).VerPatente()<<"?";
	int x = wxMessageBox(sr.str(),"Egreso de Vehiculo",wxYES_NO|wxICON_EXCLAMATION);
	if(x==wxYES){
		Vehiculo aux=m_estacionamiento->EgresoVehiculo(i);
		stringstream ss;
		ss<<"Vehiculo : "<<aux.VerPatente()<<endl
			<<"Tipo: "<<aux.VerTipo()<<endl
			<<"Ingreso: "<<aux.VerIngresoTM().tm_hour<<":"<<aux.VerIngresoTM().tm_min<<endl
			<<"Egreso: "<<" "<<aux.VerEgresoTM().tm_hour<<":"<<aux.VerEgresoTM().tm_min<<endl
			<<"Estado: "<<"Eliminado"<<endl
			<<"Fecha: "<<aux.VerIngresoTM().tm_mday<<"/"<<aux.VerIngresoTM().tm_mon+1<<
			"/"<<aux.VerIngresoTM().tm_year+1900<<endl
			<<"Tarifa: "<<aux.VerTarifa()<<"$";		
		m_estacionamiento->Guardar();
		m_grilla->DeleteRows(i);
		RefrescarGrilla();
		wxMessageBox(ss.str(),"Datos de Egreso",wxOK);
	}

}

void VentanaPrincipalCod::ClickBotonEliminar( wxCommandEvent& event )  {
	int i = m_grilla->GetGridCursorRow();
	stringstream sr;
	sr<<"¿Esta seguro? Se registrara el Vehiculo "<<m_estacionamiento->VerVehiculo(i).VerPatente()
		<<" como No pagado.";
	int x = wxMessageBox(sr.str(),"Advertencia",wxYES_NO|wxICON_EXCLAMATION);	
	if(x==wxYES){
		Vehiculo aux=m_estacionamiento->EliminarVehiculo(i);
		stringstream ss;
		ss<<"Vehiculo : "<<aux.VerPatente()<<endl
			<<"Tipo: "<<aux.VerTipo()<<endl
			<<"Ingreso: "<<aux.VerIngresoTM().tm_hour<<":"<<aux.VerIngresoTM().tm_min<<endl
			<<"Egreso: "<<" "<<aux.VerEgresoTM().tm_hour<<":"<<aux.VerEgresoTM().tm_min<<endl
			<<"Estado: "<<"Pagado"<<endl
			<<"Fecha: "<<aux.VerIngresoTM().tm_mday<<"/"<<aux.VerIngresoTM().tm_mon+1<<
			"/"<<aux.VerIngresoTM().tm_year+1900<<endl
			<<"Tarifa: "<<aux.VerTarifa()<<"$";		
		m_estacionamiento->Guardar();
		m_grilla->DeleteRows(i);
		RefrescarGrilla();
		wxMessageBox(ss.str(),"Vehiculo Eliminado",wxOK|wxICON_HAND);
	}
}

void VentanaPrincipalCod::ClickBotonTarifas( wxCommandEvent& event )  {
	VentanaCambioTarifaCod win(this,m_estacionamiento);
	win.ShowModal();
}

void VentanaPrincipalCod::ClickBotonHistorico( wxCommandEvent& event )  {
	SeleccionHistorialCod win(this,m_estacionamiento);
	win.ShowModal();
}

void VentanaPrincipalCod::ClickBotonBuscar( wxCommandEvent& event )  {
	string p=wx_to_std(m_TextoBuscador->GetValue());
	Vehiculo x("auto",p,"Si");
	string errores=x.ValidarDatos();
	if(errores.empty()){
		for(int i=0;i<m_estacionamiento->CantidadVehiculos();i++){
			if(p==m_estacionamiento->VerVehiculo(i).VerPatente()){
				m_grilla->SelectBlock(i,0,i,4,false);
			}
		}
	}else{
		wxMessageBox(errores,"error",wxOK|wxICON_ERROR);
	}
}

void VentanaPrincipalCod::ClickBotonEditar( wxCommandEvent& event )  {
	int i = m_grilla->GetGridCursorRow();
	string t=wx_to_std(m_grilla->GetCellValue(i,0));
	string p=wx_to_std(m_grilla->GetCellValue(i,1));
	string l=wx_to_std(m_grilla->GetCellValue(i,3));
	string ll=wx_to_std(m_grilla->GetCellValue(i,4));
	Vehiculo aux(t,p,l,ll);
	CuadroEditarCod win(this,m_estacionamiento,i,aux);
	if(win.ShowModal()==1){
		RefrescarGrilla();
	}
	m_estacionamiento->Guardar();
	RefrescarGrilla();
}

