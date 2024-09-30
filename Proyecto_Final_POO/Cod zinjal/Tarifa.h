#ifndef TARIFA_H
#define TARIFA_H
#include <fstream>
using namespace std;
struct registro_tarifa{
	long media;
	long hora;
	long fraccion;
};
class Tarifa {
private:
	long m_hora;
	long hora;
	long fraccion;
public:
	Tarifa();
	Tarifa(long mh, long h, long f);
	void LeerDesdeBinario(ifstream &archivo);
	void GuardarEnBinario(ofstream &archivo);
	void CargarHora(long x);
	void CargarM_Hora(long x);
	void CargarFraccion(long x);
	long VerHora();
	long VerM_Hora();
	long VerFraccion();
	string ValidarDatos(string t,long mh, long h, long f);
	void CargarTarifa(string t, long mh, long h, long f);
};

#endif

