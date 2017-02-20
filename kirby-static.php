<?php

/**
 * Kirby Static ~ Kirby static site generator
 *
 * Largely based on Bastian Allgeier's Statify script,
 * but provides additional options as well as a panel
 * widget for generating the site.
 *
 * @author Jon Gacnik <jon@folderstudio.com>
 * @link https://github.com/jongacnik/kirby-static
 * @version 0.0.0
 *
 */

require_once realpath(__DIR__) . DS . 'lib/core.php';

// new KirbyStatic instance
$statify = new KirbyStatic();
