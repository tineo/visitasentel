<?php
/**
 * Created by PhpStorm.
 * User: tineo
 * Date: 09/01/17
 * Time: 01:50 AM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping AS ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="visita")
 */
class Visita
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $idvisita;

    /** @ORM\Column(type="date", nullable=true) */
    private $fecha;

    /** @ORM\Column(type="time", nullable=true) */
    private $horaini;

    /** @ORM\Column(type="time", nullable=true) */
    private $horafin;

    /** @ORM\Column(type="string", nullable=true) */
    private $empresa;

    /** @ORM\Column(type="string", nullable=true) */
    private $motivo;

    /** @ORM\Column(type="string", nullable=true) */
    private $piso;

    /** @ORM\Column(type="string", nullable=true) */
    private $area;

    /** @ORM\Column(type="string", nullable=true) */
    private $contacto;

    /** @ORM\Column(type="integer", nullable=true ) */
    private $registerby;

    /** @ORM\Column(type="datetime", nullable=false ) */
    private $registerat;

    private $visitante;



    public function __construct()
    {
        $this->registerat = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getIdvisita()
    {
        return $this->idvisita;
    }

    /**
     * @param mixed $idvisita
     */
    public function setIdvisita($idvisita)
    {
        $this->idvisita = $idvisita;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getHoraini()
    {
        return $this->horaini;
    }

    /**
     * @param mixed $horaini
     */
    public function setHoraini($horaini)
    {
        $this->horaini = $horaini;
    }

    /**
     * @return mixed
     */
    public function getHorafin()
    {
        return $this->horafin;
    }

    /**
     * @param mixed $horafin
     */
    public function setHorafin($horafin)
    {
        $this->horafin = $horafin;
    }

    /**
     * @return mixed
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * @param mixed $empresa
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->motivo;
    }

    /**
     * @param mixed $motivo
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * @return mixed
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * @param mixed $area
     */
    public function setArea($area)
    {
        $this->area = $area;
    }

    /**
     * @return mixed
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * @param mixed $contacto
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    }

    /**
     * @return mixed
     */
    public function getVisitante()
    {
        return $this->visitante;
    }

    /**
     * @param mixed $visitante
     */
    public function setVisitante($visitante)
    {
        $this->visitante = $visitante;
    }

    /**
     * @return mixed
     */
    public function getRegisterby()
    {
        return $this->registerby;
    }

    /**
     * @param mixed $registerby
     */
    public function setRegisterby($registerby)
    {
        $this->registerby = $registerby;
    }


}