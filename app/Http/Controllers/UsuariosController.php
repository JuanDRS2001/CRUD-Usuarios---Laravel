<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['usuarios'] = Usuarios::paginate(5);
        return view('usuarios.index', $datos);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $imput = [
            'Nombre' => 'required| string | max:100',
            'Apellidos' => 'required| string | max:100',
            'Edad' => 'required| integer | max:100',
            'Email' => 'required| email',
            'Foto' => 'required| max:10000 | mimes:jpeg,png,jpg',
        ];

        $alertas = [
            'required' => 'El :attribute es obligario',
            'Foto.required' => 'La :attribute es obligaria',
            'Edad.required' => 'La :attribute es obligaria',
        ];

        $this->validate($request, $imput,$alertas);

        $datosUsuarios = request()->except('_token');

        if ($request -> hasFile('Foto')) {
            $datosUsuarios['Foto'] = $request -> file('Foto') -> store('uploads', 'public');
        }

        Usuarios::insert($datosUsuarios);

        //retornar un JSON con la info de creación
        // return response()->json($datosUsuarios);

        return redirect('usuarios')->with('mensaje','Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $usuario = Usuarios::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $imput = [
            'Nombre' => 'required| string | max:100',
            'Apellidos' => 'required| string | max:100',
            'Edad' => 'required| integer | max:100',
            'Email' => 'required| email',
        ];

        $alertas = [
            'required' => 'El :attribute es obligario',
            'Edad.required' => 'La :attribute es obligaria',
        ];

        $this->validate($request, $imput,$alertas);

        if ($request -> hasFile('Foto')) {
            $imput = ['Foto' => 'required| max:10000 | mimes:jpeg,png,jpg'];
            $alertas = ['Foto.required' => 'La :attribute es obligaria'];
        }


        $datosUsuarios = request()->except(['_token','_method']);

        if ($request -> hasFile('Foto')) {
            $usuario = Usuarios::findOrFail($id);

            Storage::delete('public/'.$usuario->Foto);
            
            $datosUsuarios['Foto'] = $request -> file('Foto') -> store('uploads', 'public');
        }

        Usuarios::where('id', '=', $id)->update($datosUsuarios); 

        $usuario = Usuarios::findOrFail($id);
        // return view('usuarios.edit', compact('usuario'));

        return redirect('usuarios')->with('mensaje','Usuario modificado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $usuario = Usuarios::findOrFail($id);
        if(Storage::delete('public/'.$usuario->Foto)){
            Usuarios::destroy($id);
        }

        return redirect('usuarios')->with('mensaje','Usuario eliminado con éxito');
    }
}
