<?php

namespace App\Http\Controllers;



use App\Entities\Asistente;
use App\Entities\Visita;
use Illuminate\Http\Request;

use App\Http\Requests;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\EntityManager;

class VisitasController extends Controller
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


        $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v");
        $data = $query->getResult();

        foreach ($data as $v){
            $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");
            //echo $v->getIdVisita();
            $query2->setParameter("idvisita", $v->getIdVisita());
            $visitante = $query2->getResult();
            //var_dump($visitante[0]->getNombre());
            $v->setVisitante($visitante[0]);
        }

        return view('visitas.index', array("visitas" => $data));
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

        /*
        $visita = new Visita();

        $visita->setArea("1");
        $visita->setContacto("1");
        $visita->setEmpresa("1");
        $visita->setFecha("1");
        $visita->setHoraini("1");
        $visita->setHorafin("1");
        $visita->setMotivo("1");
        $visita->setPiso("1");

        $asistente =  new Asistente();
        $asistente->setMotivo("1");
        $asistente->setDni("135435");
        $asistente->setEmail("1");
        $asistente->setNombre("name1");
        $asistente->setTipo("1");
        $asistente->setIdvisita($visita);

        $this->em->persist($visita);
        $this->em->persist($asistente);
        $this->em->flush();

        */

         $visita = new Visita();

        $visita->setArea($request->get('area'));
        $visita->setContacto($request->get('contacto'));
        $visita->setEmpresa($request->get('empresa'));
        $visita->setFecha($request->get('fecha'));
        $visita->setHoraini($request->get('horaini'));
        $visita->setHorafin($request->get('horafin'));
        $visita->setMotivo($request->get('motivo'));
        $visita->setPiso($request->get('piso'));
        $visita->setRegisterby( Auth::id() );

        $asistente =  new Asistente();
        $asistente->setMotivo($request->get('motivo'));
        $asistente->setDni($request->get('dni'));
        $asistente->setEmail($request->get('email'));
        $asistente->setNombre($request->get('nombre'));
        $asistente->setTipo(1);
        $asistente->setIdvisita($visita);


        $this->em->persist($visita);
        $this->em->persist($asistente);
        $this->em->flush();

        return response()->json(array('code' => $visita->getIdvisita()));


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
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function me(Request $request){

        $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.registerby = :userid");
        $query->setParameter("userid", Auth::id());
        $data = $query->getResult();

        foreach ($data as $v){
            $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");

            $query2->setParameter("idvisita", $v->getIdVisita());
            $visitante = $query2->getResult();

            $v->setVisitante($visitante[0]);
        }

        return view('visitas.index', array("visitas" => $data));
    }
}
