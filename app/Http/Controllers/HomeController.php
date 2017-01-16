<?php

namespace App\Http\Controllers;

use App\Entities\User;
use Doctrine\ORM\Query;

use App\Entities\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $em = app('Doctrine\ORM\EntityManagerInterface');
        $roles = array();

        $query0 = $em->createQuery("SELECT u FROM App\Entities\User u WHERE u.email = :email");
        $query0->setParameter("email", 'cesar@tineo.mobi');
        $user0 = $query0->getOneOrNullResult();

        if($user0 == null) {

            $query1 = $em->createQuery("SELECT r FROM App\Entities\Role r WHERE r.name = :name");
            $query1->setParameter("name", "admin");
            $role = $query1->getOneOrNullResult();
            if ($role == null) {
                $r1 = new Role();
                $r1->setName("admin");
                $r1->setDescription("Administrador");
                $em->persist($r1);

                $roles[] = "admin";
            }

            $query2 = $em->createQuery("SELECT r FROM App\Entities\Role r WHERE r.name = :name");
            $query2->setParameter("name", "user");
            $role2 = $query2->getOneOrNullResult();
            if ($role2 == null) {
                $r2 = new Role();
                $r2->setName("user");
                $r2->setDescription("Usuario");
                $em->persist($r2);

                $roles[] = "user";
            }


            $query3 = $em->createQuery("SELECT r FROM App\Entities\Role r WHERE r.name = :name");
            $query3->setParameter("name", "clerk");
            $role3 = $query3->getOneOrNullResult();
            if ($role3 == null) {
                $r3 = new Role();
                $r3->setName("clerk");
                $r3->setDescription("Recepcionista");
                $em->persist($r3);

                $roles[] = "clerk";
            }

            $em->flush();

            $user = new User("Cesar Gutierrez", "cesar@tineo.mobi", bcrypt("kokoro"));
            $user->setCodigo("996666567");


            $queryz = $em->createQuery("SELECT r FROM App\Entities\Role r ");
            $roles = $queryz->getResult();

            foreach ($roles as $role) {
                $user->getRoles()->add($role);
            }
            $em->persist($user);


            $em->flush();


            return view('home', array("roles" => $roles));
        }else{
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $hash
     * @return \Illuminate\Http\Response
     */
    public function pickup($hash)
    {
        //
        $em = app('Doctrine\ORM\EntityManagerInterface');
        $query = $em->createQuery("SELECT u FROM App\Entities\User u WHERE u.codigo = :codigo");
        //$query = $em->createQuery("SELECT u FROM App\Entities\User u");
        $query->setParameter("codigo", "".$hash);
        $user = $query->getResult();

        //return $user;

        if(count($user) > 0) Auth::login($user[0]);

        return  redirect()->intended('dashboard');


    }
}
