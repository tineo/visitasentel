<?php

namespace App\Http\Controllers;

use App\Entities\Tienda;
use App\Entities\Track;
use App\Entities\User;
use Doctrine\ORM\Query;
use Illuminate\Http\Request;

use App\Http\Requests;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Support\Facades\EntityManager;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
//use Illuminate\Contracts\Auth\Authenticatable;
use Auth;



class TrackingController extends Controller
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


        //$track = $this->em->find('App\Entities\Tienda', 1);
        //$this->em->find('App\Entities\Track');

        $tienda = new Tienda();

        $tienda->setName("prueba2");
        $tienda->setState("ok");
        //$this->em->persist($tienda);
        //$this->em->flush();

        $query =$this->em->createQuery("SELECT u FROM App\Entities\Track u");
        $data = $query->getResult();



        //return  $tienda->getIdTienda();
            //$name = $request->input('name');
        return view('tracking.listing', array("tracks" => $data));
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
        Log::debug(1);
        //
        //$name = $request->input('name');
        $tienda = 1;
        if($request->get('tienda')!=null){
            $tienda = $request->get('tienda');
        }

        Log::debug($request->get('codigo'));
        $track = $this->em->find('App\Entities\Tienda', $tienda );

        $m = new Track();

        $m->setCodigo($request->get('codigo'));
        $m->setIdTienda($track);

        $m->setObs("OBS : ".$request->get('obs')." > FLAG : ".$request->get('flag')." GUID : ".$request->get('guid'));
        $m->setLat($request->get('lat'));
        $m->setLng($request->get('lng'));
        $m->setNum($request->get('num'));
        $m->setUsr($request->get('usr'));

        $this->em->persist($m);
        $this->em->flush();

        if($request->file('photo1') != null) {

            Log::debug('Se ha subido una imagen ');

            $request->file('photo1')->getClientOriginalName();

            $imageName = $m->getId() . '_1_' . $request->file('photo1')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;

            $request->file('photo1')->move(
                base_path() . '/public/images/', $imageName
            );
        }
        if($request->file('photo2') != null) {

            Log::debug('Se ha subido una imagen ');

            $request->file('photo2')->getClientOriginalName();

            $imageName = $m->getId() . '_2_' . $request->file('photo2')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;

            $request->file('photo2')->move(
                base_path() . '/public/images/', $imageName
            );
        }
        if($request->file('photo3') != null) {

            Log::debug('Se ha subido una imagen ');

            $request->file('photo3')->getClientOriginalName();

            $imageName = $m->getId() . '_3_' . $request->file('photo3')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;

            $request->file('photo3')->move(
                base_path() . '/public/images/', $imageName
            );
        }
        if($request->file('photo4') != null) {

            Log::debug('Se ha subido una imagen ');

            $request->file('photo4')->getClientOriginalName();

            $imageName = $m->getId() . '_4_' . $request->file('photo4')->getClientOriginalName()//.'.' .$request->file('photo')->getClientOriginalExtension()
            ;

            $request->file('photo4')->move(
                base_path() . '/public/images/', $imageName
            );
        }

        //$this->em->detach($m);

        return response()->json(array('code' => $m->getCodigo()));



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        //$user =  new User();
        //$user->setEmail("cesar@tineo.mobi");


        $query =$this->em->createQuery("SELECT u FROM App\Entities\User u WHERE u.email = ?1");
        $query->setParameter(1, "itsudatte01@gmail.com");
        $user = $query->getResult(Query::HYDRATE_OBJECT);
        echo "<pre>";
        //Auth::login($user[0]);
        var_dump(session('userid'));
        var_dump(Auth::check());
        var_dump(Auth::loginUsingId($user[0]->getId(), true));
        var_dump(Auth::check());
        //Session::save();
        session(['userid' => $user[0]->getId()]);
        //var_dump($user[0]->getEmail());
        //var_dump($user[0]->getPassword());
        //var_dump(Auth::attempt(['email' => $user[0]->getEmail(), 'password' => "123456789"]),true);
        //return  redirect()->intended('home');
        //return $user[0]->getPassword();


        echo "</pre>";


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
