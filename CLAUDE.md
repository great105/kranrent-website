# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

БПМ Альянс (BPM Alyans) — static multi-page website for a crane rental company in Minsk, Belarus. Pure HTML/CSS/JS, no frameworks or build tools. A parallel WordPress theme lives in `bpm-alyans/`.

## Development

No build step. Serve with any static server:
```bash
python -m http.server 8000
```

For the WordPress version:
```bash
docker-compose up -d   # WordPress at localhost:8088
```

No package.json, no dependencies to install for the static site.

## Architecture

**Static site (root) — 8 HTML pages:**
- `index.html` — homepage (hero, services grid, advantages, process steps, news, FAQ accordion, contact form, SEO text)
- `about.html`, `contacts.html`, `news.html` — standalone pages
- `services/` — 4 service detail pages (tower-cranes, mobile-cranes, crawler-cranes, installation)

**Assets:**
- `css/style.css` — single stylesheet (CSS variables, BEM naming, responsive breakpoints at 480/768/1024px)
- `js/main.js` — minimal vanilla JS (mobile nav toggle, FAQ accordion, form stub, sticky header shadow)
- `img/` — images (`cranes/`, `icons/`, logos, hero backgrounds)

**WordPress theme (`bpm-alyans/`):**
- Mirrors the static site as a WP theme with `header.php`/`footer.php`, page templates (`page-about.php`, `page-contacts.php`, etc.), and `template-parts/contact-form.php`
- Shares the same CSS variables and design; its `style.css` duplicates the root `css/style.css` with WP theme headers added
- Runs via `docker-compose.yml` (MySQL 8 + WordPress, theme mounted at `/wp-content/themes/bpm-alyans`)

**Critical: shared layout.** Header and footer are duplicated across all 8 HTML files (no templating). When modifying nav or footer, update all 8 files. Similarly, keep the WP theme's `header.php`/`footer.php` in sync.

## CSS Conventions

**Color variables** in `:root` (note: variable is named `--orange` but the actual color is blue/indigo):
- `--orange` (#6179D8) — primary/CTA color
- `--orange-hover` (#4F64B8) — hover state
- `--dark` (#191919) — dark backgrounds

**BEM naming:** `.block__element--modifier` (e.g., `.service-card__icon`, `.btn--primary`, `.section--gray`)

**Container:** max-width 1200px, 20px side padding.

**Responsive:** 3 breakpoints — 1024px (4→2 cols), 768px (mobile nav, 2→1 cols), 480px (smaller fonts/padding).

## JavaScript

Vanilla JS only, no libraries. All functionality in `js/main.js`:
- Mobile nav: toggle `.active` class, lock body scroll
- FAQ: single-open accordion via max-height animation
- Form: alert-only stub (no backend)
- Header: dynamic shadow on scroll

## Content Language

All content is in Russian. Company: ООО «БПМ Альянс», Минск, ул. Красноармейская, д. 20А, офис 21. Phone: +375 (44) 584-10-91. Email: info@bpm-alyans.by.

## External Resources

- Google Fonts: Inter (400, 500, 600, 700)
- All icons are inline SVGs (no icon library)
