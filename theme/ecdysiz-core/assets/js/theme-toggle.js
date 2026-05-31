/* eslint-disable no-undef */
/**
 * Ecdysiz dark-mode toggle button handler.
 *
 * The inline FOUC script in header.php sets the initial theme.
 * This script wires up the toggle button(s) to switch + persist.
 */
( function () {
    'use strict';

    function getCurrentTheme() {
        return document.documentElement.getAttribute( 'data-theme' ) || 'light';
    }

    function setTheme( theme ) {
        document.documentElement.setAttribute( 'data-theme', theme );
        try {
            localStorage.setItem( 'ecdysiz-theme', theme );
        } catch ( e ) {
            // localStorage unavailable — theme still applies for this session.
        }
    }

    function toggleTheme() {
        const current = getCurrentTheme();
        setTheme( current === 'dark' ? 'light' : 'dark' );
    }

    function init() {
        const toggles = document.querySelectorAll( '[data-ecdysiz-theme-toggle]' );
        for ( let i = 0; i < toggles.length; i++ ) {
            toggles[ i ].addEventListener( 'click', toggleTheme );
        }
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', init );
    } else {
        init();
    }
}() );