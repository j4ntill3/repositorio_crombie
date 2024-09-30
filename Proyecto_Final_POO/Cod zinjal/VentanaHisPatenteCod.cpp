#include "VentanaHisPatenteCod.h"
#include <wx/filedlg.h>
#include "string_conv.h"

VentanaHisPatenteCod::VentanaHisPatenteCod(wxWindow *parent, Estacionamiento *est,vector<Vehiculo> pat) : VentanaHisPatenteWx(parent)
	, estHisPat(est), patente(pat){
	for(int i=0;i<pat.size();i++){
		Vehiculo &vei = pat[i];
		m_GrillaHisPat->AppendRows();
		m_GrillaHisPat->SetCellValue(i,0,vei.VerTipo());
		m_GrillaHisPat->SetCellValue(i,1,vei.VerPatente());
		string x1,y1,x2,y2,x3,y3,z3,aux1, aux2, aux3;
		x1=long_to_str(vei.VerIngresoTM().tm_hour);
		y1=long_to_str(vei.VerIngresoTM().tm_min);
		aux1=x1+":"+y1;
		m_GrillaHisPat->SetCellValue(i,2,aux1);
		x2=long_to_str(vei.VerEgresoTM().tm_hour);
		y2=long_to_str(vei.VerEgresoTM().tm_min);
		aux2=x2+":"+y2;
		m_GrillaHisPat->SetCellValue(i,3,aux2);
		m_GrillaHisPat->SetCellValue(i,4,vei.VerLugar());
		m_GrillaHisPat->SetCellValue(i,5,vei.VerLlave());
		m_GrillaHisPat->SetCellValue(i,6,float_to_str(vei.VerTarifa()));
		x3=long_to_str(vei.VerIngresoTM().tm_mday);
		y3=long_to_str(vei.VerIngresoTM().tm_mon+1);
		z3=long_to_str(vei.VerIngresoTM().tm_year+1900);
		aux3=x3+"/"+y3+"/"+z3;
		m_GrillaHisPat->SetCellValue(i,7,aux3);
		
	}
}


void VentanaHisPatenteCod::ClickBotonArchivo( wxCommandEvent& event )  {
	wxFileDialog arch(this,"Guardar Historial","",patente[0].VerPatente(),"*.txt",wxFD_SAVE);
	if(wxID_OK==arch.ShowModal()){
		estHisPat->GenerarResumenPatente(wx_to_std(arch.GetPath()),patente);
		EndModal(1);
	};
}

VentanaHisPatenteCod::~VentanaHisPatenteCod() {
	
}

void VentanaHisPatenteCod::ClickBotonSalir( wxCommandEvent& event )  {
	EndModal(0);
}

