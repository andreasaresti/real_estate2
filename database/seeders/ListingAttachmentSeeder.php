<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListingAttachment;

class ListingAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListingAttachment::factory()
            ->count(5)
            ->create();
    }
}
