<?php
    namespace src\Handlers;
    
    class CalendarioHandler{
        public function nomeParaNumero($mes){
            switch ($mes) {
                case ("JANEIRO"):
                    $mesNovo = "01";
                break;
                case ("FEVEREIRO"):
                    $mesNovo = "02";
                break;
                case ("MARÇO"):
                    $mesNovo = "03";
                break;
                case ("ABRIL"):
                    $mesNovo = "04";
                break;
                case ("MAIO"):
                    $mesNovo = "05";
                break;
                case ("JUNHO"):
                    $mesNovo = "06";
                break;
                case ("JULHO"):
                    $mesNovo = "07";
                break;
                case ("AGOSTO"):
                    $mesNovo = "08";
                break;
                case ("SETEMBRO"):
                    $mesNovo = "09";
                break;
                case ("OUTUBRO"):
                    $mesNovo = "10";
                break;
                case ("NOVEMBRO"):
                    $mesNovo = "11";
                break;
                case ("DEZEMBRO"):
                    $mesNovo = "12";
                break;
            }
            return $mesNovo;
        }
        public function numeroParaNome($numeroMes){
            switch ($numeroMes) {
                case (1):
                    $mes = "JANEIRO";   
                break;
                case (2):
                    $mes = "FEVEREIRO";
                    break;
                case (3):
                    $mes = "MARÇO";
                    break;
                case (4):
                    $mes = "ABRIL";
                    break;
                case (5):
                    $mes = "MAIO";
                    break;
                case (6):
                    $mes = "JUNHO";
                    break;
                case (7):
                    $mes = "JULHO";
                    break;
                case (8):
                    $mes = "AGOSTO";
                    break;
                case (9):
                    $mes = "SETEMBRO";
                    break;
                case (10):
                    $mes = "OUTUBRO";
                    break;
                case (11):
                    $mes = "NOVEMBRO";
                    break;
                case (12):
                    $mes = "DEZEMBRO";
                    break;
            }
            return $mes;
        }
    }
