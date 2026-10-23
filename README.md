# Smart Attachment Page Remove

[Smart Attachment Page Remove](https://wordpress.org/plugins/smart-attachment-page-remove/) on wordpress.org. Built by
Peter Raschendorfer ([petersplugins](https://profiles.wordpress.org/petersplugins/)),
adopted by WP User Manager in October 2026. Its history up to 4.0.5 is in
[wordpress.org SVN](https://plugins.svn.wordpress.org/smart-attachment-page-remove/).

## Releasing

1. Bump the version in the plugin header (`smart-attachment-page-remove.php`), `'version'` in
   `loader.php`, and `readme.txt` (`Stable tag` and a changelog entry).
2. Merge `develop` into `master` and tag `vX.Y.Z` on `master`.

The tag runs `.github/workflows/release.yml`: the shared
[deploy workflow](https://github.com/WPUserManager/.github) builds the zip from
everything not in `.distignore`, checks all three versions match the tag,
deploys to wordpress.org SVN (org secrets `SVN_USERNAME`, `SVN_PASSWORD`) and
creates the GitHub release. Pull requests run the same build as a dry run.

## Listing art

`.wordpress-org/` holds the icon and banner for the wordpress.org listing. They live
in the SVN `assets/` folder, not in the plugin, so a release doesn't upload them:
commit changes to `https://plugins.svn.wordpress.org/smart-attachment-page-remove/assets/`.
