#ifndef VENTANAHISFECHACOD_H
#define VENTANAHISFECHACOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"


class VentanaHisFechaCod : public VentanaHisFechaWx {

private:
	
protected:
	void ClickBotonSalir( wxCommandEvent& event )  override;
	void ClickBotonResumen( wxCommandEvent& event )  override;
	void ClickBotonArchivo( wxCommandEvent& event )  override;
	Estacionamiento  *estHis;
	vector<Vehiculo> his;
	string long_to_str(long x);
	string float_to_string(float x);
	fecha f1,f2;
	
public:
	VentanaHisFechaCod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> v, fecha fo, fecha ft);
	~VentanaHisFechaCod();
};

#endif

