//#include <iostream>
//#include "Estacionamiento.h"
//#include "Vehiculo.h"
//using namespace std;
//
//int main(int argc, char *argv[]) {
//	Estacionamiento E("estacionamiento.bin","tarifas.bin","historico.bin");
//	fecha f1,f2;
//	f1.dia=3;
//	f1.mes=3;
//	f1.anio=2020;
//	f2.dia=27;
//	f2.mes=3;
//	f2.anio=2020;
//	vector<Vehiculo> v=E.RetornarHistoricoPorFecha(f1,f2);
//	for(size_t i=0;i<v.size();i++){
//		cout<<v[i].VerTipo()<<" "<<v[i].VerPatente()<<" "<<v[i].VerLugar()<<" "<<v[i].VerLlave()
//		<<" "<<v[i].VerIngresoTM().tm_hour<<":"<<v[i].VerIngresoTM().tm_min<<" "
//		<<v[i].VerEgresoTM().tm_hour<<":"<<v[i].VerEgresoTM().tm_min<<" "<<v[i].VerEstado()<<" $"
//		<<v[i].VerTarifa()<<" "<<v[i].VerIngresoTM().tm_mday<<"/"<<v[i].VerIngresoTM().tm_mon+1<<"/"
//		<<v[i].VerIngresoTM().tm_year+1900<<endl;
//	}
//	E.Guardar();
//	getchar();
//	return 0;
//}

