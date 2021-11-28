
<?php

    class Coche{
        protected $ruedas; //Es accesible desde la propia clase y clases heredadas
                        /* la encapsulación puede ser public que se declara con var y es accesible a todos y se puede modificar, 
                        private que es accesible sólo en la propia clase (para acceder a ella o modificarla hace falta get o set), 
                        y protected que es accesible en la propia clase y en clases heredadas.*/
        protected $color;
        protected $motor;
        //Propiedad estática que es aplicable a todos los objetos
        static $tapiceria="cuero";

        function Coche(){
            //El operador this hace referencia al objeto que estamos trabajando en ese momento
            $this->ruedas=4;
            $this->motor=1600;
            $this->color="";
        
        }
        //Muestra la propiedad estática de la clase coche
        function mostrarTapiceria(){
            return Coche::$tapiceria;
        }
        function get_color(){
            return $this->color;
        }
        function get_motor(){
            return $this->motor;
        }
        //Con get se puede ver la propiedad encapsulada
        function get_ruedas(){
            return $this->ruedas;
        }
        function arrancar(){
            echo "Estoy arrancando";
        }

        function girar(){
            echo "Estoy girando";
        }
        function frenar(){
            echo "Estoy frenando";
        }
        //Con set se puede moficiar la propiedad encapsulada
        function set_color($color_coche,$nombre_coche){
            $this->color=$color_coche;
            echo "El coche cuyo nombre es ".$nombre_coche." es de color ".$this->color."<br>";
        }
    }

    class Camion extends Coche{
        //En este caso coche es la superclase y camión la subclase
        //Camión hereda de coche

        function Coche(){
            $this->ruedas=8;
            $this->motor=2600;
            $this->color="gris";
        
        }

        function arrancar(){
            //Ejecuta el método de la clase padre
            parent::arrancar();
            echo "Camión arrancado";
        }
        //Se sobreescribe el método establece_color para poner los parámetros de camión
        function set_color($color_camion,$nombre_camion){
            $this->color=$color_camion;
            echo "El coche cuyo nombre es ".$nombre_camion." es de color ".$this->color."<br>";
        }
    }



?>