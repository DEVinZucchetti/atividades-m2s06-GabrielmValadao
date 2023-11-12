<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;

class PessoasController extends Controller

// pega o dado cadastrado
{
    public function index()
    {
        try {
            $pessoas = Pessoa::all();
            $message = $pessoas->count() . " " . ($pessoas->count() === 1 ? "pessoa encontrada" : "pessoas encontradas") . " com sucesso.";
            return $this->response($message, $pessoas);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }

    // salva o dado cadastrado 
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required | min: 3 | max: 150',
                'cpf' => 'min: 11 | max: 20',
                'contact' => 'max: 20',
            ]);

            $pessoa = Pessoa::create($request->all());
            $message = $pessoa->name . "cadastrado com sucesso";
            return $this->response($message, $pessoa);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }

    public function update($id, Request $request) {
        try {

            $request->validate([
                'name' => 'required | min: 3 | max: 150',
                'cpf' => 'min: 11 | max: 20',
                'contact' => 'max: 20',
            ]);

            $pessoa = Pessoa::find($id);
            $pessoa->update($request->all());
            $message = $pessoa->name . "atualizada com sucesso";
            return $this->response($message, $pessoa);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
}
