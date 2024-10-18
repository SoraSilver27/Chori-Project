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
        $planilla = Planilla::create($request->except('repuestos_utilizados'));

        if ($request->has('repuestos_utilizados')) {
            $repuestos = $request->input('repuestos_utilizados');
            $repuestos = json_decode($request->input('repuestos_utilizados'), true);
            foreach ($repuestos as $repuestoData) {
                $planilla->repuestosUtilizados()->create([
                    'nombre_repuesto' => $repuestoData['nombre'],
                    'cantidad' => $repuestoData['cantidad'],
                ]);
            }
        }

        return new PlanillaResource($planilla);
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
