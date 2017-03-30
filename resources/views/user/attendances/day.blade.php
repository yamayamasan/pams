@extends('layouts.app')

@section('content')
<article class="content">
  <div class="row sameheight-container">
    <div class="card card-block sameheight-item">
      <form action="{{ $actionUrl }}" method="{{ $method }}">
        {{ csrf_field() }}

        <div class="form-group">
          <label class="control-label" for="date_at">日付</label>
          <input type="text" class="form-control underlined"  id="date_at" placeholder="" name="date_at" value="{{ $attendance['date_at'] ?? ''}}">
        </div>

        <div class="form-group row">
          <div class="col-xs-12 col-md-4">
            <label class="control-label" for="begin_time">出勤時間</label>
            <input type="time" class="form-control underlined" id="begin_time" placeholder="09:00" name="begin_time" value="{{ isset($attendance['begin_time'])? fmt_time($attendance['begin_time']) : ''}}">
          </div>
          <div class="col-xs-12 col-md-4">
            <label class="control-label" for="end_time">退勤時間</label>
            <input type="time" class="form-control underlined" id="end_time" placeholder="18:00" name="end_time" value="{{ isset($attendance['end_time'])? fmt_time($attendance['end_time']) : ''}}">
          </div>
          <div class="col-xs-12 col-md-4">
            <label class="control-label" for="break_time">休憩時間</label>
            <input type="time" class="form-control underlined" id="break_time" placeholder="01:00" name="break_time" value="{{ isset($attendance['break_time'])? fmt_time($attendance['break_time']) : ''}}">
          </div>
        </div>

        <div class="form-group">
          <label class="control-label" for="note">備考</label>
          <textarea id="note" name="note" class="form-control underlined" rows="2" placeholder="作業内容など">{{ $attendance['note'] ?? ''}}</textarea>
        </div>

        @include('components.work_states_selectbox', ['workStates' => $workStates, 'state' => $attendance['work_states_id'] ?? null])
        {{--
        <div class="form-group">
          <label class="control-label" for="date_at">日付</label>
          <input type="text" class="form-control underlined"  id="date_at" placeholder="" name="date_at" value="{{ $attendance['date_at'] ?? ''}}">
        </div>

        <div class="form-group">
          <label class="control-label" for="begin_time">出勤時間</label>
          <input type="time" class="form-control underlined" id="begin_time" placeholder="09:00" name="begin_time" value="{{ isset($attendance['begin_time'])? fmt_time($attendance['begin_time']) : ''}}">
        </div>

        <div class="form-group">
          <label class="control-label" for="end_time">退勤時間</label>
          <input type="time" class="form-control underlined" id="end_time" placeholder="18:00" name="end_time" value="{{ isset($attendance['end_time'])? fmt_time($attendance['end_time']) : ''}}">
        </div>

        <div class="form-group">
          <label class="control-label" for="break_time">休憩時間</label>
          <input type="time" class="form-control underlined" id="break_time" placeholder="01:00" name="break_time" value="{{ isset($attendance['break_time'])? fmt_time($attendance['break_time']) : ''}}">
        </div>

        <div class="form-group">
          <label class="control-label" for="note">備考</label>
          <textarea id="note" name="note" class="form-control underlined" rows="2" placeholder="作業内容など">{{ $attendance['note'] ?? ''}}</textarea>
        </div>

        @include('components.work_states_selectbox', ['workStates' => $workStates, 'state' => $attendance['work_states_id'] ?? null])

        --}}
        <button type="submit" class="btn btn-oval btn-primary">Submit</button>
      </form>
    </div>
  </div>
</article>
@endsection
