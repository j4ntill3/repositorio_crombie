#include "Estacionamiento.h"
#include <ctime>
#include <sstream>
#include <vector>
#include <cstddef>
#include <iostream>
using namespace std;
Estacionamiento::Estacionamiento(){tarifas.resize(3);};
Estacionamiento::Estacionamiento(string nom_E,string nom_tar,string nom_his){
	arch_E=nom_E;
	arch_tar=nom_tar;
	arch_his=nom_his;
	tarifas.resize(3);
	ifstream archivo(arch_E.c_str(),ios::binary|ios::ate);
	if (archivo.is_open()) {
		int tamanio_archivo=archivo.tellg();
		int cantidad_vehiculos=tamanio_archivo/sizeof(registro_vehiculo);
		E.resize(cantidad_vehiculos);
		archivo.seekg(0);
		for(int i=0;i<cantidad_vehiculos;i++){
			E[i].LeerDesdeBinario(archivo);
		}
	}
	archivo.close();
	ifstream archivo2(arch_tar.c_str(),ios::binary|ios::ate);
	if(archivo2.is_open()){
		int tamanio_archivo=archivo2.tellg();
		int cantidad_tarifas=tamanio_archivo/sizeof(registro_tarifa);
		tarifas.resize(cantidad_tarifas);
		archivo2.seekg(0);
		for(int i=0;i<cantidad_tarifas;i++){
			tarifas[i].LeerDesdeBinario(archivo2);
		}
	}
	archivo2.close();
}
bool Estacionamiento::Guardar(){
	ofstream archivo(arch_E.c_str(),ios::binary|ios::trunc);
	if(!archivo.is_open())return false;
	int cantidad_vehiculos = E.size();
	for (int i=0;i<cantidad_vehiculos;i++){
		E[i].GuardarEnBinario(archivo);
	}	
	archivo.close();
	ofstream archivo2(arch_tar.c_str(),ios::binary|ios::trunc);
	int cantidad_tarifas = tarifas.size(); 
	for (int i=0;i<cantidad_tarifas;i++){
		tarifas[i].GuardarEnBinario(archivo2);
	}
	archivo2.close();
	return true;
}


Vehiculo &Estacionamiento::VerVehiculo(int i){
	return E[i];
}

Tarifa &Estacionamiento::VerTar(string t){
	if(t=="Auto"){
		return tarifas[0];
	}
	if(t=="Camioneta"){
		return tarifas[1];
	}
	if(t=="Moto"){
		return tarifas[2];
	}
	if(t=="Bicicleta"){
		return tarifas[2];
	}
	
}

int Estacionamiento::CantidadVehiculos(){
	return E.size();
}
int Estacionamiento::CantidadTar(){
	return tarifas.size();
}

Vehiculo Estacionamiento::EliminarVehiculo(int i){
	E[i].CargarEstado("Eliminado");
	time_t egreso = time(0);
	E[i].CargarEgreso(egreso);
	long x=0;
	E[i].CargarTarifa(x);
	RegistrarVehiculo(i);
	Vehiculo vei = E[i];
	E.erase(E.begin()+i);
	return vei;
}

void Estacionamiento::IngresoVehiculo(Vehiculo x){
	E.push_back(x);
}

Vehiculo Estacionamiento::EgresoVehiculo(int i){
	E[i].CargarEstado("Pagado");
	time_t egreso = time(0);
	E[i].CargarEgreso(egreso);
	CalcularTarifaVehiculo(i);
	RegistrarVehiculo(i);
	Vehiculo vei = E[i];
	E.erase(E.begin()+i);
	return vei;
}

void Estacionamiento::EditarVehiculo(int i,string t, string p, string l, string ll){
	Vehiculo aux(t,p,l,ll);
	aux.CargarIngreso(E[i].VerIngreso());
	auto it=E.begin()+i;
	E.insert(it,aux);
	auto it2=E.begin()+i+1;
	E.erase(it2);
}

void Estacionamiento::RegistrarVehiculo(int i){
	ofstream archivo3(arch_his.c_str(),ios::binary|ios::out|ios::app);
	E[i].GuardarEnBinario(archivo3);
	archivo3.close();
}

long Estacionamiento::CalcularGanancias(vector<Vehiculo> r){
	long aux=0;
	for(size_t i=0;i<r.size();i++){
		aux+=r[i].VerTarifa();
	}
	return aux;
}

