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
use Illuminate\Support\Facades\Mail;


class VisitasController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Auth::user()->hasRoleByName(['clerk','admin'])){
            return redirect('/dashboard');
        }
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


        $visita->setFecha(\DateTime::createFromFormat('d/m/Y', $request->get('fecha')));
        $visita->setHoraini(\DateTime::createFromFormat('H:i', $request->get('horaini')));
        $visita->setHorafin(\DateTime::createFromFormat('H:i', $request->get('horafin')));

        $visita->setMotivo($request->get('motivo'));
        $visita->setPiso($request->get('piso'));
        $visita->setRegisterby( Auth::id() );
        $visita->setState( 0 );

        $asistente =  new Asistente();
        $asistente->setMotivo($request->get('motivo'));
        $asistente->setDni($request->get('dni'));
        $asistente->setEmail($request->get('email'));
        $asistente->setNombre($request->get('nombre'));
        $asistente->setEmpresa($request->get('empresa'));
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

        $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v JOIN v.visitantes a
                                          WHERE v.idvisita = :idvisita");
        $query->setParameter("idvisita", $id);
        $visita = $query->getOneOrNullResult();

        if($visita == null) abort(404);
        //var_dump($visita->getVisitantes()->get(0)->getNombre());

        return view('visitas.show', array("visita" => $visita));
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

        $old = $this->em->find("App\Entities\Visita", $id);

        $olddata = array("fecha" => $old->getFecha(), "horaini" => $old->getHoraini(), "horafin" => $old->getHorafin());
        $newdata = array(
            "fecha" =>\DateTime::createFromFormat('d/m/Y', $request->get('fecha')),
            "horaini" => \DateTime::createFromFormat('H:i', $request->get('horaini')),
            "horafin" => \DateTime::createFromFormat('H:i', $request->get('horafin')));

        $qb = $this->em->createQueryBuilder();
        $q = $qb->update('App\Entities\Visita', 'v')
            ->set('v.horaini', ':horaini')
            ->set('v.horafin', ':horafin')
            ->set('v.fecha', ':fecha')
            ->where('v.idvisita = :id')
            ->setParameter("horaini", \DateTime::createFromFormat('H:i', $request->get('horaini')))
            ->setParameter("horafin", \DateTime::createFromFormat('H:i', $request->get('horafin')))
            ->setParameter("fecha", \DateTime::createFromFormat('d/m/Y', $request->get('fecha')))
            ->setParameter("id", $id)
            ->getQuery();
        $res = $q->execute();

        //$query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.idvisita = :id");
        //$query->setParameter("id", $id );
        //$visita = $query->getOneOrNullResult();
        $visita = $this->em->find("App\Entities\Visita", $id);

        $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");
        $query2->setParameter("idvisita", $id);
        $asistentes = $query2->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $data = array(
            'visita' => $visita,
            'asistentes' => $asistentes,
            'olddata' => $olddata,
            'newdata' => $newdata
        );


        Mail::send('email.postergacion', $data, function ($message) use ($asistentes) {
            $message->from('cesar@tineo.mobi', 'Bot');

            foreach ($asistentes as $asistente) {
                if ($asistente['tipo'] == 1) {
                    $message->to($asistente["email"], $asistente["nombre"]);
                } else {
                    $message->cc($asistente["email"], $asistente["nombre"]);
                }
            }
            $message->subject('Cambio de fecha de vista');
        });

        return $res;



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
        if(!Auth::user()->hasRoleByName(['user','admin'])){
            return redirect('/visitas');
        }
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
            $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.fecha = :fecha AND v.registerby = :userid");
            $query->setParameter("fecha", \DateTime::createFromFormat('d/m/Y', $request->get('fecha'))->format('Y-m-d') );
            $query->setParameter("userid", Auth::id() );
            $visitas = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }else{
            $fecha = \DateTime::createFromFormat('d/m/Y', $request->get('fecha'));
            $fechalimit = \DateTime::createFromFormat('d/m/Y', $request->get('fecha'))->modify('+'.($offset-1).' day');
            $query =$this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.registerby = :userid AND (v.fecha BETWEEN :fecha1 AND :fecha2)");
            $query->setParameter("fecha1", $fecha->format('Y-m-d') );
            $query->setParameter("fecha2", $fechalimit->format('Y-m-d') );
            $query->setParameter("userid", Auth::id() );
            $visitas = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
        }
        return response()->json($visitas);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addvisitante(Request $request)
    {
        $visitante =  new Asistente();
        $visitante->setEmpresa($request->get("empresa"));
        $visitante->setMotivo($request->get("motivo"));
        $visitante->setDni($request->get("dni"));
        $visitante->setEmail($request->get("email"));
        $visitante->setNombre($request->get("nombre"));
        $visitante->setTipo(2);
        $visitante->setIdvisita($this->em->find("App\Entities\Visita", $request->get("visitaid")));

        $this->em->persist($visitante);
        $this->em->flush();

        return response()->json(array('code' => $visitante->getIdasistente()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delvisitante(Request $request)
    {
        $qb = $this->em->createQueryBuilder();
        $q = $qb->delete('App\Entities\Asistente', 'a')
            ->where('a.idasistente = :id')
            ->setParameter("id", $request->get("asistente"))
            ->getQuery();
        $p = $q->execute();

        //$a = $this->em->find('App\Entities\Asistente', $request->get("asistente") );
        //$this->em->remove($a);
        return response()->json($p);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changestate(Request $request)
    {
        $visitaid = $request->get('visitaid');
        $state1 = $request->get('state');

        $query = $this->em->createQuery("SELECT v FROM App\Entities\Visita v WHERE v.idvisita = :id");
        $query->setParameter("id", $visitaid );
        $visita = $query->getOneOrNullResult();

        $query2 =$this->em->createQuery("SELECT a FROM App\Entities\Asistente a WHERE a.idvisita = :idvisita");
        $query2->setParameter("idvisita", $visita->getIdVisita());
        $asistentes = $query2->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);

        $data = array(
            'visita' => $visita,
            'asistentes' => $asistentes
        );

        if($state1 == 1) {
            Mail::send('email.confirm', $data, function ($message) use ($asistentes) {
                $message->from('cesar@tineo.mobi', 'Bot');

                foreach ($asistentes as $asistente) {
                    if ($asistente['tipo'] == 1) {
                        $message->to($asistente["email"], $asistente["nombre"]);
                    } else {
                        $message->cc($asistente["email"], $asistente["nombre"]);
                    }
                }
                $message->subject('Confirmacion de vista');
            });
        }elseif ($state1 == 2){
            Mail::send('email.anular', $data, function ($message) use ($asistentes) {
                $message->from('cesar@tineo.mobi', 'Bot');

                foreach ($asistentes as $asistente) {
                    if ($asistente['tipo'] == 1) {
                        $message->to($asistente["email"], $asistente["nombre"]);
                    } else {
                        $message->cc($asistente["email"], $asistente["nombre"]);
                    }
                }
                $message->subject('Anulacion de vista');
            });
        }

        $qb = $this->em->createQueryBuilder();
        $q = $qb->update('App\Entities\Visita', 'v')
            ->set('v.state', ':state')
            ->where('v.idvisita = :id')
            ->setParameter("state", $state1)
            ->setParameter("id", $visitaid)
            ->getQuery();
        $p = $q->execute();

        return response()->json($p);
    }


}
