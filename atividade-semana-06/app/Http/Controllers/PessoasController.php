<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa; 

class PessoasController extends Controller
{
    public function index() {
        try {
            $pessoas = Pessoa::all();   
            $message = $pessoas->count()." ". ($pessoas->count() === 1 ? "pessoa encontrada" : "pessoas encontradas")." com sucesso.";
            return $this->response($message, $pessoas);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);   
        }
    }
}
