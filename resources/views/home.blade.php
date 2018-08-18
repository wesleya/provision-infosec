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
      <div>

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
      <div>

      <br/>
      @endif

      <div class="card">
        <div class="card-header">Available Applications</div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-6">
                <form method="POST" action="/web-application">
                  @csrf
                  <input type="hidden" name="type" value="{{App\Application::TYPE_WEBGOAT}}">
                  <input class="btn btn-primary btn-block" type="submit" value="Web Goat">
                </form>
              </div>
              <div class="col-sm-6">
                <form method="POST" action="/web-application">
                  @csrf
                  <input type="hidden" name="type" value="{{App\Application::TYPE_DVWA}}">
                  <input class="btn btn-primary btn-block" type="submit" value="Damn Vulnerable Web Application">
                </form>
              </div>
            </div>          
          </div>
        </div>
      <div>

    </div>
  </div>
</div>
@endsection
