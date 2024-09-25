<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanillaCorrectivaCollection;
use App\Http\Resources\PlanillaCorrectivaResource;
use App\Models\PlanillaCorrectiva;
use App\Http\Requests\StorePlanillaCorrectivaRequest;
use App\Http\Requests\UpdatePlanillaCorrectivaRequest;
use Illuminate\Http\Request;

class PlanillaCorrectivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new PlanillaCorrectiva();
        $queryItems = $filter->transform($request);

        $planillaCorrectiva = PlanillaCorrectiva::where($queryItems);

        return new PlanillaCorrectivaCollection($planillaCorrectiva->get());
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
    public function store(StorePlanillaCorrectivaRequest $request)
    {
        //
        return new PlanillaCorrectivaResource(PlanillaCorrectiva::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlanillaCorrectiva $planillaCorrectiva)
    {
        //
        return new PlanillaCorrectivaResource($planillaCorrectiva);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlanillaCorrectiva $planillaCorrectiva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanillaCorrectivaRequest $request, PlanillaCorrectiva $planillaCorrectiva)
    {
        //
        $planillaCorrectiva->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlanillaCorrectiva $planillaCorrectiva)
    {
        //
    }
}
