@extends('layouts.app')

@section('content')
<script>
{
  var format = null;
  var target = null;
  setInterval(function(t){
    if (!target) target = document.getElementById('currentTime');
    var time = formatTime(new Date());
    target.innerHTML = time;
  }, 1000);

  function formatTime(date) {
    if (!format) format = 'hh:mm:ss';
    format = format.replace(/hh/g, ('0' + date.getHours()).slice(-2));
    format = format.replace(/mm/g, ('0' + date.getMinutes()).slice(-2));
    format = format.replace(/ss/g, ('0' + date.getSeconds()).slice(-2));
    var res = format;
    format = null;
    return res;
  }
}
{

}
</script>
<article class="content">
  <div class="items">
    {{-- timer --}}
    <div class="card sameheight-item sales-breakdown" data-exclude="xs,sm,lg">
      <div class="card-header">
        <div class="header-block">
          <h3 class="title">Time</h3>
        </div>
      </div>
      <div class="card-block">
        <span id="currentTime"></span>
        <div>
          <button type="button" class="btn btn-oval btn-primary" id="StampStart">Start</button>
        </div>
        <div>
          <button type="button" class="btn btn-oval btn-primary" id="StampEnd">Finish</button>
        </div>
      </div>
    </div>

    {{-- chart --}}
    <div class="card sameheight-item sales-breakdown" data-exclude="xs,sm,lg">
      <div id="dashboard.chart.month"></div>
    </div>

    {{-- week --}}
    <div class="card sameheight-item sales-breakdown" data-exclude="xs,sm,lg">
      <div class="card-header">
        <div class="header-block">
          <h3 class="title">This Week</h3>
        </div>
      </div>
      <div class="card-block">
        @include('components.parts.table-week', ['dateList' => $dateList])
      </div>
    </div>
  </div>
  <!-- <input type="hidden" id="dashboard_data_weekdate" value="<?php echo json_encode($dateList); ?>" /> -->

</div>
</article>
@endsection
