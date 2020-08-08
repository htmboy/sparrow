<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedThemesData extends Migration
{
    private $table = 'sparrow_themes';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $themes = [
            [
                'name'        => '小道消息',
                'parent_id' => 0,
                'level' => 1,
                'path' => '-',
                'sort' => 1
            ],
            [
                'name'        => '本地向导',
                'parent_id' => 0,
                'level' => 1,
                'path' => '-',
                'sort' => 2
            ],
            [
                'name'        => '物品买卖',
                'parent_id' => 0,
                'level' => 1,
                'path' => '-',
                'sort' => 3
            ],
            [
                'name'        => '招聘信息',
                'parent_id' => 0,
                'level' => 1,
                'path' => '-',
                'sort' => 4
            ],
        ];
        DB::table($this->table)->insert($themes);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table($this->table)->truncate();
    }
}
