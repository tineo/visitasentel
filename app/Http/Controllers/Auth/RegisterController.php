<?php

namespace App\Http\Controllers\Auth;

//use App\User;
use App\Entities\Role;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;

use App\Entities\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');

        $this->middleware('auth');
    }

    public function showRegistrationForm()
    {
        if(!Auth::user()->hasRoleByName(['admin'])){
            return redirect('/');
        }
        $em = app('Doctrine\ORM\EntityManagerInterface');
        $query = $em->createQuery("SELECT r FROM App\Entities\Role r");
        $roles = $query->getResult();
        $query2 = $em->createQuery("SELECT s FROM App\Entities\Sede s");
        $sedes = $query2->getResult();
        return view('auth.register', array("roles" => $roles, "sedes" => $sedes));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:App\Entities\User',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $em = app('Doctrine\ORM\EntityManagerInterface');
        $user =  new User($data['name'],$data['email'],bcrypt($data['password']));
        $user->setCodigo(Input::get('code_autologin'));


        $roles_checked = Input::get('roles');

        foreach ($roles_checked as $role){
            $query = $em->createQuery("SELECT r FROM App\Entities\Role r WHERE r.id = :id");

            $query->setParameter("id", $role);
            $role = $query->getOneOrNullResult();
            $user->getRoles()->add($role);
        }

        foreach (Input::get('sedes') as $idsede){
            $query = $em->createQuery("SELECT r FROM App\Entities\Sede r WHERE r.idsede = :idsede");
            $query->setParameter("idsede", $idsede);
            $sede = $query->getOneOrNullResult();
            $sede->getUsers()->add($user);
            $user->getSedes()->add($sede);
        }

        //$user->addRole("admin");
        $em->persist($user);
        $em->flush();


        /*return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);*/
        return $user;

    }



}
