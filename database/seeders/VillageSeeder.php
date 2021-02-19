<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new CsvtoArray();
        $resourceFiles = File::allFiles(__DIR__ . '/csv/villages');
        foreach ($resourceFiles as $file) {
            $header = ['id', 'district_id', 'name', 'lat', 'long'];
            $data = $csv->csv_to_array($file->getRealPath(), $header);

            $data = array_map(function ($arr) {
                $arr['meta'] = json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]);
                unset($arr['lat'], $arr['long']);

                return $arr;
            }, $data);

            $collection = collect($data);
            foreach ($collection->chunk(50) as $chunk) {
                DB::table('villages')->insert($chunk->toArray());
            }
        }
    }
}
