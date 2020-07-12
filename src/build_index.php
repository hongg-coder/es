<?php
require_once "vendor/autoload.php";

$client = \Elasticsearch\ClientBuilder::create()->setHosts(
    [
        "127.0.0.1:9200",
    ]
)->build();

// 创建索引
$params = [
    'index' => 'user',
    'body' => [
        'mappings' => [
            '_doc' => [
                '_source' => [
                    'enabled' => true
                ],
                'properties' => [
                    "user_id" => [
                        "type" => "integer"
                    ],
                    "nickname" => [
                        "type" => "keyword"
                    ],
                    "mail" => [
                        "type" => "keyword"
                    ],
                    'description' => [
                        'type' => 'text',
                        'analyzer' => 'standard',
                    ],
                    'birthday' => [
                        'type' => 'date',
                        "format" => 'yyyy-MM-dd'

                    ],
                    'tag' => [
                        'type' => 'keyword',
                    ]
                ]
            ]
        ]
    ]
];

if ($client->indices()->exists([
    "index" => "user"
])) {
    $client->indices()->delete([
        "index" => "user"
    ]);
}

// 创建索引
$ret = $client->indices()->create($params);

// 构建索引
$fileData = file_get_contents("data/user_list.json");
$fileData = json_decode($fileData, true);

$buldData = [];
$buldData["index"] = "user";
$buldData['type'] = "_doc";

foreach ($fileData as $key => $value) {
    $buldData['body'][] = [
        "create" => [
            "_id" => $value['user_id']
        ]
    ];

    $buldData['body'][] = $value;
}

$resp = $client->bulk($buldData);
var_dump($resp);
