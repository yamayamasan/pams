<?php

use Illuminate\Database\Seeder;

class WorkStatesInit extends Seeder
{
    const TITLES = [
        ['title' => '出勤', 'off' => 0],
        ['title' => '欠勤', 'off' => 1],
        ['title' => '休日', 'off' => 1],
        ['title' => '早退', 'off' => 0],
        ['title' => '遅刻', 'off' => 0],
        ['title' => '有給', 'off' => 1], 
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::TITLES as $title) {
            DB::table('work_states')->insert([
                'title' => $title['title'],
                'off'   => $title['off'],
            ]);
        }
    }
}
