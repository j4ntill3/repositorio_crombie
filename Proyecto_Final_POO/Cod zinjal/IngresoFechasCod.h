#ifndef INGRESOFECHASCOD_H
#define INGRESOFECHASCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"

class IngresoFechasCod : public IngresoFechasWx {
	
private:
	
protected:
	void ClickBotonAceptar( wxCommandEvent& event )  override;
	void ClickBotonCancelar( wxCommandEvent& event )  override;
	Estacionamiento *estCuadroHis;
public:
	IngresoFechasCod(wxWindow *parent, Estacionamiento *est);
	~IngresoFechasCod();
};

#endif

