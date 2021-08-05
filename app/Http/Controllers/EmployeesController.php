<?php

namespace App\Http\Controllers;

use App\Company;
use App\Employee;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Muestra todas las empleados que  estan activos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $employees= Employee::where('state','1')->get();
       return view('Employee.index',compact('employees'));
    }

    /**
     * Redirecciona a la vita create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::where('state','1')->get();

        return view('Employee.create',compact('companies'));
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
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'email|unique:employees,email',


        ]);

        $employee= Employee::create($request->all());
        //realiza la erespectiva asociacin del empleado a la empresa
        $employee->company_id=$request->company;

        $employee->save();

        return redirect()->route('employee.index')->with('status_success','Empleado Agregado con Exito');

    }

    /**
     * Redirecciona a la vista de editar empleado con los datos de este
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $companies=Company::where('state','1')->get();

        return view('Employee.edit',compact('companies','employee'));
    }

    /**
     * Actualiza los datos recibidos desde el front  validando que los datos no se repitan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'email|unique:employees,email,'.$employee->id,
        ]);

        $employee->update($request->all());
        //valida si la empresa fue modificada de lo contrario no realiza ninguna funcion
        if ($employee->company_id != $request->company )
        {
            $employee->company_id=$request->company;
        }

        $employee->save();

        return redirect()->route('employee.index')->with('status_success','Empleado Editado con Exito');
    }

    /**
     *  cambia de estado del empleado
     *
     * @param  Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->state="0";

        $employee->save();

        return redirect()->route('employee.index')->with('status_success','Empleado desvinculado con Exito');
    }
}
