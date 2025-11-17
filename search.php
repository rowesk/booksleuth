<?php
// Get the search query from URL parameter
$query = isset($_GET['q']) ? $_GET['q'] : '';

// Sanitize to prevent header injection
$query = str_replace(["\r", "\n"], '', $query);

// Redirect to Z-Library
header('Location: https://z-library.la/s/' . $query);
exit;
?>
