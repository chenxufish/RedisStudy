<?php
/**
 * Created by PhpStorm.
 * User: Jenner
 * Date: 2016/3/17
 * Time: 20:51
 */

namespace jenner\redis\study\spider;


use React\EventLoop\Factory;

class Spider
{
    protected $urls;

    public function __construct(array $urls)
    {
        $this->urls = $urls;
    }

    public function start() {
        $loop = Factory::create();

        $dnsResolverFactory = new \React\Dns\Resolver\Factory();
        $dnsResolver = $dnsResolverFactory->createCached('8.8.8.8', $loop);

        $factory = new \React\HttpClient\Factory();
        $client = $factory->create($loop, $dnsResolver);

        foreach($this->urls as $url) {
            $request = $client->request('GET', $url);
            $request->on('response', function ($response) {
                $response->on('data', function ($data, $response) {
                    echo '...' . PHP_EOL;
                });
            });
            $request->end();
        }

        $loop->run();
    }
}