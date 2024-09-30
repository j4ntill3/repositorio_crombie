<?php

require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/models/M_Categoria.php');
require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/models/M_Jerarquia.php');

class C_Categorias{

    // Atributes
    private $connWOO;
    private $csv_data;
    public $nombres_categorias = array();
    public $jerarquias_categorias = array();
    public $jerarquias_categorias_WOO = array();
    public $categorias_WOO = array();

    function __construct($CONNWOO,$CSV_DATA){
        $this->csv_data = $CSV_DATA;
        $this->connWOO = $CONNWOO;
    }

    //CSV-ETL functions
    function obtenerDatosCSV(){
        $this->obtenerNombresCategoriasCSV();
        $this->obtenerJerarquiasCSV();
        $this->asignarCategoriasPadre();
    }

    public function obtenerJerarquiasCSV(){
        $this->jerarquias_categorias = array(); // Reiniciar el array jerarquias_categorias antes de iniciar el proceso

        foreach ($this->csv_data as $fila) {
            $elemento1 = $fila[0];
            $elemento2 = $fila[1];
            $elemento3 = $fila[2];
            $nuevoElemento1 = array($elemento1, $elemento2);
            $nuevoElemento2 = array($elemento2, $elemento3);

            $existeElemento1 = false;
            $existeElemento2 = false;

            foreach ($this->jerarquias_categorias as $jerarquia) {
                if ($jerarquia === $nuevoElemento1) {
                    $existeElemento1 = true;
                }
                if ($jerarquia === $nuevoElemento2) {
                    $existeElemento2 = true;
                }
            }

            if (!$existeElemento1) {
                $this->jerarquias_categorias[] = $nuevoElemento1;
            }
            if (!$existeElemento2) {
                $this->jerarquias_categorias[] = $nuevoElemento2;
            }
        }
    }

    public function obtenerJerarquiasWOO(){
        $cant_categorias_woo = count($this->categorias_WOO);
        for($i=0;$i<$cant_categorias_woo;$i++){

            //si entra significa que no es puramente padre

            if($this->categorias_WOO[$i]->getIdWooPadre() <> 0){

                $cat_hija_id = $this->categorias_WOO[$i]->getIdWoo();
                $cat_hija_nom = $this->categorias_WOO[$i]->getNombre();
                $cat_padre_id = null;
                $cat_padre_nom = null;


                //busco al padre de la cat hija
                for($j=0;$j<$cant_categorias_woo;$j++){
                    if($this->categorias_WOO[$j]->getIdWoo() == $this->categorias_WOO[$i]->getIdWooPadre()){
                        $cat_padre_id = $this->categorias_WOO[$j]->getIdWoo();
                        $cat_padre_nom = $this->categorias_WOO[$j]->getNombre();
                        break;
                    }
                }
                $jerarquia_woo = new M_Jerarquia($cat_padre_id,$cat_padre_nom,
                $cat_hija_id,$cat_hija_nom);
                array_push($this->jerarquias_categorias_WOO,$jerarquia_woo);
            }

        }

    }


    public function actualizarJerarquiasWOO(){

        echo('-> ACTUALIZANDO JERARQUIA DE CATEGORIAS ' . PHP_EOL . PHP_EOL);
        $cant_jerarquias = count($this->jerarquias_categorias);
        $cant_jerarquias_woo = count($this->jerarquias_categorias_WOO);
        $cant_cat_woo = count($this->categorias_WOO);

	if($cant_jerarquias_woo == 0){
		echo('-> No se encontraron Jerarquias Previamente cargadas' . PHP_EOL . PHP_EOL);
		$this->cargarJerarquiasWOO();
	} else {

	echo('-> Total de Jerarquias a actualizar = ' . $cant_jerarquias_woo . PHP_EOL . PHP_EOL);

        for($i=0;$i<$cant_jerarquias;$i++){
            $cat_hija = null;
            $cat_padre = null;
            //busco categoria hija en csv
            for($j=0;$j<$cant_cat_woo;$j++){

                if($this->jerarquias_categorias[$i][1] == $this->categorias_WOO[$j]->getNombre()){
                    $cat_hija = $this->categorias_WOO[$j];

                    //busco cat padre csv
                    for($k=0;$k<$cant_cat_woo;$k++){
                        if($this->jerarquias_categorias[$i][0] == $this->categorias_WOO[$k]->getNombre()){
                            $cat_padre = $this->categorias_WOO[$k];
                            break;
                        }
                    }
                    break;
                }
            }

            //verifico jerarquia

                echo('-> Analizando Jerarquia: ' . $this->jerarquias_categorias[$i][0] . ' > ' . $this->jerarquias_categorias[$i][1] . ' (' . ($i+1) . ') ');

                // buscar si la categoria esta en el array de jerarquias (si medio confuso)
                $update_padre = false;
                for($h=0;$h<$cant_jerarquias_woo;$h++){

                    //si encuentro la categoria me fijo si modifico el padre
                    if($this->jerarquias_categorias_WOO[$h]->getCatHija()->getIdWoo() == $cat_hija->getIdWoo()){

                        if($this->jerarquias_categorias_WOO[$h]->getCatHija()->getIdWooPadre() == $cat_padre->getIdWoo()){
                            echo('-> La Jerarquia esta actualizada' . PHP_EOL . PHP_EOL);

                            break;
                        } else if($h == $cant_jerarquias_woo-1){
                            echo('-> La Jerarquia no esta actualizada -> Cargando nueva jerarquia: '  . $this->jerarquias_categorias[$i][0] . ' > ' . $this->jerarquias_categorias[$i][1]);
                            $data = [
                                'parent' => $cat_padre->getIdWoo()
                            ];
                            $this->connWOO->put('products/categories/'. $cat_hija->getIdWoo() , $data);
                            echo('Jerarquia cargada con exito ' . PHP_EOL . PHP_EOL);
                            break;
                        }

                    } else if($h == $cant_jerarquias_woo-1){

                            echo('-> La Jerarquia no esta cargada -> Cargando nueva jerarquia: '  . $this->jerarquias_categorias[$i][0] . ' > ' . $this->jerarquias_categorias[$i][1]);
                            $data = [
                                'parent' => $cat_padre->getIdWoo()
                            ];
                            $this->connWOO->put('products/categories/'. $cat_hija->getIdWoo() , $data);
                            echo('-> Jerarquia cargado con exito ' . PHP_EOL . PHP_EOL);
                            break;
                   	 }
                    }

        	}

	}

	echo('-> Las ' . $cant_jerarquias_woo . ' Jerarquias fueron cargadas con exito!' . PHP_EOL . PHP_EOL);
    }

