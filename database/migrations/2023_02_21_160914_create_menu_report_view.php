<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            create or replace view menu_report as
            select
                `m`.`id`                                  AS `id`,
                `m`.`name`                                AS `name`,
                `m`.`category_id`                         AS `category_id`,
                COALESCE(sum(`o`.`qty`), 0)               AS `total_sold`,
                COALESCE(sum(`o`.`qty` * `m`.`price`), 0) AS `total_revenue`
            from (`menus` `m` left join `orders` `o` on (`o`.`menu_id` = `m`.`id`))
            group by `o`.`menu_id`, `m`.`id`, `m`.`name`, `m`.`category_id`;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('drop view menu_report');
    }
};
