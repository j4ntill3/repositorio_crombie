#include "VenHisX1Cod.h"
#include "string_conv.h"
#include "CuadroResumenCod.h"
#include <wx/filedlg.h>


VenHisX1Cod::VenHisX1Cod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> v, fecha fo)
	: VenHisX1Wx(parent),his(v), f1(fo) {
	for(int i=0;i<v.size();i++){
		Vehiculo vei = v[i];
		m_GrillaHis->AppendRows();
		m_GrillaHis->SetCellValue(i,0,std_to_wx(vei.VerTipo()));
		m_GrillaHis->SetCellValue(i,1,std_to_wx(vei.VerPatente()));
		string x1,y1,x2,y2,x3,y3,z3,aux1, aux2, aux3;
		x1=long_to_str(vei.VerIngresoTM().tm_hour);
		y1=long_to_str(vei.VerIngresoTM().tm_min);
		aux1=x1+":"+y1;
		m_GrillaHis->SetCellValue(i,2,aux1);
		x2=long_to_str(vei.VerEgresoTM().tm_hour);
		y2=long_to_str(vei.VerEgresoTM().tm_min);
		aux2=x2+":"+y2;
		m_GrillaHis->SetCellValue(i,3,aux2);
		m_GrillaHis->SetCellValue(i,4,std_to_wx(vei.VerLugar()));
		m_GrillaHis->SetCellValue(i,5,std_to_wx(vei.VerLlave()));
		m_GrillaHis->SetCellValue(i,6,std_to_wx(long_to_str(vei.VerTarifa())));
		x3=long_to_str(vei.VerIngresoTM().tm_mday);
		y3=long_to_str(vei.VerIngresoTM().tm_mon+1);
		z3=long_to_str(vei.VerIngresoTM().tm_year+1900);
		aux3=x3+"/"+y3+"/"+z3;
		m_GrillaHis->SetCellValue(i,7,aux3);
	}
}

string VenHisX1Cod::long_to_str(long x){stringstream ss; ss<<x; string str=ss.str();return str;};
string VenHisX1Cod::float_to_string(float x){stringstream ss; ss<<x; string str=ss.str();return str;};

void VenHisX1Cod::ClickBotonResumen( wxCommandEvent& event )  {
	CuadroResumenCod win(this,estHis,his);
	win.ShowModal();
}

void VenHisX1Cod::ClickBotonArchivo( wxCommandEvent& event )  {
	wxFileDialog arch(this,"Guardar Historial","","","*.txt",wxFD_SAVE);
	if(wxID_OK==arch.ShowModal()){
		estHis->GenerarResumenTextoX1(wx_to_std(arch.GetPath()),his,f1);
		EndModal(1);
	};
}

void VenHisX1Cod::ClickBotonSalir( wxCommandEvent& event )  {
	EndModal(0);
}

VenHisX1Cod::~VenHisX1Cod() {
	
}

