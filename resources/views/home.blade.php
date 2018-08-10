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

            <div class="card">
              <div class="card-header">Test</div>
                <div class="card-body">
                  <form method="POST" action="/oauth/digitalocean">
                    @csrf
                    <input class="btn btn-primary" type="submit" value="Digital Ocean">
                  </form>
                  <form method="POST" action="/oauth/linode">
                    @csrf
                    <input class="btn btn-primary" type="submit" value="linode">
                  </form>
                </div>
              </div>
            <div>

            </div>
        </div>
    </div>
</div>
@endsection
