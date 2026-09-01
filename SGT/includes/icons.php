<?php
/**
 * Inline SVG icon set (outline style, 1.75px stroke, 24px grid) — no icon font, no external
 * request, themeable via currentColor. Mirrors the Phosphor "regular" visual language.
 */
function icon(string $name, string $class = 'icon'): string
{
    $paths = [
        'logo' => '<path d="M9 11.5l2 2 4-4.5" /><rect x="3.75" y="3.75" width="16.5" height="16.5" rx="5" />',
        'plus' => '<path d="M12 5v14M5 12h14" />',
        'x' => '<path d="M6 6l12 12M18 6L6 18" />',
        'check' => '<path d="M5 12.5l4.5 4.5L19 7" />',
        'check-circle' => '<circle cx="12" cy="12" r="8.25" /><path d="M8.5 12.3l2.3 2.3 4.7-5" />',
        'pencil' => '<path d="M4 20l.9-3.9L16.6 4.4a1.5 1.5 0 0 1 2.1 0l.9.9a1.5 1.5 0 0 1 0 2.1L7.9 19.1 4 20Z" /><path d="M14.6 6.4l3 3" />',
        'trash' => '<path d="M5 7h14" /><path d="M9.5 7V5.2A1.2 1.2 0 0 1 10.7 4h2.6a1.2 1.2 0 0 1 1.2 1.2V7" /><path d="M7 7l.8 12a1.5 1.5 0 0 0 1.5 1.4h5.4a1.5 1.5 0 0 0 1.5-1.4L17 7" /><path d="M10.3 11v6M13.7 11v6" />',
        'user' => '<circle cx="12" cy="8.3" r="3.3" /><path d="M4.8 19.5a7.2 7.2 0 0 1 14.4 0" />',
        'sign-out' => '<path d="M9 4.5H6a1.5 1.5 0 0 0-1.5 1.5v12A1.5 1.5 0 0 0 6 19.5h3" /><path d="M14 8l4 4-4 4" /><path d="M18 12H9.5" />',
        'sign-in' => '<path d="M15 4.5h3a1.5 1.5 0 0 1 1.5 1.5v12a1.5 1.5 0 0 1-1.5 1.5h-3" /><path d="M10 8l4 4-4 4" /><path d="M14 12H4.5" />',
        'eye' => '<path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12Z" /><circle cx="12" cy="12" r="2.75" />',
        'eye-slash' => '<path d="M3.5 3.5l17 17" /><path d="M10.6 5.7A10.7 10.7 0 0 1 12 5.5c6 0 9.5 6.5 9.5 6.5a15.7 15.7 0 0 1-3 3.9M7.4 7.4C4.8 9 2.5 12 2.5 12S6 18.5 12 18.5a9.8 9.8 0 0 0 3.1-.5" /><path d="M9.7 10.2a2.75 2.75 0 0 0 3.9 3.9" />',
        'search' => '<circle cx="10.8" cy="10.8" r="6.3" /><path d="M20 20l-4.5-4.5" />',
        'sun' => '<circle cx="12" cy="12" r="4.25" /><path d="M12 2.5v2.4M12 19.1v2.4M4.6 4.6l1.7 1.7M17.7 17.7l1.7 1.7M2.5 12h2.4M19.1 12h2.4M4.6 19.4l1.7-1.7M17.7 6.3l1.7-1.7" />',
        'moon' => '<path d="M20 14.2A8.5 8.5 0 1 1 9.8 4a6.6 6.6 0 0 0 10.2 10.2Z" />',
        'warning' => '<path d="M12 3.5L21.5 20h-19L12 3.5Z" /><path d="M12 10v4.2M12 17.3v.1" />',
        'clipboard' => '<rect x="5.5" y="5" width="13" height="15" rx="1.8" /><path d="M9 5V4a1.5 1.5 0 0 1 1.5-1.5h3A1.5 1.5 0 0 1 15 4v1" /><path d="M8.5 11h7M8.5 14.5h7M8.5 18h4.5" />',
        'clock' => '<circle cx="12" cy="12" r="8.25" /><path d="M12 7.5V12l3 2" />',
        'spinner' => '<path d="M12 3.5v3.2M18.4 5.6l-2.3 2.3M20.5 12h-3.2M18.4 18.4l-2.3-2.3M12 20.5v-3.2M5.6 18.4l2.3-2.3M3.5 12h3.2M5.6 5.6l2.3 2.3" />',
    ];

    $body = $paths[$name] ?? $paths['warning'];

    return '<svg class="' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
        . 'stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">'
        . $body . '</svg>';
}
