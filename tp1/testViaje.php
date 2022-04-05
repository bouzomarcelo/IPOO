<?php

include 'Viaje.php';

function borde(){
    /*
     *funcion para generar un borde de 60 caracteres
     *se usara para hacer carteles 
     */
    echo "+".str_repeat("-",58)."+\n";
}
function centro($texto){
    /*
     *funcion para rodear texto en 60 caracteres
     *se usara para hacer carteles
     *tiene una entrada de texto que se corta en distinas lineas si es muy largo
     */
    while (strlen($texto)>=52){
        echo "|   ".substr($texto, 0, 52)."   |\n";
        $texto=substr($texto,52,strlen($texto)-52);
    };
    echo "|   ".$texto. str_repeat(" ",52-strlen($texto))."   |\n";
}
function cartel($texto){
    /*
     *funcion para generar hacer carteles en mayusculas
     *tiene una entrada de texto que se corta mediante la funcion centro
     */
    borde();
    centro(strtoupper($texto));
    borde();
};

function main(){
    /*
     *funcion principal
     */
    cartel("VIAJE FELIZ - IPOO 2022 - Bouzo - Leg 83623");
    $objViaje="";
    do {
        cartel("INGRESE QUE DESEA HACER");
        centro("1 - Cargar Viaje             2 - Cargar Pasajero");
        centro("3 - Mostrar Viaje            4 - Mostrar Lista");
        centro("5 - Modificar Viaje          6 - Modificar Lista");
        centro("7 - Otros                    0 - Salir");
        borde();
        echo "Opcion: ";
        $texto=trim(fgets(STDIN));
        switch ($texto){
            case "1":
                /*
                 * verifica si el objeto ya fue creado
                 * caso contrario, lo crea
                 */
                if (is_object($objViaje)){
                    echo "Ya hay viaje cargado!!!\n";
                } else {
                    cartel("CARGAR VIAJE");
                    echo "Ingrese Codigo: ";
                    $codigo=trim(fgets(STDIN));
                    echo "Ingrese Destino: ";
                    $destino=trim(fgets(STDIN));
                    $objViaje=new Viaje($codigo,$destino);
                }
                break;
            case "2":
                /*
                 * verifica si esta creado el objeto
                 * en caso de estarlo verifica que no se carguen mas del limite
                 * solicita los datos del pasajero y se agrega a la lista de pasajeros
                 */
                if (is_object($objViaje)){
                    $cant=$objViaje->getCantPasajeros();
                    $max=$objViaje->getMax();
                    if ($cant<$max){
                        cartel("CARGAR PERSONA");
                        echo "Ingrese Nombre: ";
                        $nombre=trim(fgets(STDIN));
                        echo "Ingrese Apellido: ";
                        $apellido=trim(fgets(STDIN));
                        echo "Ingrese DNI: ";
                        $dni=trim(fgets(STDIN));
                        $persona = ["nombre"=>$nombre,"apellido"=>$apellido,"dni"=>$dni];
                        $objViaje->addPasajero($persona);
                        $cant=$objViaje->getCantPasajeros();
                        cartel("El pasajero Nro ".$cant." ha sido ingresado");
                        $objViaje->mostrarPasajero($cant);
                    } else {
                        echo "No hay disponibilidad en este viaje!!!\n";
                    }
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "3":
                /*
                 * verifica que el objeto este creado
                 * en caso de estarlo, muestra por pantalla los datos
                 */
                if (is_object($objViaje)){
                    cartel("MOSTRAR VIAJE");
                    $objViaje->mostrarViaje();
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "4":
                /*
                 * verifica que el objeto este creado.
                 * en caso de estarlo, verifica que hayan pasajeros cargados
                 * en caso de haberlos, los muestra por panalla
                 */
                if (is_object($objViaje)){
                    $cant = $objViaje->getCantPasajeros();
                    if ($cant > 0){
                        cartel("MOSTRAR LISTA");
                        $objViaje->mostrarLista();
                    } else {
                        echo "No hay lista cargada!!!\n";
                    }
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "5":
                /*
                 * submenu para modificar datos de viaje
                 * verifica que sea un objeto
                 */
                if (is_object($objViaje)){
                    cartel("MODIFICAR VIAJE");
                    do {
                        cartel("INGRESE QUE DESEA HACER");
                        centro("1 - Modificar Codigo         2 - Modificar Destino");
                        centro("9 - Volver");
                        borde();
                        echo "Opcion: ";
                        $texto=trim(fgets(STDIN));
                        switch ($texto){
                            case "1":
                                /*
                                 * modifica el codigo del viaje
                                 */
                                cartel("MODIFICAR CODIGO");
                                echo "Ingrese Codigo (".$objViaje->getCodigoViaje()."): ";
                                $codigo=trim(fgets(STDIN));
                                $objViaje->setCodigoViaje($codigo);
                                $objViaje->mostrarViaje();
                                break;
                            case "2":
                                /*
                                 * modifica el destino del viaje
                                 */
                                cartel("MODIFICAR DESTINO");
                                echo "Ingrese Destino (".$objViaje->getDestinoViaje()."): ";
                                $destino=trim(fgets(STDIN));
                                $objViaje->setDestinoViaje($destino);
                                $objViaje->mostrarViaje();
                                break;
                            case "9":
                                echo "Volver\n";
                                break;
                            default:
                                echo "Error - Valor incorrecto - Ingrese nuevamente\n";
                                break;
                        };
                    } while ($texto != "9");    //retorna con la opcion 9
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "6":
                /*
                 * submenu para modificar pasajeros
                 * verifica que sea un objeto, asi como tambien que la cantidad de pasajeros sea mayor a 0
                 */
                if (is_object($objViaje)){
                    $cant=$objViaje->getCantPasajeros();
                    if ($cant>0){
                        cartel("MODIFICAR LISTA");
                        do {
                            cartel("INGRESE QUE DESEA HACER");
                            centro("1 - Modificar Pasajero       2 - Eliminar Pasajero");
                            centro("9 - Volver");
                            borde();
                            echo "Opcion: ";
                            $texto=trim(fgets(STDIN));
                            switch ($texto){
                                case "1":
                                    /*
                                     * modifica un pasajero dado su ubicacion
                                     */
                                    cartel("MODIFICAR PASAJERO");
                                    $objViaje->mostrarLista();
                                    echo "Ingrese Nro de Pasajero: ";
                                    $ubicacion=trim(fgets(STDIN));
                                    if ((0<$ubicacion) and ($ubicacion<=$cant)){
                                        /*
                                         * verifica que la ubicacion sea valida
                                         * mayor que 0 y menor o igual que la capacidad maxima
                                         * solicita los datos para modificar, mostrando los datos originales
                                         */
                                        $pasajero=$objViaje->getPasajero($ubicacion);
                                        echo "Ingrese Nuevo Nombre (".$pasajero["nombre"]."): ";
                                        $nombre=trim(fgets(STDIN));
                                        echo "Ingrese Apellido (".$pasajero["apellido"]."): ";
                                        $apellido=trim(fgets(STDIN));
                                        echo "Ingrese DNI (".$pasajero["dni"]."): ";
                                        $dni=trim(fgets(STDIN));
                                        $persona = ["nombre"=>$nombre,"apellido"=>$apellido,"dni"=>$dni];
                                        $objViaje->setPasajero($ubicacion, $persona);
                                        cartel ("Pasajero modificado!!!");
                                        $objViaje->mostrarPasajero($ubicacion);
                                    } else {
                                        echo "No existe Pasajero\n";
                                    }
                                    break;
                                case "2":
                                    /*
                                     * elimina un pasajero dado su ubicacion
                                     */
                                    cartel("ELIMINAR PASAJERO");
                                    $objViaje->mostrarLista();
                                    echo "Ingrese Nro de Pasajero: ";
                                    $ubicacion=trim(fgets(STDIN));
                                    if ((0<$ubicacion) and ($ubicacion<=$cant)){
                                        /*
                                         * verifica que la ubicacion sea valida
                                         * mayor que 0 y menor o igual que la capacidad maxima
                                         */
                                        $objViaje->mostrarPasajero($ubicacion);
                                        $objViaje->delPasajero($ubicacion);
                                        cartel ("Pasajero eliminado!!!");
                                        $objViaje->mostrarLista();
                                    } else {
                                        echo "No existe Pasajero\n";
                                    }
                                    break;
                                case "9":
                                    echo "Volver\n";
                                    break;
                                default:
                                    echo "Error - Valor incorrecto - Ingrese nuevamente\n";
                                    break;
                            }
                        } while ($texto != "9");    //retorna con la opcion 9
                    } else {
                        echo "No hay lista cargada!!!\n";
                    }
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "7":
                /*
                 * submenu adicional 
                 * verifica que sea un objeto
                 */
                if (is_object($objViaje)){
                    cartel("OTROS");
                    do {
                        cartel("INGRESE QUE DESEA HACER");
                        centro("1 - Modificar Capacidad      2 - Eliminar Viaje");
                        centro("3 - Genera Archivo CSV       9 - Volver");
                        borde();
                        echo "Opcion: ";
                        $texto=trim(fgets(STDIN));
                        switch ($texto){
                            case "1":
                                /*
                                 * modifica la capacidad de todos los objetos Viaje
                                 */
                                cartel("MODIFICAR CAPACIDAD");
                                $cantMaxPasajeros=$objViaje->getMax();
                                echo "Ingrese Capacidad Maxima (".$cantMaxPasajeros."): ";
                                $max=trim(fgets(STDIN));
                                $objViaje->setMax($max);
                                break;
                            case "2":
                                /*
                                 * eliminamos el objeto
                                 */
                                cartel("ELIMINANDO VIAJE");
                                unset($objViaje);
                                $objViaje="";
                                echo "Viaje Eliminado!!!\n";
                                break;
                            case "3":
                                /*
                                 * utilizamos __toString para generar un archivo csv
                                 */
                                cartel("GENERANDO CSV");
                                echo $objViaje;
                                break;
                            case "9":
                                echo "Volver\n";
                                break;
                            default:
                                echo "Error - Valor incorrecto - Ingrese nuevamente\n";
                                break;
                        };
                    } while ($texto != "9");    //retorna con la opcion 9
                } else {
                    echo "No hay viaje cargado!!!\n";
                }
                break;
            case "0":
                echo "Saliendo...\n";
                break;
            default:
                echo "Error - Valor incorrecto - Ingrese nuevamente\n";
                break;
        };
    } while ($texto != "0");    //sale con la opcion 0
};

main();

?>
