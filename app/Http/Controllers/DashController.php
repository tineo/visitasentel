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

        //$this->middleware('auth');
        $this->middleware('auth');
        $this->em = $em;

    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        if(!Auth::user()->hasRoleByName(['user','admin'])){
            return redirect('/visitas');
        }

        $query = $this->em->createQuery("SELECT u FROM App\Entities\User u WHERE u.id = :id");
        $query->setParameter("id", Auth::user()->getId() );
        $user = $query->getOneOrNullResult();
        $sedes = $user->getSedes();


        if(($request->get("postpone"))!= null){
            $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.idvisita = :id");
            $query->setParameter("id", $request->get("postpone") );
            $visita = $query->getOneOrNullResult();
            return view('dash.dashboard', array("visita" => $visita, "sede" => $sedes->get(0)));
        }


        //echo get_class($sedes);

        //$sede = $sedes->get(0);
        //echo "<pre>";
        //echo var_dump($sedes->get(0));
        //foreach ($sedes as $sede){
        //   echo $sedes[0]->getNombre();
        //}
        //, array("horaini" => $sede->getHoraini(),"horafin" => $sede->getHorafin())
        //var_dump(count(Auth::user()->getId()));
        //echo "</pre>";
        //$sedes1 = array("nombre" => "test", "horaini" => new \DateTime(), "horafin" => new \DateTime());

        return view('dash.dashboard', array("sede" => $sedes->get(0)));
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
