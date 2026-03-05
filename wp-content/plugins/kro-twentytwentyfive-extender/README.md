# Task \#1

The simplest question to such answer is: it depends.

If the client asked me to implement a few minor changes at their website (especially in the Friday afternoon), I would use the "Additional CSS" option (using endpoint: `wp-admin/site-editor.php?p=%2Fstyles&section=%2Fcss`, or navigation: Appearance > Editor > Styles > Additional CSS).

However, I love coding layouts with Sass, so I had the opportunity to choose my own way, I would include an additional compressed CSS file using the hook `wp_enqueue_scripts` and the function `wp_enqueue_style`, e.g.

    wp_enqueue_style( 'some-styles', get_template_directory_uri() . '/some-styles.css', [ 'parent-style-id' ], 'v1', 'screen' );

# Task \#2

The easiest way to achieve this is using `wp_enqueue_script` function, for example:

    wp_enqueue_script( 'additional-scripts', get_template_directory_uri() . '/assets/js/scripts.js', [ 'parent-script-id' ], 'v1', [ 'in_footer' => true ] );
