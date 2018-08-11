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

            <div class="card">
              <div class="card-header">Application</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <form method="POST" action="/web-application">
                        @csrf
                        <input type="hidden" name="application" value="webgoat">
                        <input class="btn btn-primary btn-block" type="submit">
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
