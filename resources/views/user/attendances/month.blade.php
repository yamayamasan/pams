@extends('layouts.app')

@section('content')
<article class="content">
  <div class="card items">
    @include('components.parts.itemlist-day', ['datelist' => $dateList])
  </div>

  <div class="">
    <div class="row">
      {{-- 要調整 --}}
      <div class="col-xs-12 col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <div class="header-block">
              <p class="title">Monthly Summary</p>
            </div>
          </div>
          <div class="card-block">
            <p>
              <p>total_work_time: {{ $monthSummary['total_work_time'] }}</p>
              <p>avg_work_time_day: {{ $monthSummary['avg_work_time_day'] }}</p>
              <p>total_work_day_count: {{ $monthSummary['total_work_day_count'] }}</p>
              <p>total_business_day_count:{{ $monthSummary['total_business_day_count'] }}</p>
            </p>
          </div>
        </div>
      </div>
      {{-- 要調整 --}}
      <div class="col-xs-12 col-md-6">
        <div class="card card-default">
          <div class="card-header">
            <div class="header-block">
              <p class="title">Monthly Assumed</p>
            </div>
          </div>
          <div class="card-block">
            <p>
              <p>{{ trans('global.average_working_hours') }}: {{ $assumedDatas['averageWorkHour'] }}</p>
              <p>{{ trans('global.number_business_days') }}: {{ $assumedDatas['businessCount'] }}</p>
              <p>{{ trans('global.days_attendance') }}: {{ $assumedDatas['attendanceCount'] }}</p>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</article>
@endsection
