<?php

namespace App\Http\Controllers;

use App\Models\Reticula;
use App\Models\Carrera;
use Illuminate\Http\Request;

class ReticulaController extends Controller
{
    public $validado;

    public function __construct()
    {
        $this->validado = [
            'idReticula' => 'required|string|max:15|unique:reticulas,idReticula',
            'Descripcion' => 'required|string|max:200',
            'fechaEnVigor' => 'required|date',
            'carrera_id' => 'required|exists:carreras,id', // Validar existencia de carrera
        ];
    }

    public function index()
    {
        $txtBuscar = request('txtBuscar', '');

        $reticulas = Reticula::with('carrera')
            ->when($txtBuscar, function ($query) use ($txtBuscar) {
                return $query->where('Descripcion', 'like', '%' . $txtBuscar . '%');
            })
            ->paginate(5);

        return view("catalogos.reticulas.index", compact("reticulas", "txtBuscar"));
    }

    public function create()
    {
        $carreras = Carrera::all();
        $reticulas = Reticula::paginate(5);
        $reticula = new Reticula;
        $accion = "crear";
        $txtbtn = "guardar";
        $desabilitado ="";

        return view("catalogos.reticulas.frm", compact("reticulas", "reticula", "accion", "txtbtn", "carreras", "desabilitado"));
    }

    public function store(Request $request)
    {
        $validado = $request->validate($this->validado);
        Reticula::create($validado);
    
        return redirect()->route('reticulas.index')->with('success', 'Retícula creada con éxito');
    }
    
       public function show(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        $accion = "ver";
        $txtbtn = "ver";
        $desabilitado = "disabled";
        $carreras = Carrera::all();
        return view('catalogos.reticulas.frm', compact('reticulas', 'reticula', 'accion', 'txtbtn', 'desabilitado', 'carreras'));
    }

    public function edit(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        $carreras = Carrera::all(); 
        $accion = "actualizar"; 
        $txtbtn = "Actualizar Datos"; 
        $desabilitado = ""; 
    
        return view('catalogos.reticulas.frm', compact('reticulas','reticula', 'accion', 'txtbtn', 'carreras', 'desabilitado'));
    }
    
    public function update(Request $request, $idReticula)
    {
        $validado = $request->validate($this->validado);
    
        $reticula = Reticula::findOrFail($idReticula);

        $reticula->update($validado);

        return redirect()->route('reticulas.index')->with('success', 'Retícula modificada exitosamente.');
    }
    
    

    public function eliminar(Reticula $reticula)
    {
        $reticulas = Reticula::paginate(5);
        return view('catalogos.reticulas.eliminar', compact('reticulas', 'reticula'));
    }

    public function destroy(Reticula $reticula)
    {
        $reticula->delete();
        return redirect()->route('reticulas.index')->with('success', 'Retícula eliminada exitosamente.');
    }
}
