
# Snyk Integration Guide (GitHub + Snyk)

1. Create a GitHub repository and push your project code.
   - git init
   - git add .
   - git commit -m "vulnscan portal option A"
   - git remote add origin <your-repo-url>
   - git push -u origin main

2. Sign up / login to Snyk (https://snyk.io) and connect your GitHub account.
   - Authorize Snyk to access your repositories.
   - Add the repository you just pushed.
   - Snyk will run an initial scan for known vulnerabilities (dependencies, e.g., npm packages) and provide remediation guidance.

3. For this PHP project (no dependencies) Snyk can still scan GitHub repository for secrets and known issues.
4. Configure Snyk to run on each push (via GitHub Actions) or let Snyk monitor your repo and open PRs with fixes.
5. Export Snyk results for inclusion in your assignment report.
