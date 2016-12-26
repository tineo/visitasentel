<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Entities\User;
use Doctrine\ORM\Query;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\EntityManager;

use Auth;


class DashController extends Controller
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dash.dashboard', array("tracks" => null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $id;

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

        $query =$this->em->createQuery("SELECT u FROM App\Entities\User u WHERE u.email = ?1");
        $query->setParameter(1, "itsudatte01@gmail.com");
        $user = $query->getResult(Query::HYDRATE_OBJECT);
        echo "<pre>";


        var_dump(Auth::check());
        Auth::login($user[0]);
        //var_dump(Auth::loginUsingId($user[0]->getId(), true));
        var_dump(Auth::check());
        //Auth::logout();
        //Session::save();
        echo "</pre>";
        //return 1;
        return  redirect()->intended('home');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
