<?php
class Torneo {
    private $partidos;
    private $importePremio;

    public function __construct($importePremio) {
        $this->partidos = [];
        $this->importePremio = $importePremio;
    }

    public function agregarPartido($partido) {
        $this->partidos[] = $partido;
    }

    public function getPartidos() {
        return $this->partidos;
    }

    public function setImportePremio($importePremio) {
        $this->importePremio = $importePremio;
    }

    public function getImportePremio() {
        return $this->importePremio;
    }

    
    public function ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) {
        if ($OBJEquipo1->getObjCategoria()->getIdCategoria() !== $OBJEquipo2->getObjCategoria()->getIdCategoria() ||
            $OBJEquipo1->getCantJugadores() !== $OBJEquipo2->getCantJugadores()) {
            echo "Los equipos no cumplen con los requisitos para jugar un partido en el torneo.";
            return null;
        }

        $partido = null;
        if ($tipoPartido === 'fotbool') {
            $partido = new PartidoFotbool(uniqid(), $fecha, $OBJEquipo1, 0, $OBJEquipo2, 0);
        } elseif ($tipoPartido === 'basket') {
            $partido = new PartidoBasket(uniqid(), $fecha, $OBJEquipo1, 80, $OBJEquipo2, 120, 7);
        } else {
            echo "Tipo de partido no válido. Debe ser 'futbol' o 'basquetbol'.";
            return null;
        }

        $this->partidos[] = $partido;

        return $partido;
    }


    public function darGanadores($deporte) {
        $ganadores = [];

        foreach ($this->partidos as $partido) {
            if ($partido instanceof PartidoFotbool && $deporte === 'fotbool') {
                $ganador = $this->determinarGanadorFutbol($partido);
                if ($ganador) {
                    $ganadores[] = $ganador;
                }
            } elseif ($partido instanceof PartidoBasket && $deporte === 'basket') {
                $ganador = $this->determinarGanadorBasquet($partido);
                if ($ganador) {

                    $ganadores[] = $ganador;
                }
            }
        }

        return $ganadores;
    }


    private function determinarGanadorFutbol($partido) {
        print_r("dasdasddsadsadasdadsfdsadfsdfasfdsa");
        print_r($partido->getCantGolesE1());
        if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
            echo "entro al if de equipo 1";
            return $partido->getObjEquipo1();
        } elseif ($partido->getCantGolesE2() > $partido->getCantGolesE1()) {
            return $partido->getObjEquipo2();
        } else {
            return null; // Empate, no hay ganador
        }
    }

    private function determinarGanadorBasquet($partido) {
        if ($partido->getCantGolesE1() > $partido->getCantGolesE2()) {
            echo "entro al if de equipo 2";
            return $partido->getObjEquipo1();
        } elseif ($partido->getCantGolesE2() > $partido->getCantGolesE1()) {
            return $partido->getObjEquipo2();
        } else {
            return null; // Empate, no hay ganador
        }
    }

    public function __toString() {
        $cadena = "Ganadores del torneo:\n";
        foreach ($this->partidos as $partido) {
            print_r($partido->darEquipoGanador());
            
        }
        $cadena .= "Cantidad de equipos en el torneo: " . count($this->partidos) . "\n";
        $cadena .= "Importe Premio: $" . $this->getImportePremio() . "\n";
        return $cadena;

    }
    

}


