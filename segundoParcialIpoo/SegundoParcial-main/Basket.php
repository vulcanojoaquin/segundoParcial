<?php
include_once("Partido.php");
class PartidoBasket extends Partido {
    private $infracciones;

    public function __construct($idPartido, $fecha, $equipo1, $golesE1, $equipo2, $golesE2, $infracciones) {
        parent::__construct($idPartido, $fecha, $equipo1, $golesE1, $equipo2, $golesE2);
        $this->infracciones = $infracciones;
    }

    public function __toString() {
        $cadena = parent::__toString();
        $cadena .= "Infracciones: " . $this->infracciones . "\n";
        return $cadena;
    }
}
