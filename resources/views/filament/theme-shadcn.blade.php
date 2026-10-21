<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Force Light Mode & Strip Dark Mode Completely -->
<script>
    (function() {
        function enforceLightMode() {
            try {
                localStorage.setItem('theme', 'light');
            } catch (e) {}

            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
            }
            if (document.body && document.body.classList.contains('dark')) {
                document.body.classList.remove('dark');
            }
        }

        // Execute immediately
        enforceLightMode();

        // Execute on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', enforceLightMode);
        }

        // Execute on Livewire navigation
        document.addEventListener('livewire:navigated', enforceLightMode);
        document.addEventListener('livewire:init', enforceLightMode);

        // Persistent observer: guarantee 'dark' class can NEVER be attached to <html>
        try {
            const observer = new MutationObserver(function(mutations) {
                for (let mutation of mutations) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        if (document.documentElement.classList.contains('dark')) {
                            document.documentElement.classList.remove('dark');
                        }
                    }
                }
            });
            observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });
        } catch (e) {}
    })();
</script>

<!-- Shadcn Admin Pure Light Design System Overrides for Filament v3 -->
<style>
    :root, html, html.dark, body, .dark {
        color-scheme: light !important;
        --font-sans: 'Inter', system-ui, -apple-system, sans-serif;
        --radius: 0.625rem;
    }

    body, .fi-body,
    .dark body, .dark .fi-body {
        font-family: var(--font-sans) !important;
        letter-spacing: -0.011em;
        background-color: #f8fafc !important;
        color: #0f172a !important;
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

    /* Topbar Header & Navigation */
    .fi-topbar,
    .dark .fi-topbar {
        position: sticky !important;
        top: 0 !important;
        z-index: 30 !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        background-color: rgba(255, 255, 255, 0.88) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .fi-topbar > nav,
    .dark .fi-topbar > nav {
        background-color: transparent !important;
        border-color: transparent !important;
        box-shadow: none !important;
    }

    /* Header Headings & Subheadings */
    .fi-header-heading,
    .dark .fi-header-heading {
        color: #0f172a !important;
        font-weight: 700 !important;
        letter-spacing: -0.02em !important;
    }
    .fi-header-subheading,
    .dark .fi-header-subheading {
        color: #64748b !important;
    }

    /* Breadcrumbs */
    .fi-breadcrumbs-item-label,
    .dark .fi-breadcrumbs-item-label {
        color: #64748b !important;
        font-weight: 500 !important;
    }
    .fi-breadcrumbs-item-label:hover,
    .dark .fi-breadcrumbs-item-label:hover {
        color: #0f172a !important;
    }

    /* Sidebar: Clean Shadcn Slate Aesthetic */
    .fi-sidebar,
    .dark .fi-sidebar {
        border-right: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
    }

    /* Sidebar Navigation Items */
    .fi-sidebar-item-button,
    .dark .fi-sidebar-item-button {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        font-size: 0.875rem !important;
        color: #475569 !important;
        transition: all 0.15s ease-in-out !important;
    }
    .fi-sidebar-item-button:hover,
    .dark .fi-sidebar-item-button:hover {
        background-color: rgba(241, 245, 249, 0.9) !important;
        color: #0f172a !important;
    }
    .fi-sidebar-item-active .fi-sidebar-item-button,
    .dark .fi-sidebar-item-active .fi-sidebar-item-button {
        background-color: #0f172a !important;
        color: #ffffff !important;
        font-weight: 600 !important;
    }
    .fi-sidebar-item-active .fi-sidebar-item-icon,
    .dark .fi-sidebar-item-active .fi-sidebar-item-icon {
        color: inherit !important;
    }

    /* Navigation Group Headers */
    .fi-sidebar-group-label,
    .dark .fi-sidebar-group-label {
        font-size: 0.6875rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.05em !important;
        text-transform: uppercase !important;
        color: #94a3b8 !important;
    }

    /* Cards, Sections, Modals */
    .fi-section,
    .dark .fi-section,
    .fi-card,
    .dark .fi-card,
    .fi-modal-window,
    .dark .fi-modal-window {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }

    /* Tables: Shadcn Data Table Styling */
    .fi-ta-ctn,
    .dark .fi-ta-ctn,
    .fi-ta-content,
    .dark .fi-ta-content {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .fi-ta-header-toolbar,
    .dark .fi-ta-header-toolbar,
    .fi-ta-header-ctn,
    .dark .fi-ta-header-ctn {
        background-color: #ffffff !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
        color: #0f172a !important;
    }
    .fi-ta-header-cell,
    .dark .fi-ta-header-cell,
    th.fi-ta-header-cell {
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.04em !important;
        text-transform: uppercase !important;
        color: #64748b !important;
        background-color: rgba(248, 250, 252, 0.9) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .fi-ta-record,
    .dark .fi-ta-record,
    tr.fi-ta-record {
        background-color: #ffffff !important;
        color: #0f172a !important;
        border-bottom: 1px solid rgba(241, 245, 249, 0.9) !important;
        transition: background-color 0.1s ease !important;
    }
    .fi-ta-record:hover,
    .dark .fi-ta-record:hover {
        background-color: rgba(248, 250, 252, 0.8) !important;
    }
    .fi-ta-cell,
    .dark .fi-ta-cell {
        color: #0f172a !important;
    }
    .fi-ta-text,
    .dark .fi-ta-text,
    .fi-ta-text-item,
    .dark .fi-ta-text-item {
        color: #0f172a !important;
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
    .fi-input-wrp,
    .dark .fi-input-wrp {
        border-radius: 0.375rem !important;
        border: 1px solid rgba(203, 213, 225, 0.9) !important;
        background-color: #ffffff !important;
        color: #0f172a !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .fi-input-wrp:focus-within,
    .dark .fi-input-wrp:focus-within {
        border-color: #0f172a !important;
        ring: 2px solid rgba(15, 23, 42, 0.1) !important;
    }
    input, select, textarea,
    .dark input, .dark select, .dark textarea {
        color: #0f172a !important;
    }

    /* KPI Stat Widgets */
    .fi-wi-stats-overview-stat,
    .dark .fi-wi-stats-overview-stat {
        padding: 1.25rem !important;
        background-color: #ffffff !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .fi-wi-stats-overview-stat-value,
    .dark .fi-wi-stats-overview-stat-value {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.025em !important;
        margin-top: 0.35rem !important;
        color: #0f172a !important;
    }
    .fi-wi-stats-overview-stat-label,
    .dark .fi-wi-stats-overview-stat-label {
        font-size: 0.8125rem !important;
        font-weight: 500 !important;
        color: #64748b !important;
    }

    /* Simple / Login Page Card Overrides */
    .fi-simple-page,
    .dark .fi-simple-page {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: #f8fafc !important;
    }
    .fi-simple-main,
    .dark .fi-simple-main {
        border-radius: 0.75rem !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05) !important;
        padding: 2.25rem !important;
        max-width: 26rem !important;
    }
</style>
