<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Resources\CidadeColletion;
use Illuminate\Support\Facades\Validator;

class CidadeController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cidades = Cidade::all();
        
        return $this->sendResponse(new CidadeColletion($cidades), 'cidades encontradas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cidadeInstace =  new Cidade();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_estado' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }

        $cidade = Cidade::create($request->only($cidadeInstace->getFillable()));
        
        return $this->sendResponse($cidade, 'cidade criada com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cidade $cidade)
    {
        $cidadeInstace =  new Cidade();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_estado' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }

        $cidade = $cidade->update($request->only($cidadeInstace->getFillable()));
        
        return $this->sendResponse($cidade, 'cidade criada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cidade  $cidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cidade $cidade)
    {
        $cidade->delete();

        return $this->sendResponse($cidade,'produto deletado com sucesso');
    }
}
