# Component: Button

**Status:** Production
**Layer:** `@layer components`
**Delivery:** Theme-delivered (CSS class)
**Version:** 0.0.1

## Description

Interactive primitive for actions. Used for form submits, links styled as buttons, and any user-triggered action. Three visual variants, three size variants.

## Required Markup

```html
<button type="button" class="ecdysiz-btn">Click me</button>
<a href="/path" class="ecdysiz-btn">Link button</a>
```

For Elementor: apply the class to an Elementor Button widget or Atomic Container with a link.

## Variants

| Class | Purpose |
|---|---|
| `.ecdysiz-btn` | Default primary action |
| `.ecdysiz-btn--secondary` | Secondary action |
| `.ecdysiz-btn--ghost` | Minimal/outline variant |
| `.ecdysiz-btn--sm` | Small size modifier |
| `.ecdysiz-btn--lg` | Large size modifier |

Combine size + variant: `.ecdysiz-btn .ecdysiz-btn--ghost .ecdysiz-btn--lg`

## Token Hooks (Override Points)

To re-skin via client `tokens.override.json`:

- `--ecdysiz-color-primary` — primary button background
- `--ecdysiz-color-primary-on` — primary button text
- `--ecdysiz-color-primary-hover` — primary hover state
- `--ecdysiz-color-secondary` / `--ecdysiz-color-secondary-on` — secondary variant
- `--ecdysiz-radius-control` — corner rounding
- `--ecdysiz-motion-hover` — transition timing

## Accessibility Baseline

- ✅ Keyboard accessible (native `<button>` or `<a>` element)
- ✅ Focus-visible outline (inherited from framework.css)
- ✅ Min touch target: 2.75rem (44px) height — meets WCAG 2.5.5
- ✅ Disabled state via `disabled` attribute or `aria-disabled="true"`
- ✅ Color contrast: primary tokens validated for AA in build (when full validation lands)

## Composition Rules

- ✅ Can be placed inside any container (placement-independent)
- ✅ Can be nested in `.ecdysiz-card__footer`
- ❌ Do NOT nest buttons inside buttons
- ❌ Do NOT use for non-interactive elements (use plain text)

## Dependencies

- Tokens: `color-primary*`, `color-secondary*`, `radius-control`, `motion-hover`, spacing tokens, typography tokens
- No JS dependencies
- No other primitives required