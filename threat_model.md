
# Threat Model — VulnScan Portal (Option A)

## Overview / Use case
A small web portal accepts user-pasted code snippets and stores them for later viewing and scanning. Intended for students to upload short code samples for static checks and demonstration of security scanning pipelines.

## Assets
- **User-submitted code snippets** (confidentiality & integrity)
- **Stored snippet files** in the server filesystem
- **Application pages** (UI)
- **Logs** (if any)

## Actors
- **Unauthenticated website user**: can paste/view snippets
- **Attacker**: malicious user trying to exploit the site to execute code, traverse filesystem, or trigger XSS/CSRF
- **Administrator**: maintains the server and reviews findings

## Trust boundaries
- Input boundary: user-submitted code -> server
- File-system boundary: saved snippets are written to server filesystem
- Execution boundary: nothing should execute server-side directly from snippets

## Threats (STRIDE)
- **Spoofing**: attacker uploads code with malicious metadata. (Low)
- **Tampering**: attacker tries to overwrite other snippet files using path traversal. Mitigated by sanitizing IDs and filenames.
- **Repudiation**: lack of logging may make it hard to track changes.
- **Information disclosure**: uploaded code may contain secrets (passwords, API keys) that when stored could be exposed.
- **Denial of Service**: extremely large uploads or many files could exhaust storage.
- **Elevation of privilege**: if the web server executes uploaded content (e.g., via include()), attacker could escalate.

## Security Controls / Mitigations
- Sanitize filenames and IDs (only allow [A-Za-z0-9_-]).
- Store snippets as JSON text files, do not execute them.
- Limit snippet size (e.g., 200KB) and rate-limit submissions (not implemented in Option A but recommended).
- Display snippets as escaped text to prevent XSS on viewing pages.
- Run Apache as a non-admin user and restrict permissions on snippet folder.
- Regularly audit snippet folder for sensitive strings (passwords, secrets).

## Residual risks
- Stored sensitive secrets in snippets — should be avoided by policy and by scanning for keywords.
- The quick scanner is heuristic-based and not comprehensive—use Snyk/CodeQL for deeper analysis.
