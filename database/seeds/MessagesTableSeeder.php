<?php

use Illuminate\Database\Seeder;
use App\Models\Message;

class MessagesTableSeeder extends Seeder
{
    public function run()
    {
        $messages = factory(Message::class)->times(50)->make()->each(function ($message, $index) {
            if ($index == 0) {
                // $message->field = 'value';
            }
        });

        Message::insert($messages->toArray());
    }

}

