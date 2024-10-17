<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use App\Models\Carrera;

class AlumnoController extends Controller
{
  // Propiedad para un arreglo.
  public $validado;

  public function __construct()
  {
           $this->validado = [
          'noctrl' => 'required|max:8',
          'nombre' => 'required|max:50',
          'apellidop' => 'required|max:50',
          'apellidom' => 'required|max:50',
          'sexo' => 'required|in:M,F',
          'email' => 'required|email',
          'carrera_id' => 'required|exists:carreras,id',
      ];
  }

  public function index()
  {

      $alumnos = Alumno::with('carrera')->paginate(5);
      return view("catalogos.alumnos2.index", compact("alumnos"));
  }

  public function create()
  {
      $carreras = Carrera::all(); 
      $alumnos = Alumno::Paginate(5);
      $alumno = new Alumno;
      $desabilitado = "";
      $accion = "crear";
      $txtbtn = "guardar";
      return view("catalogos.alumnos2.frm", compact("alumnos", "alumno", "accion", "txtbtn", 'desabilitado', 'carreras'));

  }
  public function store(Request $request)
  {
    
      //VALIDAR DATOS + CONSTRUCTOR
      $validado = $request->validate($this->validado);
      Alumno::create($validado);

      // Alumno::create($request()->all());

      return redirect()->route("alumnos2.index")->with('success', 'Alumno created sucessfully.');
      ;

  }

  public function show(Alumno $alumno)
  {
      $alumnos = Alumno::paginate(5);
      $carreras = \App\Models\Carrera::all(); // Obtener todas las carreras
      $accion = "ver";
      $txtbtn = "ver";
      $desabilitado = "disabled";
  
      return view('catalogos.alumnos2.frm', compact('alumnos', 'alumno', 'carreras', 'accion', 'txtbtn', 'desabilitado'));
  }
  

  public function edit(Alumno $alumno)
  {
      $alumnos = Alumno::paginate(5);
      $carreras = \App\Models\Carrera::all(); // Obtener todas las carreras
      $accion = "actualizar";
      $txtbtn = "Actualizar Datos";
      $desabilitado = "";
  
      return view("catalogos.alumnos2.frm", compact('alumnos', 'alumno', 'carreras', 'accion', 'txtbtn', 'desabilitado'));
  }
  



  public function update(Request $request, Alumno $alumno)
  {

      $validado = $request->validate($this->validado);

      $alumno->update($validado);
      

      return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
  }


  public function eliminar(Alumno $alumno)
  {
      $alumnos = Alumno::Paginate(5);
      return view('catalogos.alumnos2.eliminar', compact('alumnos', 'alumno'));

  }


  public function destroy(Alumno $alumno)
  {
      $alumno->delete();
      return redirect()->route('alumnos.index')->with('success', 'Alumno deleted sucessfully.');

  }
}
