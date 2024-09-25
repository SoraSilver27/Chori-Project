<?php

namespace App\Http\Controllers;

use App\Filters\PlanillaPreventivaFilter;
use App\Http\Resources\PlanillaPreventivaCollection;
use App\Http\Resources\PlanillaPreventivaResource;
use App\Models\PlanillaPreventiva;
use App\Http\Requests\StorePlanillaPreventivaRequest;
use App\Http\Requests\UpdatePlanillaPreventivaRequest;
use Illuminate\Http\Request;

class PlanillaPreventivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new PlanillaPreventivaFilter();
        $queryItems = $filter->transform($request);

        $planillaPreventiva = PlanillaPreventiva::where($queryItems);

        return new PlanillaPreventivaCollection($planillaPreventiva->get());

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
    public function store(StorePlanillaPreventivaRequest $request)
    {
        //
        return new PlanillaPreventivaResource(PlanillaPreventiva::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanillaPreventiva $planillaPreventiva)
    {
        //
        return new PlanillaPreventivaResource($planillaPreventiva);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanillaPreventiva $planillaPreventiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanillaPreventivaRequest $request, PlanillaPreventiva $planillaPreventiva)
    {
        //
        $planillaPreventiva->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanillaPreventiva $planillaPreventiva)
    {
        //
    }
}
