<?php
$faqs = isset($attributes['faqs']) ? $attributes['faqs'] : [];
if ( empty($faqs) ) return;
?>
<div <?= get_block_wrapper_attributes(); ?>>
    <?php if( !empty( $attributes[ 'title' ] ) ): ?>
        <h2><?= esc_html( $attributes[ 'title' ] ); ?></h2>
    <?php endif; ?>

    <div class="faq-accordion">
        <?php foreach( $faqs as $faq ): ?>
            <details class="faq-item">
                <summary><strong><?= esc_html( $faq[ 'question' ] ); ?></strong></summary>
                <div class="faq-content">
                    <?= wp_kses_post( $faq[ 'answer' ] ); ?>
                </div>
            </details>
        <?php endforeach; ?>
    </div>
</div>