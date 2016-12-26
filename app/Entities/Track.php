<?php
namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: tineo
 * Date: 20/09/16
 * Time: 08:38 PM
 */

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entities\Tienda;

/**
 * @ORM\Entity
 * @ORM\Table(name="track")
 */
class Track
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string") */
    private $codigo;

    /**
     * @ORM\ManyToOne(targetEntity="Tienda")
     * @ORM\JoinColumn(name="tienda_id", referencedColumnName="id")
     */
    private $idTienda;

    /** @ORM\Column(type="string") */
    private $obs;

    /** @ORM\Column(type="decimal", precision=8, scale=6) */
    private $lat;

    /** @ORM\Column(type="decimal", precision=9, scale=6) */
    private $lng;

    /** @ORM\Column(type="string") */
    private $num;

    /** @ORM\Column(type="string") */
    private $usr;

    /** @ORM\Column(type="datetime", nullable=false ) */
    private $dtime;

    public function __construct()
    {
        $this->dtime = new \DateTime();

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }



    /**
     * @return mixed
     */
    public function getIdTienda()
    {
        return $this->idTienda;
    }

    /**
     * @param mixed $idTienda
     */
    public function setIdTienda($idTienda)
    {
        $this->idTienda = $idTienda;
    }

    /**
     * @return mixed
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * @param mixed $obs
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
    }

    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return mixed
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * @param mixed $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * @return mixed
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param mixed $num
     */
    public function setNum($num)
    {
        $this->num = $num;
    }

    /**
     * @return mixed
     */
    public function getUsr()
    {
        return $this->usr;
    }

    /**
     * @param mixed $usr
     */
    public function setUsr($usr)
    {
        $this->usr = $usr;
    }

    /**
     * @return mixed
     */
    public function getDtime()
    {
        return $this->dtime;
    }

    /**
     * @param mixed $dtime
     */
    public function setDtime($dtime)
    {
        $this->dtime = $dtime;
    }






}