<?php

namespace App\Http\Controllers;

use App\Models\Depto;
use App\Models\Carrera;
use Illuminate\Http\Request;

class DeptoController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); 
    
        $departamentos = Depto::with('carreras.alumnos')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreDepto', 'like', '%' . $txtBuscar . '%'); 
            })
            ->paginate(5);
    
        return view("catalogos.deptos.index", compact("departamentos", "txtBuscar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamentos = Depto::paginate(5);
        $depto = new Depto(); 
        $desabilitado = ""; 
        $accion = "crear"; 
        $txtbtn = "guardar"; 
    
        return view("catalogos.deptos.frm", compact("departamentos", "depto", "desabilitado", "txtbtn", "accion"));
    }
    

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'idDepto' => 'required|string|max:10',
            'nombreDepto' => 'required|string|max:255',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:50',
            // Agrega otras validaciones necesarias aquí
        ]);
    
        // Crear el departamento con los datos validados
        Depto::create($validatedData);
    
        return redirect()->route('deptos.index')->with('success', 'Departamento creado con éxito');
    }
    

    public function show(Depto $depto)
    {
        $departamentos = Depto::paginate(5);
        $accion = "actualizar";
        $txtbtn = "Eliminar Datos";
        $desabilitado = "disabled";
        return view('catalogos.deptos.frm', compact('departamentos', "depto" ,'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Depto $depto)
    {
        $departamentos = Depto::all(); 
        $carrera = Carrera::where('depto_id', $depto->idDepto)->first(); 
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = ""; 
        return view('catalogos.carreras.frm', compact('departamentos', 'carrera', 'accion', 'desabilitado', 'txtbtn'));
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depto $depto)
    {
        // Validar los datos entrantes
        $validando = $request->validate([
            'idDepto' => 'required|string|max:10',
            'nombreDepto' => 'required|string|max:255',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:10',
        ]);
    
        // Actualizar el departamento
        $depto->update($validando);
    
        return redirect()->route('deptos.index')->with('success', 'Departamento modificado exitosamente.');
    }
    
    public function eliminar(Depto $depto)
    {
        $departamentos = Depto::paginate(5);
        return view('catalogos.deptos.eliminar', compact('departamentos', "depto"));
    }

    public function destroy(Depto $depto)
    {
        $depto->delete();
        return redirect()->route('deptos.index')->with('success', 'Departamento eliminado exitosamente.');
    }
}
