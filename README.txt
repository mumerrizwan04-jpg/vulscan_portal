
VulnScan Portal - Option A
==========================

This is a minimal XAMPP-ready PHP project designed for coursework. It does:
 - Accept pasted code snippets and store them as JSON file records (no DB required)
 - Run a tiny "quick scanner" (regex-based) to flag obvious risky patterns
 - Provide a manual scanner page and a sample Python scraper

How to use:
1. Place this folder inside your XAMPP htdocs directory:
   C:\xampp\htdocs\vulnscan_portal
2. Start Apache in XAMPP control panel.
3. Visit: http://localhost/vulnscan_portal/

Files of interest:
 - index.php       : Main page + paste form + list of snippets
 - paste.php       : Saves snippet and runs quick scan
 - view.php        : View saved snippet
 - scanner_manual.php: Manual scanner for snippets / raw code
 - snippets/       : JSON files storing saved snippets
 - scraper_example.py: Simple python scraper example
 - docs/           : Threat model and guidance files
