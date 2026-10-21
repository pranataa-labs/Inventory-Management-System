<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Anti-FOUC Theme Script -->
<script>
    (function() {
        try {
            const savedTheme = localStorage.getItem('theme') || 'system';
            const isDark = savedTheme === 'dark' || (savedTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        } catch (e) {}
    })();
</script>

<!-- Shadcn Admin Design System Overrides for Filament v3 -->
<style>
    :root {
        --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
        --radius: 0.625rem;
    }

    body, .fi-body {
        font-family: var(--font-sans) !important;
        letter-spacing: -0.011em;
        -webkit-font-smoothing: antialiased;
    }

    /* Scrollbar */
    * {
        scrollbar-width: thin;
        scrollbar-color: rgba(148, 163, 184, 0.3) transparent;
    }
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        background: rgba(148, 163, 184, 0.3);
        border-radius: 9999px;
    }
    ::-webkit-scrollbar-thumb:hover {
        background: rgba(148, 163, 184, 0.5);
    }

    /* Topbar Header: Sticky Blurred Effect */
    .fi-topbar {
        position: sticky !important;
        top: 0 !important;
        z-index: 30 !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        background-color: rgba(255, 255, 255, 0.82) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .dark .fi-topbar {
        background-color: rgba(9, 13, 22, 0.85) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }

    /* Sidebar: Clean Shadcn Slate Aesthetic */
    .fi-sidebar {
        border-right: 1px solid rgba(226, 232, 240, 0.8) !important;
        background-color: #ffffff !important;
    }
    .dark .fi-sidebar {
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        background-color: oklch(0.129 0.042 264.695) !important;
    }

    /* Sidebar Navigation Items */
    .fi-sidebar-item-button {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        font-size: 0.875rem !important;
        transition: all 0.15s ease-in-out !important;
    }
    .fi-sidebar-item-button:hover {
        background-color: rgba(241, 245, 249, 0.8) !important;
    }
    .dark .fi-sidebar-item-button:hover {
        background-color: rgba(255, 255, 255, 0.06) !important;
    }
    .fi-sidebar-item-active .fi-sidebar-item-button {
        background-color: #0f172a !important;
        color: #ffffff !important;
        font-weight: 600 !important;
    }
    .dark .fi-sidebar-item-active .fi-sidebar-item-button {
        background-color: rgba(255, 255, 255, 0.12) !important;
        color: #f8fafc !important;
    }
    .fi-sidebar-item-active .fi-sidebar-item-icon {
        color: inherit !important;
    }

    /* Navigation Group Headers */
    .fi-sidebar-group-label {
        font-size: 0.6875rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.05em !important;
        text-transform: uppercase !important;
        color: #94a3b8 !important;
    }
    .dark .fi-sidebar-group-label {
        color: #64748b !important;
    }

    /* Cards, Sections, Modals, Widgets */
    .fi-section, 
    .fi-ta-content, 
    .fi-wi-stats-overview-stat,
    .fi-modal-window,
    .fi-card {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .dark .fi-section, 
    .dark .fi-ta-content, 
    .dark .fi-wi-stats-overview-stat,
    .dark .fi-modal-window,
    .dark .fi-card {
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        background-color: oklch(0.14 0.04 259.21) !important;
    }

    /* Tables: Shadcn Data Table Styling */
    .fi-ta-header {
        border-bottom: 1px solid rgba(226, 232, 240, 0.8) !important;
    }
    .dark .fi-ta-header {
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .fi-ta-header-cell {
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.04em !important;
        text-transform: uppercase !important;
        color: #64748b !important;
        background-color: rgba(248, 250, 252, 0.8) !important;
    }
    .dark .fi-ta-header-cell {
        color: #94a3b8 !important;
        background-color: rgba(15, 23, 42, 0.6) !important;
    }
    .fi-ta-record:hover {
        background-color: rgba(248, 250, 252, 0.6) !important;
    }
    .dark .fi-ta-record:hover {
        background-color: rgba(255, 255, 255, 0.03) !important;
    }

    /* Badges */
    .fi-badge {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        font-size: 0.75rem !important;
        letter-spacing: 0.01em !important;
    }

    /* Buttons */
    .fi-btn {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        transition: all 0.15s ease-in-out !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }

    /* Inputs, Selects, Dropdowns */
    .fi-input-wrp {
        border-radius: 0.375rem !important;
        border-color: rgba(203, 213, 225, 0.8) !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .dark .fi-input-wrp {
        border-color: rgba(255, 255, 255, 0.12) !important;
        background-color: rgba(15, 23, 42, 0.5) !important;
    }
    .fi-input-wrp:focus-within {
        border-color: #0f172a !important;
        ring: 2px solid rgba(15, 23, 42, 0.1) !important;
    }
    .dark .fi-input-wrp:focus-within {
        border-color: #f8fafc !important;
        ring: 2px solid rgba(248, 250, 252, 0.15) !important;
    }

    /* KPI Stat Widgets */
    .fi-wi-stats-overview-stat {
        padding: 1.25rem !important;
    }
    .fi-wi-stats-overview-stat-value {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.025em !important;
        margin-top: 0.35rem !important;
    }
    .fi-wi-stats-overview-stat-label {
        font-size: 0.8125rem !important;
        font-weight: 500 !important;
        color: #64748b !important;
    }
    .dark .fi-wi-stats-overview-stat-label {
        color: #94a3b8 !important;
    }

    /* Simple / Login Page Card Overrides */
    .fi-simple-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc !important;
    }
    .dark .fi-simple-page {
        background-color: #090d16 !important;
    }
    .fi-simple-main {
        border-radius: 0.75rem !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05) !important;
        padding: 2.25rem !important;
        max-width: 26rem !important;
    }
    .dark .fi-simple-main {
        background-color: oklch(0.14 0.04 259.21) !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.2) !important;
    }
</style>
