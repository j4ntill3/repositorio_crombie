<?php

require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/models/M_Producto.php');
require_once('/home/spiazziweb.com.ar/public_html/wp-content/autoload-stock/models/M_Imagen.php');

class C_Productos{

    public $productos = array();
    private $imagenes_productos = array();
    private $csv_data;
    private $img_data;
    private $cat_data;
    private $connWOO;
    private $folder_img;
    private $folder_img_http;
    private $nombres_imagenes = array();
    public $productos_WOO = array();

    public function __construct($CONNWOO,$CSV,$CAT,$IMG,$FOLDERIMG){
        $this->csv_data = $CSV;
        $this->connWOO = $CONNWOO;
        $this->cat_data = $CAT;
        $this->img_data = $IMG;
        $this->folder_img = '/home/'.$FOLDERIMG;
	$this->folder_img_http = 'http://'.$FOLDERIMG;
    }


    //CSV-ETL functions

    public function obtenerNombresImagenes(){
        //guardo los nombres completos de las imagenes
        $this->nombres_imagenes = scandir($this->folder_img,1);
    }

	public function obtenerDatosProductosCSV(){
        $this->obtenerImagenesProductosCSV();
		$this->obtenerNombresImagenes();
		$this->obtenerProductosCSV();

	}

	public function borrarProductosRestantes(){
	echo('-> BORRANDO PRODUCTOS RESTANTES' . PHP_EOL . PHP_EOL);
	/*
	var_dump(count($this->productos_WOO));
	var_dump(count($this->productos));
	die();
	*/
        $cant_productos_WOO = count($this->productos_WOO);
        $cant_productos = count($this->productos);
        /*if(($cant_productos_WOO - $cant_productos) <= 0){
            echo('-> No hay productos para eliminar' . PHP_EOL . PHP_EOL);
        } else {*/
            echo('-> Borrando productos restantes' . PHP_EOL . PHP_EOL);
            for($i=0;$i<$cant_productos_WOO;$i++){
                $encontro_producto = false;
                $indice_producto = null;
            for($j=0;$j<$cant_productos;$j++){

                if($this->productos_WOO[$i]->sku == $this->productos[$j]->getSku()){
                    break;
                } else if ($j == $cant_productos-1) {
                    $encontro_producto = true;
                    $indice_producto = $i;
                }
            }

            if($encontro_producto == true){
                echo('-> Borrando producto ' . $this->productos_WOO[$i]->sku . PHP_EOL . PHP_EOL);
                $this->connWOO->delete('products/' . $this->productos_WOO[$i]->id , ['force' => true]);
                echo('-> Producto borrado con exito' . PHP_EOL . PHP_EOL);

            }

        //}

        }

    }

    public function obtenerProductosCSV(){

        for($i=0;$i<count($this->csv_data);$i++){

            $images = array();
            for($j=0;$j<count($this->imagenes_productos);$j++){
                if($this->imagenes_productos[$j][0] == $this->csv_data[$i][3] and $this->verificarSiExisteLaImagen($this->imagenes_productos[$j][1])){
                    $imagen_producto = new M_Imagen($this->imagenes_productos[$j][0],
                    $this->imagenes_productos[$j][1],
                    ['src' => $this->folder_img_http. '/' .$this->imagenes_productos[$j][1]]);
                    array_push($images,$imagen_producto);

                }
            }

            /* DEPRECATED
            // buscar imagenes de producto
            $images = array();
            for($j=0;$j<count($this->imagenes_productos);$j++){
                if($this->imagenes_productos[$j][0] == $this->csv_data[$i][3] and $this->verificarSiExisteLaImagen($this->imagenes_productos[$j][1])){
                    //meter url decode
                    $imagen_producto = ['src' => $this->folder_img_http. '/' .$this->imagenes_productos[$j][1]];
                    array_push($images,$imagen_producto);
                }
            }
            */

            //buscar id categorias
            $categories = array();
            for($j=0;$j<3;$j++){
                for($k=0;$k<count($this->cat_data);$k++){
                    if($this->cat_data[$k]->getNombre() == $this->csv_data[$i][$j]){
                        $id_categoria = ['id' => $this->cat_data[$k]->getIdWoo()];
                        array_push($categories,$id_categoria);
                    }
                }
            }

            $producto = new M_Producto(
                $this->csv_data[$i][3],
                $this->csv_data[$i][4],
                $this->csv_data[$i][5],
                ltrim($this->csv_data[$i][6],"$"),
                intval($this->csv_data[$i][7]),
                $this->csv_data[$i][8],
                $categories,
                $images
            );

            array_push($this->productos,$producto);
        }

    }

