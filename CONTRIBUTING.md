# Contributing to Ecdysiz Framework

## Where new code goes

- Enqueue logic → `theme/ecdysiz-core/inc/enqueue.php`
- Theme supports → `theme/ecdysiz-core/inc/theme-support.php`
- Security → `theme/ecdysiz-core/inc/security.php`
- Accessibility → `theme/ecdysiz-core/inc/accessibility.php`
- Cascade-layer wrapping → `theme/ecdysiz-core/inc/cascade.php`
- Shared helpers → `theme/ecdysiz-core/inc/helpers.php`

**Never** add logic directly to `functions.php`. It is a manifest only.

## Token authority

`src/tokens/tokens.json` is the single source of truth for all design values.

- Edit only `src/tokens/tokens.json`.
- Do not edit `tokens.css` directly (generated).
- Do not edit `dist/ecz-variables.json` directly (generated).
- Do not edit Elementor's UI Variables on production sites.

## Standards

- PHP: PHPCS + WordPress Coding Standards (run `composer run lint:php`).
- CSS: Stylelint (run `npm run lint:css`).
- JS: ESLint (run `npm run lint:js`).
- All names prefixed `ecz-` / `ecz_` / `Ecdysiz_`.

## Git workflow

See `docs/standards/git-workflow.md`.