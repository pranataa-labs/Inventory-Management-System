<!-- Google Fonts: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- Force Light Mode & Clear Dark Storage -->
<script>
    (function() {
        try {
            document.documentElement.classList.remove('dark');
            localStorage.removeItem('theme');
        } catch (e) {}
    })();
</script>

<!-- Shadcn Admin Light Design System Overrides for Filament v3 -->
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
        background-color: rgba(255, 255, 255, 0.85) !important;
        border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
    }

    /* Sidebar: Clean Shadcn Slate Aesthetic */
    .fi-sidebar {
        border-right: 1px solid rgba(226, 232, 240, 0.8) !important;
        background-color: #ffffff !important;
    }

    /* Sidebar Navigation Items */
    .fi-sidebar-item-button {
        border-radius: 0.375rem !important;
        font-weight: 500 !important;
        font-size: 0.875rem !important;
        color: #475569 !important;
        transition: all 0.15s ease-in-out !important;
    }
    .fi-sidebar-item-button:hover {
        background-color: rgba(241, 245, 249, 0.9) !important;
        color: #0f172a !important;
    }
    .fi-sidebar-item-active .fi-sidebar-item-button {
        background-color: #0f172a !important;
        color: #ffffff !important;
        font-weight: 600 !important;
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

    /* Cards, Sections, Modals, Widgets */
    .fi-section, 
    .fi-ta-content, 
    .fi-wi-stats-overview-stat,
    .fi-modal-window,
    .fi-card {
        border-radius: var(--radius) !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }

    /* Tables: Shadcn Data Table Styling */
    .fi-ta-header {
        border-bottom: 1px solid rgba(226, 232, 240, 0.8) !important;
    }
    .fi-ta-header-cell {
        font-size: 0.75rem !important;
        font-weight: 600 !important;
        letter-spacing: 0.04em !important;
        text-transform: uppercase !important;
        color: #64748b !important;
        background-color: rgba(248, 250, 252, 0.8) !important;
    }
    .fi-ta-record:hover {
        background-color: rgba(248, 250, 252, 0.7) !important;
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
        background-color: #ffffff !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04) !important;
    }
    .fi-input-wrp:focus-within {
        border-color: #0f172a !important;
        ring: 2px solid rgba(15, 23, 42, 0.1) !important;
    }

    /* KPI Stat Widgets */
    .fi-wi-stats-overview-stat {
        padding: 1.25rem !important;
        background-color: #ffffff !important;
    }
    .fi-wi-stats-overview-stat-value {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        letter-spacing: -0.025em !important;
        margin-top: 0.35rem !important;
        color: #0f172a !important;
    }
    .fi-wi-stats-overview-stat-label {
        font-size: 0.8125rem !important;
        font-weight: 500 !important;
        color: #64748b !important;
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
    .fi-simple-main {
        border-radius: 0.75rem !important;
        border: 1px solid rgba(226, 232, 240, 0.9) !important;
        background-color: #ffffff !important;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px -1px rgba(0, 0, 0, 0.05) !important;
        padding: 2.25rem !important;
        max-width: 26rem !important;
    }
</style>
