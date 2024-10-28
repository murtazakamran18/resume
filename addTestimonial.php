<?php
$data = json_decode(file_get_contents('php://input'), true);
if ($data) {
    $name = $data['name'];
    $message = $data['message'];

    // Pehle se mojood testimonials file mein data add karna
    $file = 'testimonials.json';
    $testimonials = json_decode(file_get_contents($file), true);
    $testimonials[] = ['name' => $name, 'message' => $message];
    file_put_contents($file, json_encode($testimonials));

    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
