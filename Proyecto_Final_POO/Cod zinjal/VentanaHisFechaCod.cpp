#include "VentanaHisFechaCod.h"
#include <vector>
#include "Vehiculo.h"
#include "string_conv.h"
#include "CuadroResumenCod.h"
#include <wx/filedlg.h>
using namespace std;

VentanaHisFechaCod::VentanaHisFechaCod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> v, fecha fo, fecha ft) :
	VentanaHisFechaWx(parent), estHis(est), his(v), f1(fo), f2(ft){
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

string VentanaHisFechaCod::long_to_str(long x){stringstream ss; ss<<x; string str=ss.str();return str;};
string VentanaHisFechaCod::float_to_string(float x){stringstream ss; ss<<x; string str=ss.str();return str;};

void VentanaHisFechaCod::ClickBotonResumen( wxCommandEvent& event )  {
	CuadroResumenCod win(this,estHis,his);
	win.ShowModal();
}

void VentanaHisFechaCod::ClickBotonArchivo( wxCommandEvent& event )  {
	wxFileDialog arch(this,"Guardar Historial","","","*.txt",wxFD_SAVE);
	if(wxID_OK==arch.ShowModal()){
		estHis->GenerarResumenTexto(wx_to_std(arch.GetPath()),his,f1,f2);
		EndModal(1);
	};
}

VentanaHisFechaCod::~VentanaHisFechaCod() {
	
}

void VentanaHisFechaCod::ClickBotonSalir( wxCommandEvent& event )  {
	EndModal(0);
}

