# Component: Card

**Status:** Production
**Layer:** `@layer components`
**Delivery:** Theme-delivered (CSS class)
**Version:** 0.0.1

## Description

Structural primitive with named slots for media, body, and footer content. Container-query-aware: switches to horizontal layout when the card's container is wide enough. **Content-agnostic** — Phase 2 marketing cards (testimonial, team, blog) compose this primitive by filling its slots.

## Required Markup

```html
<article class="ecdysiz-card">
  <div class="ecdysiz-card__media">
    <img src="..." alt="...">
  </div>
  <div class="ecdysiz-card__body">
    <h3>Title</h3>
    <p>Body content.</p>
  </div>
  <div class="ecdysiz-card__footer">
    <span>Footer left</span>
    <a class="ecdysiz-btn ecdysiz-btn--ghost ecdysiz-btn--sm">Action</a>
  </div>
</article>
```

All three slots are optional. Use only what's needed.

## Variants

| Class | Purpose |
|---|---|
| `.ecdysiz-card` | Default with subtle shadow |
| `.ecdysiz-card--flat` | No shadow, border only |
| `.ecdysiz-card--elevated` | Stronger shadow, raised feel |
| `.ecdysiz-card--horizontal` | Horizontal layout when container ≥ 30rem |

## Token Hooks (Override Points)

- `--ecdysiz-color-surface` — card background
- `--ecdysiz-color-surface-raised` — footer/media background
- `--ecdysiz-color-border` — card border
- `--ecdysiz-color-border-muted` — footer separator
- `--ecdysiz-radius-card` — corner rounding
- `--ecdysiz-shadow-sm`, `--ecdysiz-shadow-md`, `--ecdysiz-shadow-lg` — elevation
- `--ecdysiz-motion-hover` — hover transition

## Container Query Behavior

- Below 30rem container width: vertical stack (media → body → footer)
- 30rem and above with `.ecdysiz-card--horizontal`: media left, body+footer right

**Placement-independent:** the card adapts to whatever container width it's given, regardless of viewport.

## Accessibility Baseline

- ✅ Use semantic `<article>` element when card represents independent content
- ✅ Media slot images require `alt` attribute
- ✅ If card is clickable, wrap in `<a>` or use button — do NOT add click handler to the card element
- ✅ Focus-visible inherited for any interactive children

## Composition Rules

- ✅ Composable with: button, container
- ✅ Slots accept any content (text, images, other components)
- ❌ Do NOT nest cards inside cards
- ✅ Card is **content-agnostic** — use it as the base for Phase 2 marketing cards (testimonial, team, etc.)

## Dependencies

- Tokens: surface colors, border, radius-card, shadow tokens, motion-hover, spacing
- No JS dependencies
- Optional composition with: `.ecdysiz-btn`