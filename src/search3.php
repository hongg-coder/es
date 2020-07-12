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
            "range" => [
                "birthday" => [
                    "gt" => "1994-11-30"
                ]
            ]
        ]
    ]
]);

var_dump($list);exit;