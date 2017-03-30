<?php

return [
  ['label' => '日付', 'type' => 'text', 'name' => 'date_at', 'value' => '??'],
  ['label' => '出勤時間', 'type' => 'time', 'name' => 'begin_time', 'value' => 'isset(%value%)? fmt_time(%value%) : ""'],
  ['label' => '退勤時間', 'type' => 'time', 'name' => 'end_time', 'value' => 'isset(%value%)? fmt_time(%value%) : ""'],
  ['label' => '休憩時間', 'type' => 'time', 'name' => 'break_time', 'value' => 'isset(%value%)? fmt_time(%value%) : ""'],
  ['label' => '備考', 'type' => 'textarea', 'name' => 'note', 'value' => '??'],
];
