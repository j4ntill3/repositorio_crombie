#ifndef SELECCIONHISTORIALCOD_H
#define SELECCIONHISTORIALCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"

class SeleccionHistorialCod : public SeleccionHistorialWx {
	
private:
	
protected:
	void ClickBotonFechas( wxCommandEvent& event )  override;
	void ClickBotonPatente( wxCommandEvent& event )  override;
	Estacionamiento *estCuadroHistorial;
public:
	SeleccionHistorialCod(wxWindow *parent, Estacionamiento *est);
};

#endif

