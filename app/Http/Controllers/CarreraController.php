<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); 
    
        $carreras = Carrera::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreCarrera', 'like', '%' . $txtBuscar . '%'); 
            })
            ->paginate(5);
    
        return view("catalogos.carreras.index", compact("carreras", "txtBuscar")); 
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamentos = \App\Models\Depto::all(); // Obtener todos los departamentos
        $carreras = Carrera::paginate(5);
        $carrera = new Carrera();
        $desabilitado = "";
        $accion = "crear";
        $txtbtn = "guardar";

        return view("catalogos.carreras.frm", compact("carreras", "carrera", "desabilitado", "txtbtn", "accion", "departamentos"));
    }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nombreCarrera' => 'required|string|max:200|unique:carreras',
        'nombreMediano' => 'nullable|string|max:50|unique:carreras',
        'nombreCorto' => 'nullable|string|max:5|unique:carreras',
        'depto_id' => 'required|exists:deptos,id', 
    ]);

    // Generar un idCarrera único
    $numeroBase = 'C' . str_pad((Carrera::count() + 1), 3, '0', STR_PAD_LEFT);
    $letrasAleatorias = strtoupper(substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 3));
    $validatedData['idCarrera'] = $numeroBase . $letrasAleatorias;

    Carrera::create($validatedData);

    return redirect()->route('carreras.index')->with('success', 'Carrera creada con éxito');
}
    

    public function show(Carrera $carrera)
    {
        $carreras = Carrera::paginate(5);
        $departamentos = \App\Models\Depto::all(); 
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.carreras.frm', compact('carreras', "carrera", 'accion', 'txtbtn', 'desabilitado', 'departamentos'));
    }

    public function edit(Carrera $carrera)
    {
        $departamentos = \App\Models\Depto::all(); // Obtener todos los departamentos

          
        $carreras = Carrera::paginate(5);
        
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.carreras.frm', compact('carreras', 'carrera', 'accion', 'desabilitado', 'txtbtn', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
      
        $validando = $request->validate([
            'nombreCarrera' => 'required|string|max:50',
            'nombreMediano' => 'nullable|string|max:7',
            'nombreCorto' => 'nullable|string|max:5',
            'idDepto' => 'required|exists:deptos,idDepto',
        ]);

        // Actualizar la carrera
        $carrera->update($validando);

        return redirect()->route('carreras.index')->with('success', 'Carrera modificada exitosamente.');
    }

    public function eliminar(Carrera $carrera)
    {
        $carreras = Carrera::paginate(5);
        return view('catalogos.carreras.eliminar', compact('carreras', "carrera"));
    }

    public function destroy(Carrera $carrera)
    {
        $carrera->delete();
        return redirect()->route('carreras.index')->with('success', 'Carrera eliminada exitosamente.');
    }
}
