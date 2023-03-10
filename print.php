<?php

require_once './api/database.php';
require_once './api/utils.php';

cors();

$upload = !empty($_GET['upload']) ? $conn->real_escape_string($_GET['upload']) : null;
if ($upload === null) die('Invalid params');

$receipt_res = $conn->query("SELECT * FROM documents WHERE upload='$upload' LIMIT 1");
if ($receipt_res->num_rows === 0) die('Invalid params');

$upload_path = __DIR__ . "/api/data/$upload.pdf";

header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $upload . '.pdf"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($upload_path));
readfile($upload_path);

?>
