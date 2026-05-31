<?php
/**
 * Cascade layer wrapping for Elementor stylesheets.
 *
 * Single responsibility: wrap Elementor's stylesheets into @layer elementor
 * via @import url(...) layer(elementor) so @layer client can override
 * Elementor CSS without !important.
 *
 * Validated in Validation 2 (May 2026) across Chrome, Firefox, Safari.
 * See docs/decisions/0002-cascade-import-layer.md.
 *
 * Populated in Step 7 (productionizes the validation script).
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Step 7:
 *   - emit @layer reset, framework, components, elementor, client; in wp_head.
 *   - filter style_loader_tag to wrap matched Elementor handles.
 *   - static handle list + dynamic patterns (local-{id}-frontend-*, elementor-post-{id}).
 */
