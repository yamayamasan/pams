<ul class="item-list striped" id="itemlist">

  <li class="item item-list-header">
    <div class="item-row">
        <div class="item-col item-col-header item-col-title"><div><span>date</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>state</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>begin</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>end</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>break</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>work</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>edit</span></div></div>
        <div class="item-col item-col-header item-col-title"><div><span>done</span></div></div>
    </div>
  </li>

  @foreach ($dateList as $dateData)
  <li class="item item-list-header">
    <div class="item-row @if(date_dotweek($dateData['date_at']) === 0) week sun @elseif(date_dotweek($dateData['date_at']) === 6) week sat @endif">

        <div class="item-col item-col-header item-col-title">
          <div><span>{{ $dateData['date_at'] }}({{ $dateData['dotweek'] }})</span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
            <div><span>{{ $dateData['work_state'] ?? '-'}}</span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><span>{{ fmt_time($dateData['begin_time']) ?? '-'}}</span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><span>{{ fmt_time($dateData['end_time'])  ?? '-'}}</span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><span>{{ fmt_time($dateData['break_time'])  ?? '-'}}</span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><span>
            {{ $dateData['work_time']  ?? '-'}}
            @if (empty($dateData['work_time']) && !is_null($dateData['fore_work_time']))
            ({{ $dateData['fore_work_time'] }})
            @endif
          </span></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><a href="/attendances/day/{{ date_to_url($dateData['date_at']) }}">edit</a></div>
        </div>
        <div class="item-col item-col-header item-col-title">
          <div><a href="/attendances/update/day/status/{{ date_to_url($dateData['date_at']) }}">done</a></div>
        </div>

    </div>
  </li>
  @endforeach
</ul>
