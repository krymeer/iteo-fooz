<?php
// This file is generated. Do not modify it manually.
return array(
	'kro-faq-block' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'create-block/kro-faq-block',
		'version' => '1.0.0',
		'title' => 'FAQ Accordion',
		'category' => 'widgets',
		'icon' => 'editor-help',
		'description' => 'Example FAQ scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'title' => array(
				'type' => 'string',
				'default' => 'Frequently Asked Questions'
			),
			'faqs' => array(
				'type' => 'array',
				'default' => array(
					array(
						'question' => '',
						'answer' => ''
					)
				)
			)
		),
		'textdomain' => 'kro-faq-block',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