    public function obtenerImagenesProductosCSV(){
        // Procesar cada fila de la matriz
        foreach ($this->img_data as $fila) {
            if (!empty($fila)) { // Verificar si la fila no está vaca
                $data = $fila; // Obtener los datos de la fila
                // Guardar los valores de todas las columnas en el array $csv_data
                $stock_data[] = $data; // Agregar la fila al array $csv_data
            }
        }
        $this->imagenes_productos = $stock_data;
    }

    public function verificarSiExisteLaImagen($nombre_imagen){
        for($i=0;$i<count($this->nombres_imagenes);$i++){
            if($this->nombres_imagenes[$i] == $nombre_imagen){
                return true;
            }
        }
        return false;
    }

    //WOO functions

    public function cargarProductosWOO(){
	echo('-> CARGANDO PRODUCTOS ' . PHP_EOL . PHP_EOL);
        $cont = 0;
        $cant_productos = count($this->productos);
        echo('-> Total de productos a cargar = ' . $cant_productos . PHP_EOL . PHP_EOL);
        for($i=0;$i<$cant_productos;$i++){
		$img_load = array();
		for($f=0;$f<count($this->productos[$i]->getImages());$f++){
			array_push($img_load, $this->productos[$i]->getImages()[$f]->getSrc());
		}
            $data_producto = [
                'sku' => $this->productos[$i]->getSku(),
                'name' => $this->productos[$i]->getName(),
                'short_description' => $this->productos[$i]->getShortDescription(),
                'regular_price' => $this->productos[$i]->getRegularPrice(),
                'manage_stock' => true,
                'stock_quantity' => $this->productos[$i]->getStockQuantity(),
                'type' => 'simple',
                'categories' => $this->productos[$i]->getCategories(),
                'images' => $img_load
            ];
            echo('-> Cargando producto '. $this->productos[$i]->getName() . ' ');

                $this->connWOO->post('products', $data_producto);

            $cont++;
            echo('-> Producto cargado con exito'. PHP_EOL . PHP_EOL);
        }
        echo('-> Los '. $cant_productos . ' productos fueron cargados con exito!' . PHP_EOL . PHP_EOL);
    }

