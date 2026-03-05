window.addEventListener('load', loadEvent => {
    console.warn('Hello world!');
    console.log(
        '%cThis is file enqueued by wp_enqueue_script() function.',
        'color: white; background-color: magenta; padding: 3px; font-family: monospace'
    );
})