#ifndef VENTANAPRINCIPALCOD_H
#define VENTANAPRINCIPALCOD_H
#include "wxfb_project.h"
#include "Estacionamiento.h"


class VentanaPrincipalCod : public VentanaPrincipalWx {
	
private:
	
protected:
	void ClickBotonEditar( wxCommandEvent& event )  override;
	void ClickBotonBuscar( wxCommandEvent& event )  override;
	void ClickBotonHistorico( wxCommandEvent& event )  override;
	void ClickBotonTarifas( wxCommandEvent& event )  override;
	void ClickBotonEgreso( wxCommandEvent& event )  override;
	void ClickBotonIngreso( wxCommandEvent& event )  override;
	void ClickBotonEliminar( wxCommandEvent& event )  override;
	Estacionamiento *m_estacionamiento;
	
public:
	VentanaPrincipalCod(Estacionamiento *est);
	~VentanaPrincipalCod();
	void RefrescarGrilla();
};

#endif

