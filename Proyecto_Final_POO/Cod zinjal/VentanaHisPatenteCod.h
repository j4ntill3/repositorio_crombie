#ifndef VENTANAHISPATENTECOD_H
#define VENTANAHISPATENTECOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"
#include <sstream>
using namespace std;

class VentanaHisPatenteCod : public VentanaHisPatenteWx {
	
private:
	
protected:
	void ClickBotonSalir( wxCommandEvent& event )  override;
	void ClickBotonArchivo( wxCommandEvent& event )  override;
	Estacionamiento *estHisPat;
	vector<Vehiculo> patente;
	string float_to_str(float i){stringstream ss;ss<<i;string aux=ss.str();return aux;}
	string long_to_str(long i){stringstream ss;ss<<i;string aux=ss.str();return aux;}
public:
	VentanaHisPatenteCod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> pat);
	~VentanaHisPatenteCod();
};

#endif

