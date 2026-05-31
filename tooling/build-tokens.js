#!/usr/bin/env node
/**
 * Ecdysiz token build script — v1.0.
 *
 * Reads src/tokens/tokens.json and generates:
 *   - theme/ecdysiz-core/assets/css/generated/tokens.css
 *   - dist/ecz-variables.json
 *
 * Per-client mode (--client=<name>):
 *   - Merges reference-child/<name>/tokens.override.json into base tokens
 *   - Outputs to reference-child/<name>/assets/css/generated/tokens.css
 *   - Outputs to dist/<name>-variables.json
 *
 * No dependencies. Node.js >= 20.
 */

'use strict';

const fs = require('fs');
const path = require('path');

const PROJECT_ROOT = path.resolve(__dirname, '..');

// Parse --client=<name> argument for per-client builds.
const args = process.argv.slice(2);
const clientArg = args.find(function (a) { return a.startsWith('--client='); });
const CLIENT = clientArg ? clientArg.split('=')[1] : null;

// Paths depend on whether this is a parent or per-client build.
const TOKENS_INPUT = path.join(PROJECT_ROOT, 'src', 'tokens', 'tokens.json');

const CLIENT_OVERRIDE_INPUT = CLIENT
    ? path.join(PROJECT_ROOT, 'reference-child', CLIENT, 'tokens.override.json')
    : null;

const CSS_OUTPUT = CLIENT
    ? path.join(PROJECT_ROOT, 'reference-child', CLIENT, 'assets', 'css', 'generated', 'tokens.css')
    : path.join(PROJECT_ROOT, 'theme', 'ecdysiz-core', 'assets', 'css', 'generated', 'tokens.css');

const JSON_OUTPUT = CLIENT
    ? path.join(PROJECT_ROOT, 'dist', CLIENT + '-variables.json')
    : path.join(PROJECT_ROOT, 'dist', 'ecz-variables.json');

// ----------------------------------------------------------------------------
// Helpers
// ----------------------------------------------------------------------------

function deepMerge(base, override) {
    const result = JSON.parse(JSON.stringify(base));
    for (const key of Object.keys(override)) {
        if (typeof override[key] === 'object' && override[key] !== null && !Array.isArray(override[key])) {
            result[key] = result[key] ? deepMerge(result[key], override[key]) : override[key];
        } else {
            result[key] = override[key];
        }
    }
    return result;
}

function resolveReference(value, tokens) {
    if (typeof value !== 'string') {
        return value;
    }
    return value.replace(/\{([^}]+)\}/g, function (match, refPath) {
        const segments = refPath.split('.');
        let current = tokens;
        for (const key of segments) {
            if (current === undefined || current === null || !(key in current)) {
                throw new Error(`Invalid token reference: "${match}"`);
            }
            current = current[key];
        }
        if (typeof current !== 'string') {
            throw new Error(`Reference "${match}" must resolve to a string`);
        }
        return current;
    });
}

function refToCssVar(value, prefix) {
    if (typeof value !== 'string') {
        return value;
    }
    return value.replace(/\{primitives\.([^.]+)\.([^}]+)\}/g, function (match, category, name) {
        return `var(--ecdysiz-${name})`;
    });
}

function sortedKeys(obj) {
    return Object.keys(obj).sort();
}

function primitiveVar(name) {
    return `--ecdysiz-${name}`;
}

function semanticVar(category, name) {
    return `--ecdysiz-${category}-${name}`;
}

function clampFromTokens(minToken, maxToken, viewportMin, viewportMax) {
    const min = parseFloat(minToken);
    const max = parseFloat(maxToken);
    const vMin = parseFloat(viewportMin);
    const vMax = parseFloat(viewportMax);

    const slope = (max - min) / (vMax - vMin);
    const intercept = min - slope * vMin;

    const slopeVw = (slope * 100).toFixed(4);
    const interceptRem = intercept.toFixed(4);

    return `clamp(${min}rem, ${interceptRem}rem + ${slopeVw}vw, ${max}rem)`;
}

// ----------------------------------------------------------------------------
// CSS generators by category
// ----------------------------------------------------------------------------

function emitPrimitives(tokens, lines) {
    lines.push('  :root {');

    if (!tokens.primitives) {
        lines.push('  }');
        return;
    }

    for (const category of sortedKeys(tokens.primitives)) {
        const entries = tokens.primitives[category];
        if (typeof entries !== 'object') {
            continue;
        }

        for (const name of sortedKeys(entries)) {
            const value = entries[name];

            if (category === 'type-size') {
                continue;
            }

            lines.push(`    ${primitiveVar(name)}: ${value};`);
        }
    }

    if (tokens.primitives['type-size'] && tokens.primitives.typography) {
        const vMin = tokens.primitives.typography['viewport-min'];
        const vMax = tokens.primitives.typography['viewport-max'];
        const sizes = tokens.primitives['type-size'];

        const roles = new Set();
        for (const key of Object.keys(sizes)) {
            const match = key.match(/^(.+)-(min|max)$/);
            if (match) {
                roles.add(match[1]);
            }
        }

        for (const role of [...roles].sort()) {
            const minKey = `${role}-min`;
            const maxKey = `${role}-max`;
            if (sizes[minKey] && sizes[maxKey]) {
                const clamp = clampFromTokens(sizes[minKey], sizes[maxKey], vMin, vMax);
                lines.push(`    --ecdysiz-type-${role}: ${clamp};`);
            }
        }
    }

    lines.push('  }');
    lines.push('');
}

