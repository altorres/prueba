<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class CompanyController extends Controller
{
    /**
     * Muestra todas las empresas que tienen estado 1
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Company::where('state','1')->get();

        return view('Company.index', compact('companies'));
    }

    /**
     *redireciona a la vista de crear de la empresa
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Recibe los datos por medio del Request y agrega la empresa con su respectiva imagen
     * y los almacena en la base de datos
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:companies,name',
            'email'=>'email|unique:companies,email',
            'logo' => ['image','mimes:jpeg,png,jpg,gif,svg','dimensions:min_width=100,min_height=100']

        ]);

        $company= Company::create($request->all());
        $logo =  $request->file('logo')->store('logo/'.$company->id.'/img', 'public');

        $company->logo=$logo;
        $company->save();

        return redirect()->route('company.index')->with('status_success','Empresa Agregada con Exito');

    }

    /**
     * Recibe como paramero La empresa y lo devulve con sus respectivos datos
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {

        return view('Company.show',compact('company'));
    }

    /**
     * Actualiza los datos recibidos desde el front  validando que los datos no se repitan
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        Return view('company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Company $company)
    {
        $request->validate([
            'name'=>'required|unique:companies,name,'.$company->id,
            'email'=>'email|unique:companies,email,'.$company->id,
            'logo' => ['image','mimes:jpeg,png,jpg,gif,svg','dimensions:min_width=100,min_height=100']

        ]);

        $company-> update($request->all());
        if($request->file('logo'))
        {
            Storage::disk('public')->delete($company->logo);
            $logo =  $request->file('logo')->store('logo/'.$company->id.'/img', 'public');
            $company->logo=$logo;
        }

        $company->save();

        return redirect()->route('company.index')->with('status_success','Empresa Modificada con Exito');
    }

    /**
     * cambia de estado la empresa siempre y cuando no tengga empresas asociadas
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $employee=Employee::where('company_id',$company->id)->exists();

        if ($employee)
        {
            return redirect()->route('company.index')->with('status_danger','No se puede inactivar esta empresa por que tiene empleados activos');
        }
        else{

            $company->state='0';

            $company->save();
            return redirect()->route('company.index')->with('status_success','Empresa inactiva con Exito');
        }




    }
}
