<?php

    class Viaje{
        
        private $codigo;
        private $destino;
        private $limitePasajeros;
        private $responsableV;
        private array $listaPasajeros;
        private static $maxCapacidad=10;

////static access////

//setea restriccion general static
        public function setMax($max){
            if(is_numeric($max)&&($max>0)){
                Viaje::$maxCapacidad=$max;
            }
            return true;
        }

//retorna restriccion general static
        public function getMax(){
            $max=Viaje::$maxCapacidad;
            return $max;
        }
        
//constructor
//recibe por parametros el codigo del viaje, destino y limite
//tanto los pasajeros como el responsable seran modificados luego
        public function __construct($codigo,$destino,$limite){
            $this->codigo=$codigo;
            $this->destino=$destino;
            $this->responsableV=null;
            $this->listaPasajeros=[];
            if(is_numeric($limite)&&($limite>0)&&($limite<=Viaje::getMax())){
                $this->limitePasajeros=$limite;
            }else{
                $this->limitePasajeros=Viaje::getMax();
            }
        }

////set////

//setea codigo
//retorna true
        public function setCodigo($codigo){
            $this->codigo=$codigo;
            return true;
        }

//setea destino
//retorna true
        public function setDestino($destino){
            $this->destino=$destino;
            return true;
        }
        
//setea limite
//verifica valor esta dentro del rango aceptable sino setea el maximo
//retorna booleano
        public function setLimitePasajeros($limite){
            if (is_numeric($limite)&&($limite>0)&&($limite<=Viaje::getMax())){
                $this->limitePasajeros=$limite;
            } else {
                $this->limitePasajeros=Viaje::getMax;
            }
            return true;
        }

//setea responsable
//retorna true
        public function setResponsableV($objResponsableV){
            $this->responsableV=$objResponsableV;
            return true;
        }

//setea lista pasajero        
//verifica si es un arreglo
//retorna booleano
        public function setListaPasajeros($arrListaPasajeros){
            /*
             * setea la lista de pasajeros completa
             */
            if (is_array($arrListaPasajeros)){
                $this->listaPasajeros=$arrListaPasajeros;
                $retorno=true;
            } else {
                $retorno=false;
            }
            return $retorno;
        }
        
//get

//retorna string        
        public function getCodigo(){
            $codigo=$this->codigo;
            return $codigo;
        }

//retorna string        
        public function getDestino(){
            $destino=$this->destino;
            return $destino;
        }

//retorna string        
        public function getLimitePasajeros(){
            $limite=$this->limitePasajeros;
            return $limite;
        }
    
//retorna obj Responsable
        public function getResponsableV(){
            $objResponsableV=$this->responsableV;
            return $objResponsableV;
        }

//retorna arreglo
        public function getListaPasajeros(){
            $arrListaPasajeros=$this->listaPasajeros;
            return $arrListaPasajeros;
        }
        
//tostring

//llama a 2 funciones privadas
//retorna string
        public function __toString(){
            $retorno=$this->csvViaje()."\n".$this->csvLista();
            return $retorno;
        }

//others tostring

//valores separados por ;
//retorna string
        private function csvViaje(){
            $retorno=$this->getCodigo().";";
            $retorno=$retorno.$this->getDestino().";";
            $retorno=$retorno.$this->getLimitePasajeros()."\n";
            $retorno=$retorno.$this->getResponsableV();
            return $retorno;
        }

//valores separados por ;
//retorna string
        private function csvLista(){
            $retorno="";
            $arrListaPasajeros=$this->getListaPasajeros();
            if (count($arrListaPasajeros)>0){
                foreach ($arrListaPasajeros as $posicion => $objPasajero){
                    $retorno=$retorno.$posicion.";";
                    $retorno=$retorno.$objPasajero."\n";
                }
            }
            return $retorno;
        }

//funciones mostrar        

//mostrar viaje
//retorna string
        public function mostrarViaje(){
            $codigo=$this->getcodigo();
            $destino=$this->getdestino();
            $limite=$this->getLimitePasajeros();
            $cant=count($this->getListaPasajeros());
            $max=self::getMax();
            $retorno="Datos de Viaje\n";
            $retorno=$retorno."Codigo de Viaje..............: ".$codigo."\n";
            $retorno=$retorno."Destino de Viaje.............: ".$destino."\n";
            $retorno=$retorno."Datos de Capacidad\n";
            $retorno=$retorno."Cantidad de pasajeros........: ".$cant."\n";
            $retorno=$retorno."Limite de Pasajeros..........: ".$limite."\n";
            $retorno=$retorno."Restriccion General de Viajes: ".$max."\n";
            return $retorno;
        }

//mostrar responsable
//retorna string
        public function mostrarResponsableV(){
            $objResponsableV=$this->getResponsableV();
            if (is_object($objResponsableV)){
                $retorno="Datos del Responsable\n";
                $retorno=$retorno.$objResponsableV->mostrarResponsableV()."\n";
            } else {
                $retorno="No hay Responsable cargado!!!\n";;
            }
            return $retorno;
        }
        
//mostrar lista
//retorna string
        public function mostrarLista(){
            $arrListaPasajeros=$this->getListaPasajeros();
            if (count($arrListaPasajeros)>0){
                $retorno="Datos de Lista de Pasajeros\n";;
                foreach ($arrListaPasajeros as $posicion => $objPasajero){
                    $retorno=$retorno."Posicion.....................: ".$posicion."\n";
                    $retorno=$retorno.$objPasajero->mostrarPasajero()."\n";
                }
            } else {
                $retorno="No hay Pasajeros cargados!!!\n";
            }
            return $retorno;
        }

        public function mostrarListaCorta($arrListaCorta){
            if (count($arrListaCorta)>0){
                $retorno="Datos de Lista de Pasajeros\n";;
                foreach ($arrListaCorta as $objPasajero){
                    $retorno=$retorno.$objPasajero->mostrarPasajero()."\n\n";
                }
            } else {
                $retorno="No hay Pasajeros cargados!!!\n";
            }
            return $retorno;
        }
        
//borrado arreglo limite
//retorna arreglo restante
        public function cortaListaPasajeros(){
            $arrListaPasajeros=$this->getListaPasajeros();
            $arrListaCorta=[];
            $cant=count($arrListaPasajeros);
            $limite=$this->getLimitePasajeros();
            $max=Viaje::getMax();
            $ubicacion=1;
            if ($cant>0){
                while (($ubicacion<=$cant)&&($ubicacion<=$limite)&&($ubicacion<=$max)){
                    $arrListaCorta[$ubicacion]=$arrListaPasajeros[$ubicacion];
                    $ubicacion++;
                }
                $this->setListaPasajeros($arrListaCorta);
                $arrListaCorta=[];
                while ($ubicacion<=$cant){
                    $arrListaCorta[]=$arrListaPasajeros[$ubicacion];
                    $ubicacion++;
                }
            }
            if ($cant>$max){
                $this->setLimitePasajeros($max);
            }
            return $arrListaCorta;
        }

//verificar disponibilidad
//retorna booleano
        public function capacidadDisponible(){
            $cant=count($this->getListaPasajeros());
            $limite=$this->getLimitePasajeros();
            if ($cant<$limite){
                return true;
            } else {
                return false;
            }
            
        }
        
//funcion encontrar dni y devolver ubicacion en arreglo
//retorna entero 0 si no lo encuentra
        public function encontrarDni($dni){
            $arrListaPasajeros=$this->getListaPasajeros();
            $cant=count($arrListaPasajeros);
            $retorno=0;
            $buscar=true;
            $ubicacion=1;
            if ($cant>0){
                while (($ubicacion<=$cant)&&($buscar)) {
                    $objPasajero=$arrListaPasajeros[$ubicacion];
                    if ($dni==$objPasajero->getDni()){
                        $buscar=false;
                        $retorno=$ubicacion;
                    }
                    $ubicacion++;
                }
            }
            return $retorno;
        }        

//agregar pasajeros
//verifica que no se repita dni
//retorna string
        public function addPasajero($objPasajero){
            $retorno="";
            $arrListaPasajeros=$this->getListaPasajeros();
            $dni=$objPasajero->getDni();
            $max=self::getMax();
            $cant=count($arrListaPasajeros);
            if ($cant<$max){
                if ($this->capacidadDisponible()){
                    if ($this->encontrarDni($dni)==0){
                        $arrListaPasajeros[$cant+1]=$objPasajero;
                        $this->setListaPasajeros($arrListaPasajeros);
                        $retorno="Pasajero nro ".($cant+1)." Cargado!!!\n";
                    } else {
                        $retorno="Pasajeros duplicado!!!\n";
                    }
                } else {
                    $retorno="No hay disponibilidad en este viaje!!!\n";
                }
            } else {
                $retorno="Restriccion General de Viajes!!!\n";
            }
            return $retorno;
            
        }

//elimina pasajero por ubicacion
//verifica ubicacion detro de limites
//retorna booleano
        public function delPasajero($ubicacion){
            $arrListaPasajeros=$this->getListaPasajeros();
            if ((is_numeric($ubicacion))&&($ubicacion>0)&&($ubicacion<count($arrListaPasajeros))){
                unset($arrListaPasajeros[$ubicacion]);
                $arrListaPasajeros=array_values($arrListaPasajeros);
                array_unshift($arrListaPasajeros,null);
                unset($arrListaPasajeros[0]);
                $this->setListaPasajeros($arrListaPasajeros);
                $retorno=true;
            } else {
                $retorno=false;
            }
            return $retorno;
        }

//entrega un pasajero dada su ubicacion        
//retorna objpasajero o null
        public function getPasajero($ubicacion){
            $arrListaPasajeros=$this->getListaPasajeros();
            if (($ubicacion>0)&&($ubicacion<count($arrListaPasajeros))){
                $objPasajero=$arrListaPasajeros[$ubicacion];
            } else {
                $objPasajero=null;
            }
            return $objPasajero;
        }

//asigna un pasajero a una ubicacion en particular
//retorna booleano
        public function setPasajero($ubicacion,$objPasajero){
            $arrListaPasajeros=$this->getListaPasajeros();
            if ((is_object($objPasajero))&&($ubicacion>0)&&($ubicacion<=count($arrListaPasajeros))){
                $arrListaPasajeros[$ubicacion]=$objPasajero;
                $this->setListaPasajeros($arrListaPasajeros);
                $retorno=true;
            } else {
                $retorno=false;
            }
            return $retorno ;
        }

    }

?>