<?php

namespace App\Service;

use App\Entity\Image;
use Symfony\Component\Cache\Adapter\RedisAdapter;

class CacheService implements CacheServiceInterface
{
    /**
     * @param Image $image
     * @return bool|mixed|string|void|null
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function getCachedImage(Image $image)
    {

        $cacheKeys = [];

        $redis = RedisAdapter::createConnection($_ENV['REDIS_URL']);

        $cache = new RedisAdapter($redis);

        $urls = $image->getImageUrls();

        foreach (json_decode($urls) as $url) {

            $cacheKeys[] = md5($url);
        }

        foreach ($cacheKeys as $cacheKey) {

            if ($cache->hasItem($cacheKey)) {

                $imageData = $cache->getItem($cacheKey)->get();

            } else {

                $imageData = $this->getImage($url);

                $cacheItem = $cache->getItem($cacheKey);

                $cacheItem->set($imageData);

                try {

                  $cache->save($cacheItem);
                }catch (\Throwable $exception) {
                    dd($exception->getMessage());
                }

            }
        }

        return $imageData;

    }

    /**
     * @param $imageUrl
     * @return bool|null|string
     */
    public function getImage($imageUrl): ?string
    {
        try {

            $data = file_get_contents($imageUrl);


            return  base64_encode($data);
        } catch (\Throwable $exception) {

            return null;
        }
    }
}
