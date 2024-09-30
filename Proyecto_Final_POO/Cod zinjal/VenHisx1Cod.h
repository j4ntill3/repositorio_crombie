#ifndef VENHISX1COD_H
#define VENHISX1COD_H
#include "wxfb_project.h"
#include <vector>
#include <string>
#include "Vehiculo.h"
#include "Estacionamiento.h"
using namespace std;

class VenHisX1Cod : public VenHisX1Wx {
	
private:
	
protected:
	void ClickBotonResumen( wxCommandEvent& event )  override;
	void ClickBotonArchivo( wxCommandEvent& event )  override;
	void ClickBotonSalir( wxCommandEvent& event )  override;
	Estacionamiento *estHis;
	vector<Vehiculo> his;
	string long_to_str(long x);
	string float_to_string(float x);
	fecha f1;
public:
	VenHisX1Cod(wxWindow *parent, Estacionamiento *est, vector<Vehiculo> v, fecha fo);
	~VenHisX1Cod();
};

#endif

