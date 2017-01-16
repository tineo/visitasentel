<?php

namespace App\Entities;


use Doctrine\Common\Collections\ArrayCollection;
use Illuminate\Notifications\Notifiable;
use Doctrine\ORM\Mapping as ORM;

//use LaravelDoctrine\ACL\Contracts\Role ;
use App\Entities\Role as Role;
use LaravelDoctrine\ACL\Roles\HasRoles;
use LaravelDoctrine\ACL\Mappings as ACL;
use LaravelDoctrine\ACL\Contracts\HasRoles as HasRolesContract;

//use Illuminate\Contracts\Auth\Authenticatable;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */

class User implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\CanResetPassword, HasRolesContract
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;


    use HasRoles;
    use Notifiable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(type="string", nullable=false )
     */
    public $codigo;

    /** @ORM\Column(type="datetime", nullable=false ) */
    private $created_at;
    /** @ORM\Column(type="datetime", nullable=false ) */
    private $updated_at;
    /**
     * @ACL\HasRoles()
     * @var \Doctrine\Common\Collections\ArrayCollection|\LaravelDoctrine\ACL\Contracts\Role[]
     */
    protected $roles;

    public function setRoles($roles)
    {
        $this->roles = $roles;
    }
    public function getRoles()
    {
        return $this->roles;
    }


    /**
     * User constructor.
     * @param $name
     * @param $email
     * @param $password
     */
    public function __construct($name, $email, $password)
    {

        $this->roles = new ArrayCollection();

        $this->name = $name;
        $this->email = $email;
        $this->password = $password;

        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'codigo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


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
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        // TODO: Implement getEmailForPasswordReset() method.
        return $this->email;
    }

    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        // TODO: Implement sendPasswordResetNotification() method.
    }



}