<?php

/*
 *  Importante: Deben enviar el link a la resolución en su repositorio en GitHub del ejercicio.
 *
 *  La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus
 *  viajes. De cada viaje se precisa almacenar el código del mismo, destino, cantidad máxima de
 *  pasajeros y los pasajeros del viaje.
 *
 *  Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los
 *  atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la
 *  información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves
 *  “nombre”, “apellido” y “numero de documento”.
 *
 *  Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que
 *  permita cargar la información del viaje, modificar y ver sus datos.
 *
 */

/*
 * Modificar la clase Viaje para que ahora los pasajeros sean un objeto que tenga los atributos
 * nombre, apellido, numero de documento y teléfono. El viaje ahora contiene una referencia a
 * una colección de objetos de la clase Pasajero. También se desea guardar la información de la
 * persona responsable de realizar el viaje, para ello cree una clase ResponsableV que registre
 * el número de empleado, número de licencia, nombre y apellido. La clase Viaje debe hacer
 * referencia al responsable de realizar el viaje.
 *
 * Volver a implementar las operaciones que permiten modificar el nombre, apellido y teléfono
 * de un pasajero. Luego implementar la operación que agrega los pasajeros al viaje,
 * solicitando por consola la información de los mismos. Se debe verificar que el pasajero no
 * este cargado mas de una vez en el viaje. De la misma forma cargue la información del
 * responsable del viaje.
 *
 * Nota: Recuerden que deben enviar el link a la resolución en su repositorio en GitHub.
 */

include 'Viaje.php';
include 'Pasajero.php';
include 'ResponsableV.php';

//funcion para generar un borde de 60 caracteres
//se usara para hacer carteles
function borde(){
    echo "+".str_repeat("-",58)."+\n";
}

//funcion para rodear texto en 60 caracteres
//se usara para hacer carteles
//tiene una entrada de texto que se corta en distinas lineas si es muy largo
function centro($texto){
    while (strlen($texto)>=52){
        echo "|  ".substr($texto, 0, 54)."  |\n";
        $texto=substr($texto,54,strlen($texto)-54);
    };
    echo "|  ".$texto. str_repeat(" ",54-strlen($texto))."  |\n";
}

//funcion para generar hacer carteles en mayusculas
//tiene una entrada de texto que se corta mediante la funcion centro
function cartel($texto){
    borde();
    centro(strtoupper($texto));
    borde();
};

//funcion de precarga de datos
function precarga(){
    $objViaje=new Viaje("A0001", "NEUQUEN", 4);
    $objResponsableV=new ResponsableV("Marcelo", "Bouzo", "83623", "28792770");
    $objViaje->setResponsableV($objResponsableV);
    $objPasajero=new Pasajero("Analia", "Peleato", "28661344", "2995934140");
    $objViaje->addPasajero($objPasajero);
    $objPasajero=new Pasajero("Ana Luz", "Bouzo", "48487792", "2996722931");
    $objViaje->addPasajero($objPasajero);
    $objPasajero=new Pasajero("Gonzalo", "Bouzo", "49859313", "2995345897");
    $objViaje->addPasajero($objPasajero);
    $objPasajero=new Pasajero("Matias", "Bouzo", "52537611", "Sin Tel");
    $objViaje->addPasajero($objPasajero);
    return $objViaje;
}

//funciones solicitan datos y retornan objetos
//carga viaje
//retorna objViaje
function cargaViaje(){
    echo "Ingrese Codigo: ";
    $codigo=trim(fgets(STDIN));
    echo "Ingrese Destino: ";
    $destino=trim(fgets(STDIN));
    echo "Ingrese Limite Capacidad: ";
    $limite=trim(fgets(STDIN));
    $objViaje=new Viaje($codigo, $destino, $limite);
    return $objViaje;
}

//carga responsable
//retorna objResponsableV
function cargaResponsableV(){
    echo "Ingrese Nombre: ";
    $nombre=trim(fgets(STDIN));
    echo "Ingrese Apellido: ";
    $apellido=trim(fgets(STDIN));
    echo "Ingrese Legajo: ";
    $legajo=trim(fgets(STDIN));
    echo "Ingrese Licencia: ";
    $licencia=trim(fgets(STDIN));
    $objResponsableV=new ResponsableV($nombre, $apellido, $legajo, $licencia);
    return $objResponsableV;
}

//carga pasajero
//retorna objPasajero
function cargaPasajero(){
    echo "Ingrese Nombre: ";
    $nombre=trim(fgets(STDIN));
    echo "Ingrese Apellido: ";
    $apellido=trim(fgets(STDIN));
    echo "Ingrese DNI: ";
    $dni=trim(fgets(STDIN));
    echo "Ingrese Telefono: ";
    $telefono=trim(fgets(STDIN));
    $objPasajero=new Pasajero($nombre, $apellido, $dni, $telefono);
    return $objPasajero;
}

