#ifndef CUADROINGRESOCOD_H
#define CUADROINGRESOCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"

class CuadroIngresoCod : public CuadroIngresoWx {
private:

protected:
	void ClickBotonAceptar( wxCommandEvent& event )  override;
	void ClickBotonCancelar( wxCommandEvent& event )  override;
	Estacionamiento *estacionamientoCuadroIngreso;
public:
	CuadroIngresoCod(wxWindow *parent, Estacionamiento *est);
	~CuadroIngresoCod();
};

#endif

