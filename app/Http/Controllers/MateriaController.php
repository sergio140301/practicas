<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); 
        
        $materias = Materia::with('carrera')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreMateria', 'like', '%' . $txtBuscar . '%'); 
            })
            ->paginate(5);

        return view("catalogos.materias.index", compact("materias", "txtBuscar"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $materias = Materia::paginate(5);
        $materia = new Materia(); 
        $carreras = Carrera::all(); 
        $desabilitado = ""; 
        $accion = "crear"; 
        $txtbtn = "guardar"; 

        return view("catalogos.materias.frm", compact("materias", "materia", "carreras", "desabilitado", "txtbtn", "accion"));
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'idMateria' => 'required|string|max:15|unique:materias,idMateria',
            'nombreMateria' => 'required|string|max:255',
            'nivel' => 'nullable|string|max:50',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:50',
            'modalidad' => 'nullable|string|max:50',
            'carrera_id' => 'required|exists:carreras,id', // Validar que exista la carrera
        ]);

        // Crear la materia con los datos validados
        Materia::create($validatedData);

        return redirect()->route('materias.index')->with('success', 'Materia creada con éxito!!!');
    }

    public function show(Materia $materia)
    {
        $carreras = \App\Models\Carrera::all();
        $materias = Materia::paginate(5);
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.materias.frm', compact('materias', "materia", 'accion', 'txtbtn', 'desabilitado', 'carreras'));
    }

    public function edit(Materia $materia)
    {
        $materias = Materia::all(); 
        $carreras = Carrera::all(); 
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = ""; 
        return view('catalogos.materias.frm', compact('materias', 'materia', 'carreras', 'accion', 'desabilitado', 'txtbtn'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materia $materia)
    {
        // Validar los datos entrantes
        $validando = $request->validate([
            'idMateria' => 'required|string|max:15|unique:materias,idMateria,' . $materia->id,
            'nombreMateria' => 'required|string|max:255',
            'nivel' => 'nullable|string|max:50',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:50',
            'modalidad' => 'nullable|string|max:50',
            'carrera_id' => 'required|exists:carreras,id', // Validar que exista la carrera
        ]);

        // Actualizar la materia
        $materia->update($validando);

        return redirect()->route('materias.index')->with('success', 'Materia modificada exitosamente.');
    }

    public function eliminar(Materia $materia)
    {
        $materias = Materia::paginate(5);
        return view('catalogos.materias.eliminar', compact('materias', "materia"));
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
