<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class BaseController
{

    protected $classe;

    public function index(Request $request)
    {
        return $this->classe::paginate($request->per_page);
    }

    public function show(int $id)
    {
        $serie = $this->classe::find($id);

        if (is_null($serie)) {
            return response()->json('', 204);
        }

        return response()->json($serie);
    }

    public function store(Request $request)
    {
        return response()->json($this->classe::create($request->all()), 201);
    }

    public function update(int $id, Request $request)
    {
        $recurso = $this->classe::find($id);
        if (is_null($recurso)) {
            return response()->json(['erro' => 'Recurso não encontrada'], 404);
        }
        $recurso->fill($request->all());
        $recurso->save();
        return response()->json($recurso);
    }

    public function destroy(int $id)
    {
        $qtdRecursos = $this->classe::destroy($id);
        if($qtdRecursos === 0){
            return response()->json(['erro' => 'Recurso não encontrada'], 404);
        }
        return response()->json('', 204);
    }

}
