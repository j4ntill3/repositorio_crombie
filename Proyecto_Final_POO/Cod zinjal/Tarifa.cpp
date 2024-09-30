#include "Tarifa.h"
#include <sstream>
#include <iostream>
using namespace std;

Tarifa::Tarifa(long mh, long h, long f) : m_hora(mh),hora(h),fraccion(f) {

}

Tarifa::Tarifa(){};

void Tarifa::LeerDesdeBinario(ifstream &archivo){
	registro_tarifa reg;
	archivo.read((char*)&reg,sizeof(reg));
	m_hora=reg.media;
	hora=reg.hora;
	fraccion=reg.fraccion;
}
void Tarifa::GuardarEnBinario(ofstream &archivo){
	registro_tarifa reg;
	reg.media=m_hora;
	reg.hora=hora;
	reg.fraccion=fraccion;
	archivo.write((char*)&reg,sizeof(reg));                                                         		
}

string Tarifa::ValidarDatos(string t,long mh, long h, long f){
	string errores;
	stringstream ss1,ss2,ss3;
	ss1<<mh;ss2<<h;ss3<<f;
	string aux1=ss1.str();
	string aux2=ss2.str();
	string aux3=ss3.str();
	if (t.size()==0) {
		errores+="El campo tipo no puede estar vacio ";
	}
	if (t.size()>256){
		errores+="El campo tipo es demasiado largo\n";
	}
	if (aux1.size()==0){
		errores+="El campo 30 min no puede estar vacio ";
	}
	if (aux1.size()>256){
		errores+="El campo 30 min es demasiado largo\n";
	}
	if (aux2.size()==0){
		errores+="El campo 1 hora no puede estar vacio ";
	}
	if (aux2.size()>256){
		errores+="El campo 1 hora es demasiado largo\n";
	}
	if (aux3.size()==0){
		errores+="El campo Fraccion 15 min no puede estar vacio ";
	}
	if (aux3.size()>256){
		errores+="El campo Fraccion 15 min es demasiado largo\n";
	}
	return errores;
}

void Tarifa::CargarHora(long x){hora=x;}
void Tarifa::CargarM_Hora(long x){m_hora=x;}
void Tarifa::CargarFraccion(long x){fraccion=x;}
long Tarifa::VerHora(){return hora;}
long Tarifa::VerM_Hora(){return m_hora;}
long Tarifa::VerFraccion(){return fraccion;}

