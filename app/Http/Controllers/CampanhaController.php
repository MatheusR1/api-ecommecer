<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\CampanhaColletion;
use App\Models\Campanha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CampanhaController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campanha = Campanha::all();

        return $this->sendResponse( new CampanhaColletion($campanha), 'campanhas encontradas');
    }

    public function show( Campanha $campanha)
    {
        return $this->sendResponse( new CampanhaColletion($campanha), 'campanha encontrada');        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campanhaInstace =  new Campanha();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_cidade' => 'required',
            'id_campanha' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }
        
        $checkUnique = Campanha::validadorCidadeCampanha($request->only('id_cidade', 'id_campanha'));

        if ($checkUnique){
            return $this->sendError('erro de validacao', 'campanha já cadastrada', 401);       
        }

        $campanha = Campanha::create($request->only($campanhaInstace->getFillable()));
        
        return $this->sendResponse( new CampanhaColletion($campanha), 'camapanha inserida com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campanha  $campanha
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campanha $campanha)
    {
        $campanhaInstace =  new Campanha();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_cidade' => 'required',
            'id_campanha' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }
        
        $checkUnique = Campanha::validadorCidadeCampanha($request->only('id_cidade', 'id_campanha'));

        if ($checkUnique){
            return $this->sendError('erro de validacao', 'campanha já cadastrada', 401);       
        }

        $campanha->update($request->only($campanhaInstace->getFillable()));
        
        return $this->sendResponse( new CampanhaColletion($campanha), 'campanha atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campanha  $campanha
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campanha $campanha)
    {
        $campanha->delete();

        return $this->sendResponse([],'campanha deletada');
    }
}
