<?php

namespace App\Http\Controllers;

use App\Entities\User;

use Doctrine\ORM\Query;
use Illuminate\Http\Request;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\EntityManager;

use App\Http\Requests;

class UsersController extends Controller
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->middleware('auth');
        $this->em = $em;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasRoleByName(['user','admin'])){
            return redirect('/visitas');
        }
        $query =$this->em->createQuery("SELECT u FROM App\Entities\User u");
        $data = $query->getResult();
        return view('users.index', array("users" => $data));
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
