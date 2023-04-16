<?php

namespace Database\Seeders;

use App\Models\Reason;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Reasons extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $reasons = ['Spamming', 'Cheating', 'Other'];

            foreach ($reasons as $reason) {
                DB::table('reasons')->insert([
                    'reason'=>$reason
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();

    }
}