    public function actualizarProductosWOO(){
	echo('-> ACTUALIZANDO PRODUCTOS ' . PHP_EOL . PHP_EOL);
        $cant_productos = count($this->productos);
        $cant_productos_WOO = count($this->productos_WOO);
	if($cant_productos_WOO == 0){
		echo('-> No se encontraron productos cargados previamente' . PHP_EOL . PHP_EOL);
		$this->cargarProductosWOO();
	} else {
		echo('-> Total de productos a actualizar = ' . $cant_productos . PHP_EOL . PHP_EOL);

            for($i=0;$i<$cant_productos;$i++){
            $producto_cargado = false;
            $producto_encontrado_por = null; // sku o nombre
            $producto_indice = null;
            $actualizar_datos = array();

                // buscar producto woo por sku
                for($j=0;$j<$cant_productos_WOO;$j++){

                    if($this->productos[$i]->getSku() == $this->productos_WOO[$j]->sku){
                        $producto_cargado = true;
                        $producto_encontrado_por = 'sku';
                        $producto_indice = $j;
                    }
                }
                //si no encontro el nombre con el sku lo busco por nombre
                if($producto_cargado <> true){
                    // buscar producto woo por nombre
                    for($j=0;$j<$cant_productos_WOO;$j++){

                        if($this->productos[$i]->getName() == $this->productos_WOO[$j]->name){
                            $producto_encontrado_por = 'nombre';
                            $producto_cargado = true;
                            $producto_indice = $j;
                        }
                    }
                }

                //verifico si encontro el producto, sino lo cargo
                if($producto_cargado == true){
                    $actualizar_datos = array();

                    // si lo encontro por el sku actualizo todo menos el sku
                    if( $producto_encontrado_por == 'sku'){
                        if($this->productos[$i]->getName() <> $this->productos_WOO[$producto_indice]->name){
                            $actualizar_datos['name'] = $this->productos[$i]->getName();
                        }
                        //limpiar formato de short_description

                        $short_description = str_replace('<p>', '', $this->productos_WOO[$producto_indice]->short_description);
                        $short_description = str_replace('</p>', '', $short_description);
                        $short_description = substr($short_description, 0, -1);

                        if($this->productos[$i]->getShortDescription() <> $short_description){
                            $actualizar_datos['short_description'] = $this->productos[$i]->getShortDescription();
                        }


                        // Eliminar el separador de miles y reemplazar el separador decimal
                        $regular_price = str_replace('.', '', $this->productos_WOO[$producto_indice]->regular_price);
                        $regular_price = str_replace(',', '.', $this->productos_WOO[$producto_indice]->regular_price);

                        // Dar formato al número con separador de miles y decimal
                        $regular_price = number_format($regular_price, 2, ',', '.');

                        if($this->productos[$i]->getRegularPrice() <> $regular_price){
                            $actualizar_datos['regular_price'] = $this->productos[$i]->getRegularPrice();
                        }
                        if($this->productos[$i]->getStockQuantity() <> $this->productos_WOO[$producto_indice]->stock_quantity){
                            $actualizar_datos['stock_quantity'] = $this->productos[$i]->getStockQuantity();
                        }

                        // verifico categorias
                        $cant_categorias_WOO = count($this->productos_WOO[$producto_indice]->categories);
                        $cant_categorias = count($this->productos[$i]->getCategories());

                        // verifico si ya tiene categorias cargadas, si no se las cargo
                        if($cant_categorias_WOO == 1){ //es igual a uno por la categoria "uncategorized"

                            $actualizar_datos['categories'] = $this->productos[$i]->getCategories();


                        } else { //ak agrego cuando tenga que actualizarlas
				$falta_cat = false;
				for($c=0;$c<count($this->productos[$i]->getCategories());$c++){
					for($cwoo=0;$cwoo<count($this->productos_WOO[$producto_indice]->categories);$cwoo++){
						if($this->productos[$i]->getCategories()[$c] == $this->productos_WOO[$producto_indice]->categories[$cwoo]){
							break;
						} else if ($cwoo-1 == count($this->productos_WOO[$producto_indice]->categories)) {
							$falta_cat = true;
						}
					}
				}
				if($falta_cat == true){
					$actualizar_datos['categories'] = $this->productos[$i]->getCategories();
				}
                        }

                        //verifico imagenes

                        $img_update = array();
                        $img_delete = array();
                        $img_prod = $this->productos[$i]->getImages();
                        $img_prod_woo = $this->productos_WOO[$producto_indice]->images;
                        $cant_img_prod = count($this->productos[$i]->getImages());
                        $cant_img_prod_woo = count($this->productos_WOO[$producto_indice]->images);

                        // si esto se cumple significa que el producto cargado en woo no tiene imagenes
                        if($cant_img_prod_woo == 0){
                            // cargo directamente en el array las imagenes disponibles

                            for($j=0;$j<$cant_img_prod;$j++){
                                array_push($img_update,$this->productos[$i]->getImages()[$j]->getSrc());
                            }

                        } else {

                            for($j=0;$j<$cant_img_prod;$j++){

                            // Obtener la imagen cargada en stock

                            $url_img = file_get_contents($this->productos[$i]->getImages()[$j]->getPath());

                            // verificar que imagenes tengo que actualizar
                            for($k=0;$k<$cant_img_prod_woo;$k++){

                                // Obtener la imagen cargada en WOO
                                //modificar para que busque la imagen localmente
                                $url_img_woo = file_get_contents($this->productos_WOO[$producto_indice]->images[$k]->src);

                                $es_la_misma_img = ($url_img === $url_img_woo);

                                if($es_la_misma_img == true){

                                    break;

                                } else if ($k == $cant_img_prod_woo-1){
                                    // no se encontro la imagen, se carga en el array para acutlizarla
                                    for($h=0;$h<$cant_img_prod;$h++){
                                        array_push($img_update,$this->productos[$i]->getImages()[$h]->getSrc());
                                    }
                                }

                            }


                        }

                    }

                    if(!(empty($img_update))){
                        // si al array no esta vacio cargo las nuevas imagenes
                        $actualizar_datos['images'] = $img_update;
                    }

                    // verifico si el producto esta desactualizado

                    if(count($actualizar_datos) > 0){

                        echo('-> El producto ' . $this->productos[$i]->getName() . '(' . ($i+1) . ')'  . ' esta desactualizado' . PHP_EOL . PHP_EOL);
                        echo('-> Datos a actualizar:' . PHP_EOL . PHP_EOL);
                        foreach ($actualizar_datos as $atributo => $valor) {

				// si son las imagenes
				if(is_array($valor) and (count($valor)>0)){

					if($atributo == 'images'){

						for($h=0;$h<count($valor);$h++){

							echo('-> Imagen nueva a cargar -> ' . $valor[$h]['src'] . PHP_EOL . PHP_EOL);
						}
					}

					if($atributo == 'categories'){
						$cat_update = array();
						for($h=0;$h<count($this->cat_data);$h++){

							for($hh=0;$hh<count($valor);$hh++){
								
								if($this->cat_data[$h]->getIdWoo() == $valor[$hh]['id']){
									array_push($cat_update,$this->cat_data[$h]->getNombre());
								}
							}

						}

						for($h=0;$h<count($valor);$h++){
							echo('-> Categoria nueva a cargar -> ' . $cat_update[$h] . PHP_EOL . PHP_EOL);
						}
					}

				} else {
					echo ('-> Atributo ' . $atributo . ' / Valor actual = '. $this->productos_WOO[$producto_indice]->$atributo . ' / Valor nuevo = '. $valor . PHP_EOL . PHP_EOL);
				}
                            
                        }
                        echo('-> Actualizando producto ' . $this->productos[$i]->getName() . ' ');
                        $this->connWOO->put('products/'.$this->productos_WOO[$producto_indice]->id, $actualizar_datos);
                        echo('-> Producto actualizado con exito' . PHP_EOL . PHP_EOL);
                    } else {
                        echo('-> El producto ' . $this->productos[$i]->getName() . ' (' . ($i+1) . ')'  . ' esta actualizado' . PHP_EOL . PHP_EOL);
                        }
                } else {
			        echo('-> El producto ' . $this->productos[$i]->getName() . ' no esta cargado ');
                    // subo el producto si no esta

                    // preparo array de imagenes

                    $array_images = array();

                    if($this->productos[$i]->getImages() <> null){
                        for($j=0;$j<count($this->productos[$j]->getImages());$j++){
                        array_push($array_images,$this->productos[$i]->getImages()[$j]->getSrc());
                        }
                    }

                    $data_producto = [
                        'sku' => $this->productos[$i]->getSku(),
                        'name' => $this->productos[$i]->getName(),
                        'short_description' => $this->productos[$i]->getShortDescription(),
                        'regular_price' => $this->productos[$i]->getRegularPrice(),
                        'manage_stock' => true,
                        'stock_quantity' => $this->productos[$i]->getStockQuantity(),
                        'type' => 'simple',
                        'categories' => $this->productos[$i]->getCategories(),
                        'images' => $array_images
                    ];
                    echo('-> Cargando producto ');

                        $this->connWOO->post('products', $data_producto);

                    echo('-> Producto cargado con exito'. PHP_EOL . PHP_EOL);

                }

                // si lo encontro por el nombre actualizo todo menos el nombre
                if( $producto_encontrado_por == 'nombre'){
                    if($this->productos[$i]->getSku() <> $this->productos_WOO[$producto_indice]->sku){
                        $actualizar_datos['sku'] = $this->productos[$i]->getSku();
                    }
                    //limpiar formato de short_description

                        $short_description = str_replace('<p>', '', $this->productos_WOO[$producto_indice]->short_description);
                        $short_description = str_replace('</p>', '', $short_description);
                        $short_description = substr($short_description, 0, -1);

                        if($this->productos[$i]->getShortDescription() <> $short_description){
                            $actualizar_datos['short_description'] = $this->productos[$i]->getShortDescription();
                        }

                        // Eliminar el separador de miles y reemplazar el separador decimal
                        $regular_price = str_replace('.', '', $this->productos_WOO[$producto_indice]->regular_price);
                        $regular_price = str_replace(',', '.', $this->productos_WOO[$producto_indice]->regular_price);
                        // Dar formato al número con separador de miles y decimal
                        $regular_price = number_format($regular_price, 2, ',', '.');

                        if($this->productos[$i]->getRegularPrice() <> $regular_price){
                            $actualizar_datos['regular_price'] = $this->productos[$i]->getRegularPrice();
                        }
                        if($this->productos[$i]->getStockQuantity() <> $this->productos_WOO[$producto_indice]->stock_quantity){
                            $actualizar_datos['stock_quantity'] = $this->productos[$i]->getStockQuantity();
                        }

                        // verifico categorias

                        $cant_categorias_WOO = count($this->productos_WOO[$producto_indice]->categories);
                        $cant_categorias = count($this->productos[$i]->getCategories());

                        // verifico si ya tiene categorias cargadas, si no se las cargo

                        if($cant_categorias_WOO == 1){

                            $actualizar_datos['categories'] = $this->productos[$i]->getCategories();

                        }/* else { //ak agrego cuando tenga que actualizarlas

                        }*/

                        // verifico si el producto esta desactualizado

                        if(count($actualizar_datos) > 0){
                            echo('-> El producto ' . $this->productos[$i]->getName() . ' esta desactualizado' . PHP_EOL . PHP_EOL);
                            echo('  -Datos a actualizar:' . PHP_EOL . PHP_EOL);
                            foreach ($actualizar_datos as $atributo => $valor) {
                                echo ('     * Atributo ' . $atributo . ' / Valor actual = '. $this->productos_WOO[$producto_indice]->$atributo . ' / Valor nuevo = '. $valor . PHP_EOL . PHP_EOL);
                            }
                            echo('  ->Actualizando producto ' . $this->productos[$i]->getName());
                            $this->connWOO->put('products/'.$this->productos_WOO[$producto_indice]->id, $actualizar_datos);
                            echo(' ->Producto ' . $this->productos[$i]->getName() . ' actualizado con exito' . PHP_EOL . PHP_EOL);
                        } else {
                            echo('->El producto ' . $this->productos[$i]->getName() . ' esta actualizado' . PHP_EOL . PHP_EOL);
                        }

                    }

                } else {
			echo('-> El producto ' . $this->productos[$i]->getName() . ' no esta cargado ');
                    // subo el producto si no esta

                    // preparo array de imagenes

                    $array_images = array();

                    if($this->productos[$i]->getImages() <> null){
                        for($j=0;$j<count($this->productos[$j]->getImages());$j++){
                        array_push($array_images,$this->productos[$i]->getImages()[$j]->getSrc());
                        }
                    }

                    $data_producto = [
                        'sku' => $this->productos[$i]->getSku(),
                        'name' => $this->productos[$i]->getName(),
                        'short_description' => $this->productos[$i]->getShortDescription(),
                        'regular_price' => $this->productos[$i]->getRegularPrice(),
                        'manage_stock' => true,
                        'stock_quantity' => $this->productos[$i]->getStockQuantity(),
                        'type' => 'simple',
                        'categories' => $this->productos[$i]->getCategories(),
                        'images' => $array_images
                    ];
                    echo('-> Cargando producto ');

                        $this->connWOO->post('products', $data_producto);

                    echo('-> Producto cargado con exito'. PHP_EOL . PHP_EOL);

                }

            }
		echo('-> Los ' . $cant_productos . ' productos fueron actualizados con exito!' . PHP_EOL . PHP_EOL);
	    }
	
    }

