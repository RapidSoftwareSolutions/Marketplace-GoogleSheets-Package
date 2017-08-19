<?php
$routes = [
    'metadata',
    'getAccessToken',
    'updateSpreadsheet',
    'createSpreadsheet',
    'getSingleSpreadsheet',
    'copySheets',
    'appendSheetValues',
    'batchClear',
    'getBatchValues',
    'batchUpdate',
    'clearValues',
    'getRangeValues',
    'updateRangeValues'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

