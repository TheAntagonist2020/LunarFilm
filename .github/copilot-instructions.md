# Copilot Instructions for LUNARFILM

## Project Persona

LUNARFILM is a **professional film journalism and data tracking platform** dedicated to cinema criticism, film theory essays, and awards prognostication. All code contributions should reflect the editorial rigor and visual sophistication expected of a serious film publication.

## Tech Stack

- **Core CMS:** WordPress (PHP 7.4+) — standalone theme with no parent theme dependency, deployed to WordPress.com via GitHub Actions.
- **Automation & Data:** Python 3 — used for backend scripts that manage film datasets, awards predictions, and content pipelines.
- **Frontend:** HTML5, CSS3, vanilla JavaScript — optimized for readability, fast-loading media, and SEO for long-form essays.

## PHP / WordPress Coding Standards

- Follow [WordPress PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- Use tabs for indentation in PHP files.
- Prefix all theme functions, hooks, and global variables with `lunarfilm_` (e.g., `lunarfilm_setup`, `lunarfilm_scripts`).
- Use `esc_html__()` / `esc_html_e()` with the `'lunarfilm'` text domain for all translatable strings.
- Keep template files (`header.php`, `footer.php`, `single.php`, etc.) in the repository root — the theme is deployed directly from the repo root.
- Document every function with a PHPDoc block describing its purpose and parameters.

## Custom Post Types & Naming Conventions

When registering WordPress custom post types or taxonomies, use these slugs and labels:

| Content Type | Slug | Singular Label | Plural Label |
|---|---|---|---|
| Film Reviews | `lunarfilm_review` | Review | Reviews |
| Film Theory Essays | `lunarfilm_essay` | Essay | Essays |
| Awards Prognostications | `lunarfilm_prognostication` | Prognostication | Prognostications |

- Register custom post types in `functions.php` or a dedicated include file.
- Use the `lunarfilm_` prefix for all custom post type slugs and related meta keys.

## Film Metadata

All film-related content should support rich metadata fields:

- **Title** — the film's title.
- **Director** — the film's director(s).
- **Year** — the release year.
- **Genre** — one or more genre tags (e.g., Drama, Thriller, Documentary).
- **Studio** — the production studio or distributor.
- **Runtime** — runtime in minutes.

Store custom metadata using WordPress post meta with the `_lunarfilm_` prefix (e.g., `_lunarfilm_director`, `_lunarfilm_year`, `_lunarfilm_genre`).

## Python Automation Scripts

- Use **Python 3.8+** for all automation and data-management scripts.
- Preferred libraries:
  - `requests` — for HTTP calls to external film databases or APIs.
  - `beautifulsoup4` — for web scraping when API access is unavailable.
  - `pandas` — for tabular data manipulation (awards tallies, film lists).
  - `pyyaml` or `json` (stdlib) — for structured data interchange.
- Follow [PEP 8](https://peps.python.org/pep-0008/) style guidelines.
- Place Python scripts in a `scripts/` directory at the repository root.
- Include a `requirements.txt` for any Python dependencies.

## Frontend & Performance

- Optimize all images for the web (compressed, responsive `srcset` where applicable) — high-quality film imagery is central to the site's identity.
- Ensure CSS is minimal and purposeful; avoid heavy frameworks.
- Use semantic HTML5 elements (`<article>`, `<section>`, `<figure>`, `<figcaption>`) for content structure.
- Maintain the existing dark color scheme (`background: #0a0a0a`, text: `#e0e0e0`, accent: `#8ab4f8`).

## SEO for Long-Form Content

- Use proper heading hierarchy (`<h1>` for post titles, `<h2>`–`<h4>` for sub-sections).
- Ensure every page has a unique `<title>` tag (handled via `add_theme_support('title-tag')`).
- Support Open Graph and structured data markup for film reviews and essays when possible.
- Keep URLs clean and human-readable via WordPress permalink settings.

## Deployment

- The theme deploys to WordPress.com automatically on every push to the `main` branch via `.github/workflows/wpcom.yml`.
- Theme files must remain in the repository root (not in a subdirectory).
- Do not commit build artifacts, `node_modules/`, or other files listed in `.gitignore` or `.deployignore`.
