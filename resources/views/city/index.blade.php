@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="card">
      <div class="card-header">
        <div class="float-left">
          <b>Cidades</b>
        </div>
        <div class="float-right">
            <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalCreateCity" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Nova Cidade</button>
        </div>
      </div>
      <div class="card-body ">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Latitude</th>
              <th>Longitude</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
          @foreach($data['cities'] as $item)
            <tr>
              <td>{{$item->name}}</td>
              <td>{{$item->latitude}}</td>
              <td>{{$item->longitude}}</td>
              <td>
                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-info mr-2" href='{{ url("cidades/$item->id/edit") }}'><i class="fa fa-edit" aria-hidden="true"></i> Editar</a>
                  </div>
                  <div class="col-md-6">
                    <form action='{{ url("cidades/$item->id") }}' method="POST">
                    {{ csrf_field() }}

                    @method('DELETE')
                    <button class="btn btn-warning" type="submit"><i class="fa fa-trash" aria-hidden="true"></i> Deletar</button>
                    </form>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

    <!-- Modal -->
    <div class="modal fade" id="modalCreateCity" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Nova Cidade</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="create-city">
          <div class="modal-body">
            <div class="form-group">
              <div class="form-row">
                <div class="col-md-4">    
                    <label for="name" class="control-label">Nome</label>
                    <input required type="text" name="city[name]" id="name" class="form-control" >
                </div>
                <div class="col-md-4">    
                    <label for="latitude" class="control-label">Latitude</label>
                    <input required type="text" name="city[latitude]" id="latitude" class="form-control">
                </div>
                <div class="col-md-4">    
                    <label for="longitude" class="control-label">Longitude</label>
                    <input required type="text" name="city[longitude]" id="longitude" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit"  class="btn btn-primary">Save changes</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    
@endsection
@section('js')
<script src="{{ asset('js/city/index.js') }}"></script>
@endsection