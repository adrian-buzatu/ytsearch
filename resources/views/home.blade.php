<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
        <title>Youtube Search</title>
    </head>
    <body>
        <div class="main-app">
            <h3 class="main-app-title align-center">Youtube Video Search</h3>
            <div class="main-app-body">
                <div class="yt-search-form align-center-m">
                    <input type="text" name="search" id="search" placeholder="Search Youtube Video">
                </div>
                <div class="main-app-body-results" id="results">

                </div>
                <div id="show-more-wrapper" data-next-page-token="" class="main-app-body-show-more hide">
                    <a id="show-more" href="javascript:void(0)">Click here for more results</a>
                </div>
            </div>

        </div>
        <div class="hide" id="bulk-item">
            <div class="search-item-title">

            </div>
            <div class="search-item-thumbnail-wrapper">
                <img class="search-item-thumbnail" alt="" src="" />
            </div>
            <div class="search-item-url-wrapper">
                <a class="search-item-url" target="_blank" href=""></a>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
