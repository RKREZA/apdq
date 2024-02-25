<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;

use Modules\Video\Entities\VideoPlaylist;

class VideoPlaylistTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VideoPlaylist::create([
            'name'  => 'Demo Playlist',
        ]);
    }
}
