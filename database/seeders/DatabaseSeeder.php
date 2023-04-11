<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\UserRoleEnum;
use App\Enums\UserVendorRoleEnum;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Laravel\Telescope\Telescope;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Telescope::startRecording();

        User::factory()->create([
            'name' => 'Oleh Talanov',
            'email' => 'oleh@webcap.com',
            'role' => UserRoleEnum::Administrator,
        ]);

        User::factory()->create([
            'name' => 'Valentina Dmitrenko',
            'email' => 'valentina@webcap.com',
            'role' => UserRoleEnum::Administrator,
        ]);

        User::factory(10)->create()->each(function (User $user) {
            $vendor = Vendor::factory()->create();

            $user->vendors()->attach([
                $vendor->id => [
                    'role' => UserVendorRoleEnum::Owner,
                    'joined_at' => now(),
                ],
            ]);
        });

        User::factory(50)->create([
            'role' => UserRoleEnum::Customer,
        ])->each(function (User $user) {
            $vendor = Vendor::inRandomOrder()->first();

            $order = Order::factory()->create([
                'user_id' => $user->getKey(),
                'vendor_id' => $vendor->getKey(),
            ]);

            Feedback::factory()->create([
                'order_id' => $order->id,
            ]);
        });

        Telescope::startRecording();
    }
}
