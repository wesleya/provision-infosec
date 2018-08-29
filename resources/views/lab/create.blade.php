@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card">
        <div class="card-header">{{$application->name}}</div>
          <div class="card-body">
            <form method="POST" action="/lab">
              @csrf

              <div class="form-group">
                <label for="ip">IP address</label>
                <div class="input-group">
                  <input type="text"
                         class="form-control @if ($errors->has('ip')) is-invalid @endif"
                         id="ip" aria-describedby="ipHelp"
                         name="ip"
                         required
                  >
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">My IP</button>
                  </div>
                  <div class="invalid-feedback">
                    {{$errors->first('ip')}}
                  </div>
                </div>
                <small id="ipHelp" class="form-text text-muted">Explain what this is and why we do it. maybe a link to more details in faq?</small>
              </div>

              <div class="form-group">
                  <label for="ttl">Time to live</label>
                  <select class="form-control @if ($errors->has('ttl')) is-invalid @endif"
                          id="ttl"
                          name="ttl"
                          required
                  >
                    <option value="1">1 hour</option>
                    <option value="2">2 hours</option>
                    <option value="3">3 hours</option>
                    <option value="4">4 hours</option>
                    <option value="5">5 hours</option>
                  </select>
                  <div class="invalid-feedback">{{$errors->first('ttl')}}</div>
                  <small id="ttlHelpBlock" class="form-text text-muted">
                    Explain what this is and why we do it. maybe a link to more details in faq?
                  </small>
              </div>

              <input type="hidden" name="type" value="{{$application->id}}">
              <input class="btn btn-primary btn-block" type="submit" value="Create">
            </form>            
          </div>
        </div>
      <div>
    </div>
  </div>
</div>
@endsection
