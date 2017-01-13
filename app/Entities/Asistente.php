<?php
/**
 * Created by PhpStorm.
 * User: tineo
 * Date: 09/01/17
 * Time: 02:17 AM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping AS ORM;
use App\Entities\Visita;
/**
 * @ORM\Entity
 * @ORM\Table(name="asistente")
 */
class Asistente
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $idasistente;

    /** @ORM\Column(type="string") */
    private $nombre;

    /** @ORM\Column(type="string") */
    private $dni;

    /** @ORM\Column(type="string", nullable=true) */
    private $empresa;

    /** @ORM\Column(type="string") */
    private $email;

    /** @ORM\Column(type="string") */
    private $motivo;

    /** @ORM\Column(type="string") */
    private $tipo;

    /**
     * @ORM\ManyToOne(targetEntity="Visita")
     * @ORM\JoinColumn(name="idvisita", referencedColumnName="idvisita")
     */
    private $idvisita;

    /** @ORM\Column(type="datetime", nullable=false ) */
    private $registerat;

    public function __construct()
    {
        $this->registerat = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getIdasistente()
    {
        return $this->idasistente;
    }

    /**
     * @param mixed $idasistente
     */
    public function setIdasistente($idasistente)
    {
        $this->idasistente = $idasistente;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * @param mixed $dni
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
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
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
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




}