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
            $message = $pessoa->name . " cadastrado com sucesso";
            return $this->response($message, $pessoa);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }

    public function update($id, Request $request)
    {
        try {

            $request->validate([
                'name' => 'required | min: 3 | max: 150',
                'cpf' => 'min: 11 | max: 20',
                'contact' => 'max: 20',
            ]);

            $pessoa = Pessoa::find($id);
            $pessoa->update($request->all());

            if (empty($pessoa)) {
                return $this->response('Pessoa não encontrada', null, false, 404);
            }

            $message = $pessoa->name . "atualizado com sucesso";
            return $this->response($message, $pessoa);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pessoa = Pessoa::find($id);
            if(empty($pessoa)) {
                return $this->response('Pessoa não encontrada', null, false, 404);
            }
            $success = Pessoa::destroy($id);
           return $this->response("$pessoa->name excluído com sucesso!", null);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }

    public function show($id) {
        try {

            $pessoa = Pessoa::find($id);

            if (empty($pessoa)) {
                return $this->response('Pessoa não encontrada', null, false, 404);
            }

            $message = "Pessoa ".$pessoa->name . "encontrada com sucesso";
            return $this->response($message, $pessoa);
        } catch (\Exception $exception) {
            return $this->response($exception->getMessage(), null, false, 500);
        }
    }
}

