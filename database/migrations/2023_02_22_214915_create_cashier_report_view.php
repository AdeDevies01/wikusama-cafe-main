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
            create or replace view cashier_report as
            select
                `c`.`id`                            AS `id`,
                `c`.`name`                          AS `name`,
                count(`t`.`id`)                     AS `total_transaction`,
                COALESCE(sum(`t`.`total_price`), 0) AS `total_revenue`
            from (`users` `c` left join `transactions` `t` on (`t`.`cashier_id` = `c`.`id`))
            where `c`.`role` = 'cashier'
            group by `t`.`cashier_id`, `c`.`id`, `c`.`name`;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('drop view cashier_report');
    }
};
