<?php

blocksy_theme_get_dynamic_styles([
	'name' => 'admin/editor-background',
	'css' => $css,
	'mobile_css' => $mobile_css,
	'tablet_css' => $tablet_css,
	'context' => $context,
	'chunk' => 'admin'
]);

$post_type = get_current_screen()->post_type;

$post_id = null;

if (isset($_GET['post']) && $_GET['post']) {
	$post_id = $_GET['post'];
}

$prefix = blocksy_manager()->screen->get_admin_prefix($post_type);

$post_atts = blocksy_get_post_options($post_id);

$page_structure = blocksy_default_akg(
	'page_structure_type',
	$post_atts,
	'default'
);

$maybe_matching_template = null;
$content_block_atts = null;

$has_content_block_structure = 'no';
$template_type = null;

if ($post_type === 'ct_content_block') {
	$default_content_block_structure = 'yes';
	$template_type = get_post_meta($post_id, 'template_type', true);

	if ($template_type === 'hook' || $template_type === 'popup') {
		$default_content_block_structure = 'no';
	}

	$has_content_block_structure = blocksy_akg(
		'has_content_block_structure',
		$post_atts,
		$default_content_block_structure
	);
}

if (function_exists('blc_get_content_block_that_matches')) {
	$maybe_matching_template = blc_get_content_block_that_matches([
		'template_type' => 'single',
		'template_subtype' => 'canvas',
		'match_conditions_strategy' => $prefix
	]);

	if ($maybe_matching_template) {
		$content_block_atts = blocksy_get_post_options($maybe_matching_template);
	}
}

if ($page_structure === 'default') {
	$page_structure = blocksy_get_theme_mod(
		$prefix . '_structure',
		($prefix === 'single_blog_post') ? 'type-3' : 'type-4'
	);

	if ($content_block_atts) {
		$page_structure = blocksy_default_akg(
			'content_block_structure',
			$content_block_atts,
			'type-4'
		);
	}
}

if ($post_type === 'ct_content_block') {
	if ($has_content_block_structure === 'yes') {
		$page_structure = blocksy_default_akg(
			'content_block_structure',
			$post_atts,
			'type-4'
		);
	}
}

if ($page_structure === 'type-4') {
	$css->put(
		':root',
		'--theme-block-max-width: var(--theme-normal-container-max-width)'
	);

	$css->put(
		':root',
		'--theme-block-wide-max-width: calc(var(--theme-normal-container-max-width) + var(--theme-wide-offset) * 2)'
	);
} else {
	$css->put(
		':root',
		'--theme-block-max-width: var(--theme-narrow-container-max-width)'
	);

	$css->put(
		':root',
		'--theme-block-wide-max-width: calc(var(--theme-narrow-container-max-width) + var(--theme-wide-offset) * 2)'
	);
}

$source = [
	'strategy' => $post_atts
];

if (blocksy_default_akg(
	'content_style_source',
	$post_atts,
	'inherit'
) === 'inherit' && $post_type !== 'ct_content_block') {
	$source = [
		'prefix' => $prefix,
		'strategy' => 'customizer'
	];

	if ($content_block_atts) {
		$source = [
			'strategy' => $content_block_atts
		];
	}
}

$has_boxed = blocksy_akg_or_customizer(
	'content_style',
	$source,
	blocksy_get_content_style_default($prefix)
);

if ($post_type === 'ct_content_block') {
	$template_subtype = blocksy_akg('template_subtype', $post_atts, 'card');

	if (
		$has_content_block_structure !== 'yes'
		||
		$template_type === 'archive' && $template_subtype === 'card'
	) {
		$has_boxed = blocksy_get_content_style_default($prefix);
	}
}

global $wp_version;

$is_65_wordpress = version_compare($wp_version, '6.5', '>=');

