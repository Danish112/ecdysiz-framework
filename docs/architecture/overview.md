# Architecture Overview

**Status:** Stub (Step 1). Populated in Step 6.

The Ecdysiz framework is a WordPress parent theme + per-client child theme
model using Elementor Pro 4.1.x as the page builder, with all design values
flowing from a single `tokens.json` source through a build step into both
CSS custom properties and Elementor's design system.

Validated in May 2026 across Chrome, Firefox, Safari.

See `decisions/` for the load-bearing decisions.