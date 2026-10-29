<?php
$context = stream_context_create(['http' => ['timeout' => 3]]);
$page = @file_get_contents('http://127.0.0.1/index.php', false, $context);
exit($page !== false && str_contains($page, '<title>DM Producciones</title>') ? 0 : 1);
