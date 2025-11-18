<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forms = Form::orderBy('id', 'desc')->paginate(20);
        return view('forms.index', compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            "nombre" => "required|string|max:127", // aca habria que ir uno por uno y poner unas reglas razonables
            "apellido" => "required|string|max:127", // https://laravel.com/docs/8.x/validation#available-validation-rules
            "tel_casa" => "required|numeric|min:8|max:24",
            "celular" => "required|numeric|min:8|max:24",
            "email" => "required|email",
            "direccion" => "required|string|max:255",
            "fecha_nacimiento" => "required",
            "pais_nacimiento" => "required",
            "ciudadania" => "required|string|max:127",
            "tipo_documento" => "required",
            "pasaporte_dni" => "required",
            "cuit" => "required|numeric|between:1:16",
            "estado_civil" => "required",
            "nombre_pareja" => "required_if:estado_civil,casado|max:127",
            "hijos_dependientes" => "required|numeric|min:0|max:30",

            "nombre_contacto" => "string|max:255",   //required_if mayor a 65
            "direccion_contacto" => "string|max:127", 
            "email_contacto" => "email", 
            "nacimiento_contacto" => "string|max:127", 
            "tel_contacto" => "numeric|max:24", 
            

            "ocupacion" => "required|string|max:255",
            "tipo_negocio" => "required|string|max:255",
            "nombre_empresa" => "required|string|max:255",
            "anios_empleo" => "required|numeric|min:0",
            "direccion_empresa" => "required",
            "telefono_empresa" => "required",
            "ingreso_anual" => "required|numeric|min:0",
            "patrimonio" => "required|numeric|min:0",
            "liquidez" => "required",
            "monto_inicial_cuenta" => "required|numeric|min:0",
            "fondeo_cuenta" => "required|string|max:255",
            "banco_fondos" => "required|string|max:255",
            "otros_movimientos" => "required|string|max:2",
            "otros_movimientos_texto" => "required_if:otros_movimientos,si|max:255", // probar
            "activos_*" => "string|max:2", // no se si funca el *
            "instrumentos_*_other" => "string|max:2",
            "instrumentos_*_conocimiento" => "string|max:24",
            "instrumentos_*_anio" => "digits:4",
            "cuenta_otro_banco" => "required|string|max:2",
            "riesgo_exposicion" => "required|string|max:24",
            "pep" => "required|string|max:2",
            "horizonte_temporal" => "required|string|max:127",
        ]);
        
        $form = new Form;
        $form->data = $request->all();
        $form->save();

        // con dd($bar); podés debuggear, te devuelve la variable tal cual.
     
        return view('home')
            ->with('success','Formulario registrado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(Form $form)
    {
        return view('forms.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form)
    {
        $request->validate([
            // validacion...
        ]);

        $form->update($request->all());

        return redirect()->route('forms.index')
            ->with('success', 'Formulario editado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(Form $form)
    {
        // borrar archivo pdf si existe (los datos quedan guardados ya que es un soft delete).

        $form->delete();

        return redirect()->route('forms.index')
            ->with('success','Formulario borrado correctamente');
    }

    /**
     * Generar archivo pdf.
     *
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function generar_pdf(Form $form)
    {
        //
    }
}
