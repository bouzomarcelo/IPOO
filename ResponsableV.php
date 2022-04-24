<?php

class ResponsableV{
    
    //instancias
    private $nombre;
    private $apellido;
    private $legajo;
    private $licencia;
    
    //metodos de acceso
    
    //constructor
    public function __construct($nombre,$apellido,$legajo,$licencia){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->legajo=$legajo;
        $this->licencia=$licencia;
    }
    
    //set
    public function setNombre($nombre){
        $this->nombre=$nombre;
    }
    public function setApellido($apellido){
        $this->apellido=$apellido;
    }
    public function setLegajo($legajo){
        $this->legajo=$legajo;
    }
    public function setLicencia($licencia){
        $this->licencia=$licencia;
    }
    
    //get
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getLegajo(){
        return $this->legajo;
    }
    public function getLicencia(){
        return $this->licencia;
    }
    
    //tostring
    public function __toString(){
        return $this->getNombre().";".$this->getApellido().";".$this->getLegajo().";".$this->getLicencia();
    }
    public function mostrarResponsableV(){
        $apellido=$this->getApellido();
        $nombre=$this->getNombre();
        $dni=$this->getLegajo();
        $telefono=$this->getLicencia();
        $retorno="";
        $retorno=$retorno."Apellido.....................: ".$apellido."\n";
        $retorno=$retorno."Nombre.......................: ".$nombre."\n";
        $retorno=$retorno."Legajo.......................: ".$dni."\n";
        $retorno=$retorno."Licencia.....................: ".$telefono;
        return $retorno;
    }
}
?>