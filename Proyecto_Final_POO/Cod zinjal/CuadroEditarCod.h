#ifndef CUADROEDITARCOD_H
#define CUADROEDITARCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"
#include <sstream>
using namespace std;

class CuadroEditarCod : public CuadroEditarWx {
	
private:
	
protected:
	void SeleccionTipo( wxCommandEvent& event )  override;
	void ClickBotonAceptar( wxCommandEvent& event )  override;
	void ClickBotonCancelar( wxCommandEvent& event )  override;
	Estacionamiento *estEditar;
	string long_to_str(long i){stringstream ss;ss<<i;string aux=ss.str();return aux;};
	Vehiculo vei;
	int p;
	
public:
	CuadroEditarCod(wxWindow *parent, Estacionamiento *est, int i,Vehiculo aux);
	~CuadroEditarCod();
};

#endif

