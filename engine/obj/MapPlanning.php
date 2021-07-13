<?php
    class MapPlanning{
        var $atribute;
        var $component;

        public function __construct(Type $var = null) {
            $this->var = $var;
        }

        function setAttribute(array $atribut){
            $this->atribute = $atribut;
        }

        function setComponent(array $component){
            $this->component = $component;
        }

    }
?>