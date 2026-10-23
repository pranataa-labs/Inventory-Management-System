# 📦 Enterprise Inventory Management System (Shadcn Admin UI)

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Filament](https://img.shields.io/badge/FilamentPHP-v3-F59E0B?style=for-the-badge)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)

An enterprise-grade Inventory Management System engineered with **Laravel 13, Filament v3, Tailwind CSS v4, and MySQL**, elevated with the refined aesthetics of the **Shadcn Admin Design System** (`satnaing/shadcn-admin`). Designed for tracking high-volume asset movements, auditing stock availability, processing complex vendor returns, and forecasting inventory turnover across multi-warehouse locations in real time.

---

## 📸 High-Definition Application Preview

<p align="center">
  <b>Enterprise Dashboard (Shadcn-Admin & 12-Month Stock Movement Overview)</b><br>
  <img src="screenshots/dashboard-preview.png" alt="Inventory Studio Dashboard" width="920">
</p>

---

## 🎨 Design System & UI/UX (Shadcn Admin)

- **Slate OKLCH Palette & Inter Typography:** High-contrast professional palette with Inter font and 0.625rem border radiuses (`rounded-xl`).
- **16rem Collapsible Sidebar:** Modular navigation collapsing smoothly into an iconic mini-rail on desktop displays.
- **Sticky Blurred Header:** Translucent sticky navbar with `backdrop-blur-md` and understated separation borders.
- **3-Way Theme Support (Light / Dark / System):** Native dark and light theme integration spanning all pages, data tables, modals, and charts.
- **Command Palette (`⌘K` / `Ctrl+K`):** Global instantaneous navigation and keyword search executable directly from the keyboard.

---

## 🚀 Key System Capabilities

### 1. Catalog Management & Multi-Warehouse Tracking
Manage product hierarchies and balance inventory allocations across distributed physical warehouses:
- **Product Catalog:** Comprehensive master records detailing SKU, Cost/Retail Pricing, and Threshold Alert levels.
- **Categories & Measurement Units:** Granular grouping and configurable units (Pieces, Boxes, Kilograms, Liters).
- **Supplier Directory:** Centralized vendor database with contact persons, lead times, and terms.
- **Multi-Warehouse Locations:** Dedicated tracking across branch facilities.

### 2. Transaction Integrity & Movement Safeguards
Enforces transactional consistency with zero-negative-inventory constraints:
- **Inbound Receipts:** Record arrivals and supplier replenishment.
- **Outbound Shipments:** Process customer orders and branch fulfillment. Transactions exceeding on-hand stock are blocked at the database engine level.
- **Asset Returns:** Separate workflows for Customer Returns and Vendor RMA dispatches.
- **Inter-Warehouse Transfers:** Dual-ledger atomic transfer recordings.
- **Physical Stock Opname:** Cycle counting discrepancy resolution via automated adjustments.
- **Integrated QR Code Scanner:** Automatic QR code generation and in-app camera scanning for rapid item identification.

### 3. Business Intelligence & Analytics
- **Low Stock Alerts:** Automated warnings when SKU balances fall below designated safety stock thresholds.
- **Financial Capital Valuation:** Live calculation of idle inventory asset valuation and gross profit potentials.
- **Stock Movement Trends (Line Chart):** Inbound vs. Outbound flow analytics.
- **Fast-Moving Products (Bar Chart):** Identify top 5 fastest-depleting inventory items.
- **Inventory Turnover Ratio:** Measure 30-day velocity metrics.
- **Dead Stock Analysis:** Surface stagnant SKUs to optimize warehouse capital.

### 4. Admin Route Obfuscation & Security Hardening
- **Dynamic Administrative Route:** Management panel paths avoid predictable routes (`/admin`) and are driven by `ADMIN_PREFIX` in `.env` (default: `inventaris-portal-mgmt`).
- **Automated Scanner Mitigation:** Direct requests to `/admin` immediately return **HTTP 404 Not Found**, cloaking the administrative surface from bot probes.
- **Role-Based Access Control (RBAC):** Strict separation between Administrator roles (full administrative permissions) and Warehouse Staff (transaction logging only).
- **Comprehensive Audit Trail:** Silent recording of system activities (Login, Logout, Failed Attempts, Modifications) logging IP addresses and User Agents.
- **Soft Delete Safeguards:** Non-destructive deletion on critical master data preventing accidental data loss.
- **Bulk Data Migration:** CSV/Excel import and export capabilities.

---

## 🛠️ System Requirements

- **PHP** 8.3 or higher
- **Composer**
- **Node.js & NPM**
- **MySQL / MariaDB**

---

## 📦 Local Installation & Setup Guide

### 1. Repository Cloning
```bash
git clone https://github.com/pranataa-labs/Inventory-Management-System.git
cd Inventory-Management-System
```

### 2. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```
Configure your database credentials in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventaris_db
DB_USERNAME=root
DB_PASSWORD=
ADMIN_PREFIX=inventaris-portal-mgmt
```

### 3. Dependency Installation
```bash
composer install
npm install && npm run build
```

### 4. Database Migration & Seeding
```bash
php artisan migrate:fresh --seed
```

### 5. Launch Development Server
```bash
php artisan serve
```
Access the application at `http://localhost:8000`.
