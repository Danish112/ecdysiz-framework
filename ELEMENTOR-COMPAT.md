# Elementor Compatibility Policy

## Pinned Version

**Elementor:** 4.1.x
**Elementor Pro:** 4.1.x
**Atomic Editor:** required (default in fresh 4.x installs)
**Verified against:** Validation Sprint, May 2026

## Validated Behaviors

1. `@layer client` overrides Elementor Atomic CSS without `!important`
   (proven Chrome, Firefox, Safari).
2. CSS-variable-referenced values in Elementor Variables flow from
   `tokens.json` through `tokens.css` to live content without UI editing.
3. Dark mode `[data-theme]` remap works on Elementor-built content via
   CSS-variable references.

## Architectural Rules

- **Containers only.** Legacy Sections are prohibited.
- **Kit is generated, not hand-edited in production.** Changes flow
  tokens → build → re-import or CSS-variable reference.
- **No UI edits to Global Settings** on live sites. Drift detection planned
  for Phase 4.

## Upgrade Procedure

When a new Elementor Pro version releases:

1. Test in isolation on staging.
2. Re-validate the cascade technique (Validation 2 equivalent).
3. Re-validate the token round-trip (Validation 3 equivalent).
4. Confirm Container behavior unchanged.
5. Confirm breakpoint behavior unchanged.
6. Update this pin and the compatibility matrix.
7. ADR the change.
8. Tag a framework release.

**Elementor upgrades are framework releases.** Never auto-update on live sites.

## Compatibility Matrix

| Framework Version | Elementor Pro | Token Schema | Status |
|---|---|---|---|
| 0.0.1 (scaffold) | 4.1.x | 1.0.0 | Not certified |