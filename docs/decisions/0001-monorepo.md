# ADR-0001: Monorepo Structure

**Status:** Accepted
**Date:** 2026-05-31
**Deciders:** Ecdysiz core team

## Context

Per-client child themes will live in their own repos consuming a tagged
framework release. But the framework parent theme, build tooling, tokens,
docs, and the reference child are tightly coupled and versioned together —
splitting them creates sync overhead before there's anything to sync.

## Decision

Single monorepo holds the parent theme, build tooling, token source, docs,
and reference child. Per-client child themes will live in separate repos.

## Consequences

**Easier:** atomic commits across tokens/build/theme; single CI; single
versioning surface.

**Harder:** repo is larger than a pure theme repo; clients can't fork just
the theme without the surrounding tooling (intentional — they shouldn't).

## Alternatives Considered

- **Theme + separate tooling repo:** rejected — sync overhead with no
  payoff until external consumers exist.