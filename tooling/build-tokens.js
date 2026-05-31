#!/usr/bin/env node
/**
 * Ecdysiz token build script.
 *
 * Reads src/tokens/tokens.json and generates:
 *   - theme/ecdysiz-core/assets/css/generated/tokens.css
 *   - dist/ecz-variables.json
 *
 * No dependencies. Node.js >= 20.
 *
 * Status: Scaffold version (matches Validation 3 script).
 * Step 5 productionizes this with the full token taxonomy and --client flag.
 */

'use strict';

const fs = require('fs');
const path = require('path');

const PROJECT_ROOT = path.resolve(__dirname, '..');
const TOKENS_INPUT = path.join(PROJECT_ROOT, 'src', 'tokens', 'tokens.json');
const CSS_OUTPUT = path.join(PROJECT_ROOT, 'theme', 'ecdysiz-core', 'assets', 'css', 'generated', 'tokens.css');
const JSON_OUTPUT = path.join(PROJECT_ROOT, 'dist', 'ecz-variables.json');

function resolveReference(ref, tokens) {
    if (typeof ref !== 'string' || !ref.startsWith('{') || !ref.endsWith('}')) {
        return ref;
    }
    const segments = ref.slice(1, -1).split('.');
    let current = tokens;
    for (const key of segments) {
        if (current === undefined || current === null || !(key in current)) {
            throw new Error(`Invalid token reference: "${ref}"`);
        }
        current = current[key];
    }
    if (typeof current !== 'string') {
        throw new Error(`Reference "${ref}" must resolve to a string`);
    }
    return current;
}

function sortedKeys(obj) {
    return Object.keys(obj).sort();
}

function primitiveVar(name) {
    return `--ecz-${name}`;
}

function semanticVar(category, name) {
    return `--ecz-${category}-${name}`;
}

function generateCss(tokens) {
    const lines = [];
    lines.push('/**');
    lines.push(' * Ecdysiz Tokens — GENERATED FILE');
    lines.push(' * Do not edit directly. Source: src/tokens/tokens.json');
    lines.push(` * Schema version: ${tokens['$schema-version'] || 'unknown'}`);
    lines.push(' */');
    lines.push('');
    lines.push('@layer reset, framework, components, elementor, client;');
    lines.push('');
    lines.push('@layer framework {');
    lines.push('  :root {');

    if (tokens.primitives) {
        for (const category of sortedKeys(tokens.primitives)) {
            for (const name of sortedKeys(tokens.primitives[category])) {
                lines.push(`    ${primitiveVar(name)}: ${tokens.primitives[category][name]};`);
            }
        }
    }

    lines.push('  }');
    lines.push('');
    lines.push('  [data-theme="light"], :root:not([data-theme="dark"]) {');

    if (tokens.semantic) {
        for (const category of sortedKeys(tokens.semantic)) {
            for (const name of sortedKeys(tokens.semantic[category])) {
                const tokenDef = tokens.semantic[category][name];
                const lightValue = (typeof tokenDef === 'object' && 'light' in tokenDef) ? tokenDef.light : tokenDef;
                let cssValue;
                if (typeof lightValue === 'string' && lightValue.startsWith('{primitives.')) {
                    const primName = lightValue.slice(1, -1).split('.').pop();
                    cssValue = `var(--ecz-${primName})`;
                } else {
                    cssValue = resolveReference(lightValue, tokens);
                }
                lines.push(`    ${semanticVar(category, name)}: ${cssValue};`);
            }
        }
    }

    lines.push('  }');
    lines.push('');
    lines.push('  [data-theme="dark"] {');

    if (tokens.semantic) {
        for (const category of sortedKeys(tokens.semantic)) {
            for (const name of sortedKeys(tokens.semantic[category])) {
                const tokenDef = tokens.semantic[category][name];
                if (typeof tokenDef !== 'object' || !('dark' in tokenDef)) {
                continue;
                }
                const darkValue = tokenDef.dark;
                let cssValue;
                if (typeof darkValue === 'string' && darkValue.startsWith('{primitives.')) {
                    const primName = darkValue.slice(1, -1).split('.').pop();
                    cssValue = `var(--ecz-${primName})`;
                } else {
                    cssValue = resolveReference(darkValue, tokens);
                }
                lines.push(`    ${semanticVar(category, name)}: ${cssValue};`);
            }
        }
    }

    lines.push('  }');
    lines.push('}');
    lines.push('');
    return lines.join('\n');
}

function generateJson(tokens) {
    const variables = {};
    if (tokens.semantic && tokens.semantic.color) {
        for (const name of sortedKeys(tokens.semantic.color)) {
            const tokenDef = tokens.semantic.color[name];
            const lightValue = (typeof tokenDef === 'object' && 'light' in tokenDef) ? tokenDef.light : tokenDef;
            const resolved = resolveReference(lightValue, tokens);
            variables[`ecz-color-${name}`] = {
                type: 'color',
                label: `ECZ ${name.charAt(0).toUpperCase() + name.slice(1)}`,
                value: resolved,
            };
        }
    }
    return JSON.stringify({
        version: '4.1',
        type: 'variables-and-classes',
        schemaVersion: tokens['$schema-version'] || '0.1.0',
        variables: variables,
        classes: {},
    }, null, 2) + '\n';
}

function main() {
    if (!fs.existsSync(TOKENS_INPUT)) {
        console.error(`ERROR: tokens.json not found at ${TOKENS_INPUT}`);
        process.exit(1);
    }
    let tokens;
    try {
        tokens = JSON.parse(fs.readFileSync(TOKENS_INPUT, 'utf8'));
    } catch (err) {
        console.error(`ERROR: ${err.message}`);
        process.exit(1);
    }
    fs.mkdirSync(path.dirname(CSS_OUTPUT), { recursive: true });
    fs.mkdirSync(path.dirname(JSON_OUTPUT), { recursive: true });
    fs.writeFileSync(CSS_OUTPUT, generateCss(tokens), 'utf8');
    fs.writeFileSync(JSON_OUTPUT, generateJson(tokens), 'utf8');
    console.log('✓ tokens.css      →', path.relative(PROJECT_ROOT, CSS_OUTPUT));
    console.log('✓ ecz-variables.json →', path.relative(PROJECT_ROOT, JSON_OUTPUT));
    console.log('Build complete.');
}

main();