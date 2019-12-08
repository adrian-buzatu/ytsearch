<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    private $api_list = [
        'videos' => 'https://www.googleapis.com/youtube/v3/search?order=relevance&part=snippet,id&type=video',
    ];
    private $api_list_item = 'videos';
    private $search = '';
    private $next_page_token = '';
    private $max_results = 10;

    public function getApiKey() {
    	return config('app.youtube_api_key');
    }

    /**
     * Sets the search tag and the pagination token.
     *
     * @param  string  $tag
     * @param  string  $ptoken - pagintation token
     * @return \App\Youtube
     */

    public function search($query, $nextPageToken) {
    	$this->search = $query;
    	$this->next_page_token = $nextPageToken;

    	return $this;
    }

    public function getResults() {
    	return file_get_contents($this->generateSearchLink());
    }

    private function getApiUrl() {
    	return $this->api_list[$this->api_list_item];
    }

    private function generateSearchLink() {
		$extraParams = "&q=". urlencode($this->search).
			"&key=". $this->getApiKey().
			"&maxResults=".$this->max_results;
		if ($this->next_page_token !== '') {
			$extraParams .= "&pageToken=". $this->next_page_token;
		}

    	return $this->getApiUrl(). $extraParams;
    }

}
