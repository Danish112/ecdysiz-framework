module.exports = [
    {
        ignores: ['node_modules/**', 'dist/**', '**/generated/**', 'vendor/**'],
    },
    {
        files: ['tooling/**/*.js', 'theme/**/*.js', 'reference-child/**/*.js'],
        languageOptions: {
            ecmaVersion: 2022,
            sourceType: 'script',
            globals: {
                wp: 'readonly',
                jQuery: 'readonly',
                elementor: 'readonly',
                ecz: 'writable',
            },
        },
        rules: {
            'no-unused-vars': ['warn', { argsIgnorePattern: '^_' }],
            'no-undef': 'error',
            'no-console': ['warn', { allow: ['warn', 'error'] }],
            semi: ['error', 'always'],
            quotes: ['error', 'single', { avoidEscape: true }],
            indent: ['error', 4, { SwitchCase: 1 }],
            'no-var': 'error',
            'prefer-const': 'error',
            eqeqeq: ['error', 'always'],
            curly: ['error', 'all'],
        },
    },
];