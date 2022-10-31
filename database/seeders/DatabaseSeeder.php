<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
            RankSeeder::class,
        ]);
        Customer::factory(1000)->create();
        $items = Item::all();
        Purchase::factory(20000)->create()->each(function(Purchase $purchase) use ($items){
            $purchase->items()->attach(
                // 1～3個のitemをpurchaseにランダムに紐づけ
                $items->random(rand(1,3))->pluck('id')->toArray(),
                ['quantity' => rand(1, 5) ]
            );
        });
    }
}
