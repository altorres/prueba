<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
         return response()->json($companies,201);
    }

    /**
     * Recibe los datos por medio del Request y agrega la empresa con su respectiva imagen
     *y los almacena en la base de datos
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

        //Recibe la imagen y la almacena en la ruta storage
        $company= Company::create($request->all());
        $logo =  $request->file('logo')->store('logo/'.$company->id.'/img', 'public');

        $company->logo=$logo;
        $company->save();

        return response()->json($company,201);
    }

    /**
     * Recibe como paramero La empresa y lo devulve con sus respectivos datos
     *
     * @param  Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json($company,201);
    }

    /**
     * Actualiza los datos recibidos desde el front  validando que los datos no se repitan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Company $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name'=>'required|unique:companies,name,'.$company->id,
            'email'=>'email|unique:companies,email,'.$company->id,
            'logo' => ['image','mimes:jpeg,png,jpg,gif,svg','dimensions:min_width=100,min_height=100']

        ]);
        $company-> update($request->all());

        //valida si el logo fue modificado de lo contrario no realiza ninguna funcion
        if($request->file('logo'))
        {
            Storage::disk('public')->delete($company->logo);
            $logo =  $request->file('logo')->store('logo/'.$company->id.'/img', 'public');
            $company->logo=$logo;
        }
        $company->save();

        return response()->json($company,201);
    }

    /**
     * cambia de estado la empresa siempre y cuando no tengga empresas asociadas
     *
     * @param  Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $employee=Employee::where('company_id',$company->id)->exists();

        if (!$employee)
        {
            $company->state='0';

            $company->save();

        }

    }
}
