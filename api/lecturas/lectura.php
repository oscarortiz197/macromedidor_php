<?php

class Lectura {
    public $ID;
    public $fecha;
    public $codigoEmpleado;
    public $lectura;
    public $img;

    public function __construct($ID, $fecha, $codigoEmpleado, $lectura, $img) {
        $this->ID = $ID;
        $this->fecha = $fecha;
        $this->codigoEmpleado = $codigoEmpleado;
        $this->lectura = $lectura;
        $this->img = $img;
    }

    // Puedes agregar métodos adicionales según sea necesario
}

?>
