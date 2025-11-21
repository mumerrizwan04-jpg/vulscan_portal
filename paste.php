<?php
if($_SERVER['REQUEST_METHOD'] !== 'POST'){ header("Location: index.php"); exit; }
$title = trim($_POST['title'] ?? 'untitled');
$lang = trim($_POST['lang'] ?? '');
$code = $_POST['code'] ?? '';
if($code === ''){ echo "No code provided."; exit; }

$id = preg_replace('/[^a-z0-9_\-]/i','', strtolower(preg_replace('/\s+/', '_', $title)));
if(!$id) $id = 'snippet_'.time();
$dir = __DIR__ . '/snippets';
if(!is_dir($dir)) mkdir($dir, 0755, true);

$data = ['id'=>$id, 'title'=>$title, 'lang'=>$lang, 'code'=>$code, 'created'=>date('c')];
file_put_contents("$dir/$id.json", json_encode($data, JSON_PRETTY_PRINT));

// Very simple static checks (quick scanner)
function quick_scan($code){
    $issues = [];
    if(preg_match('/\\beval\\s*\\(/i', $code)) $issues[] = "Use of eval() detected — risky.";
    if(preg_match('/\\bsystem\\s*\\(|\\bexec\\s*\\(|\\bshell_exec\\s*\\(/i', $code)) $issues[] = "Use of system/exec functions — command injection risk.";
    if(preg_match('/<script\\b/i', $code)) $issues[] = "Inline <script> tag found — possible XSS payload.";
    if(preg_match('/password\\s*[:=]/i', $code)) $issues[] = "Hardcoded password-like string found.";
    if(preg_match('/base64_decode\\s*\\(/i', $code)) $issues[] = "Base64 decoding found — could hide payloads.";
    if(preg_match('/require_once\\s*\\(|include\\s*\\(/i', $code)) $issues[] = "Include/require usage — check file paths and sanitization.";
    return $issues;
}

$issues = quick_scan($code);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Saved</title></head><body>
  <h2>Saved: <?=htmlspecialchars($title) ?></h2>
  <p><a href="view.php?id=<?=urlencode($id)?>">View snippet</a> | <a href="index.php">Back</a></p>
  <h3>Quick scan results</h3>
  <?php if(!$issues) echo "<p>No obvious quick issues found.</p>"; else { echo "<ul>"; foreach($issues as $i) echo "<li>".htmlspecialchars($i)."</li>"; echo "</ul>"; } ?>
</body></html>
