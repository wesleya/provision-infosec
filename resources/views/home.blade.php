@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
      @endif
      
      <div class="card">
        <div class="card-header">Provider</div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              <a href="/provider" class="btn btn-primary btn-block">Add Provider</a>
            </div>
          </div>          
        </div>
      </div>

      <br/>

      @if (!empty($application))
      <div class="card">
        <div class="card-header">Active Application</div>
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12">
              name: {{$application->name}}
            </div>
          </div>          
        </div>
      </div>

      <br/>
      @endif

      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Web Goat</div>
            <div class="card-body">
              <a href="app/create/{{App\Application::TYPE_WEBGOAT}}" class="btn btn-primary btn-block">Create</a>          
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card">
            <div class="card-header">Damn Vulnerable Web App</div>
            <div class="card-body">
              <a href="app/create/{{App\Application::TYPE_DVWA}}" class="btn btn-primary btn-block">Create</a>          
            </div>
          </div>
        </div>
      </div>
      

    </div>
  </div>
</div>
@endsection
