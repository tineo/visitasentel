<?php
/**
 * Created by PhpStorm.
 * User: tineo
 * Date: 18/01/17
 * Time: 07:16 PM
 */

namespace App\Entities;
use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="sede")
 */
class Sede
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $idsede;

    /** @ORM\Column(type="string", nullable=true) */
    private $nombre;

    /** @ORM\Column(type="string", nullable=true) */
    private $direccion;

    /** @ORM\Column(type="time", nullable=true) */
    private $horaini;

    /** @ORM\Column(type="time", nullable=true) */
    private $horafin;

    /** @ORM\Column(type="string", nullable=true) */
    private $lastupdate;

    /**
     * Many Users have Many Groups.
     * @var \Doctrine\Common\Collections\Collection|User[]
     * @ORM\ManyToMany(targetEntity="User", mappedBy="sedes")
     * @ORM\JoinTable(name="users_sedes",
     *      joinColumns={@ORM\JoinColumn(name="sede_id", referencedColumnName="idsede")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")}
     *      )
     */
    private $users;

    function __construct()
    {
        $this->users =  new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getIdsede()
    {
        return $this->idsede;
    }

    /**
     * @param mixed $idsede
     */
    public function setIdsede($idsede)
    {
        $this->idsede = $idsede;
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
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
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * @param mixed $lastupdate
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param mixed $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }




    public function addUser(User $user)
    {
        $user->addSede($this);
        $this->users[] = $user;
    }


}