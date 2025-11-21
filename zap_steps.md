
# OWASP ZAP — Basic VAPT Steps (for this local app)

1. Install OWASP ZAP on your machine (https://www.zaproxy.org/).
2. Start the VulnScan Portal locally:
   - Place folder into C:\\xampp\\htdocs\\vulnscan_portal
   - Start Apache via XAMPP control panel
   - Open http://localhost/vulnscan_portal/
3. Open ZAP and configure the browser to use ZAP proxy (default localhost:8080) OR use ZAP's built-in browser.
4. Spider the site root: http://localhost/vulnscan_portal/
5. Run an active scan on the discovered URLs (index.php, paste.php, view.php, scanner_manual.php).
6. Review alerts - look for XSS, CSRF, insecure headers, path traversal, file upload issues.
7. Export findings as PDF/HTML for your report.
Notes: Because this app stores snippets in files, check for path traversal issues, and ensure that the saved JSON files are not interpreted as code.
