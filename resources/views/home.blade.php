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

      <div class="card-deck">
        <div class="card">
          <div class="card-body">
          <h5 class="card-title">Web Goat</h5>
          <h6 class="card-subtitle mb-2 text-muted"><a href="https://www.owasp.org">By Owasp</a></h6>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <a href="https://github.com/WebGoat/WebGoat" class="card-link">Documentation</a>
            <a href="app/create/{{App\Application::TYPE_WEBGOAT}}" class="card-link btn btn-outline-primary">Create</a>
          </div>
          <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>       
          </div>
        </div>

        <div class="card">
          <div class="card-body">
          <h5 class="card-title">Damn Vulnerable Web App</h5>
          <h6 class="card-subtitle mb-2 text-muted"><a href="https://dewhurstsecurity.com/">By Dewhurst Security</a></h6>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <a href="https://github.com/ethicalhack3r/DVWA" class="card-link">Documentation</a>
            <a href="app/create/{{App\Application::TYPE_DVWA}}" class="card-link btn btn-outline-primary">Create</a>
          </div>
          <div class="card-footer">
          <small class="text-muted">Last updated 3 mins ago</small>       
          </div>
        </div>
  

      </div>

      
    </div>
  </div>
</div>
@endsection
