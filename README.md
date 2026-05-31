# Ecdysiz Framework

A reusable WordPress + Elementor Pro framework for agency client projects.

**Status:** Scaffold (Step 1 of 11 complete)
**Version:** 0.0.1
**Target:** WordPress 6.4+, Elementor Pro 4.1.x

## Structure

- `theme/ecdysiz-core/` — parent theme
- `reference-child/ecdysiz-reference/` — reference client child theme
- `src/tokens/tokens.json` — design tokens (single source of truth)
- `tooling/build-tokens.js` — token build script
- `dist/` — generated build outputs (committed)
- `docs/` — architecture, standards, ADRs

## Development

Documentation lives in `docs/`. Start with `docs/architecture/overview.md`.

## Build

```bash
node tooling/build-tokens.js
```

Per-client build:

```bash
node tooling/build-tokens.js --client=ecdysiz-reference
```

## License

See `LICENSE`.