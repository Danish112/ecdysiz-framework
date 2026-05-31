# Component: Container

**Status:** Production
**Layer:** `@layer components`
**Delivery:** Theme-delivered (CSS class)
**Version:** 0.0.1

## Description

Layout primitive that centers content with token-driven max-width and side padding. Establishes a container-query context for any child primitives. Used as the **outer wrapper** for every section.

## Required Markup

```html
<section>
  <div class="ecdysiz-container">
    <!-- content -->
  </div>
</section>
```

For Elementor: apply to an Atomic Flexbox Container set to full-width parent.

## Variants

| Class | Purpose |
|---|---|
| `.ecdysiz-container` | Default content-width (1280px) |
| `.ecdysiz-container--wide` | Wide content-width (1440px) |
| `.ecdysiz-container--full` | Full-bleed, no max-width or padding |

## Token Hooks (Override Points)

- `--ecdysiz-content-width` — default max content width
- `--ecdysiz-content-width-wide` — wide variant max width
- `--ecdysiz-side-padding` — default horizontal padding
- `--ecdysiz-side-padding-sm` — mobile padding (≤ 767px)

## Accessibility Baseline

- ✅ No semantic structure (use within `<section>`, `<article>`, etc.)
- ✅ Responsive padding adjusts for mobile
- ✅ No interactive behavior — purely structural

## Composition Rules

- ✅ Should be the immediate child of full-width section wrappers
- ✅ Establishes container-query context for nested primitives
- ✅ Can contain any other primitive
- ❌ Do NOT nest containers (causes double-padding)

## Dependencies

- Tokens: `content-width`, `content-width-wide`, `side-padding`, `side-padding-sm`, `breakpoint-mobile-max`
- No JS dependencies
- No other primitives required