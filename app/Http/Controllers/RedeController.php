<?php

namespace App\Http\Controllers;

use App\Models\Rede;
use App\Http\Requests\RedeRequest;

/**
 * Class RedeController
 * @package App\Http\Controllers
 */
class RedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $redes = Rede::paginate();

        return view('rede.index', compact('redes'))
            ->with('i', (request()->input('page', 1) - 1) * $redes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rede = new Rede();
        return view('rede.create', compact('rede'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RedeRequest $request)
    {
        Rede::create($request->validated());

        return redirect()->route('redes.index')
            ->with('success', 'Rede created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rede = Rede::find($id);

        return view('rede.show', compact('rede'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rede = Rede::find($id);

        return view('rede.edit', compact('rede'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RedeRequest $request, Rede $rede)
    {
        $rede->update($request->validated());

        return redirect()->route('redes.index')
            ->with('success', 'Rede updated successfully');
    }

    public function destroy($id)
    {
        Rede::find($id)->delete();

        return redirect()->route('redes.index')
            ->with('success', 'Rede deleted successfully');
    }
}
