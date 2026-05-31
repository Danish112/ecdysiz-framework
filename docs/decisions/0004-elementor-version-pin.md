# ADR-0004: Elementor Pro 4.1.x Pin

**Status:** Accepted
**Date:** 2026-05-31
**Deciders:** Ecdysiz core team

## Context

Validation 1 verified the current Elementor ecosystem in May 2026 as 4.1
across both Elementor (free) and Elementor Pro. V4 introduced the Atomic
Editor — the largest architectural shift in Elementor's history — including
Variables, Classes, Components, and a Flexbox Container model.

The framework architecture was designed against an assumed V3 pin from
Phase 1.1. Validation 1 retargeted onto V4 reality.

## Decision

Pin to Elementor Pro 4.1.x and Elementor 4.1.x with Atomic Editor enabled.
Treat Elementor version bumps as framework releases (test → re-validate →
ADR → release).

## Consequences

**Easier:** the framework targets current and forward-looking Elementor
architecture; V4's Variables system aligns with the framework's tiered
token model; granularity tension from Phase 1.3 review dissolves.

**Harder:** V4 ecosystem is still maturing; third-party addon compatibility
is settling; Pro release lag (we encountered Pro 4.0.3 vs Elementor 4.1.1)
is a real operational concern.

## Validated

Validations 1, 2, 3, May 2026.