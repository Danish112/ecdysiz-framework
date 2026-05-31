# ADR-0002: Cascade Control via @import + layer()

**Status:** Accepted
**Date:** 2026-05-31
**Deciders:** Ecdysiz core team

## Context

Elementor 4.x emits unlayered CSS, which beats layered CSS regardless of
layer order. The framework needs `@layer client` to override Elementor's
CSS without `!important` so client overrides win cleanly.

Tested in Validation 2 (Gate Zero) across Chrome, Firefox, Safari.

## Decision

At enqueue time, convert Elementor's `<link>` stylesheets into `<style>`
blocks containing `@import url("...") layer(elementor) <media>;`. This
places Elementor's CSS into `@layer elementor` (between `framework` and
`client` in the cascade order), allowing `@layer client` to win.

## Consequences

**Easier:** clean overrides without `!important`; cascade is fully
predictable; client overrides are a structural guarantee, not a
specificity arms race.

**Harder:** requires runtime conversion of Elementor's enqueued styles;
the handle matcher must stay current with Elementor's evolving stylesheet
naming.

## Alternatives Considered

- **`:where()` scoping:** kept as recovery path. Lowers Elementor's
  specificity to zero, but less expressive than layer order.
- **Partial-unlayered client:** kept as fallback. Cleaner intent
  expressed via `@layer`.

## Validated

Validation 2, May 2026, all three browsers green.