<?php

namespace App\Http\Controllers;

use App\Models\Plaza;
use Illuminate\Http\Request;

class PlazaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idplaza' => 'required|string|max:255|unique:plazas,idplaza',
            'nombreplaza' => 'required|string|max:255',
        ];
    }

    public function index()
    {
        $plazas = Plaza::paginate(5);
        return view("catalogos.plazas.index", compact("plazas"));
    }

    public function create()
    {
        $plazas = Plaza::paginate(5);
        $plaza = new Plaza; 
        $desabilitado="";
        $accion = "crear";
        $txtbtn = "guardar";
        return view("catalogos.plazas.frm", compact("plazas", "plaza", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        
        $validado = $request->validate($this->validado);
        Plaza::create($validado);

        return redirect()->route('plazas.index')->with('success', 'Plaza creada con éxito');
    }

    public function show(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.plazas.frm', compact('plazas', 'plaza', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.plazas.frm', compact('plazas', 'plaza', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Plaza $plaza)
    {
      
        $validado = $request->validate($this->validado);
        $plaza->update($validado);
        
        return redirect()->route('plazas.index')->with('success', 'Plaza modificada exitosamente.');
    }

    public function eliminar(Plaza $plaza)
    {
        $plazas = Plaza::paginate(5);
        return view('catalogos.plazas.eliminar', compact('plazas', 'plaza'));
    }

    public function destroy(Plaza $plaza)
    {
        $plaza->delete();
        return redirect()->route('plazas.index')->with('success', 'Plaza eliminada exitosamente.');
    }
}
