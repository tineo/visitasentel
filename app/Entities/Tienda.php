<?php
namespace App\Entities;
/**
 * Created by PhpStorm.
 * User: tineo
 * Date: 20/09/16
 * Time: 08:42 PM
 */
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tienda")
 */
class Tienda
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;
    /** @ORM\Column(type="string") */
    protected $name;
    /** @ORM\Column(type="string") */
    private $state;

    /**
     * @return mixed
     */
    public function getIdTienda()
    {
        return $this->id;
    }

    /**
     * @param mixed $idTienda
     */
    public function setIdTienda($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }



}