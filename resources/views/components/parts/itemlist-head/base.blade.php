<li class="item item-list-header">
  <div class="item-row">
    @foreach($headers as $label => $options)
    <div class="item-col @if($options['class']) {{ $options['class'] }} @endif">
      <div>
        <span>{{ $label }}</span>
      </div>
    </div>
    @endforeach
  </div>
</li>
