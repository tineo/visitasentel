<?php

namespace App\Entities;


use Illuminate\Notifications\Notifiable;
use Doctrine\ORM\Mapping AS ORM;

//use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
//use Illuminate\Foundation\Auth\User as Authenticatable;

class User implements \Illuminate\Contracts\Auth\Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $name;

    /**
     * @ORM\Column(type="string")
     */
    public $email;

    /**
    // * @ORM\Column(type="string")
     */
    //protected $password;

    /** @ORM\Column(type="datetime", nullable=false ) */
    private $created_at;
    /** @ORM\Column(type="datetime", nullable=false ) */
    private $updated_at;



    /**
     * User constructor.
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct($name, $email, $password)
    {

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();

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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param mixed $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }





    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}