<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return view('alumnos.index', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alumnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|min:4|max:30|regex:/^[\p{L}\s]+$/u',
        'apellido' => 'required|string|min:4|max:30|regex:/^[\p{L}\s]+$/u',
        'email' => 'required|email',
        'edad' => 'required|integer|min:1',
    ], [
        'nombre.required' => 'El nombre del alumno es obligatorio.',
        'nombre.min' => 'El nombre debe tener al menos 4 caracteres.',
        'nombre.max' => 'El nombre no puede exceder los 30 caracteres.',
        'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
        'apellido.required' => 'El apellido del alumno es obligatorio.',
        'apellido.min' => 'El apellido debe tener al menos 4 caracteres.',
        'apellido.max' => 'El apellido no puede exceder los 30 caracteres.',
        'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Debe ser un correo electrónico válido.',
        'edad.required' => 'La edad es obligatoria.',
        'edad.integer' => 'La edad debe ser un número entero.',
        'edad.min' => 'La edad debe ser un número positivo.',
    ]);

    Alumno::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'edad' => $request->edad,
    ]);

    return redirect()->route('alumnos.index')->with('success', 'Alumno creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Alumno $alumno)
    {
        return view('alumnos.show', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alumno = Alumno::findOrFail($id);
        return view('alumnos.edit', compact('alumno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|min:4|max:30|regex:/^[\p{L}\s]+$/u',
            'apellido' => 'required|string|min:4|max:30|regex:/^[\p{L}\s]+$/u',
            'email' => 'required|email',
            'edad' => 'required|integer|min:1',
        ], [
            // Mensajes de error personalizados
        ]
        , [
            'nombre.required' => 'El nombre del alumno es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 4 caracteres.',
            'nombre.max' => 'El nombre no puede exceder los 30 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'apellido.required' => 'El apellido del alumno es obligatorio.',
            'apellido.min' => 'El apellido debe tener al menos 4 caracteres.',
            'apellido.max' => 'El apellido no puede exceder los 30 caracteres.',
            'apellido.regex' => 'El apellido solo puede contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe ser un correo electrónico válido.',
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un número entero.',
            'edad.min' => 'La edad debe ser un número positivo.',
        ]);        

        $alumno = Alumno::findOrFail($id);

        $alumno->nombre = $request->nombre;
        $alumno->apellido = $request->apellido;
        $alumno->email = $request->email;
        $alumno->edad = $request->edad;

        $alumno->save();

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
