<?php
// Load WordPress environment
require_once('../../../wp-load.php');

// API endpoint and API key
$api_url = 'https://api2.speechace.com/api/scoring/text/v9/json';
$api_key = '%2Fca9SiIJBgN0Fp%2FpyYGBEQuqS%2BWKTQ9Bc%2FZPQ4SQADdCXL8PS0i7QsV06D5qYcX1djIC5IQWBlK9sHu1TgG7bT%2BPmV0cXoFjko53Fh%2F%2FjHAWLVFcmgkhn8U%2BJekkMohO';
$dialect = 'en-gb';

// Append API key to the URL
$api_url_with_key = $api_url . '?key=' . $api_key . '&dialect=' . $dialect;

// Check for the file
if (empty($_FILES['user_audio_file'])) {
    die("Error: No audio file provided.");
}

$file_path = $_FILES['user_audio_file']['tmp_name'];
$file_name = $_FILES['user_audio_file']['name'];

// Prepare the headers and the body
$headers = array('Content-Type' => 'multipart/form-data');
$body = array(
    'text' => $_POST['text'],
    // 'user_audio_file' => new CURLFile($file_path, $_FILES['user_audio_file']['type'], $file_name),
    'question_info' => $_POST['question_info'],
    'no_mc' => $_POST['no_mc']
);

// Use wp_remote_post to make the request
$response = wp_remote_post($api_url_with_key, array(
    'headers' => $headers,
    'body' => $body,
    'timeout' => 45
));

// Check for WP_Error
if (is_wp_error($response)) {
    die('Error: ' . $response->get_error_message());
}

// Output the response
header('Content-Type: application/json');
echo wp_remote_retrieve_body($response);
