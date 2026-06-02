# CLAUDE.md

Guidance for Claude Code and other AI agents working in this repository.

## Project overview

`axazara/mailbluster-laravel` is a Laravel package (published on Packagist) that provides a fluent facade-based client for the MailBluster email marketing API. It auto-registers via Laravel's package discovery and exposes CRUD operations for Leads, custom Fields, and Products. Consuming Laravel apps require PHP 8.1+ and Laravel 9 or 10.

## Tech stack

- PHP ^8.1
- Laravel (illuminate/contracts ^9.0 || ^10.1) — no full Laravel app, package only
- Orchestra Testbench ^7.22 (test harness)
- PHPUnit ^9.6 (test runner)
- Larastan/PHPStan ^2.4 (static analysis, level 4)
- php-cs-fixer ^3.22 (code style)

## Getting started

```bash
composer install

# Copy the config for your consuming app
php artisan mailbluster:install

# Add to .env
MAILBLUSTER_API_KEY=your_key_here
# Set to "test" locally to suppress real API calls
MAILBLUSTER_API_URL=test
```

## Common commands

| Task | Command |
|---|---|
| Test | `composer test` |
| Test with coverage | `composer test-coverage` |
| Static analysis | `composer analyse` |
| Lint (dry-run) | `composer sniff` |
| Format (apply fixes) | `composer format` |
| Scan unused deps | `composer unused` |

## Architecture

The package follows a trait-composition pattern — the core `MailBluster` class composes behaviour from four traits:

- `src/Traits/Request.php` — shared HTTP dispatch logic via `Illuminate\Support\Facades\Http`; reads `api_url` / `api_key` from config; setting `MAILBLUSTER_API_URL=test` short-circuits all real HTTP calls
- `src/Traits/Leads.php` — `createLead`, `readLead`, `updateLead`, `deleteLead` (addresses leads by `md5($email)`)
- `src/Traits/Fields.php` — `createField`, `getFields`, `updateField`, `deleteField`
- `src/Traits/Products.php` — `createProduct`, `getProducts`, `getProduct`, `updateProduct`, `deleteProduct`
- `src/Facades/MailBluster.php` — standard Laravel facade backed by the `mailbluster` binding
- `src/MailBlusterServiceProvider.php` — registers binding and publishes `config/mailbluster.php`
- `src/Exceptions/` — typed exceptions: `ApiKeyIsMissing`, `InvalidApiUrl`, `InvalidEmail`, `RequestError`
- `config/mailbluster-laravel.php` — package config (published as `config/mailbluster.php` in the host app)
- `tests/` — PHPUnit tests using Orchestra Testbench; runs in random execution order

## Conventions

- PSR-4 autoloading under `AxaZara\MailBluster\` (src) and `AxaZara\MailBluster\Tests\` (tests)
- Code style enforced by php-cs-fixer; always run `composer format` before committing
- Static analysis via PHPStan at level 4; baseline tracked in `phpstan-baseline.neon`
- All API responses are cast to `object` (not typed DTOs); null is returned on failed requests, `getLastError()` retrieves the last HTTP error body
- Never hardcode `MAILBLUSTER_API_KEY` — always read from environment via config
- Contributions target the `dev-main` branch via pull request

## Git Conventions

### 1. Branch names

Enforced regex (`branch_name_pattern`):
```
^(feature|fix|hotfix|chore|docs|refactor|test|ci|perf|build|style)/[a-z0-9._-]+$
```

- Lowercase only, kebab-case after the prefix, **max 50 characters** total.
- Use the full word `feature/` — **never** `feat/` (the short `feat` form is only for commit message types).
- Include the ticket id when relevant: `feature/AXA-123-add-stripe` (the ticket id is lowercased to satisfy the pattern — e.g. `feature/axa-123-add-stripe`).
- **Never** use a `claude/` prefix or any prefix outside the allowed set.
- `main`, `release`, `staging` are permanent protected branches — never push to them directly.
- If a branch is misnamed, rename it before pushing: `git branch -m <old> <new>`.

### 2. Commit messages
Enforced regex (`commit_message_pattern`), applied to **every** commit:
```
^(feat|fix|docs|style|refactor|perf|test|build|ci|chore|revert)(\([^)]+\))?!?: .+
```
- Lowercase type, optional scope in parens, optional `!` for breaking changes, subject after `: `.
- Subject starts with a lowercase letter and has no trailing period.
- Examples: `feat(checkout): add Apple Pay support`, `fix(api): handle expired tokens`, `chore(deps): bump axios from 1.7.2 to 1.15.2`, `refactor!: drop Node 18 support`.
- Do not rewrite Dependabot commits — `chore(deps): bump X from a to b` is already enforced via `.github/dependabot.yml`.

### 3. Files that are always rejected
Never stage or commit:
- `.env`, `.env.*` (only `.env.example` and `.env.sample` are allowed), `**/.env`, `**/.env.*`
- Private keys: `**/id_rsa{,.pub}`, `**/id_dsa`, `**/id_ecdsa`, `**/id_ed25519`, `**/.ssh/id_*`
- Credentials: `**/.aws/credentials`, `**/credentials.json`, `**/service-account.json`, `**/firebase-adminsdk-*.json`, `**/secrets.{yml,yaml}`
- Extensions: `*.pem`, `*.key`, `*.p12`, `*.pfx`, `*.jks`, `*.keystore`, `*.ppk`, `*.asc`, `*.gpg`
- Any file larger than 100 MB (use git LFS)
If a secret is needed, use `.env.example` for env vars and an external secret manager for credentials.

### Pull requests targeting `main`, `release`, `staging`
All three are protected — a PR is required (direct push blocked):
- 1 approval, all conversations resolved, **squash or rebase merge only** (linear history enforced — no merge commits).
- Commits must be GPG- or SSH-signed. Signing is required for `main` (`required-signatures-main` ruleset).
- The PR **title** becomes the squash commit message and must match the commit-message regex above (enforced on all three branches).

**Required workflows run on PRs whose base is `main` only** (not `release`/`staging`): `Branch naming convention`, `PR title — Conventional Commits`, and `PR size labeler`.
If a check shows `Waiting for workflow to run` for over a minute, the third-party action is likely missing from the enterprise allowlist.

When the branch-naming or PR-title check fails, the baseline bot auto-posts rename/title suggestions, following the enforced regex patterns.
If the bot's suggestions are incorrect, edit the PR title or branch name to match the required format.

### Pre-push checklist
Before running `git push`:
1. Branch name matches the regex.
2. Every commit in `origin/main..HEAD` matches the commit pattern (`git log --format=%s origin/main..HEAD`).
3. No staged file is in the blocked paths/extensions list.
4. Commits are signed if the target is `main`.

If any check fails, fix it locally rather than letting the server reject the push.
