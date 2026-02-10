# LUNARFILM

A fully standalone, film-focused WordPress theme with complete customization — no parent theme dependency. Designed for WordPress.com Business Plan and deployed via GitHub.

## ✅ Ready for WordPress.com Business Plan

This theme is now **fully configured** for WordPress.com Business Plan integration with all required files:

- ✓ **style.css** - Theme stylesheet with proper WordPress headers
- ✓ **index.php** - Main theme template
- ✓ **functions.php** - Theme functionality and features
- ✓ **screenshot.png** - Theme preview image (1200x900px)
- ✓ **README.txt** - WordPress theme documentation
- ✓ **.deployignore** - Excludes unnecessary files from deployment
- ✓ **GitHub Actions workflow** - Automated deployment to WordPress.com

## Quick Start: Connect to WordPress.com

### Prerequisites
- WordPress.com **Business Plan** or higher (required for custom themes)
- This GitHub repository

### Setup Steps

1. **Log in to WordPress.com**
   - Go to your [WordPress.com dashboard](https://wordpress.com/home)

2. **Navigate to GitHub Deployments**
   - Go to **Hosting** → **GitHub Deployments**
   - Or visit: `https://wordpress.com/github-deployments/[your-site]`

3. **Connect This Repository**
   - Click **"Connect to GitHub"** (if first time)
   - Authenticate with your GitHub account
   - Select repository: `TheAntagonist2020/LunarFilm`
   - Choose branch: `main`
   - Set deployment path: `/` (root)

4. **Deploy Your Theme**
   - Click **"Deploy"** to start initial deployment
   - Wait for deployment to complete (usually 1-2 minutes)

5. **Activate Your Theme**
   - Go to **Appearance** → **Themes** in your WordPress.com dashboard
   - Find **LUNARFILM** and click **Activate**

6. **Done!** 🎉
   - Your theme is now live
   - Any future changes pushed to `main` branch will auto-deploy

## How to Customize Your Theme

### Option 1: Edit via GitHub.com (Quick Changes)

1. Go to your repository: https://github.com/TheAntagonist2020/LunarFilm
2. Make sure you are on the **`main`** branch
3. Click on a file to edit (e.g., `style.css`, `functions.php`)
4. Click the pencil icon (✏️) to edit
5. Make your changes
6. Scroll down, add a description of your changes
7. Click **"Commit changes"**
8. Changes will automatically deploy to WordPress.com! ✅

### Option 2: Edit via GitHub Desktop (Recommended for Major Changes)

1. Download [GitHub Desktop](https://desktop.github.com/) and sign in
2. Click **"Clone a repository"** → search for `TheAntagonist2020/LunarFilm` → click **Clone**
3. Open the cloned folder on your computer
4. Edit theme files with your preferred code editor
5. Go back to GitHub Desktop — you'll see your changes
6. Type a summary of your changes in the bottom left
7. Click **"Commit to main"**
8. Click **"Push origin"** at the top
9. Changes will automatically deploy to WordPress.com! ✅

## Theme Files Structure

All WordPress theme files are in the **root** of this repository:

```
LunarFilm/                ← this repository
├── style.css             ← ✓ Theme stylesheet with WordPress headers
├── index.php             ← ✓ Main template file
├── functions.php         ← ✓ Theme setup and features
├── header.php            ← ✓ Site header and navigation
├── footer.php            ← ✓ Site footer
├── sidebar.php           ← ✓ Sidebar widget area
├── single.php            ← ✓ Single post template
├── page.php              ← ✓ Static page template
├── archive.php           ← ✓ Archive/category listing
├── search.php            ← ✓ Search results page
├── 404.php               ← ✓ "Page not found" page
├── comments.php          ← ✓ Comments section
├── screenshot.png        ← ✓ Theme preview image (1200x900px)
├── README.txt            ← ✓ WordPress theme documentation
└── .deployignore         ← ✓ Files to exclude from deployment
```

## About This Theme

LUNARFILM is a complete WordPress theme with:

- **Fully standalone** — no parent theme dependency
- **Dark color scheme** designed for film content
- **Responsive** with mobile support
- **Widget-ready** with sidebar and footer widget areas
- **Custom menus** — Primary and Footer menu locations
- **Custom logo and background** support
- **Clean, semantic HTML5** markup
- **Accessibility features** built-in

## Automatic Deployment

This repository is configured with GitHub Actions for automatic deployment:

- **Trigger**: Every push to the `main` branch
- **Workflow**: `.github/workflows/wpcom.yml`
- **Result**: Theme automatically packaged and available to WordPress.com

You can also manually trigger deployment from the [Actions tab](https://github.com/TheAntagonist2020/LunarFilm/actions).

## Troubleshooting

### Theme Not Showing in WordPress.com
1. Verify GitHub Deployments is connected in WordPress.com
2. Check that the `main` branch is selected
3. Confirm deployment completed in Actions tab
4. Try manually triggering a deployment

### Changes Not Appearing
1. Clear WordPress cache (Hosting → Configuration → Clear cache)
2. Check Actions tab for deployment status
3. Verify changes were pushed to `main` branch
4. Hard refresh your browser (Ctrl+F5 or Cmd+Shift+R)

### Deployment Failed
1. Check Actions tab for error details
2. Verify all required files exist (style.css, index.php)
3. Ensure no PHP syntax errors in theme files
4. Review GitHub Actions workflow logs

## Resources & Support

- [WordPress.com GitHub Deployments Guide](https://wordpress.com/support/github-deployments/)
- [WordPress Theme Handbook](https://developer.wordpress.org/themes/)
- [GitHub Desktop Download](https://desktop.github.com/)

## License

This project is licensed under the GNU General Public License v2 or later.
