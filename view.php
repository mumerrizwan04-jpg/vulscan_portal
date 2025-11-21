<?php
$id = $_GET['id'] ?? '';
$path = __DIR__ . "/snippets/".basename($id).".json";
if(!file_exists($path)){ echo "Snippet not found. <a href='index.php'>Back</a>"; exit; }
$data = json_decode(file_get_contents($path), true);
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($data['title'])?></title>
<style>pre{background:#0f1724;color:#f8fafc;padding:12px;border-radius:6px;overflow:auto;font-family:monospace}</style>
</head><body>
  <h2><?=htmlspecialchars($data['title'])?></h2>
  <p><strong>Language:</strong> <?=htmlspecialchars($data['lang'])?> | <strong>Created:</strong> <?=htmlspecialchars($data['created'])?></p>
  <pre><?=htmlspecialchars($data['code'])?></pre>
  <p><a href="scanner_manual.php?id=<?=urlencode($data['id'])?>">Run manual scanner</a> | <a href="index.php">Back</a></p>
</body></html>
