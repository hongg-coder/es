<?php
require_once "vendor/autoload.php";

$client = \Elasticsearch\ClientBuilder::create()->setHosts(
    [
        "127.0.0.1:9200",
    ]
)->build();

$list = $client->search([
    "type" => "_doc",
    "index" => "user",
    "body" => [
        "query" => [
            "match" => [
                "mail" => "WcQT9YHGXb@mail.com"
            ]
        ]
    ]
]);

var_dump($list);exit;