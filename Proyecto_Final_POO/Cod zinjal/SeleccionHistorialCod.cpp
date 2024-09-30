#include "SeleccionHistorialCod.h"
#include "IngresoFechasCod.h"
#include "IngresoPatenteCod.h"

SeleccionHistorialCod::SeleccionHistorialCod(wxWindow *parent, Estacionamiento *est) : SeleccionHistorialWx(parent)
	,estCuadroHistorial(est){
	
}

void SeleccionHistorialCod::ClickBotonFechas( wxCommandEvent& event )  {
	EndModal(1);
	IngresoFechasCod win(this,estCuadroHistorial);
	win.ShowModal();
}

void SeleccionHistorialCod::ClickBotonPatente( wxCommandEvent& event )  {
	EndModal(0);
	IngresoPatenteCod win(this,estCuadroHistorial);
	win.ShowModal();
}



