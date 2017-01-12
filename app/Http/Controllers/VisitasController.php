<?php

namespace App\Http\Controllers;



use App\Entities\Asistente;
use App\Entities\Visita;
use Illuminate\Http\Request;

use App\Http\Requests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $perpage = 10;
        $page = 1;

        if($request->get('p')) $page =$request->get('p');

        if($request->get('dni')) {
            $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v JOIN v.visitantes a WHERE a.dni = :dni ")
                ->setFirstResult($perpage * ($page - 1))
                ->setMaxResults($perpage);
            $query->setParameter("dni", $request->get('dni'));

        }else{
            $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v")
                ->setFirstResult($perpage * ($page - 1))
                ->setMaxResults($perpage);
        }
        $data = new Paginator($query);

        $c = count($data);

        $pages = intval($c/$perpage);
        if($c % $perpage > 0) $pages++;

        foreach ($data as $v){
            $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");
            $query2->setParameter("idvisita", $v->getIdVisita());
            $visitante = $query2->getResult();

            $v->setVisitante($visitante[0]);
        }

        return view('visitas.index', array("visitas" => $data, "count" => $c, "pages" => $pages));
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
        $visita = new Visita();

        $visita->setArea($request->get('area'));
        $visita->setContacto($request->get('contacto'));
        $visita->setEmpresa($request->get('empresa'));

        $visita->setFecha(\DateTime::createFromFormat('d/m/Y', $request->get('fecha')));
        $visita->setHoraini(\DateTime::createFromFormat('H:i', $request->get('horaini')));
        $visita->setHorafin(\DateTime::createFromFormat('H:i', $request->get('horafin')));

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
        //
        $perpage = 10;
        $page = 1;

        if($request->get('p')) $page =$request->get('p');

        if($request->get('dni')) {
            $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v JOIN v.visitantes a WHERE v.registerby = :userid AND a.dni = :dni ")
                ->setFirstResult($perpage * ($page - 1))
                ->setMaxResults($perpage);
            $query->setParameter("dni", $request->get('dni'));
            $query->setParameter("userid", Auth::id());

        }else{
            $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.registerby = :userid")
                ->setFirstResult($perpage * ($page - 1))
                ->setMaxResults($perpage);
            $query->setParameter("userid", Auth::id());
        }
        $data = new Paginator($query);

        $c = count($data);

        $pages = intval($c/$perpage);
        if($c % $perpage > 0) $pages++;

        foreach ($data as $v){
            $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");
            $query2->setParameter("idvisita", $v->getIdVisita());

            $visitante = $query2->getResult();

            $v->setVisitante($visitante[0]);
        }

        return view('visitas.index', array("visitas" => $data, "count" => $c, "pages" => $pages));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bydate(Request $request)
    {
        //sleep(4);
        $offset = 1;
        if($request->get('fecha') !== null) $offset = $request->get('offset');
        //
        if($offset < 2 ){
            $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.fecha = :fecha");
            $query->setParameter("fecha", \DateTime::createFromFormat('d/m/Y', $request->get('fecha'))->format('Y-m-d') );
            $visitas = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }else{
            $fecha = \DateTime::createFromFormat('d/m/Y', $request->get('fecha'));
            $fechalimit = \DateTime::createFromFormat('d/m/Y', $request->get('fecha'))->modify('+'.($offset-1).' day');
            $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.fecha BETWEEN :fecha1 AND :fecha2");
            $query->setParameter("fecha1", $fecha->format('Y-m-d') );
            $query->setParameter("fecha2", $fechalimit->format('Y-m-d') );
            $visitas = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }
        return response()->json($visitas);

    }
}
