#include <wx/image.h>
#include "Application.h"
#include "VentanaPrincipalCod.h"
#include <string>
using namespace std;
IMPLEMENT_APP(Application)

bool Application::OnInit() {
	m_estacionamiento = new Estacionamiento("estacionamiento.bin","tarifas.bin","historico.bin");
	VentanaPrincipalCod *ventanaPrincipal = new VentanaPrincipalCod(m_estacionamiento);
	ventanaPrincipal->Show();
	return true;
}

