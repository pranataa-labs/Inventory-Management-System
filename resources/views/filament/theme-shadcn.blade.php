<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- 2-Mode Theme Resolution Script (Light vs Sistem) -->
<script>
    (function() {
        function resolveTheme() {
            try {
                const savedTheme = localStorage.getItem('theme') || 'system';
                const isDark = (savedTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
                if (isDark) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            } catch (e) {}
        }

        // Apply immediately
        resolveTheme();

        // Apply on DOM loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', resolveTheme);
        }

        // Apply on Livewire SPA navigation
        document.addEventListener('livewire:navigated', resolveTheme);
        document.addEventListener('livewire:init', resolveTheme);

        // Watch OS preference changes
        try {
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                const savedTheme = localStorage.getItem('theme') || 'system';
                if (savedTheme === 'system') {
                    if (e.matches) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                }
            });
        } catch (e) {}
    })();
</script>

<!-- Shadcn Admin Design System Overrides for Filament v3 (Light & Dark Support) -->
<style>
    :root {
        --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
        --radius: 0.625rem;
    }

    body, .fi-body {
        font-family: var(--font-sans) !important;
        letter-spacing: -0.011em;
        background-color: #f8fafc !important;
        color: #0f172a !important;
        -webkit-font-smoothing: antialiased;
    }
    .dark body, .dark .fi-body {
        background-color: #090d16 !important;
        color: #f8fafc !important;
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

    /* Topbar Header & Navigation */
    .fi-topbar {
        position: sticky !important;
        top: 0 !important;
        z-index: 30 !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        background-color: rgba(255, 255, 255, 0.88) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .dark .fi-topbar {
        background-color: rgba(9, 13, 22, 0.88) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .fi-topbar > nav {
        background-color: transparent !important;
        border-color: transparent !important;
        box-shadow: none !important;
    }
    .dark .fi-topbar > nav {
        background-color: transparent !important;
        border-color: transparent !important;
        box-shadow: none !important;
    }

    /* Header Headings & Subheadings */
    .fi-header-heading {
        color: #0f172a !important;
        font-weight: 700 !important;
        letter-spacing: -0.02em !important;
    }
    .dark .fi-header-heading {
        color: #f8fafc !important;
    }
    .fi-header-subheading {
        color: #64748b !important;
    }
    .dark .fi-header-subheading {
        color: #94a3b8 !important;
    }

    /* Breadcrumbs */
    .fi-breadcrumbs-item-label {
        color: #64748b !important;
        font-weight: 500 !important;
    }
    .dark .fi-breadcrumbs-item-label {
        color: #94a3b8 !important;
    }
    .fi-breadcrumbs-item-label:hover {
        color: #0f172a !important;
    }
    .dark .fi-breadcrumbs-item-label:hover {
        color: #f8fafc !important;
    }

    /* Sidebar: Clean Shadcn Slate Aesthetic */
    .fi-sidebar {
        border-right: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
    }
    .dark .fi-sidebar {
        border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        background-color: #090d16 !important;
    }

    /* Sidebar Navigation Items */
    .fi-sidebar-item-button {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        font-size: 0.875rem !important;
        color: #475569 !important;
        transition: all 0.15s ease-in-out !important;
    }
    .dark .fi-sidebar-item-button {
        color: #94a3b8 !important;
    }
    .fi-sidebar-item-button:hover {
        background-color: rgba(241, 245, 249, 0.9) !important;
        color: #0f172a !important;
    }
    .dark .fi-sidebar-item-button:hover {
        background-color: rgba(255, 255, 255, 0.06) !important;
        color: #f8fafc !important;
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

    /* Cards, Sections, Modals */
    .fi-section,
    .fi-card,
    .fi-modal-window {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .dark .fi-section,
    .dark .fi-card,
    .dark .fi-modal-window {
        border-color: rgba(255, 255, 255, 0.08) !important;
        background-color: #0f172a !important;
        color: #f8fafc !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.3) !important;
    }

    /* Tables: Shadcn Data Table Styling */
    .fi-ta-ctn,
    .fi-ta-content {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .dark .fi-ta-ctn,
    .dark .fi-ta-content {
        border-color: rgba(255, 255, 255, 0.08) !important;
        background-color: #0f172a !important;
    }
    .fi-ta-header-toolbar,
    .fi-ta-header-ctn {
        background-color: #ffffff !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
        color: #0f172a !important;
    }
    .dark .fi-ta-header-toolbar,
    .dark .fi-ta-header-ctn {
        background-color: #0f172a !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        color: #f8fafc !important;
    }
    .fi-ta-header-cell,
    th.fi-ta-header-cell {
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.04em !important;
        text-transform: uppercase !important;
        color: #64748b !important;
        background-color: rgba(248, 250, 252, 0.9) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .dark .fi-ta-header-cell,
    .dark th.fi-ta-header-cell {
        color: #94a3b8 !important;
        background-color: rgba(15, 23, 42, 0.8) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .fi-ta-record,
    tr.fi-ta-record {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-bottom: 1px solid rgba(241, 245, 249, 0.9) !important;
        transition: background-color 0.1s ease !important;
    }
    .dark .fi-ta-record,
    .dark tr.fi-ta-record {
        background-color: #0f172a !important;
        color: #f8fafc !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06) !important;
    }
    .fi-ta-record:hover {
        background-color: rgba(248, 250, 252, 0.8) !important;
    }
    .dark .fi-ta-record:hover {
        background-color: rgba(255, 255, 255, 0.04) !important;
    }
    .fi-ta-cell {
        color: #0f172a !important;
    }
    .dark .fi-ta-cell {
        color: #f8fafc !important;
    }
    .fi-ta-text,
    .fi-ta-text-item {
        color: #0f172a !important;
    }
    .dark .fi-ta-text,
    .dark .fi-ta-text-item {
        color: #f8fafc !important;
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
        border: 1px solid rgba(203, 213, 225, 0.9) !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .dark .fi-input-wrp {
        border-color: rgba(255, 255, 255, 0.12) !important;
        background-color: rgba(15, 23, 42, 0.6) !important;
        color: #f8fafc !important;
    }
    .fi-input-wrp:focus-within {
        border-color: #0f172a !important;
        ring: 2px solid rgba(15, 23, 42, 0.1) !important;
    }
    .dark .fi-input-wrp:focus-within {
        border-color: #f8fafc !important;
        ring: 2px solid rgba(248, 250, 252, 0.15) !important;
    }
    input, select, textarea {
        color: #0f172a !important;
    }
    .dark input, .dark select, .dark textarea {
        color: #f8fafc !important;
    }

    /* KPI Stat Widgets */
    .fi-wi-stats-overview-stat {
        padding: 1.25rem !important;
        background-color: #ffffff !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .dark .fi-wi-stats-overview-stat {
        background-color: #0f172a !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
    }
    .fi-wi-stats-overview-stat-value {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.025em !important;
        margin-top: 0.35rem !important;
        color: #0f172a !important;
    }
    .dark .fi-wi-stats-overview-stat-value {
        color: #f8fafc !important;
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
        background-color: #0f172a !important;
        border-color: rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3) !important;
    }
</style>