    public function obtenerNombresCategoriasCSV(){
        $result = array();
        foreach ($this->csv_data as $value) {
        $subArray = array($value[0], $value[1], $value[2]);
        $result = array_merge($result, $subArray);
        }
        $this->nombres_categorias = array_values(array_unique($result));
    }

    public function asignarCategoriasPadre(){
        for($i=0;$i<count($this->jerarquias_categorias);$i++){
            $categoria_padre = $this->jerarquias_categorias[$i][0];
            $categoria_hija = $this->jerarquias_categorias[$i][1];
            $id_padre = null;
            for($j=0;$j<count($this->categorias_WOO);$j++){
                if($this->categorias_WOO[$j]->getNombre() == $categoria_padre){
                    $id_padre = $this->categorias_WOO[$j]->getIdWOO();
                    break;
                }
            }
            for($j=0;$j<count($this->categorias_WOO);$j++){
                if($this->categorias_WOO[$j]->getNombre() == $categoria_hija){
                    $this->categorias_WOO[$j]->setIdWooPadre($id_padre);
                    break;
                }
            }
        }
    }

    //WOO functions

    public function actualizarCategoriasWOO(){
	echo('-> ACTUALIZANDO CATEGORIAS ' . PHP_EOL . PHP_EOL);
        $cant_categorias = count($this->nombres_categorias);
        $cant_categorias_WOO = count($this->categorias_WOO);



	if($cant_categorias_WOO == 0){
		echo('-> No se econtraron categorias cargadas previamente en WOO' . PHP_EOL . PHP_EOL);
		$this->cargarCategoriasWOO();
	} else {
		echo('-> Total de Categorias a actualizar = ' . $cant_categorias . PHP_EOL . PHP_EOL);
        	// Busco si hay categorias nuevas para agregar o actualizar
        	for($i=0;$i<$cant_categorias;$i++){
            	echo('-> Analizando categoria ' . $this->nombres_categorias[$i] . ' (' . ($i+1) . ')' . ' ');
	            	for($j=0;$j<$cant_categorias_WOO;$j++){
        	        	if($this->categorias_WOO[$j]->getNombre() == $this->nombres_categorias[$i]){
                			echo('-> La categoria ya se encuentra cargada.' . PHP_EOL . PHP_EOL);
					break;
                	} 	else if($j == $cant_categorias_WOO-1){
                    		echo('-> Cargando categoria ' . $this->nombres_categorias[$i] . ' ');
                    		$data = [
                        		        'name' => urldecode($this->nombres_categorias[$i])
                            		];
                    		$this->connWOO->post('products/categories', $data);
                    		echo('-> Categoria cargada con exito.' . PHP_EOL . PHP_EOL);
                		}
            	}

        	}
		echo('-> Las ' . $cant_categorias . ' Categorias fueron actualizandas con exito!' . PHP_EOL . PHP_EOL);
	}

    }

