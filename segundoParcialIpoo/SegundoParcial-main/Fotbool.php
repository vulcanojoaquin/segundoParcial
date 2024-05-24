<?php

class PartidoFotbool extends Partido {

    public function __construct($idPartido, $fecha, $equipo1, $cantGolesE1, $equipo2, $cantGolesE2) {
        parent::__construct($idPartido, $fecha, $equipo1, $cantGolesE1, $equipo2, $cantGolesE2);
    }

    public function __toString() {
        $cadena = parent::__toString();
        return $cadena;
    }
}

