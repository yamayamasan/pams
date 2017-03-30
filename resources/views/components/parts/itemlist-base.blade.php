<ul class="item-list striped">
  {{-- head --}}
  @include('components.parts.itemlist-head.base', ['headers' => $headers])

  {{-- items --}}
  @if ($body['template'])
    @include($body['template'], $body['params'])
  @else
    @include('components.parts.itemlist-body.base', $body['params'])
  @endif
</ul>
