#ifndef ESTACIONAMIENTO_H
#define ESTACIONAMIENTO_H
#include <vector>
#include <fstream>
#include <string>
#include "Vehiculo.h"
#include "Tarifa.h"
#include <list>
using namespace std;

struct resumen{
	int ganancias;
	int n_autos;
	int n_camionetas;
	int n_motos;
	int n_bicicleta;
	int n_total;
};
	
struct fecha{
	long dia;
	long mes;
	long anio;
};

class Estacionamiento{
private:
	string arch_E;
	string arch_tar;
	string arch_his;
	vector<Vehiculo> E; 
	vector<Tarifa> tarifas;
public:
	Estacionamiento();//c
	Estacionamiento(string nom_E,string nom_tar,string nom_his);//c
	bool Guardar();//c
	Vehiculo &VerVehiculo(int i);//c
	Tarifa &VerTar(string i);//c
	int CantidadVehiculos();//c
	int CantidadTar();//c
	void EditarVehiculo(int i,string t, string p, string l, string ll);
	void IngresoVehiculo(Vehiculo x);//c
	Vehiculo EgresoVehiculo(int i);//c
	void RegistrarVehiculo(int i);//c
	int ObMin(int i);//c
	string inTOstr(int i);//c
	void CalcularTarifaVehiculo(int i);//c
	Vehiculo EliminarVehiculo(int i);//c
	void CambiarTarifa(string tip, int mh, int h, int f);//c
	Vehiculo BuscarVehiculo(string x);//c
	vector<Vehiculo> RetornarHistoricoPorFecha(fecha f1,fecha f2);//c
	vector<Vehiculo> RetornarHistoricoPorPatente(string p);
	vector<Vehiculo> BuscarVehiculoHis(string x, vector<Vehiculo> h);
	resumen CalcularResumenHis(vector<Vehiculo> e);
	void GenerarResumenTexto(string nom_reg,vector<Vehiculo> r,fecha f1, fecha f2);
	long CalcularGanancias(vector<Vehiculo> r);
	void GenerarResumenPatente(string nom_reg,vector<Vehiculo> r);
	void GenerarResumenTextoX1(string nom_reg,vector<Vehiculo> r,fecha f1);
	vector<Vehiculo> RetornarHistoricoPorFechaX1(fecha f1);
};

#endif

