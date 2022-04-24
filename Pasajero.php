<?php

class Pasajero{
    
//instancias
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    
//metodos de acceso
    
//constructor
    public function __construct($nombre,$apellido,$dni,$telefono){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->dni=$dni;
        $this->telefono=$telefono;
    }
    
//set
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setDni($dni){
        $this->dni=$dni;
    }
    public function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    
//get
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getTelefono(){
        return $this->telefono;
    }
    
//tostring
    public function __toString(){
        return $this->getNombre().";".$this->getApellido().";".$this->getDni().";".$this->getTelefono();
    }
    
//metodos
//muestra un pasajero
    public function mostrarPasajero(){
        $apellido=$this->getApellido();
        $nombre=$this->getNombre();
        $dni=$this->getDni();
        $telefono=$this->getTelefono();
        $retorno="";
        $retorno=$retorno."Apellido.....................: ".$apellido."\n";
        $retorno=$retorno."Nombre.......................: ".$nombre."\n";
        $retorno=$retorno."DNI..........................: ".$dni."\n";
        $retorno=$retorno."Telefono.....................: ".$telefono;
        return $retorno;
    }
    
}
?>