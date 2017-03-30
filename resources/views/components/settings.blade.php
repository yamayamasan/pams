<ul class="nav nav-pills nav-stacked">
  <li role="presentation" @if (match_current_url('/setting')) class="active" @endif><a href="/setting">Home</a></li>
  <li role="presentation" @if (match_current_url('/setting/monthly_base_infos')) class="active" @endif><a href="/setting/monthly_base_infos">month base</a></li>
  <li role="presentation" @if (match_current_url('/setting/account')) class="active" @endif><a href="/setting/account">my account</a></li>
</ul>
