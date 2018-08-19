@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{\App\Application::$names[$type]}}</div>
          <div class="card-body">
            
            <form method="POST" action="/app">
              @csrf
              <input type="hidden" name="type" value="{{$type}}">
              <input class="btn btn-primary btn-block" type="submit" value="Create">
            </form>
                    
          </div>
        </div>
      <div>
    </div>
  </div>
</div>
@endsection
