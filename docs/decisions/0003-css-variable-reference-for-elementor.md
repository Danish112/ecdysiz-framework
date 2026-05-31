# ADR-0003: Elementor Variables Reference CSS Variables

**Status:** Accepted
**Date:** 2026-05-31
**Deciders:** Ecdysiz core team

## Context

The original Phase 1.6 plan emitted token values as literals into the
Elementor Kit/Variables JSON. This created two problems:

1. Dark-mode tension: Elementor stores one value; CSS variables remap
   under `[data-theme]`. If Elementor holds literals, theme-switching
   doesn't reach Elementor-built content.
2. UI import gap: Validation 3 surfaced that the Elementor 4.1.1 + Pro
   4.0.3 environment did not expose the Variables import/export UI.

## Decision

Elementor Variables hold CSS-variable references (`var(--ecz-color-surface)`)
rather than literal values. The build script still emits
`ecz-variables.json` for future automated import, but the production
mechanism is one-time UI wiring of Elementor Variables to reference the
generated CSS variables — after which all token changes flow automatically
through `tokens.css`.

## Consequences

**Easier:** dark mode reaches Elementor content for free; resilient to
Elementor Kit-JSON schema changes; reduces dependence on Elementor's
import UI surface.

**Harder:** initial one-time wiring step per site (creating the Elementor
Variables that point at CSS variables). Automatable via REST API later if
needed.

## Validated

Validation 3, May 2026. Token change in `tokens.json` → rebuild →
visible color change in Elementor-rendered content with no UI action.