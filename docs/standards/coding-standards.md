# Coding Standards

**Status:** Stub (Step 1). Populated in Step 2.

## PHP

- WordPress Coding Standards (WPCS)
- `ecz_` prefix on all functions
- `Ecdysiz_` prefix on classes
- All output escaped

## CSS

- `ecz-` prefix on all custom properties and class selectors
- No `!important` outside an explicitly allowlisted file
- No raw color or size values — tokens only

## JavaScript

- `ecz` namespace on global objects
- Prettier formatting

All enforced in CI from Step 2 onward.