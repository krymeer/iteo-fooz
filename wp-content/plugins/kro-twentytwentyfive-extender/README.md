# Task \#1

The simplest question to such answer is: it depends.

If the client asked me to implement a few minor changes at their website (especially in the Friday afternoon), I would use the "Additional CSS" option (using endpoint: `wp-admin/site-editor.php?p=%2Fstyles&section=%2Fcss`, or navigation: Appearance > Editor > Styles > Additional CSS).

However, I love coding layouts with Sass, so I had the opportunity to choose my own way, I would include an additional compressed CSS file using the hook `wp_enqueue_scripts` and the function `wp_enqueue_style()`, e.g.

    wp_enqueue_style( 'some-styles', get_template_directory_uri() . '/some-styles.css', [ 'parent-style-id' ], 'v1', 'screen' );

# Task \#2

The easiest way to achieve this is using `wp_enqueue_script()` function (like `wp_enqueue_style()` in Task \#1), for example:

    wp_enqueue_script( 'additional-scripts', get_template_directory_uri() . '/assets/js/scripts.js', [ 'parent-script-id' ], 'v1', [ 'in_footer' => true ] );

# Task \#3

In order to complete this task, I used the WordPress functions `register_post_type()` (to define a custom post type), and `register_taxonomy` (to define a custom taxonomy).

All the labels can be translated using WordPress localization functions (i.e. `__()`, `_x`).

# Task \#4

Since we are operating in the world of the **Twenty Twenty-Five** template, I created a few _patterns_ and _templates_ that enable us to display both book details and lists of books.

I believe that reinventing the wheel is not the purpose of this task, so I reused the syntax from Twenty Twenty-Five patterns and templates wherever possible.

# Task \#5

I created the block using the tool `@wordpress/create-block` available in `npm`, updated attributes and some other details in the `block.json` file, then defined required logic in the `edit.js` file, and finally styled the component using Sass inside files: `style.scss` as well as `editor.scss`.

When it comes to responsiveness, in my opinion there is little work for such a basic component. Yet, for the sake of completeness, I used some media queries.