function emitSemanticForTheme(tokens, themeKey, selector, lines) {
    lines.push(`  ${selector} {`);

    if (!tokens.semantic) {
        lines.push('  }');
        return;
    }

    for (const category of sortedKeys(tokens.semantic)) {
        const entries = tokens.semantic[category];
        if (typeof entries !== 'object') {
            continue;
        }

        for (const name of sortedKeys(entries)) {
            const tokenDef = entries[name];

            let rawValue;
            let isThemeAware = false;

            if (typeof tokenDef === 'object' && tokenDef !== null && (themeKey in tokenDef)) {
                rawValue = tokenDef[themeKey];
                isThemeAware = true;
            } else if (typeof tokenDef === 'string') {
                rawValue = tokenDef;
            } else {
                continue;
            }

            if (!isThemeAware && themeKey === 'dark') {
                continue;
            }

            const cssValue = refToCssVar(rawValue, category);
            lines.push(`    ${semanticVar(category, name)}: ${cssValue};`);
        }
    }

    lines.push('  }');
    lines.push('');
}

// ----------------------------------------------------------------------------
// Top-level CSS generation
// ----------------------------------------------------------------------------

function generateCss(tokens) {
    const lines = [];

    lines.push('/**');
    lines.push(' * Ecdysiz Tokens — GENERATED FILE');
    lines.push(' * Do not edit directly. Source: src/tokens/tokens.json');
    lines.push(` * Schema version: ${tokens['$schema-version'] || 'unknown'}`);
    if (CLIENT) {
        lines.push(` * Client build: ${CLIENT}`);
    }
    lines.push(' */');
    lines.push('');
    lines.push('@layer reset, framework, components, elementor, client;');
    lines.push('');
    lines.push('@layer framework {');

    emitPrimitives(tokens, lines);
    emitSemanticForTheme(tokens, 'light', '[data-theme="light"], :root:not([data-theme="dark"])', lines);
    emitSemanticForTheme(tokens, 'dark', '[data-theme="dark"]', lines);

    lines.push('}');
    lines.push('');

    return lines.join('\n');
}

// ----------------------------------------------------------------------------
// Elementor Variables JSON (V4 format)
// ----------------------------------------------------------------------------

function generateJson(tokens) {
    const variables = {};

    if (tokens.semantic && tokens.semantic.color) {
        for (const name of sortedKeys(tokens.semantic.color)) {
            const tokenDef = tokens.semantic.color[name];
            const lightValue = (typeof tokenDef === 'object' && 'light' in tokenDef)
                ? tokenDef.light
                : tokenDef;
            const resolved = resolveReference(lightValue, tokens);

            variables[`ecdysiz-color-${name}`] = {
                type: 'color',
                label: `Ecdysiz ${name}`,
                value: resolved,
            };
        }
    }

    const output = {
        version: '4.1',
        type: 'variables-and-classes',
        schemaVersion: tokens['$schema-version'] || '0.0.0',
        client: CLIENT || 'parent',
        variables: variables,
        classes: {},
    };

    return JSON.stringify(output, null, 2) + '\n';
}

// ----------------------------------------------------------------------------
// Main
// ----------------------------------------------------------------------------

function main() {
    if (!fs.existsSync(TOKENS_INPUT)) {
        console.error(`ERROR: tokens.json not found at ${TOKENS_INPUT}`);
        process.exit(1);
    }

    let tokens;
    try {
        tokens = JSON.parse(fs.readFileSync(TOKENS_INPUT, 'utf8'));
    } catch (err) {
        console.error(`ERROR: failed to parse tokens.json — ${err.message}`);
        process.exit(1);
    }

    // If client build, merge override into base tokens.
    if (CLIENT) {
        if (!fs.existsSync(CLIENT_OVERRIDE_INPUT)) {
            console.error(`ERROR: client override not found at ${CLIENT_OVERRIDE_INPUT}`);
            process.exit(1);
        }
        let override;
        try {
            override = JSON.parse(fs.readFileSync(CLIENT_OVERRIDE_INPUT, 'utf8'));
        } catch (err) {
            console.error(`ERROR: failed to parse override — ${err.message}`);
            process.exit(1);
        }
        tokens = deepMerge(tokens, override);
    }

    fs.mkdirSync(path.dirname(CSS_OUTPUT), { recursive: true });
    fs.mkdirSync(path.dirname(JSON_OUTPUT), { recursive: true });

    let css, json;
    try {
        css = generateCss(tokens);
        json = generateJson(tokens);
    } catch (err) {
        console.error(`ERROR: ${err.message}`);
        process.exit(1);
    }

    fs.writeFileSync(CSS_OUTPUT, css, 'utf8');
    fs.writeFileSync(JSON_OUTPUT, json, 'utf8');

    console.log('✓ tokens.css           →', path.relative(PROJECT_ROOT, CSS_OUTPUT));
    console.log('✓ ecz-variables.json   →', path.relative(PROJECT_ROOT, JSON_OUTPUT));
    if (CLIENT) {
        console.log(`Build complete (client: ${CLIENT}).`);
    } else {
        console.log('Build complete.');
    }
}

main();