<?php
function quick_scan($code){
    $issues = [];
    if(preg_match('/\beval\s*\(/i', $code)) $issues[] = "Use of eval() detected — risky.";
    if(preg_match('/\bsystem\s*\(|\bexec\s*\(|\bshell_exec\s*\(/i', $code)) $issues[] = "Use of system/exec functions — command injection risk.";
    if(preg_match('/<script\b/i', $code)) $issues[] = "Inline <script> tag found — possible XSS payload.";
    if(preg_match('/password\s*[:=]/i', $code)) $issues[] = "Hardcoded password-like string found.";
    if(preg_match('/base64_decode\s*\(/i', $code)) $issues[] = "Base64 decoding found — could hide payloads.";
    if(preg_match('/require_once\s*\(|include\s*\(/i', $code)) $issues[] = "Include/require usage — check file paths and sanitization.";
    return $issues;
}

$code = '';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $code = $_POST['code'] ?? '';
} elseif(isset($_GET['id'])){
    $id = basename($_GET['id']);
    $path = __DIR__ . "/snippets/$id.json";
    if(file_exists($path)){
        $d = json_decode(file_get_contents($path), true);
        $code = $d['code'] ?? '';
    }
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Manual Scanner</title></head><body>
<h2>Manual Scanner</h2>
<form method="post">
  <textarea name="code" style="width:100%;height:260px"><?=htmlspecialchars($code)?></textarea><br>
  <button type="submit">Run scanner</button>
</form>

<?php
if($code !== ''){
    echo "<h3>Results</h3>";
    $issues = quick_scan($code);
    if(!$issues) { echo "<p>No obvious quick issues detected.</p>"; }
    else { echo "<ul>"; foreach($issues as $i) echo "<li>".htmlspecialchars($i)."</li>"; echo "</ul>"; }
}
?>
<p><a href="index.php">Back</a></p>
</body></html>
