#ifndef VENTANACAMBIOTARIFACOD_H
#define VENTANACAMBIOTARIFACOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"
#include "Tarifa.h"
#include <sstream>
using namespace std;

class VentanaCambioTarifaCod : public VentanaCambioTarifaWx {
	
private:
	Estacionamiento *estVentanaCambioTarifa;
protected:
	void SeleccionTipo( wxCommandEvent& event )  override;
	void ClickBotonAceptar( wxCommandEvent& event )  override;
	void ClickBotonCancelar( wxCommandEvent& event )  override;
	Tarifa aux;
	string long_to_str(long i){stringstream ss;ss<<i;string aux=ss.str();return aux;};
public:
	VentanaCambioTarifaCod(wxWindow *parent, Estacionamiento *est);
	~VentanaCambioTarifaCod();
	void RefrescarCampos();
};

#endif