void Estacionamiento::GenerarResumenTextoX1(string nom_reg,vector<Vehiculo> r,fecha f1){
	ofstream archivo(nom_reg.c_str(),ios::trunc);
	archivo<<"Registro: "<<f1.dia<<"."
		<<f1.mes<<"."<<f1.anio<<endl<<endl;
	for(int i=0;i<r.size();i++){
		archivo<<r[i].VerPatente()<<" "<<r[i].VerTipo()<<" "
			<<r[i].VerIngresoTM().tm_hour<<":"<<r[i].VerIngresoTM().tm_min<<"-"
			<<r[i].VerEgresoTM().tm_hour<<":"<<r[i].VerEgresoTM().tm_min<<" $"<<r[i].VerTarifa()
			<<" "<<r[i].VerEstado()<<" "<<r[i].VerEgresoTM().tm_mday<<"/"<<r[i].VerEgresoTM().tm_mon+1
			<<"/"<<r[i].VerEgresoTM().tm_year+1900<<endl;
	}
	resumen aux=CalcularResumenHis(r);
	archivo<<endl<<"Cantidad Autos: "<<aux.n_autos<<endl
		<<"Cantidad Camionetas: "<<aux.n_camionetas<<endl
		<<"Cantidad Motos: "<<aux.n_motos<<endl
		<<"Cantidad Bicicletas: "<<aux.n_bicicleta<<endl
		<<"Total Vehiculos: "<<aux.n_total<<endl<<endl
		<<"Ganancias: $"<<CalcularGanancias(r);
	archivo.close();
}


void Estacionamiento::GenerarResumenTexto(string nom_reg,vector<Vehiculo> r,fecha f1,fecha f2){
		ofstream archivo(nom_reg.c_str(),ios::trunc);
		archivo<<"Registro: "<<f1.dia<<"."
			<<f1.mes<<"."<<f1.anio
			<<" al "<<f2.dia<<"."<<f2.mes
			<<"."<<f2.anio<<endl<<endl;
		for(int i=0;i<r.size();i++){
			archivo<<r[i].VerPatente()<<" "<<r[i].VerTipo()<<" "
				<<r[i].VerIngresoTM().tm_hour<<":"<<r[i].VerIngresoTM().tm_min<<"-"
				<<r[i].VerEgresoTM().tm_hour<<":"<<r[i].VerEgresoTM().tm_min<<" $"<<r[i].VerTarifa()
				<<" "<<r[i].VerEstado()<<" "<<r[i].VerEgresoTM().tm_mday<<"/"<<r[i].VerEgresoTM().tm_mon+1
				<<"/"<<r[i].VerEgresoTM().tm_year+1900<<endl;
		}
		resumen aux=CalcularResumenHis(r);
		archivo<<endl<<"Cantidad Autos: "<<aux.n_autos<<endl
		<<"Cantidad Camionetas: "<<aux.n_camionetas<<endl
		<<"Cantidad Motos: "<<aux.n_motos<<endl
		<<"Cantidad Bicicletas: "<<aux.n_bicicleta<<endl
		<<"Total Vehiculos: "<<aux.n_total<<endl<<endl
		<<"Ganancias: $"<<CalcularGanancias(r);
		archivo.close();
}

void Estacionamiento::GenerarResumenPatente(string nom_reg,vector<Vehiculo> r){
	ofstream archivo(nom_reg.c_str(),ios::trunc);
	archivo<<"Registro Patente: "<<r[0].VerPatente()<<endl<<endl;
	for(int i=0;i<r.size();i++){
		archivo<<r[i].VerPatente()<<" "<<r[i].VerTipo()<<" "
		<<r[i].VerIngresoTM().tm_hour<<":"<<r[i].VerIngresoTM().tm_min<<"-"
		<<r[i].VerEgresoTM().tm_hour<<":"<<r[i].VerEgresoTM().tm_min<<" $"<<r[i].VerTarifa()
		<<" "<<r[i].VerEstado()<<" "<<r[i].VerEgresoTM().tm_mday<<"/"<<r[i].VerEgresoTM().tm_mon+1
		<<"/"<<r[i].VerEgresoTM().tm_year+1900<<endl;
	}
	archivo.close();
}

