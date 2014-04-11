# Require any additional compass plugins here.

# Set this to the root of your project when deployed:
http_path = "/"
css_dir = ""
sass_dir = ""
images_dir = "img"
javascripts_dir = "js"

asset_cache_buster = :none
relative_assets = true

# You can select your preferred output style here (can be overridden via the command line):
output_style = :expanded

# disable debugging comments that display the original location of your selectors:
line_comments = false

# Gives us additional, common directories for shared assets
additional_import_paths = [ '/home/wpcom/public_html/bin/compass' ];

preferred_syntax = :scss

sass_options = {:cache => true}