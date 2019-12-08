<?php

namespace App\Http\Controllers;

use App\Youtube;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{

    /**
     * Perform a search after a given string and returns a JSON with the results.
     *
     * @param  string  $tag
     * @param  string  $ptoken - pagintation token
     * @return string The search result(JSON)
     */
    public function search($tag, $ptoken = '')
    {
        $youtube = new Youtube;
        $videos = $youtube->search($tag, $ptoken)->getResults();
        echo $videos;
    }
}
