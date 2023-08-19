<?php

namespace App\Data;

use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class RssItemData
{
    protected $title;
    protected $category;
    protected $date;
    protected $link;
    protected $imageUrl;
    protected $description;

    public function __construct($item)
    {
        $this->title = data_get($item, 'title');
        $this->category = data_get($item, 'category');
        $this->description = data_get($item, 'description');
        $this->link = data_get($item, 'link');
        $this->imageUrl = data_get($item, 'enclosure.@attributes.url');
        $this->pubDate = data_get($item, 'pubDate');

        $this->date = Carbon::parse(strtotime($item->pubDate))
            ->timezone(Config::get('app.timezone'))
            ->format('d.m.y H:i');
    }

    public function get($key)
    {
        if(property_exists($this, $key)) {
            return $this->$key;
        }
        return null;
    }

}
