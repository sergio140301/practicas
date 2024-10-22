<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Carrera;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idMateria' => 'required|string|max:15|unique:materias,idMateria',
            'nombreMateria' => 'required|string|max:255',
            'nivel' => 'required|string|max:255',
            'nombreMediano' => 'nullable|string|max:255',
            'nombreCorto' => 'nullable|string|max:255',
            'modalidad' => 'required|string|max:255',
            'carrera_id' => 'required|exists:carreras,id',
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', ''); // Inicializa con un valor por defecto
    
        $materias = Materia::when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('nombreMateria', 'like', '%' . $txtBuscar . '%'); // Filtra por nombre de materia
            })
            ->paginate(5);
    
        return view("catalogos.materias.index", compact("materias", "txtBuscar")); // Pasa $txtBuscar a la vista
    }
    
    public function create()
    {
        $materias = Materia::paginate(5);
        $carreras = Carrera::all(); // Obtener todas las carreras
        $materia = new Materia; 
        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado = "";
        return view("catalogos.materias.frm", compact('materias',"carreras", "materia", "accion", "txtbtn", "desabilitado"));
    }

    public function store(Request $request)
    {
        
        // Validar datos
        $validado = $request->validate($this->validado);
        Materia::create($validado);

        return redirect()->route('materias.index')->with('success', 'Materia creada con éxito');
    }

    public function show(Materia $materia)
    {
        $materias = Materia::paginate(5);
        $carreras = Carrera::all(); // Obtener todas las carreras
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        return view('catalogos.materias.frm', compact('materias','materia', 'carreras', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function edit(Materia $materia)
    {
        $materias = Materia::paginate(5);
        $carreras = Carrera::all(); // Obtener todas las carreras
        $accion = "actualizar";
        $txtbtn = "Actualizar Datos";
        $desabilitado = "";
        return view('catalogos.materias.frm', compact('materia','materias', 'carreras', 'accion', 'txtbtn', 'desabilitado'));
    }

    public function update(Request $request, Materia $materia)
    {
        // Validar datos
        $validado = $request->validate($this->validado);
        
        // Actualizar la materia
        $materia->update($validado);
        
        return redirect()->route('materias.index')->with('success', 'Materia modificada exitosamente.');
    }

    public function eliminar(Materia $materia)
    {
        $materias = Materia::paginate(5);
        $carreras = Carrera::all(); 
        return view('catalogos.materias.eliminar', compact('materia','materias', 'carreras'));
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
