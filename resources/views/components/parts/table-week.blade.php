<script>
{
  /*
  setTimeout(function() {
  var el = document.querySelector('.week-day-block');
  el.onclick = function() {
  console.log(document.querySelector('#dashboard_form_day'));
  document.querySelector('#dashboard_form_day').classList.add('in');
  document.querySelector('#dashboard_form_day').style.display = 'block';
  document.querySelector('body').classList.add('modal-open');
};
}, 2000);
*/
}
</script>
<div class="table-responsive" id="table">
  <table class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        @foreach ($dateList as $dateData)
        <th>
          <a href="/attendances/day/{{ date_to_url($dateData['date_at']) }}">
            {{ $dateData['date_at'] }}({{ $dateData['dotweek'] }})
          </a>
        </th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      <tr>
        @foreach ($dateList as $dateData)
        <td class="week-day-block">
          {{ fmt_time($dateData['begin_time']) ?? '-'}} ~ {{ fmt_time($dateData['end_time'])  ?? '-'}}
        </td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>
@include('components.parts.day-modal', ['openModalId' => 'dashboard_form_day'])
