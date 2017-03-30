@extends('layouts.app')

@section('content')
<article class="content">
  <div class="row sameheight-container">
    <div class="card card-block sameheight-item">
      <form action="{{ $actionUrl }}" method="POST">

        {{ csrf_field() }}

        @include('components.parts.form-input-base', [
          'id' => 'title',
          'label' => 'タイトル',
          'placeholder' => 'タイトル',
          'value' => $info['title'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'term_start_day',
          'label' => '適用開始日',
          'placeholder' => '適用開始日',
          'value' => $info['term_start_day'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'term_end_day',
          'label' => '適用終了日',
          'placeholder' => '適用終了日',
          'value' => $info['term_end_day'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'total_base_work_time',
          'label' => '基準勤務時間',
          'placeholder' => '160',
          'value' => $info['total_base_work_time'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'total_lowest_work_time',
          'label' => '最低勤務時間',
          'placeholder' => '140',
          'value' => $info['total_lowest_work_time'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'total_highest_work_time',
          'label' => '最高勤務時間',
          'placeholder' => '180',
          'value' => $info['total_highest_work_time'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'base_attend_time',
          'label' => '出勤時間',
          'placeholder' => '09:00',
          'value' => $info['base_attend_time'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'base_leaving_time',
          'label' => '退勤時間',
          'placeholder' => '18:00',
          'value' => $info['base_leaving_time'] ?? '',
        ])
        @include('components.parts.form-input-base', [
          'id' => 'base_break_time',
          'label' => '休憩時間',
          'placeholder' => '01:00',
          'value' => $info['base_break_time'] ?? '',
        ])

        <button type="submit" class="btn btn-oval btn-primary">Submit</button>

      </form>
    </div>
  </div>
</article>
@endsection
