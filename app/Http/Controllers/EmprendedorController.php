<?php

namespace App\Http\Controllers;

use App\Models\Emprendedor;
use App\Http\Requests\EmprendedorRequest;

/**
 * Class EmprendedorController
 * @package App\Http\Controllers
 */
class EmprendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emprendedors = Emprendedor::paginate();

        return view('emprendedor.index', compact('emprendedors'))
            ->with('i', (request()->input('page', 1) - 1) * $emprendedors->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $emprendedor = new Emprendedor();
        return view('emprendedor.create', compact('emprendedor'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmprendedorRequest $request)
    {
        Emprendedor::create($request->validated());

        return redirect()->route('emprendedors.index')
            ->with('success', 'Emprendedor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $emprendedor = Emprendedor::find($id);

        return view('emprendedor.show', compact('emprendedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $emprendedor = Emprendedor::find($id);

        return view('emprendedor.edit', compact('emprendedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmprendedorRequest $request, Emprendedor $emprendedor)
    {
        $emprendedor->update($request->validated());

        return redirect()->route('emprendedors.index')
            ->with('success', 'Emprendedor updated successfully');
    }

    public function destroy($id)
    {
        Emprendedor::find($id)->delete();

        return redirect()->route('emprendedors.index')
            ->with('success', 'Emprendedor deleted successfully');
    }
}
