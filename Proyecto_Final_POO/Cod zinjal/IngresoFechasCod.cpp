#include "IngresoFechasCod.h"
#include "VentanaHisFechaCod.h"
#include "string_conv.h"
#include <wx/msgdlg.h>
#include "VenHisX1Cod.h"

IngresoFechasCod::IngresoFechasCod(wxWindow *parent, Estacionamiento *est) : IngresoFechasWx(parent)
	, estCuadroHis(est) {
	
}

void IngresoFechasCod::ClickBotonAceptar( wxCommandEvent& event )  {
	string d11,m11,a11,d22,m22,a22;
	long d1,m1,a1,d2,m2,a2;
	d11=wx_to_std(m_d1->GetValue());
	m11=wx_to_std(m_m1->GetValue());
	a11=wx_to_std(m_a1->GetValue());
	d22=wx_to_std(m_d2->GetValue());
	m22=wx_to_std(m_m2->GetValue());
	a22=wx_to_std(m_a2->GetValue());
	if(d11.empty() || m11.empty() || a11.empty()){
		wxMessageBox("Escriba al menos la primer fecha.","Advertencia",wxOK|wxICON_EXCLAMATION);
	}
	else{
		if(!(d11.empty() || m11.empty() || a11.empty()) && (d22.empty() && m22.empty() && a22.empty())){
			m_d1->GetValue().ToLong(&d1);
			m_m1->GetValue().ToLong(&m1);
			m_a1->GetValue().ToLong(&a1);
			fecha f1;
			f1.dia=d1;
			f1.mes=m1;
			f1.anio=a1;
			vector<Vehiculo> v=estCuadroHis->RetornarHistoricoPorFechaX1(f1);
			if(v.empty()){
				wxMessageBox("No se encontraron registros","error",wxOK|wxICON_ERROR);
			}
			else{
				VenHisX1Cod win(this,estCuadroHis,v,f1);
				win.ShowModal();
			}			
		}else{
			if(!(d11.empty() || m11.empty() || a11.empty()) && !(d22.empty() || m22.empty() || a22.empty())){
				m_d1->GetValue().ToLong(&d1);
				m_m1->GetValue().ToLong(&m1);
				m_a1->GetValue().ToLong(&a1);
				m_d2->GetValue().ToLong(&d2);
				m_m2->GetValue().ToLong(&m2);
				m_a2->GetValue().ToLong(&a2);
				fecha f1,f2;
				f1.dia=d1;
				f1.mes=m1;
				f1.anio=a1;
				f2.dia=d2;
				f2.mes=m2;
				f2.anio=a2;
				vector<Vehiculo> v=estCuadroHis->RetornarHistoricoPorFecha(f1,f2);
				if(v.empty()){
					wxMessageBox("No se encontraron registros","error",wxOK|wxICON_ERROR);
				}
				else{
					VentanaHisFechaCod win(this,estCuadroHis,v,f1,f2);
					win.ShowModal();
				}
			}else{
				wxMessageBox("No se encontraron registros","error",wxOK|wxICON_ERROR);
			}
		}
	}
}

void IngresoFechasCod::ClickBotonCancelar( wxCommandEvent& event )  {
	EndModal(0);
}

IngresoFechasCod::~IngresoFechasCod() {
	
}

