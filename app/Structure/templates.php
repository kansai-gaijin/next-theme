<?php

namespace Tonik\Theme\App\Structure;

/*
|-----------------------------------------------------------
| Theme Templates Actions
|-----------------------------------------------------------
|
| This file purpose is to include your templates rendering
| actions hooks, which allows you to render specific
| partials at specific places of your theme.
|
*/

use function Tonik\Theme\App\template;

/**
 * Renders post thumbnail by its formats.
 *
 * @see resources/templates/index.tpl.php
 */
function render_post_thumbnail()
{
  template(['partials/post/thumbnail', get_post_format()]);
}
add_action('theme/index/post/thumbnail', 'Tonik\Theme\App\Structure\render_post_thumbnail');

/**
 * Renders empty post content where there is no posts.
 *
 * @see resources/templates/index.tpl.php
 */
function render_empty_content()
{
  template(['partials/index/content', 'none']);
}
add_action('theme/index/content/none', 'Tonik\Theme\App\Structure\render_empty_content');

/**
 * Renders post contents by its formats.
 *
 * @see resources/templates/single.tpl.php
 */
function render_post_content()
{
  template(['partials/post/content', get_post_format()]);
}
add_action('theme/single/content', 'Tonik\Theme\App\Structure\render_post_content');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/page.tpl.php
 */
function render_page_content()
{
  template('partials/page/content');
}
add_action('theme/page/content', 'Tonik\Theme\App\Structure\render_page_content');


/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/page.tpl.php
 */
function render_page_header()
{
  template('partials/page/header');
}
add_action('theme/page/header', 'Tonik\Theme\App\Structure\render_page_header');


/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_header()
{
  template('partials/header');
}
add_action('theme/header', 'Tonik\Theme\App\Structure\render_header');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_footer()
{
  template('partials/footer');
}
add_action('theme/footer', 'Tonik\Theme\App\Structure\render_footer');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_before_footer()
{
  template('partials/before-footer');
}
add_action('theme/before-footer', 'Tonik\Theme\App\Structure\render_before_footer');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_after_footer()
{
  template('layout/contact-footer');
  template('layout/modal');
  template('layout/drawer');
}
add_action('theme/after-footer', 'Tonik\Theme\App\Structure\render_after_footer');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_logo()
{
  template('partials/logo');
}
add_action('theme/logo', 'Tonik\Theme\App\Structure\render_logo');

/**
 * Renders page contents by its formats.
 *
 * @see resources/templates/header.tpl.php
 */
function render_preloader()
{
  template('partials/preloader');
}
add_action('theme/preloader', 'Tonik\Theme\App\Structure\render_preloader');