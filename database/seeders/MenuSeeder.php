<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::insert([
            [
                'name' => 'Coffee Americano',
                'price' => 15000,
                'desc' => 'Kopi dengan tambahan air panas, rasa yang kuat dan kental',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cappuccino',
                'price' => 20000,
                'desc' => 'Kopi dengan tambahan susu yang diwhisk, rasa yang lembut dan creamy',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Espresso',
                'price' => 10000,
                'desc' => 'Kopi yang diperas dengan tekanan tinggi, rasa yang kuat dan konsentrasi yang tinggi',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Coffee Latte',
                'price' => 25000,
                'desc' => 'Kopi dengan tambahan susu yang diwhisk dan ditambahkan dengan busa, rasa yang lembut dan creamy',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Mocha',
                'price' => 30000,
                'desc' => 'Kopi dengan tambahan coklat dan susu yang diwhisk, rasa yang lembut dan creamy dengan sentuhan coklat yang kuat',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Caramel Macchiato',
                'price' => 20000,
                'desc' => 'Kopi dengan tambahan susu yang diwhisk, ditambahkan dengan caramel, rasa yang lembut dan creamy dengan sentuhan caramel yang kuat',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Milkshake Chocolate',
                'price' => 25000,
                'desc' => 'Minuman yang terbuat dari es krim coklat yang di blend dengan susu, rasa yang creamy dan chocolaty',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Tea Camomile',
                'price' => 10000,
                'desc' => 'Teh yang diperoleh dari bunga camomile yang di infuse dengan air panas, rasa yang lembut dan menenangkan',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Juice Orange',
                'price' => 15000,
                'desc' => 'Jus jeruk yang diperoleh dari buah jeruk yang diperas, rasa yang asam dan segar',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Boba Brown Sugar',
                'price' => 20000,
                'desc' => 'Minuman yang terbuat dari teh dengan tambahan boba dan gula cair yang diperas dari tebu, rasa yang manis dan segar',
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Sandwich',
                'price' => 25000,
                'desc' => 'Makanan yang terbuat dari roti yang ditambahkan dengan daging, sayuran, dan saus',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pizza',
                'price' => 30000,
                'desc' => 'Makanan yang terbuat dari adonan roti yang diisi dengan saus dan topping seperti daging, sayuran, dan keju',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pasta',
                'price' => 25000,
                'desc' => 'Makanan yang terbuat dari pasta yang diolah dengan saus dan topping seperti daging, sayuran, dan keju',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Burger',
                'price' => 25000,
                'desc' => 'Makanan yang terbuat dari roti yang ditambahkan dengan daging, sayuran, dan saus',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Fried Rice',
                'price' => 20000,
                'desc' => 'Nasi yang digoreng dengan tambahan bahan-bahan seperti telur, daging, sayuran, dan rempah-rempah',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Grilled Chicken',
                'price' => 30000,
                'desc' => 'Ayam yang diolah dengan cara dipanggang dan ditambahkan dengan bumbu dan rempah-rempah',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Kentang Goreng',
                'price' => 15000,
                'desc' => 'Camilan yang terbuat dari kentang yang digoreng dan ditambahkan dengan bumbu, rasa yang gurih dan renyah',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Croffle',
                'price' => 20000,
                'desc' => 'Camilan yang terbuat dari adonan roti yang digoreng dan ditambahkan dengan bumbu, rasa yang manis dan renyah',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Nachos',
                'price' => 10000,
                'desc' => 'Camilan yang terbuat dari tortilla yang digoreng dan ditambahkan dengan saus dan keju, rasa yang gurih dan renyah',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Brownies',
                'price' => 20000,
                'desc' => 'Camilan yang terbuat dari tepung coklat dan mentega, rasa yang manis dan kenyal',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Cheesecake',
                'price' => 25000,
                'desc' => 'Camilan yang terbuat dari keju dan krim, rasa yang lembut dan creamy',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Donat',
                'price' => 10000,
                'desc' => 'Camilan yang terbuat dari tepung, telur, dan gula, diolah dengan cara digoreng dan ditambahkan dengan topping coklat atau gula',
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
