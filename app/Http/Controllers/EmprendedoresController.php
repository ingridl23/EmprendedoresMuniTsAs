<?php

namespace App\Http\Controllers;

use App\Models\Emprendedore;
use App\Http\Requests\EmprendedoreRequest;

/**
 * Class EmprendedoreController
 * @package App\Http\Controllers
 */
class EmprendedoresController extends Controller
{



    public function emprendedores()
    {
        // cuando conectes modelo, descomentá esto
        // $emprendedores = Emprendedores::all();

        // return view("emprendedor.index", compact("emprendedores"));


        return view("layouts.index");
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emprendedores = new Emprendedores();
        return view('emprendedores.create', compact('emprendedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmprendedoresRequest $request)
    {
        Emprendedores::create($request->validated());

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emprendedore = Emprendedores::find($id);

        return view('emprendedores.show', compact('emprendedores'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emprendedores = Emprendedores::find($id);

        return view('emprendedores.edit', compact('emprendedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmprendedoresRequest $request, Emprendedores $emprendedores)
    {
        $emprendedores->update($request->validated());

        return redirect()->route('emprendedores.index')
            ->with('success', 'emprendedor editado con exito');
    }

    public function destroy($id)
    {
        Emprendedores::find($id)->delete();

        return redirect()->route('emprendedores')
            ->with('success', 'emprendedor eliminado');
    }
}
