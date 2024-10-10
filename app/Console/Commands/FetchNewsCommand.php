<?php

namespace App\Console\Commands;

use App\Models\Source;
use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch news articles from various sources and store them in the database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sources = Source::all();

        foreach ($sources as $source) {
            $this->fetchNewsFromSource($source);
        }
    }
    protected function fetchNewsFromSource($source)
    {
        // Fetch news from the source's API URL
        $response = Http::get($source->api_url);

        if ($response->successful()) {
            $articles = $response->json()['articles'] ?? $response->json()['results'] ?? [];

            foreach ($articles as $article) {
                // Modify based on the structure of the response from the source
                Article::updateOrCreate(
                    [
                        'source_id' => $source->id,
                        'title' => $article['title'] ?? $article['webTitle']
                    ],
                    [
                        'author' => $article['author'] ?? $article['byline'] ?? null,
                        'content' => json_encode($article),
                        'description' => $article['description'] ?? $article['summary']?? $article['abstract'] ?? $article['fields']['bodyText'] ?? null, // Add description here
                        'url' => $article['url'] ?? $article['webUrl'],
                        'published_at' => $article['publishedAt'] ?? $article['published_date'] ?? $article['webPublicationDate'],
                        'category' => 'General' // You can categorize as needed
                    ]
                );
            }
        }
    }
}