    public function obtenerCategoriasWOO(){

        if(!empty($this->categorias_WOO)){
            $this->categorias_WOO = array();
        }

        $page = 1;
        $get_categoriasWOO = [];
        while(count($get_categoriasWOO) <> 0 or $page == 1){
            $get_categoriasWOO = $this->connWOO->get('products/categories?per_page=100&page=' . $page);
            for($i=0;$i<count($get_categoriasWOO);$i++){
                if($get_categoriasWOO[$i]->id <> 15){
                    $categoriaWOO = new M_Categoria($get_categoriasWOO[$i]->id,$get_categoriasWOO[$i]->name,$get_categoriasWOO[$i]->parent); 
                    array_push($this->categorias_WOO,$categoriaWOO);
                }
            }
            $page++;

        }

    }

    //DEPRECATED functions
    public function cargarJerarquiasWOO(){
	echo('-> CARGANDO JERARQUIAS' . PHP_EOL . PHP_EOL);
        $cant_jerarquias = count($this->jerarquias_categorias);

        echo('-> Total de Jerarquias a cargar = ' . $cant_jerarquias . PHP_EOL . PHP_EOL);
        for($i=0;$i<$cant_jerarquias;$i++){

/*
            // buscar padre (esto solo sirve para el log, no es necesario)
            for($j=0;$j<count($this->categorias_WOO);$j++){
                if($this->categorias_WOO[$j]->getIdWoo() == $this->categorias_WOO[$i]->getIdWooPadre()){
                    $categoria_padre = $this->categorias_WOO[$j];
                }
            }

*/
/*
    	if($this->categorias_WOO[$i]->getIdWooPadre() <> null){
		echo('Cargando Jerarquia: ' . $categoria_padre->getNombre() . ' > ' . $this->categorias_WOO[$i]->getNombre() . PHP_EOL . PHP_EOL);
                $data_padre = [
                    'parent' => $this->categorias_WOO[$i]->getIdWooPadre()
                ];
                $this->connWOO->put('products/categories/' . $this->categorias_WOO[$i]->getIdWoo(), $data_padre);
                echo('Jerarquia: ' . $categoria_padre->getNombre() . ' > ' . $this->categorias_WOO[$i]->getNombre() . ' cargada con exito.' . PHP_EOL . PHP_EOL);
            }
*/

		echo('-> Cargando Jerarquia: ' . $this->jerarquias_categorias[$i][0] . ' > ' . $this->jerarquias_categorias[$i][1] . ' (' . ($i+1) . ') ');

		// busco categoria padre

		$cat_padre_id = null;
		for($j=0;$j<count($this->categorias_WOO);$j++){
			if($this->categorias_WOO[$j]->getNombre() == $this->jerarquias_categorias[$i][0]){
				$cat_padre_id = $this->categorias_WOO[$j]->getIdWoo();
				break;
			}
		}

		// busco categoria hija

		$cat_hija_id = null;
		for($j=0;$j<count($this->categorias_WOO);$j++){
			if($this->categorias_WOO[$j]->getNombre() == $this->jerarquias_categorias[$i][1]){
				$cat_hija_id = $this->categorias_WOO[$j]->getIdWoo();
				break;
			}
		}

		$data = [
				'parent' => $cat_padre_id
			];

		$this->connWOO->put('products/categories/' . $cat_hija_id, $data);

		echo('-> Jerarquia cargada con exito!' . PHP_EOL . PHP_EOL);

	}
	echo('Las ' . count($this->categorias_WOO) . ' Jerarquias fueron cargadas con exito!');
    }


    public function getCategoriasWOO(){
        return $this->categorias_WOO;
    }

    public function eliminarCategorias(){
        $cant_categorias = count($this->categorias_WOO);
        echo('-> Total de categorias a eliminar = ' . $cant_categorias . PHP_EOL . PHP_EOL);
        if($cant_categorias <> 0){
            for($i=0;$i<$cant_categorias;$i++){
                echo('-> Eliminando Categoria ' . $this->categorias_WOO[$i]->getNombre() . ' ');
                $this->connWOO->delete('products/categories/' . $this->categorias_WOO[$i]->getIdWoo(), ['force' => true]);
                echo('-> Categoria eliminada con exito.' . PHP_EOL . PHP_EOL);
            }
        }
        echo('-> Las '. $cant_categorias . ' categorias fueron eliminadas con exito!' . PHP_EOL . PHP_EOL);
    }

    public function cargarCategoriasWOO(){
	echo('-> CARGANDO CATEGORIAS' . PHP_EOL . PHP_EOL);
        $cant_categorias = count($this->nombres_categorias);
        echo('-> Total de categorias a cargar =  ' . $cant_categorias . PHP_EOL . PHP_EOL);

        for($i=0;$i<$cant_categorias;$i++){
		echo('-> Cargando categoria ' . $this->nombres_categorias[$i] . ' (' . ($i+1) . ')' . ' ');
            $data = [
                'name' => urldecode($this->nombres_categorias[$i])
            ];
            $this->connWOO->post('products/categories', $data);

            echo('-> Categoria '. $this->nombres_categorias[$i] . ' cargada con exito.' . PHP_EOL . PHP_EOL);
        }
        echo('-> Las '. $cant_categorias . ' categorias fueron cargadas con exito!' . PHP_EOL . PHP_EOL);
    }

}

?>
