<?php

namespace Tests\Feature\Http\Controllers\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Se Realizara test para agregar un empleado
     *
     * @return void
     */
    public function test_store()
    {

        $this->withoutExceptionHandling();
        $response = $this->json('POST','/api/employee',[
            'first_name'=>"alvaro",
            'last_name'=>"torres",
            'email'=>"prueba@gmail.com",
            'phone'=>"123456789",
            'company_id'=>"2"
        ]);
        $response->assertJsonStructure(['id','first_name','last_name','email','phone'])
        ->assertJson(['first_name'=>"alvaro"])
        ->assertStatus(201);

        $this->assertDatabaseHas('employees',['first_name'=>'alvaro']);
    }
}
