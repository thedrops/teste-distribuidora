@extends('layouts.app')
@section('content')
    
    <div class="card col-md-12 ">
    <form action="{{ $data['url'] }}" method="POST">
      {{ csrf_field() }}
      @if($data['model'])
        @method('PUT')
      @endif 
      <div class="card-header">
        <h4>{{$data['title']}}</h4>
      </div>

      <div class="card-body">
        <div class="form-group">
          <div class="form-row">
              <div class="col-md-4">    
                  <label for="name" class="control-label">Nome</label>
                  <input required type="text" name="city[name]" id="name" class="form-control" value="{{ $data['model'] ? $data['model']->name : old('name', "") }}">
                  <label class="errors"> {{ $errors->first('name') }} </label>
              </div>
              <div class="col-md-4">    
                  <label for="latitude" class="control-label">Latitude</label>
                  <input required type="text" name="city[latitude]" id="latitude" class="form-control" value="{{ $data['model'] ? $data['model']->latitude : old('latitude', "") }}">
                  <label class="errors"> {{ $errors->first('latitude') }} </label>
              </div>
              <div class="col-md-4">    
                  <label for="longitude" class="control-label">Longitude</label>
                  <input required type="text" name="city[longitude]" id="longitude" class="form-control" value="{{ $data['model'] ? $data['model']->longitude : old('longitude', "") }}">
                  <label class="errors"> {{ $errors->first('longitude') }} </label>
              </div>
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="form-row">
          <a class="btn btn-light mr-sm-3" href="{{ url('cidades') }}"><i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
          <button type="submit" class="btn btn-success flot">Salvar</button>
        </div>
      </div>
    </form>
    </div>

@endsection