int Estacionamiento::ObMin(int i){
	time_t egreso = time(0);
	double aux=difftime(egreso,E[i].VerIngreso())/60;
	int xx=aux;
	return xx;
}

string Estacionamiento::inTOstr(int i){
	stringstream ss;
	ss<<i;
	string aux=ss.str();
	return aux;
}

void Estacionamiento::CalcularTarifaVehiculo(int i){
	int min=ObMin(i);
	if(E[i].VerTipo()=="Auto"){
		E[i].CargarTarifa(tarifas[0].VerM_Hora());
		if(min>30){
			E[i].CargarTarifa(tarifas[0].VerHora());
		}
		if(min>60){
			int aux=min-60;
			while(aux>0){
				aux=aux-15;
				E[i].CargarTarifa(tarifas[0].VerFraccion());
			}
		}
	}
	if(E[i].VerTipo()=="Camioneta"){
		E[i].CargarTarifa(tarifas[1].VerM_Hora());
		if(min>30){
			E[i].CargarTarifa(tarifas[1].VerHora());
		}
		int aux=min-60;
		if(min>60){
			while(aux>0){
				aux=aux-15;
				E[i].CargarTarifa(tarifas[1].VerFraccion());
			}
		}
	}
	if(E[i].VerTipo()=="Moto"){
		E[i].CargarTarifa(tarifas[2].VerM_Hora());
		if(min>30){
			E[i].CargarTarifa(tarifas[2].VerHora());
		}
		if(min>60){
			int aux=min-60;
			while(aux>0){
				aux=aux-15;
				E[i].CargarTarifa(tarifas[2].VerFraccion());
			}
		}
	}
	if(E[i].VerTipo()=="Bicicleta"){
		E[i].CargarTarifa(tarifas[2].VerM_Hora());
		if(min>30){
			E[i].CargarTarifa(tarifas[2].VerHora());
		}
		if(min>60){
			int aux=min-60;
			while(aux>0){
				aux=aux-15;
				E[i].CargarTarifa(tarifas[2].VerFraccion());
			}
		}
	}

}

void Estacionamiento::CambiarTarifa(string tip, int mh, int h, int f){
	if(tip=="Auto"){
		tarifas[0].CargarHora(h);
		tarifas[0].CargarM_Hora(mh);
		tarifas[0].CargarFraccion(f);
		
	}
	if(tip=="Camioneta"){
		tarifas[1].CargarHora(h);
		tarifas[1].CargarM_Hora(mh);
		tarifas[1].CargarFraccion(f);
	}
	if(tip=="Moto"){
		tarifas[2].CargarHora(h);
		tarifas[2].CargarM_Hora(mh);
		tarifas[2].CargarFraccion(f);
	}
	if(tip=="Bicicleta"){
		tarifas[2].CargarHora(h);
		tarifas[2].CargarM_Hora(mh);
		tarifas[2].CargarFraccion(f);
	}
};

Vehiculo Estacionamiento::BuscarVehiculo(string x){
	for(int i=0;i<E.size();i++){
		if(E[i].VerPatente()==x){
			return E[i];
		}
	}
}

vector<Vehiculo> Estacionamiento::RetornarHistoricoPorPatente(string p){
	vector<Vehiculo> v;
	ifstream archivo(arch_his.c_str(),ios::binary|ios::ate);
	if (archivo.is_open()) {
		int tamanio_archivo=archivo.tellg();
		int cantidad_vehiculos=tamanio_archivo/sizeof(registro_vehiculo);
		archivo.seekg(0);
		for(int i=0;i<cantidad_vehiculos;i++){
			Vehiculo x;
			registro_vehiculo reg;
			archivo.read((char*)&reg,sizeof(reg));
			x.CargarTipo(reg.tipo);
			x.CargarPatente(reg.patente);
			x.CargarTarifa(reg.tarifa);
			x.CargarIngreso(reg.ingreso);
			x.CargarEgreso(reg.egreso);
			x.CargarEstado(reg.estado);
			x.CargarLlave(reg.llave);
			x.CargarLugar(reg.lugar);
			if(x.VerPatente()==p){
				v.push_back(x);
			}
		}
	}
	return v;
}

