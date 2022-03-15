<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\GrupoCidadeColletion;
use App\Models\GrupoCidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GrupoCidadeController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $grupoCidades = GrupoCidade::all();

        return $this->sendResponse( new GrupoCidadeColletion($grupoCidades), 'cidades encontradas');
    }

    /**
     * show the resource
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $grupoCidade = GrupoCidade::findOrFail($id);

        return $this->sendResponse( new GrupoCidadeColletion($grupoCidade), 'cidade encontrada');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupoCidadeInstace =  new GrupoCidade();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_cidade' => 'required',
            'id_campanha' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }
        
        $checkUnique = GrupoCidade::validadorCidadeCampanha($request->only('id_cidade', 'id_campanha'));

        if ($checkUnique){
            return $this->sendError('erro de validacao', 'campanha já cadastrada', 401);     
        }

        $grupoCidade = GrupoCidade::create($request->only($grupoCidadeInstace->getFillable()));
        
       return $this->sendResponse( new GrupoCidadeColletion($grupoCidade), 'Grupo de cidades criada com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GrupoCidade  $grupoCidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GrupoCidade $grupoCidade)
    {
        $grupoCidadeInstace =  new GrupoCidade();

        $input = $request->all();

        $validator = Validator::make($input, [
            'id_cidade' => 'required',
            'id_campanha' => 'required',
            'nome' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('erro de validacao', $validator->errors());       
        }
        
        $checkUnique = GrupoCidade::validadorCidadeCampanha($request->only('id_cidade', 'id_campanha'));

        if ($checkUnique){
            return $this->sendError('erro de validacao', 'campanha já cadastrada', 401);       
        }

        $grupoCidade->update($request->only($grupoCidadeInstace->getFillable()));
        
       return $this->sendResponse( new GrupoCidadeColletion($grupoCidade), 'Grupo de cidades atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GrupoCidade  $grupoCidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(GrupoCidade $grupoCidade)
    {
        $grupoCidade->delete();

        return $this->sendResponse(new GrupoCidadeColletion([]),'Grupo de cidades deletado');
    }
}
