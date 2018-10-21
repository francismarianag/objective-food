<?php

class Usuario
{
    public $nombre;
    public $apellido;
    public $email;
    public $contrasenia;
    public $terminos;
    public $fotoPerfil;


    public function __construct($nombre, $apellido, $email, $contrasenia){
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setEmail($email);
        $this->setContrasenia($contrasenia);
    }


    public function setNombre($nombre)
    {
        $this->nombre=strtolower($nombre);
        return $this;
    }
    public function setApellido($apellido)
    {
        $this->apellido=strtolower($apellido);
        return $this;
    }
    public function setEmail($email)
    {
        $this->email=strtolower($email);
        return $this;
    }
    public function setContrasenia($contrasenia)
    {
        $this->contrasenia=$contrasenia;
        return $this;
    }
    public function setTerminos($terminos)
    {
        $this->terminos=$terminos;
        return $this;
    }
    public function setFotoPerfil($fotoPerfil)
    {
        $this->fotoPerfil=$fotoPerfil;
        return $this;
    }

    // GETTERS
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getContrasenia()
    {
        return $this->contrasenia;
    }
    public function getTerminos()
    {
        return $this->terminos;
    }
    public function getFotoPerfil()
    {
        return $this->fotoPerfil;
    }
    
}
