<?php

class Usuario {
    public $codigoEmpleado;
    public $nombre;
    public $apellido;
    public $clave;

    public function __construct($codigoEmpleado, $nombre, $apellido, $clave) {
        $this->codigoEmpleado = $codigoEmpleado;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->clave = $clave;
    }

    // Puedes agregar métodos adicionales según sea necesario
}

?>
