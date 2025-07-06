<?php
$dataFile = 'data.json';

function loadData($file) {
    if (!file_exists($file)) return [];
    return json_decode(file_get_contents($file), true);
}

function saveData($file, $data) {
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
}

$action = $_GET['action'] ?? '';
if ($action === 'list') {
    echo json_encode(loadData($dataFile));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $data = loadData($dataFile);

    if ($action === 'add' && isset($input['item'])) {
        $data[] = htmlspecialchars($input['item']);
        saveData($dataFile, $data);
        echo json_encode(['success' => true]);
        exit;
    }

    if ($action === 'delete' && isset($input['index'])) {
        $index = (int) $input['index'];
        if (isset($data[$index])) {
            array_splice($data, $index, 1);
            saveData($dataFile, $data);
        }
        echo json_encode(['success' => true]);
        exit;
    }
}
