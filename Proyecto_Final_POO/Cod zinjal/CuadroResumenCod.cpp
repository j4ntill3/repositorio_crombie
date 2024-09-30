#include "CuadroResumenCod.h"
#include "string_conv.h"

CuadroResumenCod::CuadroResumenCod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> r) : CuadroResumenWx(parent)
	, estResumen(est){
	resumen res=estResumen->CalcularResumenHis(r);
	int x=estResumen->CalcularGanancias(r);
	m_TextoVehiculo->SetLabel(wx_to_std(int_to_str(res.n_total)));
	m_TextoAuto->SetLabel(wx_to_std(int_to_str(res.n_autos)));
	m_TextoCamioneta->SetLabel(wx_to_std(int_to_str(res.n_camionetas)));
	m_TextoMoto->SetLabel(wx_to_std(int_to_str(res.n_motos)));
	m_TextoBicicleta->SetLabel(wx_to_std(int_to_str(res.n_bicicleta)));
	m_TextoGanancias->SetLabel(wx_to_std(int_to_str(x)));
}

void CuadroResumenCod::ClickBotonOk( wxCommandEvent& event )  {
	EndModal(1);
}

CuadroResumenCod::~CuadroResumenCod() {
	
}

