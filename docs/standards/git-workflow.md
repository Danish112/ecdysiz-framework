# Git Workflow

**Status:** Stub (Step 1). Populated as the team grows.

## Branches

- `main` — released, tagged state. Protected.
- `develop` — integration. Protected.
- `feature/<short-desc>` — branched from `develop`.
- `fix/<short-desc>` — bug fixes against `develop`.
- `hotfix/<version>` — patches from a release tag.

## Commits

Conventional Commits enforced via commitlint:
`feat:`, `fix:`, `docs:`, `chore:`, `refactor:`, `test:`, `build:`, `ci:`.

## Releases

Automated changelog + semver bump driven by commit types.
See `versioning.md`.