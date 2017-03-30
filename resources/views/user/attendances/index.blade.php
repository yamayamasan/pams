@extends('layouts.app')

@section('content')
<article class="content">
  <div class="card items">
    @include('components.parts.itemlist-base', [
      'headers' => [
          'month'                => ['class' => 'item-col-header item-col-date'],
          'total work time'      => ['class' => 'item-col-header item-col-title'],
          'avg work time day'    => ['class' => 'item-col-header'],
          'total work day count' => ['class' => 'item-col-header'],
          'action'               => ['class' => 'item-col-header'],
      ],
      'body' => [
         'template' => 'components.parts.itemlist-body.month',
         'params'   => ['monthSummary' => $monthSummary,]
      ]
    ])
  </div>
</article>
@endsection
