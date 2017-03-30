@extends('layouts.app')

@section('content')
<article class="content">
  <div class="items">
    <div class="row">
      <div class="col-xs-6 col-md-4">
        <div class="card card-default">
          <div class="card-header">
            <div class="header-block">
              <p class="title">User Account</p>
            </div>
          </div>
          <div class="card-block">
            <a href="/setting/account" class="btn btn-primary btn-lg btn-block">edit</a>
          </div>
          <!-- <div class="card-footer"> Card Footer </div> -->
        </div>
      </div>
      {{-- end card --}}
      <div class="col-xs-6 col-md-4">
        <div class="card card-default">
          <div class="card-header">
            <div class="header-block">
              <p class="title">Monthly Base Infos</p>
            </div>
          </div>
          <div class="card-block">
            <a href="/setting/monthly_base_infos" class="btn btn-primary btn-lg btn-block">edit</a>
          </div>
          <!-- <div class="card-footer"> Card Footer </div> -->
        </div>
      </div>
      {{-- end card --}}
      <div class="col-xs-6 col-md-4">
      </div>
      {{-- end card --}}
    </div>
  </div>
</article>
@endsection
