@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>

            <br/>

            <div class="card">
              <div class="card-header">Provider</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <form method="POST" action="/oauth/digitalocean">
                        @csrf
                        <input class="btn btn-primary btn-block" type="submit" value="Digital Ocean">
                      </form>
                    </div>
                    <div class="col-sm-6">
                      <form method="POST" action="/oauth/linode">
                        @csrf
                        <input class="btn btn-primary btn-block" type="submit" value="linode">
                      </form>
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
</div>
@endsection
