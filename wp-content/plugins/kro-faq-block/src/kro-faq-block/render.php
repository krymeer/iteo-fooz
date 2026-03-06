<?php
$faqs = isset($attributes['faqs']) ? $attributes['faqs'] : [];
if ( empty($faqs) ) return;
?>
<div <?= get_block_wrapper_attributes(); ?>>
    <?php if( !empty( $attributes[ 'title' ] ) ): ?>
        <h2 class="kro-faq-heading"><?= esc_html( $attributes[ 'title' ] ); ?></h2>
    <?php endif; ?>

    <div class="kro-faq-accordion">
        <?php foreach( $faqs as $faq ): ?>
            <details class="kro-faq-item">
                <summary class="kro-faq-item-question"><strong><?= esc_html( $faq[ 'question' ] ); ?></strong></summary>
                <div class="kro-faq-item-answer">
                    <?= wp_kses_post( $faq[ 'answer' ] ); ?>
                </div>
            </details>
        <?php endforeach; ?>
    </div>
</div>