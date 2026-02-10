# LUNARFILM

A film-focused website hosted on [WordPress.com](https://wordpress.com).

## About

LUNARFILM is a website dedicated to film content, deployed and managed through WordPress.com with version control via GitHub.

## Repository Structure

```
LunarFilm/
├── style.css        # Theme stylesheet with metadata header
├── index.php        # Main template file
├── functions.php    # Theme functions and setup
├── .gitignore       # Git ignore rules
├── README.md        # This file
└── .github/
    └── workflows/
        └── wpcom.yml  # WordPress.com deployment workflow
```

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

## License

This project is licensed under the GNU General Public License v2 or later.
