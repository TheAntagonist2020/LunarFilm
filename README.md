# LUNARFILM

A fully standalone, film-focused WordPress theme with complete customization — no parent theme dependency. Hosted on [WordPress.com](https://wordpress.com) and deployed via GitHub.

## About

LUNARFILM is a custom WordPress theme built from the ground up for total control over design and functionality. It has no parent theme, giving you complete freedom to customize every aspect of your website.

## Repository Structure

```
LunarFilm/
├── style.css        # Theme stylesheet with metadata and base styles
├── index.php        # Main template file (post listing)
├── header.php       # Site header, navigation, and HTML head
├── footer.php       # Site footer and closing HTML
├── sidebar.php      # Widget-ready sidebar
├── single.php       # Single post template
├── page.php         # Static page template
├── archive.php      # Archive/category listing template
├── search.php       # Search results template
├── 404.php          # Custom 404 error page
├── comments.php     # Comment display and form
├── functions.php    # Theme setup, menus, widgets, and enqueues
├── .gitignore       # Git ignore rules
├── README.md        # This file
└── .github/
    └── workflows/
        └── wpcom.yml  # WordPress.com deployment workflow
```

## Theme Features

- **Standalone theme** — no parent theme required
- **Custom navigation menus** — Primary and Footer menu locations
- **Widget areas** — Sidebar and Footer widget zones
- **Custom logo** support
- **Custom background** support
- **Featured images** (post thumbnails)
- **Responsive design** with mobile-first approach
- **Dark color scheme** designed for film content
- **Accessible** — skip links and screen reader support
- **Translation-ready** with full text domain support

## Deployment

This repository is connected to WordPress.com via GitHub deployments. When changes are pushed to the `main` branch, the GitHub Actions workflow automatically packages and uploads the theme for deployment.

### How It Works

1. Push changes to the `main` branch
2. The `Publish Website` workflow runs automatically
3. The theme files are packaged as an artifact
4. WordPress.com deploys the updated theme

You can also trigger a deployment manually from the **Actions** tab using the `workflow_dispatch` event.

## Getting Started

To connect this repository to your WordPress.com site:

1. Go to your WordPress.com dashboard
2. Navigate to **Hosting** > **GitHub Deployments**
3. Connect this repository and select the `main` branch
4. Choose the deployment target path for your theme

## Customization

Since this is a standalone theme with no parent, you can modify any file directly:

- **Styles** — Edit `style.css` to change the look and feel
- **Layout** — Edit `header.php`, `footer.php`, and template files
- **Functionality** — Edit `functions.php` to add or change features
- **Templates** — Add new template files as needed (e.g., `front-page.php`, `category.php`)

## License

This project is licensed under the GNU General Public License v2 or later.