//funcion principal
function main(){
    cartel("VIAJE FELIZ - IPOO 2022 - Bouzo - Leg 83623");
//    $objViaje="";
    $objViaje=precarga();
    do {
        echo "Presione Entrer para continuar!!!\n";
        trim(fgets(STDIN));
        cartel("INGRESE QUE DESEA HACER");
        borde();
        centro("01 - Cargar Viaje");
        centro("02 - Cargar Responsable");
        centro("03 - Cargar Pasajero");
        borde();
        centro("04 - Mostrar Viaje");
        centro("05 - Mostrar Responsable");
        centro("06 - Mostrar Lista Pasajeros");
        borde();
        centro("07 - Modificar Viaje");
        centro("08 - Modificar Responsable");
        centro("09 - Modificar Pasajero");
        centro("10 - Modificar Pasajero por DNI");
        borde();
        centro("11 - Eliminar Viaje");
        centro("12 - Eliminar Responsable");
        centro("13 - Eliminar Pasajero");
        centro("14 - Eliminar Pasajero por DNI");
        borde();
        centro("15 - Modificar Restriccion");
        centro("16 - Genera Archivo CSV");
        centro("17 - Visualizar Viaje");
        centro("18 - Precarga Viaje");
        borde();
        centro("00 - Salir");
        borde();
        echo "Opcion: ";
        $texto=trim(fgets(STDIN));
        switch ($texto){
            case "01":                
                if (is_object($objViaje)){
                    echo "ERROR - Ya existe Viaje!!!\n";
                } else {
                    cartel("CARGAR VIAJE");
                    $objViaje=cargaViaje();
                    echo "Datos cargados!!!\n";
                }
                break;
            case "02":
                if (is_object($objViaje)){
                    $objResponsableVBKP=$objViaje->getResponsableV();
                    if (!(is_object($objResponsableVBKP))){
                        cartel("CARGAR RESPONSABLE");
                        $objResponsableV=cargaResponsableV();
                        $objViaje->setResponsableV($objResponsableV);
                        echo "Datos cargados!!!\n";
                    } else {
                        echo "ERROR - Ya existe Responsable!!!\n";
                    }
                } else {
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "03":
                if (is_object($objViaje)){
                    if ($objViaje->capacidadDisponible()){
                        cartel("CARGAR PASAJERO");
                        $objPasajero=cargaPasajero();
                        echo $objViaje->addPasajero($objPasajero);
                    } else {
                        echo "ERROR - No hay disponibilidad!!!\n";
                    }
                } else {
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "04":
                if (is_object($objViaje)){
                    cartel("MOSTRAR VIAJE");
                    echo $objViaje->mostrarViaje()."\n";
                } else {
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "05":
                if (is_object($objViaje)){
                    cartel("MOSTRAR RESPONSABLE");
                    echo $objViaje->mostrarResponsableV()."\n";
                } else {
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "06":
                if (is_object($objViaje)){
                    cartel("MOSTRAR PASAJEROS");
                    echo $objViaje->mostrarLista()."\n";
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "07":
                if (is_object($objViaje)){
                    cartel("MODIFICAR VIAJE");
                    $objViajeBKP=$objViaje;
                    $objResponsableV=$objViaje->getResponsableV();
                    $arrListaPasajeros=$objViaje->getListaPasajeros();
                    echo $objViaje->mostrarViaje();
                    cartel("CARGAR DATOS");
                    $objViaje=cargaViaje();
                    if (is_object($objViaje)){
                        $objViaje->setResponsableV($objResponsableV);
                        $objViaje->setListaPasajeros($arrListaPasajeros);
                        echo "Datos Modificados!!!\n";
                        $arrListaCorta=$objViaje->cortaListaPasajeros();
                        if(count($arrListaCorta)>0){
                            cartel("Pasajeros Eliminados");
                            echo Viaje::mostrarListaCorta($arrListaCorta);
                        }
                    }else{
                        $objViaje=$objViajeBKP;
                        echo "ERROR - No se pudo cargar dato!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "08":
                if (is_object($objViaje)){
                    $objResponsableVBKP=$objViaje->getResponsableV();
                    if (is_object($objResponsableVBKP)){
                        cartel("MODIFICAR RESPONSABLE");
                        echo $objViaje->mostrarResponsableV();
                        $objResponsableVBKP=$objViaje->getResponsableV();
                        cartel("CARGAR DATOS");
                        $objResponsableV=cargaResponsableV();
                        if (is_object($objResponsableV)){
                            $objViaje=$objViajeBKP;
                            $objViaje->setResponsableV($objResponsableV);
                            $objViaje->setListaPasajeros($arrListaPasajeros);
                            echo "Datos Modificados!!!\n";
                        }else{
                            $objViaje->setResponsableV($objResponsableVBKP);
                            echo "ERROR - No se pudo cargar dato!!!\n";
                        }
                    }else{
                        echo "ERROR - No existe Responsable!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "09":
                if (is_object($objViaje)){
                    cartel("MODIFICAR PASAJERO");
                    echo $objViaje->mostrarLista();
                    echo "Ingrese Nro de Pasajero: ";
                    $ubicacion=trim(fgets(STDIN));
                    $arrListaPasajeros=$objViaje->getListaPasajeros();
                    $cant=count($arrListaPasajeros);
                    if ((0<$ubicacion)&&($ubicacion<=$cant)){
                        $objPasajeroBKP=$objViaje->getPasajero($ubicacion);
                        $objPasajero=cargaPasajero();
                        if ($objViaje->setPasajero($ubicacion,$objPasajero)){
                            echo "Pasajero cargado en ubicacion ".$ubicacion."!!!\n";
                        }else{
                            $objViaje->setPasajero($ubicacion,$objPasajeroBKP);
                            echo "ERROR - No se pudo cargar dato!!!\n";
                        }
                    }else{
                        echo "ERROR - No existe Pasajero!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "10":
                if (is_object($objViaje)){
                    cartel("MODIFICAR PASAJERO POR DNI");
                    echo $objViaje->mostrarLista();
                    echo "Ingrese Nro de DNI: ";
                    $dni=trim(fgets(STDIN));
                    $ubicacion=$objPasajero->encontrarDni($dni);
                    $arrListaPasajeros=$objViaje->getListaPasajeros();
                    $cant=count($arrListaPasajeros);
                    if ((0<$ubicacion)&&($ubicacion<=$cant)){
                        $objPasajeroBKP=$objViaje->getPasajero($ubicacion);
                        $objPasajero=cargaPasajero();
                        if ($objViaje->setPasajero($ubicacion,$objPasajero)){
                            echo "Pasajero cargado en ubicacion ".$ubicacion."!!!\n";
                        }else{
                            $objViaje->setPasajero($ubicacion,$objPasajeroBKP);
                            echo "ERROR - No se pudo cargar dato!!!\n";
                        }
                    }else{
                        echo "ERROR - No existe Pasajero!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "11":
                cartel("ELIMINANDO VIAJE");
                unset($objViaje);
                $objViaje="";
                echo "Viaje Eliminado!!!\n";
                break;
            case "12":
                if (is_object($objViaje)){
                    cartel("ELIMINANDO RESPONSABLE");
                    $objViaje->setResponsableV(null);
                    echo "Responsable Eliminado!!!\n";
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "13":
                if (is_object($objViaje)){
                    $arrListaPasajeros=$objViaje->getListaPasajeros();
                    $cant=count($arrListaPasajeros);
                    if ($cant>0){
                        cartel("ELIMINAR PASAJERO");
                        echo $objViaje->mostrarLista();
                        echo "Ingrese Nro de Pasajero: ";
                        $ubicacion=trim(fgets(STDIN));
                        if ((0<$ubicacion)&&($ubicacion<=$cant)){
                            $objViaje->delPasajero($ubicacion);
                            echo "Pasajero eliminado!!!\n";
                        } else {
                            echo "ERROR - No existe Pasajero!!!\n";
                        }
                    }else{
                        echo "ERROR - No existe Lista!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "14":
                if (is_object($objViaje)){
                    $arrListaPasajeros=$objViaje->getListaPasajeros();
                    $cant=count($arrListaPasajeros);
                    if ($cant>0){
                        cartel("ELIMINAR PASAJERO POR DNI");
                        echo $objViaje->mostrarLista();
                        echo "Ingrese Nro DNI: ";
                        $dni=trim(fgets(STDIN));
                        $ubicacion=$objViaje->encontrarDni($dni);
                        if ((0<$ubicacion)&&($ubicacion<=$cant)){
                            $objViaje->delPasajero($ubicacion);
                            echo "Pasajero eliminado!!!\n";
                        } else {
                            echo "ERROR - No existe Pasajero!!!\n";
                        }
                    }else{
                        echo "ERROR - No existe Lista!!!\n";
                    }
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "15":
                cartel("MODIFICAR RESTRICCION GENERAL VIAJES");
                $max=$objViaje->getMax();
                echo "Restriccion General Viajes...: ".$max."\n";
                echo "Ingrese Nueva Restriccion General: ";
                $max=trim(fgets(STDIN));
                $objViaje->setMax($max);
                $arrListaCorta=$objViaje->cortaListaPasajeros();
                if(count($arrListaCorta)>0){
                    cartel("Pasajeros Eliminados");
                    echo $objViaje->mostrarListaCorta($arrListaCorta);
                }
                break;
            case "16":
                cartel("GENERANDO CSV");
                echo $objViaje;
                break;
            case "17":
                cartel("MOSTRAR VIAJE COMPLETA");
                if (is_object($objViaje)){
                    cartel("MOSTRAR VIAJE");
                    echo $objViaje->mostrarViaje()."\n";
                    cartel("MOSTRAR RESPONSABLE");
                    echo $objViaje->mostrarResponsableV()."\n";
                    cartel("MOSTRAR PASAJEROS");
                    echo $objViaje->mostrarLista()."\n";
                }else{
                    echo "ERROR - No existe Viaje!!!\n";
                }
                break;
            case "18":
                cartel("PRECARGA DE VIAJE");
                $objViaje=precarga();
                break;
            case "00":
                echo "Saliendo...\n";
                break;
            default:
                echo "Error - Valor incorrecto - Ingrese nuevamente\n";
                break;
        };
    } while ($texto != "00");    //sale con la opcion 0
};

main();

?>