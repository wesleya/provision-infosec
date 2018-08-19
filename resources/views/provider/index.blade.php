@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">Provider</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-6">
                      <form method="GET" action="/provider/create">
                        @csrf
                        <input class="btn btn-primary btn-block" type="submit" value="Digital Ocean">
                        <input type="hidden" name="type" value="digitalocean">
                      </form>
                    </div>
                    <div class="col-sm-6">
                      <form method="GET" action="/provider/create">
                        @csrf
                        <input class="btn btn-primary btn-block" type="submit" value="linode">
                        <input type="hidden" name="type" value="linode">
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