// We don't support boxed styles for 6.4 and less. For that version of WP
// we will only support the main page background.
if ($is_65_wordpress) {
	blocksy_theme_get_dynamic_styles([
		'name' => 'admin/6-5-styles',
		'css' => $css,
		'mobile_css' => $mobile_css,
		'tablet_css' => $tablet_css,
		'context' => $context,
		'chunk' => 'admin',
		'has_boxed' => $has_boxed,
		'source' => $source,
	]);
}

// form styles
$forms_type = blocksy_get_theme_mod('forms_type', 'classic-forms');

if ($forms_type === 'classic-forms') {
	$css->put(
		':root',
		'--has-classic-forms: var(--true)'
	);

	$css->put(
		':root',
		'--has-modern-forms: var(--false)'
	);
} else {
	$css->put(
		':root',
		'--has-classic-forms: var(--false)'
	);

	$css->put(
		':root',
		'--has-modern-forms: var(--true)'
	);
}

blocksy_output_colors([
	'value' => blocksy_get_theme_mod('formTextColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
		'focus' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword('DEFAULT') ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => ':root',
			'variable' => 'theme-form-text-initial-color'
		],

		'focus' => [
			'selector' => ':root',
			'variable' => 'theme-form-text-focus-color'
		],
	],
]);

$formFontSize = blocksy_get_theme_mod('formFontSize', 16);

if ($formFontSize !== 16) {
	$css->put(':root', '--theme-form-font-size: ' . $formFontSize . 'px');
}

blocksy_output_colors([
	'value' => blocksy_get_theme_mod('formBackgroundColor'),
	'default' => [
		'default' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword() ],
		'focus' => [ 'color' => Blocksy_Css_Injector::get_skip_rule_keyword() ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => ':root',
			'variable' => 'theme-form-field-background-initial-color'
		],

		'focus' => [
			'selector' => ':root',
			'variable' => 'theme-form-field-background-focus-color'
		],
	],
]);

$formInputHeight = blocksy_get_theme_mod( 'formInputHeight', 40 );

if ($formInputHeight !== 40) {
	$css->put( ':root', '--theme-form-field-height: ' . $formInputHeight . 'px' );
}

$formFieldBorderRadius = blocksy_get_theme_mod( 'formFieldBorderRadius', 3 );

if ($formFieldBorderRadius !== 3) {
	$css->put( ':root', '--theme-form-field-border-radius: ' . $formFieldBorderRadius . 'px' );
}

blocksy_output_colors([
	'value' => blocksy_get_theme_mod('formBorderColor'),
	'default' => [
		'default' => [ 'color' => 'var(--theme-border-color)' ],
		'focus' => [ 'color' => 'var(--theme-palette-color-1)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => ':root',
			'variable' => 'theme-form-field-border-initial-color'
		],

		'focus' => [
			'selector' => ':root',
			'variable' => 'theme-form-field-border-focus-color'
		],
	],
]);

$formBorderSize = blocksy_get_theme_mod( 'formBorderSize', 1 );

if ($forms_type === 'classic-forms') {
	if($formBorderSize !== 1) {
		$css->put(
			':root',
			'--theme-form-field-border-width: ' . $formBorderSize . 'px'
		);
	}
} else {
	$css->put(
		':root',
		'--theme-form-field-border-width: 0 0 ' . $formBorderSize . 'px 0'
	);

	$css->put(
		':root',
		'--form-selection-control-border-width: ' . $formBorderSize . 'px'
	);
}

blocksy_output_colors([
	'value' => blocksy_get_theme_mod('radioCheckboxColor'),
	'default' => [
		'default' => [ 'color' => 'var(--theme-border-color)' ],
		'accent' => [ 'color' => 'var(--theme-palette-color-1)' ],
	],
	'css' => $css,
	'variables' => [
		'default' => [
			'selector' => ':root',
			'variable' => 'theme-form-selection-field-initial-color'
		],

		'accent' => [
			'selector' => ':root',
			'variable' => 'theme-form-selection-field-active-color'
		],
	],
]);
