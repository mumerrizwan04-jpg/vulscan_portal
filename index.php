<?php
// Simple VulnScan Portal - Option A
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>VulnScan Portal (Option A)</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Inter,Arial,Helvetica,sans-serif;margin:24px;background:#f7f7fb;color:#111}
    header{margin-bottom:18px}
    textarea{width:100%;height:200px;font-family:monospace}
    .card{background:#fff;padding:16px;border-radius:8px;box-shadow:0 1px 4px rgba(0,0,0,0.08);margin-bottom:12px}
    .btn{display:inline-block;padding:8px 12px;border-radius:6px;background:#0b69ff;color:#fff;text-decoration:none}
    .small{font-size:0.9rem;color:#555}
    pre{white-space:pre-wrap;background:#0f1724;color:#f8fafc;padding:12px;border-radius:6px;overflow:auto}
  </style>
</head>
<body>
  <header>
    <h1>VulnScan Portal — Simple (XAMPP)</h1>
    <p class="small">Paste a code snippet, run a quick static check, and view stored snippets. Designed for offline XAMPP use.</p>
  </header>

  <div class="card">
    <h3>Paste code to save & scan</h3>
    <form method="post" action="paste.php">
      <label>Title (short): <input required name="title" style="width:50%"></label><br><br>
      <label>Language (optional): <input name="lang" style="width:30%"></label><br><br>
      <textarea name="code" placeholder="// paste your code here"></textarea><br><br>
      <button class="btn" type="submit">Save & Quick Scan</button>
    </form>
  </div>

  <div class="card">
    <h3>Existing Snippets</h3>
    <?php
      $files = glob(__DIR__ . '/snippets/*.json');
      if(!$files){ echo '<p class="small">No snippets yet.</p>'; }
      else{
        echo '<ul>';
        foreach($files as $f){
          $data = json_decode(file_get_contents($f), true);
          $id = basename($f, ".json");
          echo '<li><a href="view.php?id='.htmlspecialchars($id).'">'.htmlspecialchars($data["title"]).'</a> <span class="small">('.htmlspecialchars($data["lang"]).')</span></li>';
        }
        echo '</ul>';
      }
    ?>
  </div>

  <div class="card">
    <h3>Utilities</h3>
    <a class="btn" href="scanner_manual.php">Run manual scanner</a>
    <a class="btn" href="scraper_example.py" style="background:#06ad6b">Download scraper (Python)</a>
    <a class="btn" href="docs/threat_model.md" style="background:#555">Threat model (doc)</a>
  </div>

  <footer style="margin-top:20px;font-size:0.9rem;color:#666">
    <p>Prepared for coursework — Option A. Place this folder inside <code>C:\xampp\htdocs\yourfolder</code> then visit <code>http://localhost/yourfolder/</code>.</p>
  </footer>
</body>
</html>
