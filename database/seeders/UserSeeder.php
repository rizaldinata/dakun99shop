<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User dan Admin
        $user = User::create([
            'name' => 'Pengguna Biasa',
            'email' => 'user@example.com',
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 2. Nama skin PUBG
        $skins = [
            'Scar-L Orange Burst', 'Mini14 Jungle Hunter', 'M416 Tropical', 'UMP45 Toxic', 'QBZ Crystal Clear',
            'AKM Desert Camo', 'Groza Black Gold', 'MK14 Mecha', 'DP-28 Sakura', 'M416 The Fool',
            'AKM Icebreaker', 'SKS Forest', 'AKM Urban Commando', 'M16A4 Lava', 'AKM Red Skull',
            'Scar-L Chrome', 'UMP45 Plasma', 'UMP45 Golden Pharaoh', 'M416 Biohazard', 'Mini14 Winter Strike',
            'M762 Psycho Clown', 'AWM Volcano', 'MK14 Lava Beast', 'Groza Dragon Fire', 'Vector Cyberpunk',
            'UMP45 Lightning', 'Kar98k White Death', 'AWM Frozen Hell', 'Scar-L Starburst', 'AWM Godzilla',
            'M16A4 Sandstorm', 'Kar98k Moonlight', 'Groza Titan', 'UMP45 Bonefire', 'SLR Lava Burst',
            'M762 Viper', 'AKM Blaze', 'M416 Glacier', 'DP-28 Crimson', 'Beryl M762 Blue Fang',
            'DP-28 Titan', 'SKS Shadow', 'Beryl M762 Arctic', 'M16A4 Stealth', 'M762 Magma Core',
            'SLR Thunder', 'QBZ Neon Light', 'M416 Cyber Rage', 'Kar98k Gold Plate', 'Vector Shark'
        ];

        // 3. Buat 50 Produk
        foreach ($skins as $skin) {
            Product::create([
                'name' => $skin,
                'description' => 'Skin senjata PUBG eksklusif',
                'price' => rand(50000, 500000),
                'stock' => rand(5, 20),
                'image' => null,
            ]);
        }

        // 4. Buat 3 Transaksi untuk user
        $products = Product::inRandomOrder()->take(3)->get();

        foreach (['dikirim', 'dikirim', 'menunggu'] as $status) {
            $trx = Transaction::create([
                'user_id' => $user->id,
                'alamat' => 'Alamat Pengiriman Dummy',
                'status' => $status,
            ]);

            foreach ($products as $product) {
                TransactionItem::create([
                    'transaction_id' => $trx->id,
                    'product_id' => $product->id,
                    'quantity' => rand(1, 3),
                    'price' => $product->price,
                ]);
            }
        }
    }
}