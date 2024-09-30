#ifndef APPLICATION_H
#define APPLICATION_H

#include <wx/app.h>
#include "Estacionamiento.h"

class Application : public wxApp {
	Estacionamiento *m_estacionamiento;
public:
	virtual bool OnInit();
};

#endif
