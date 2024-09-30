#include "Vehiculo.h"
#include <cstring>
#include <iostream>
using namespace std;

///Costructores y destructores
Vehiculo::Vehiculo(){}
Vehiculo::Vehiculo(string t,string p,string l, string sn){
	tipo=t;
	patente=p;
	ingreso = time(0);
	lugar=l;
	llave=sn;
}
Vehiculo::Vehiculo(string t,string p,string sn){
	tipo=t;
	patente=p;
	ingreso = time(0);
	lugar="-";
	llave=sn;
}
///Manejo de Archivos
void Vehiculo::LeerDesdeBinario(ifstream &archivo){
	registro_vehiculo reg;
	archivo.read((char*)&reg,sizeof(reg));
	tipo=reg.tipo;
	patente=reg.patente;
	tarifa=reg.tarifa;
	ingreso=reg.ingreso;
	egreso=reg.egreso;
	estado=reg.estado;
	llave=reg.llave;
	lugar=reg.lugar;
}
void Vehiculo::GuardarEnBinario(ofstream &archivo){
	registro_vehiculo reg;
	strcpy(reg.tipo,tipo.c_str());
	strcpy(reg.patente,patente.c_str());
	reg.tarifa=tarifa;
	reg.ingreso=ingreso;
	reg.egreso=egreso;
	strcpy(reg.estado,estado.c_str());
	strcpy(reg.llave,llave.c_str());
	strcpy(reg.lugar,lugar.c_str());
	archivo.write((char*)&reg,sizeof(reg));                                                         		
}
string Vehiculo::ValidarDatos(){
	string errores;
	if (patente.size()==0) errores+="El campo Patente no puede estar vacio\n";
	if (patente.size()>8) errores+="El campo Patente es demasiado largo\n";
	if (patente.size()<6) errores+="El campo Patente es demasiado corto\n";
	if(patente.size()==6){
		char x[6];
		strcpy(x,patente.c_str());
		if(!(x[0]>='A' && x[0]<='Z' && x[1]>='A' && x[1]<='Z' && x[2]>='A' && x[2]<='Z')){
			errores+="Formato de patente mal ingresado.";
		}else{
			if(!(x[3]>='0' && x[3]<='9' && x[4]>='0' && x[4]<='9' && x[5]>='0' && x[5]<='9')){
				errores+="Formato de patente mal ingresado.";
			}
		}
	}
	if(patente.size()==7){
		char x[7];
		strcpy(x,patente.c_str());
		if(!(x[0]>='A' && x[0]<='Z' && x[1]>='A' && x[1]<='Z')){
			errores+="Formato de patente mal ingresado.";
		}else{
			if(!(x[2]>='0' && x[2]<='9' && x[3]>='0' && x[3]<='9' && x[4]>='0' && x[4]<='9')){
				errores+="Formato de patente mal ingresado.";
			}else{
				if(!(x[5]>='A' && x[5]<='Z' && x[6]>='A' && x[6]<='Z')){
					errores+="Formato de patente mal ingresado.";
				}
			}
		}
	}
	if(patente.size()==8){
		char x[8];
		strcpy(x,patente.c_str());
		if(!(x[0]>='0' && x[0]<='9' && x[1]>='0' && x[1]<='9' && x[2]>='0' && x[2]<='9' &&
			 x[3]>='0' && x[3]<='9' && x[4]>='0' && x[4]<='9' && x[5]>='0' && x[5]<='9' &&
			 x[6]>='0' && x[6]<='9' && x[7]>='0' && x[7]<='9')){
			errores+="Formato de DNI mal ingresado.";
		}
	}
	
	
	
	if (lugar.size()>256) errores+="El campo Lugar es demasiado largo\n";
	return errores;
}
///Metodos para ver/cargar
string Vehiculo::VerTipo(){return tipo;}
string Vehiculo::VerPatente(){return patente;}
long Vehiculo::VerTarifa(){return tarifa;}
time_t Vehiculo::VerIngreso(){return ingreso;}
time_t Vehiculo::VerEgreso(){return egreso;}
string Vehiculo::VerEstado(){return estado;}
string Vehiculo::VerLlave(){return llave;}
string Vehiculo::VerLugar(){return lugar;};
tm Vehiculo::VerIngresoTM(){ 
	tm *p = localtime(&ingreso);
	tm ingresoTM = *p;
	return ingresoTM;
}
tm Vehiculo::VerEgresoTM(){ 
	tm *p = localtime(&egreso);
	tm egresoTM = *p;
	return egresoTM;
}
void Vehiculo::CargarTipo(string t){tipo=t;}
void Vehiculo::CargarPatente(string p){patente=p;}
void Vehiculo::CargarTarifa(long tar){tarifa=tarifa+tar;}
void Vehiculo::CargarEstado(string est){estado=est;}
void Vehiculo::CargarEgreso(time_t x){egreso=x;}
void Vehiculo::CargarIngreso(time_t x){ingreso=x;}
void Vehiculo::CargarLlave(string lla){llave=lla;}
void Vehiculo::CargarLugar(string x){lugar=x;}
