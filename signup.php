<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');

$data = json_decode(file_get_contents('php://input'), true);

if(empty($data)){
    exit;
}

$success = false;
$error = '';

$link = mysqli_connect("localhost", "notfound_trukker", "random123@", "notfound_trukker");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$query = "
    INSERT INTO drivers (first_name, last_name, email, phone, freelancer)
    VALUES (?,?,?,?,?)";
$statement = mysqli_prepare($link, $query);
$statement->bind_param(
    'sssss',
    $data['firstName'],
    $data['lastName'],
    $data['email'],
    $data['phone'],
    $data['freelancer']
);

$success = $statement->execute();
$statement->close();

if (!$success) {
    $error = mysqli_error($link);
}

mysqli_close($link);

$header = $success ? '201 Created' : '500 Internal Server Error';
header('HTTP/1.1 ' . $header);
echo json_encode(['success' => $success, 'error' => $error]);
