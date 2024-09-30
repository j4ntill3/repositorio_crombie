#ifndef Vehiculo_H
#define Vehiculo_H
#include <ctime>
#include <string>
#include <fstream>
using namespace std;

struct registro_vehiculo{
	char tipo[256];
	char patente[256];
	long tarifa;
	long ingreso;
	long egreso;
	char estado[256];
	char llave[256];
	char lugar[256];
};
class Vehiculo {
private:
	string tipo;//Auto,Camioneta,Moto,Bicicleta.
	string patente;//Si no tiene se ingresa el DNI.
	long tarifa = 0;
	time_t ingreso;
	time_t egreso;
	string estado;//Pagado,No pagado.
	string llave;//Si, No.
	string lugar;//Puede o no tener;
public:
	Vehiculo();
	Vehiculo(string t,string p,string l, string sn);
	Vehiculo(string t,string p,string sn);
	void LeerDesdeBinario(ifstream &archivo);
	void GuardarEnBinario(ofstream &archivo);
	string ValidarDatos();
	string VerTipo();
	string VerPatente();
	long VerTarifa();
	string VerLlave();
	time_t VerIngreso();
	time_t VerEgreso();
	tm VerIngresoTM();
	tm VerEgresoTM();
	string VerEstado();
	string VerLugar();
	void CargarTipo(string tip);
	void CargarPatente(string pat);
	void CargarTarifa(long tar);
	void CargarEstado(string est);
	void CargarIngreso(time_t x);
	void CargarEgreso(time_t x);
	void CargarLlave(string lla);
	void CargarLugar(string x);
};

#endif

