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
            create or replace view menu_report_by_date as
            select
                cast(`o`.`created_at` as date)               AS `date`,
                sum(if(`m`.`category_id` = 1, `o`.`qty`, 0)) AS `total_drink_sold`,
                sum(if(`m`.`category_id` = 2, `o`.`qty`, 0)) AS `total_food_sold`,
                sum(if(`m`.`category_id` = 3, `o`.`qty`, 0)) AS `total_snack_sold`
            from (`orders` `o` join `menus` `m` on (`o`.`menu_id` = `m`.`id`))
            group by cast(`o`.`created_at` as date)
            order by cast(`o`.`created_at` as date);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('drop view menu_report_by_date');
    }
};
