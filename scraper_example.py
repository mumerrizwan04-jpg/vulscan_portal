
#!/usr/bin/env python3
# scraper_example.py
# Simple scraper to fetch a snippet page from the local site and save HTML.
import requests, sys, os
if len(sys.argv) > 1:
    url = sys.argv[1]
else:
    url = "http://localhost/vulnscan_portal/view.php?id=snippet_example"

try:
    r = requests.get(url, timeout=6)
    r.raise_for_status()
    out = "scraped_page.html"
    with open(out, "w", encoding="utf-8") as f:
        f.write(r.text)
    print("Saved to", out)
except Exception as e:
    print("Error:", e)