vector<Vehiculo> Estacionamiento::RetornarHistoricoPorFechaX1(fecha f1){
	tm tm1;
	tm1.tm_mday=f1.dia;
	tm1.tm_mon=f1.mes-1;
	tm1.tm_year=f1.anio-1900;
	tm1.tm_hour=0;
	tm1.tm_min=0;
	tm1.tm_sec=0;
	tm1.tm_isdst=-1;
	time_t t1=mktime(&tm1);
	vector<Vehiculo> v;
	ifstream archivo(arch_his.c_str(),ios::binary|ios::ate);
	if (archivo.is_open()) {
		int tamanio_archivo=archivo.tellg();
		int cantidad_vehiculos=tamanio_archivo/sizeof(registro_vehiculo);
		archivo.seekg(0);
		for(int i=0;i<cantidad_vehiculos;i++){
			Vehiculo x;
			registro_vehiculo reg;
			archivo.read((char*)&reg,sizeof(reg));
			x.CargarTipo(reg.tipo);
			x.CargarPatente(reg.patente);
			x.CargarTarifa(reg.tarifa);
			x.CargarIngreso(reg.ingreso);
			x.CargarEgreso(reg.egreso);
			x.CargarEstado(reg.estado);
			x.CargarLlave(reg.llave);
			x.CargarLugar(reg.lugar);
			if(x.VerIngresoTM().tm_mday==tm1.tm_mday && x.VerIngresoTM().tm_mon+1==tm1.tm_mon+1 &&
			   x.VerIngresoTM().tm_year+1900==tm1.tm_year+1900){
				v.push_back(x);
			}
		}
	}
	return v;
}


vector<Vehiculo> Estacionamiento::RetornarHistoricoPorFecha(fecha f1, fecha f2){
	tm tm1, tm2;
	tm1.tm_mday=f1.dia;
	tm1.tm_mon=f1.mes-1;
	tm1.tm_year=f1.anio-1900;
	tm1.tm_hour=0;
	tm1.tm_min=0;
	tm1.tm_sec=0;
	tm1.tm_isdst=-1;
	tm2.tm_mday=f2.dia;
	tm2.tm_mon=f2.mes-1;
	tm2.tm_year=f2.anio-1900;
	tm2.tm_hour=0;
	tm2.tm_min=0;
	tm2.tm_sec=0;
	tm2.tm_isdst=-1;
	time_t t1=mktime(&tm1);
	time_t t2=mktime(&tm2);
	vector<Vehiculo> v;
	ifstream archivo(arch_his.c_str(),ios::binary|ios::ate);
	if (archivo.is_open()) {
		int tamanio_archivo=archivo.tellg();
		int cantidad_vehiculos=tamanio_archivo/sizeof(registro_vehiculo);
		archivo.seekg(0);
		for(int i=0;i<cantidad_vehiculos;i++){
			Vehiculo x;
			registro_vehiculo reg;
			archivo.read((char*)&reg,sizeof(reg));
			x.CargarTipo(reg.tipo);
			x.CargarPatente(reg.patente);
			x.CargarTarifa(reg.tarifa);
			x.CargarIngreso(reg.ingreso);
			x.CargarEgreso(reg.egreso);
			x.CargarEstado(reg.estado);
			x.CargarLlave(reg.llave);
			x.CargarLugar(reg.lugar);
			if(x.VerIngreso()>=t1 && x.VerIngreso()<=t2){
				v.push_back(x);
			}
		}
	}
	return v;
}


vector<Vehiculo> Estacionamiento::BuscarVehiculoHis(string x, vector<Vehiculo> h){
	vector<Vehiculo> aux;
	for(size_t i=0;i<h.size();i++){
		if(h[i].VerPatente()==x){
			aux.push_back(h[i]);
		}
	}
	return aux;
}

resumen Estacionamiento::CalcularResumenHis(vector<Vehiculo> e){
	resumen x;
	x.n_autos=x.n_camionetas=x.n_bicicleta=x.n_motos=x.n_total=0;
	for(size_t i=0;i<e.size();i++){
		if(e[i].VerTipo()=="Auto"){
			x.n_autos++;
			x.n_total++;
		}
		if(e[i].VerTipo()=="Camioneta"){
			x.n_camionetas++;
			x.n_total++;
		}
		if(e[i].VerTipo()=="Moto"){
			x.n_motos++;
			x.n_total++;
		}
		if(e[i].VerTipo()=="Bicicleta"){
			x.n_bicicleta++;
			x.n_total++;
		}
	}
	return x;
}



