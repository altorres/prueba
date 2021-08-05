<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name', 'email', 'website'
    ];
    /*
     * Permite crear un enlace directo en la carpeta de almacenamicento
     */
    public function getGetLogoAttribute()
    {

        if($this->logo){

            return url("storage/$this->logo");
        }
    }
}
