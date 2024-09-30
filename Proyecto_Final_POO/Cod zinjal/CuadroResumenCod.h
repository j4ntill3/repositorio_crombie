#ifndef CUADRORESUMENCOD_H
#define CUADRORESUMENCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"
#include <sstream>
using namespace std;

class CuadroResumenCod : public CuadroResumenWx {
	
private:
	
protected:
	void ClickBotonOk( wxCommandEvent& event )  override;
	Estacionamiento *estResumen;
	string int_to_str(int i){stringstream ss;ss<<i;string aux=ss.str();return aux;}
public:
	CuadroResumenCod(wxWindow *parent,Estacionamiento *est,vector<Vehiculo> r);
	~CuadroResumenCod();
};

#endif

