

<?php

class cuentaBancaria{
    private $saldo;
    private $movimientos;
    private static $numeroCuentas=0;


    public function __construct(int $saldo=0){
        $this->saldo=$saldo;
        $this->movimientos=0;
        self::$numeroCuentas++;
    }
    //Si el objeto y el atributo existen se muestra el valor sino hay un error.
    // Redifino el método __get 
    public function __get($atributo){
        if(property_exists($this, $atributo)) {
            return $this->$atributo;
        }
        trigger_error("Atributo no definido ", E_USER_NOTICE);
        return null;
    }
    public function ingreso($cantidadIngreso){
        $this->saldo=$this->saldo+$cantidadIngreso;
        $this->movimientos++;
    }
    public function abono($cantidadAbono){
        $this->saldo=$this->saldo-$cantidadAbono;
        $this->movimientos++;
    }
    public function anotarGastos(){
        if($this->saldo<1000){
            $this->saldo=$this->saldo-20;
            $this->movimientos++;
        }
        
    }
    public function anotarIntereses($cantidadInteres){
        $this->saldo=$this->saldo+intval(round($this->saldo*($cantidadInteres/100)));
        $this->movimientos++;
    }
    public function transferencia($cantidadTransferencia,$cuenta){
        $this->saldo=$this->saldo-$cantidadTransferencia;
        $cuenta->saldo=$cuenta->saldo+$cantidadTransferencia;
        $this->movimientos++;
    }
    public function consultarEstado(){
        return " Saldo = ". $this->saldo .
        " Nº operaciones = ". $this->movimientos;

    }

}


?>
