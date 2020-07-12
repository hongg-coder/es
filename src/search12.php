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
                    [
                        "term" => [
                            "tag" => "渣男"
                        ],
                    ],
                    [
                        "range" => [
                            "birthday" => [
                                "gt" => "1994-11-30"
                            ],
                        ],
                    ],
                    [
                        "range" => [
                            "user_id" => [
                                "gte" => 1,
                                "lte" => 100
                            ]
                        ],
                    ]
                ]
            ]
        ]
    ]
]);

var_dump($list);
exit;