<?php

namespace App\Http\Controllers;

use App\Filters\NotaDelCalendarioFilter;
use App\Http\Resources\NotaDelCalendarioResource;
use App\Http\Resources\NotaDelCalendarioCollection;
use App\Models\NotaDelCalendario;
use App\Http\Requests\StoreNotaDelCalendarioRequest;
use App\Http\Requests\UpdateNotaDelCalendarioRequest;
use Illuminate\Http\Request;
class NotaDelCalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new NotaDelCalendarioFilter();
        $queryItems = $filter->transform($request);

        $notaDelCalendario = NotaDelCalendario::where($queryItems);
        return new NotaDelCalendarioCollection($notaDelCalendario->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNotaDelCalendarioRequest $request)
    {
        //
        return new NotaDelCalendarioResource(NotaDelCalendario::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(NotaDelCalendario $notaDelCalendario)
    {
        //
        return new NotaDelCalendarioResource($notaDelCalendario);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NotaDelCalendario $notaDelCalendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNotaDelCalendarioRequest $request, NotaDelCalendario $notaDelCalendario)
    {
        //
        $notaDelCalendario->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NotaDelCalendario $notaDelCalendario)
    {
        //
    }
}
