<?php

namespace Database\Seeders;

use App\Models\Source;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Source::create([
            'name' => 'BBC News',
            'api_url' => 'https://newsapi.org/v2/everything?q=all&from=2024-10-08&sortBy=popularity&apiKey=d47480ec83d040daaea5572700c6e095&sources=bbc-news'
        ]);

        Source::create([
            'name' => 'NY Times',
            'api_url' => 'https://api.nytimes.com/svc/topstories/v2/technology.json?api-key=wycarqhn9ueA2lrEPBSSng5NcSd1SX0w'
        ]);

        Source::create([
            'name' => 'The Guardian',
            'api_url' => 'https://content.guardianapis.com/search?api-key=abe802c6-929c-46e4-9c8e-b3e3c41b0233&from-date=2024-10-01&to-date=2024-10-09&page-size=20&show-fields=all'
        ]);
    }
}
