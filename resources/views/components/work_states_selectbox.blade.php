<div class="form-group">
  <label for="break_time">ステータス</label>
  <select id="work_states_id" name="work_states_id" multiple class="form-control">
    @foreach ($workStates as $workState)
    <option value="{{ $workState->id }}" @if($workState->id == $state) selected @endif>{{$workState->title}}</option>
    @endforeach
  </select>
</div>
