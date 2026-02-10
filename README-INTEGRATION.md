# Lunara repo integration bundle

This bundle is laid out to be dropped into the root of your GitHub repo.

It contains:

- wp-content/plugins/academy-awards-table  (optimized build)
- wp-content/plugins/lunara-public-likes   (optimized build)
- wp-content/themes/lunara-film            (optimized build)

## How to apply (GitHub website)

1) Open your repo on GitHub
2) Click **Add file → Upload files**
3) Drag the **wp-content** folder from this bundle into the upload area
4) Commit to a new branch (recommended) like: `integrate-optimized-packages`
5) Open a Pull Request into `main`

## Notes

- If wp-content already exists in the repo, GitHub will merge folders, not replace them.
- If any of these already exist and you want to overwrite: delete the old folder in the branch first, then upload.
