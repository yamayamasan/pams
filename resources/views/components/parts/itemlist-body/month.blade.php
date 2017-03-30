@foreach ($monthSummary as $summary)
<li class="item item-list-header">
  <div class="item-row">
    <div class="item-col item-col-date">
      <div><span>{{ date_to_fmt($summary['year_month'], 'Y/m') }}</span></div>
    </div>
    <div class="item-col item-col-title">
      <div><span>{{ $summary['total_work_time'] ?? '-' }}</span></div>
    </div>
    <div class="item-col">
      <div><span>{{ $summary['avg_work_time_day'] ?? '-'}}</span></div>
    </div>
    <div class="item-col">
      <div><span>{{ $summary['total_work_day_count'] ?? '-'}}</span></div>
    </div>
    <div class="item-col">
      <div>
        <a href="/attendances/month/{{ date_to_url($summary['year_month'], 'Y/m') }}/">detail</a>
      </div>
    </div>
  </div>
</li>
@endforeach
