@extends('master')

@section('content')
<div class="row">
 <div class="col-md-12">
  <br />
  <h3 aling="center">Ajouter un client</h3>
  <br />
  @if(count($errors) > 0)
  <div class="alert alert-danger">
   <ul>
   @foreach($errors->all() as $error)
    <li>{{$error}}</li>
   @endforeach
   </ul>
  </div>
  @endif
  @if(\Session::has('success'))
  <div class="alert alert-success">
   <p>{{ \Session::get('success') }}</p>
  </div>
  @endif

    <form method="post" action="{{ route('client.store') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" />
    </div>
    <div class="form-group">
        <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" />
    </div>
    <div class="form-group">
        @can ('view_page_admin')
            <input type="radio"  name="type" value="residentiel" id="radioResidentiel" />
            <label for="radioResidentiel">Client résidentiel</label>
            <input type="radio"  name="type" value="affaire" id="radioAffaire" />
            <label for="radioAffaire">Client d'affaire</label>
        @endcan

        @can ('view_page_prep_residentiels')
            <input type="radio" name="type" value="residentiel" checked hidden />
        @endcan

        @can ('view_page_prep_affaire')
            <input type="radio" name="type" value="affaire" checked hidden />
        @endcan
        
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" />
    </div>
    </form>
 </div>
</div>
@endsection