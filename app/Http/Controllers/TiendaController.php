<?php

namespace App\Http\Controllers;

use App\Entities\Tienda;
use Illuminate\Http\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Illuminate\Support\Facades\EntityManager;


use App\Http\Requests;


class TiendaController extends Controller
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
        Log::debug("tiendas");
        $query =$this->em->createQuery("SELECT s FROM App\Entities\Tienda s");
        $data = $query->getResult( Query::HYDRATE_ARRAY);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('tienda.create');

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
        $name = $request->input('name');
        $state = $request->input('state');

        $tienda =  new Tienda();
        $tienda->setName($name);
        $tienda->setState($state);

        $this->em->persist($tienda);
        $this->em->flush();

        return $tienda->getIdTienda();
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
