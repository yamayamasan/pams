@extends('layouts.app')

@section('content')
<article class="content">
  <div class="items">

    <a href="/setting/monthly_base_infos/new" class="btn btn-primary btn-sm rounded-s">Add New</a>
    @foreach (array_chunk($monthBaseInfo->toArray(), 3) as $infos)
    <div class="row">
      @foreach($infos as $info)
      <div class="col-xs-6 col-md-4">
        <div class="card card-default">
          <div class="card-header">
            <div class="header-block">
              <p class="title">{{ $info['title'] }}</p>
            </div>
          </div>
          <div class="card-block">
            <p>
              {{ $info['term_start_day']}} ~ {{ $info['term_end_day']}}
            </p>
            <div class="btn-group">
              <a href="/setting/monthly_base_infos/edit/{{ $info['uuid'] }}" class="btn btn-primary ">
                edit
              </a>
              <a href="/setting/monthly_base_infos/edit/{{ $info['uuid'] }}" class="btn btn-info ">
                copy
              </a>
              <a href="/setting/monthly_base_infos/edit/{{ $info['uuid'] }}" class="btn btn-success ">
                ON
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endforeach
  </div>
</article>

@endsection
@include('components.settings')
