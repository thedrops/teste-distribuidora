@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Rotas</div>

                <div class="card-body">
                  <form action="{{url('verificar-rotas')}}" enctype="multipart/form-data" method="POST">
                  {{ csrf_field() }}


                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4"> 
                                <label for="file">Arquivo</label>   
                                <div class="custom-file">
                                    <input required type="file" name='file' class="custom-file-input" id="file">
                                    <label class="custom-file-label" for="file">Choose file</label>
                                </div>
                            </div>
                            <div class="col-md-4">    
                                <label for="initial_city" class="control-label">Cidade Inicial</label>
                                <select name="initial_city" id="initial_city" class="form-control" >
                                    <option selected disabled value="">Selecione uma cidade inicial</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">    
                                <label for="final_city" class="control-label">Cidade Final</label>
                                <select name="final_city" id="final_city" class="form-control" >
                                    <option selected disabled value="">Selecione uma cidade final</option>
                                    @foreach($data['cities'] as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="float-right">
                        <button class='btn btn-primary' type="submit">Enviar</button>
                    </div>
                  </form>

                  @if($data['array'])
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h5>Melhor Rota</h5>
                        </div>
                    </div>
                    <table class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Cidade A</th>
                                <th>Cidade B</th>
                                <th>Distância</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['array'] as $rota)
                                <tr>
                                    <td>{{$rota[0]}}</td>
                                    <td>{{$rota[1]}}</td>
                                    <td>{{$rota[2]}} Km</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                  @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
