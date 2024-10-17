<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idpuesto' => 'required|string|max:255|unique:puestos,idpuesto',
            'nombrepuesto' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
        ];
    }

    public function index()
    {
        $puestos = Puesto::paginate(5);
        return view("catalogos.puestos.index", compact("puestos"));
    }

    public function create()
    {
        $puestos = Puesto::paginate(5);
        $puesto = new Puesto; 
        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.puestos.frm", compact("puestos", "puesto", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        Puesto::create($validado);

        return redirect()->route('puestos.index')->with('success', 'Puesto creado con éxito');
    }

    public function show(Puesto $puesto)
    {
        $puestos = Puesto::paginate(5);
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.puestos.frm', compact('puestos', 'puesto', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Puesto $puesto)
    {
        $puestos = Puesto::paginate(5);
        $accion = "actualizar";
        $desabilitado = "";
        $txtbtn = "Actualizar Datos";
        return view('catalogos.puestos.frm', compact('puestos', 'puesto', 'accion', 'txtbtn' , 'desabilitado'));
    }

    public function update(Request $request, Puesto $puesto)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        
        // Actualizar el puesto
        $puesto->update($validado);
        
        return redirect()->route('puestos.index')->with('success', 'Puesto modificado exitosamente.');
    }

    public function eliminar(Puesto $puesto)
    {
        $puestos = Puesto::paginate(5);
        return view('catalogos.puestos.eliminar', compact('puestos', 'puesto'));
    }

    public function destroy(Puesto $puesto)
    {
        $puesto->delete();
        return redirect()->route('puestos.index')->with('success', 'Puesto eliminado exitosamente.');
    }
}
