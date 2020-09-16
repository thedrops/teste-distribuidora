<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{City};

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'cities' => City::all(),
        ];
       
        return view('city.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => null,
            'title' => 'Criação de Cidade',
            'url' => url('cidades'),
        ];
       
        return view('city.form')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $city = City::create($request->city);
        if($city->save()){
            return json_encode(array('status' => 'success', 'message' => 'Cidade cadastrada com sucesso!'));
        }else{
            return json_encode(array('status' => 'error', 'message' => 'Erro ao cadastrar tente novamente'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'model' => City::find($id),
            'title' => 'Edição de Cidade',
            'url' => url("cidades/$id"),
        ];
       
        return view('city.form')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $city =  City::find($id);
        $city->update($request->city);
       
        if($city->save()){
            return redirect('cidades')->with('success', 'Cidade atualizada com sucesso!');
        }else{
            return back()->with('error','Erro de atualização');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
