# Versioning

**Status:** Stub (Step 1). Populated as releases begin.

## Two version lines

1. **Framework version** — semver, in `style.css` and `package.json`.
   - MAJOR: breaking change to override contract or template behavior.
   - MINOR: additive features.
   - PATCH: fixes.

2. **Token schema version** — separate semver, in `tokens.json` `$schema-version`.
   - MAJOR: renamed or removed token (breaking for children).
   - MINOR: added token.
   - PATCH: clarifications.

## Compatibility Matrix

See `ELEMENTOR-COMPAT.md` for the framework × Elementor × token-schema matrix.

## Deprecation policy

Breaking changes get one MINOR release of deprecation warning before removal.