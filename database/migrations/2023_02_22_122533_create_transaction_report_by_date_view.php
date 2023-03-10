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
            create or replace view transaction_report_by_date as
            select
                cast(`t`.`created_at` as date)             AS `date`,
                count(`t`.`id`)                            AS `total_transaction`,
                COALESCE(sum(`t`.`total_price`), 0)        AS `total_revenue`
            from `transactions` `t`
            where `t`.`is_paid` = 1
            group by cast(`t`.`created_at` as date)
            order by cast(`t`.`created_at` as date);
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('drop view transaction_report_by_date');
    }
};
