<?php

namespace App\Services;

use App\Data\RssItemData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RssReaderService
{
    public function read(): array
    {
        $result = [];
        try {
            $xml = Cache::get($this->getCacheKey());
            if (!$xml) {
                $xml = $this->getXml();
                Cache::put($this->getCacheKey(), $xml, config('rss.cache.length'));
            }

            $xmlObject = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
            $jsonFormatData = json_encode($xmlObject);
            $data = json_decode($jsonFormatData);

            foreach (array_slice(data_get($data, 'channel.item', []), 0, config('rss.count')) as $item) {
                $result[] = (new RssItemData($item));
            }
        } catch (\Exception $e) {
            Log::error('RSS read error: ' . $e->getMessage());
        }

        return $result;
    }

    protected function getXML()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => config('rss.url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    private function getCacheKey()
    {
        return 'rss::' . config('rss.url');
    }
}
