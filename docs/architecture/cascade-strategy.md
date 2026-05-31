# Cascade Strategy

**Status:** Validated. Documented here Step 7.

## Layer Order

```css
@layer reset, framework, components, elementor, client;
```

## Technique

Elementor stylesheets are wrapped at enqueue time via the
`style_loader_tag` filter, converted from `<link>` to `<style>` containing
`@import url("...") layer(elementor)`.

Proven across Chrome, Firefox, Safari (Validation 2, May 2026).
See `decisions/0002-cascade-import-layer.md`.