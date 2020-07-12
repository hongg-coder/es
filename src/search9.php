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
            "bool" => [
                "must" => [
                    ["term" => ["tag" => "渣男"]],
                    ["term" => ["tag" => "宅男"]],
                ]
            ]
        ]
    ]
]);

var_dump($list);
exit;