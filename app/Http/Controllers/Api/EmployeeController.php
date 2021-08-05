<?php

namespace App\Http\Controllers\Api;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Muestra todas las empleados que  estan activos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees= Employee::where('state','1')->get();
        return response()->json($employees,201);
    }

    /**
     * Agrega el empleado con su respectiva empresa
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

        return response()->json($employee,201);
    }

    /**
     *Muesta los datos del empleado con su respectivo identificador
     *
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return $employee;
    }

    /**
     * Actualiza los datos recibidos desde el api  validando que los datos no se repitan
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Employee $employee
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

        return response()->json($employee,201);
    }

    /**
     *
     * cambia de estado del empleado
     * @param  Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->state="0";

        $employee->save();
    }
}
