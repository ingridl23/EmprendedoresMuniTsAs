<?php

namespace App\Http\Controllers;

use App\Models\Emprendedore;
use App\Http\Requests\EmprendedoreRequest;

/**
 * Class EmprendedoreController
 * @package App\Http\Controllers
 */
class EmprendedoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprendedores = Emprendedore::paginate();

        return view('emprendedore.index', compact('emprendedores'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedores->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emprendedore = new Emprendedore();
        return view('emprendedore.create', compact('emprendedore'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmprendedoreRequest $request)
    {
        Emprendedore::create($request->validated());

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedore created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emprendedore = Emprendedore::find($id);

        return view('emprendedore.show', compact('emprendedore'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emprendedore = Emprendedore::find($id);

        return view('emprendedore.edit', compact('emprendedore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmprendedoreRequest $request, Emprendedore $emprendedore)
    {
        $emprendedore->update($request->validated());

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedore updated successfully');
    }

    public function destroy($id)
    {
        Emprendedore::find($id)->delete();

        return redirect()->route('emprendedores.index')
            ->with('success', 'Emprendedore deleted successfully');
    }
}