    //DEPRECATED
    /*
    public function obtenerIdProductosWOO(){
        $page = 1;
        $get_productosWOO = [];
        while(count($get_productosWOO) <> 0 or $page == 1){
            $get_productosWOO = $this->conexionWOO->get('products/?per_page=100&page=' . $page);
            for($i=0;$i<count($get_productosWOO);$i++){
                array_push($this->productos_Id_WOO,$get_productosWOO[$i]->id);
            }
            $page++;
        }
    }

    public function eliminarProductos(){
        $cant_productos = count($this->productos_Id_WOO);
        echo('Total de productos a eliminar = ' . $cant_productos . PHP_EOL . PHP_EOL);
        if($cant_productos <> 0){
            for($i=0;$i<$cant_productos;$i++){
                echo('Eliminando producto "' . $this->productos_Id_WOO[$i] . '"' . PHP_EOL . PHP_EOL);

                    $this->conexionWOO->delete('products/' . $this->productos_Id_WOO[$i], ['force' => true]);

                echo('Producto "' . $this->productos_Id_WOO[$i] . '" eliminado con exito' . PHP_EOL . PHP_EOL);
            }
        }
        echo('Los ' . $cant_productos . ' productos fueron eliminados con exito!' . PHP_EOL . PHP_EOL);
    }
    */


    public function obtenerProductosWOO(){
        $page = 1;
        $get_productosWOO = [];
        while(count($get_productosWOO) <> 0 or $page == 1){
            $get_productosWOO = $this->connWOO->get('products/?per_page=100&page=' . $page);
            for($i=0;$i<count($get_productosWOO);$i++){
                array_push($this->productos_WOO,$get_productosWOO[$i]);
            }
            $page++;
        }
    }

}
?>
