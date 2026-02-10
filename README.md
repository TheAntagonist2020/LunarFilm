# LUNARFILM

A fully standalone, film-focused WordPress theme with complete customization — no parent theme dependency. Hosted on [WordPress.com](https://wordpress.com) and deployed via GitHub.

## How to Upload Your Theme Files

You already have your own theme files ready — here's how to get them into this repository. **Your theme files go directly in the root (top level) of this repository.**

### Option 1: Upload via GitHub.com (Easiest — No Tools Required)

1. Go to your repository: https://github.com/TheAntagonist2020/LunarFilm
2. Make sure you are on the **`main`** branch (check the dropdown in the top left)
3. Click the **"Add file"** button → **"Upload files"**
4. Drag and drop your theme files (e.g. `style.css`, `index.php`, `functions.php`, `header.php`, etc.) into the upload area
5. Scroll down, add a short description like "Upload my theme files"
6. Click **"Commit changes"**
7. Your site will automatically deploy! ✅

> **Tip:** If you have a folder of theme files on your computer, select all the files _inside_ the folder (not the folder itself) and drag them in.

### Option 2: Upload via GitHub Desktop (Recommended for Ongoing Changes)

1. Download [GitHub Desktop](https://desktop.github.com/) and sign in
2. Click **"Clone a repository"** → search for `TheAntagonist2020/LunarFilm` → click **Clone**
3. Open the cloned folder on your computer (click **"Show in Explorer/Finder"**)
4. Copy your theme files into this folder (replace existing files if prompted)
5. Go back to GitHub Desktop — you'll see your changes listed
6. Type a short summary like "Upload my custom theme" in the bottom left
7. Click **"Commit to main"**
8. Click **"Push origin"** at the top
9. Your site will automatically deploy! ✅

### What Files Go Where?

All your WordPress theme files should be placed **directly in the root** of this repository (not inside a subfolder). A typical theme looks like this:

```
LunarFilm/                ← this repository
├── style.css             ← REQUIRED: your theme stylesheet (must have the theme header comment)
├── index.php             ← REQUIRED: main template file
├── functions.php         ← theme setup and features
├── header.php            ← site header and navigation
├── footer.php            ← site footer
├── sidebar.php           ← sidebar widget area
├── single.php            ← single post template
├── page.php              ← static page template
├── archive.php           ← archive/category listing
├── search.php            ← search results page
├── 404.php               ← "page not found" page
├── comments.php          ← comments section
├── screenshot.png        ← theme preview image (optional)
├── /images/              ← your image assets (optional)
├── /js/                  ← your JavaScript files (optional)
├── /css/                 ← additional CSS files (optional)
└── ... any other theme files you have
```

> **Important:** `style.css` and `index.php` are the two files WordPress **requires** for any theme to work. Make sure those are included.

### After Uploading

Once your files are pushed to the `main` branch:

1. The **Publish Website** workflow runs automatically (see the **Actions** tab)
2. Go to your [WordPress.com dashboard](https://wordpress.com/home)
3. Navigate to **Hosting** → **GitHub Deployments**
4. Connect this repository if you haven't already, and select the `main` branch
5. Your custom theme will be deployed to your site

## About This Repository

This repo contains starter theme files that you can replace with your own. The starter theme is:

- **Fully standalone** — no parent theme dependency
- **Dark color scheme** designed for film content
- **Responsive** with mobile support
- **Widget-ready** with sidebar and footer widget areas
- **Custom menus** — Primary and Footer menu locations
- **Custom logo and background** support

You can keep these starter files and modify them, or replace them entirely with your own theme.

## Deployment

Deployment is automatic. Every time you push changes to the `main` branch, the GitHub Actions workflow (`.github/workflows/wpcom.yml`) packages your theme and makes it available to WordPress.com.

You can also trigger a deployment manually from the [Actions tab](https://github.com/TheAntagonist2020/LunarFilm/actions) by clicking **"Run workflow"**.

## Need Help?

- [WordPress.com GitHub Deployments Guide](https://wordpress.com/support/github-deployments/)
- [GitHub Desktop Download](https://desktop.github.com/)
- [GitHub Uploading Files Guide](https://docs.github.com/en/repositories/working-with-files/managing-files/adding-a-file-to-a-repository)

## License

This project is licensed under the GNU General Public License v2 or later.
