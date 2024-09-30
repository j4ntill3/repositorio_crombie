#ifndef INGRESOPATENTECOD_H
#define INGRESOPATENTECOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"

class IngresoPatenteCod : public IngresoPatenteWx {
	
private:
	
protected:
	void ClickBotonAceptar( wxCommandEvent& event )  override;
	void ClickBotonCancelar( wxCommandEvent& event )  override;
	Estacionamiento *estHisPat;
public:
	IngresoPatenteCod(wxWindow *parent, Estacionamiento *est);
	~IngresoPatenteCod();
};

#endif

