<?php

namespace App\Http\Controllers;

use App\Filters\PlanillaFilter;
use App\Http\Resources\PlanillaCollection;
use App\Http\Resources\PlanillaResource;
use App\Models\Planilla;
use App\Http\Requests\StorePlanillaRequest;
use App\Http\Requests\UpdatePlanillaRequest;
use Illuminate\Http\Request;

class PlanillaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $filter = new PlanillaFilter();
        $queryItems = $filter->transform($request);

        $planilla = Planilla::where($queryItems);
        $includePlanillasPreventivas = $request->query("includePlanillasPreventivas");
        $includePlanillasCorrectivas = $request->query("includePlanillasCorrectivas");
        if($includePlanillasPreventivas){
            $planilla = $planilla->with("planillasPreventivas");
        }
        if($includePlanillasCorrectivas){
            $planilla = $planilla->with("planillasCorrectivas");
        }
        return new PlanillaCollection($planilla->get());

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
    public function store(StorePlanillaRequest $request)
    {
        //
        return new PlanillaResource(Planilla::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Planilla $planilla)
    {
        //
        return new PlanillaResource($planilla);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Planilla $planilla)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlanillaRequest $request, Planilla $planilla)
    {
        //
        $planilla->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Planilla $planilla)
    {
        //
    }
}
