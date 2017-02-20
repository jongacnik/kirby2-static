<?php

$options = require(realpath(__DIR__) . DS . '../lib/options.php');

return [
  'title' => 'Kirby Static',
  'html' => function () use ($options) {
    return tpl::load(__DIR__ . DS . 'template.php', [
      'route' => kirby()->site()->url() . DS . $options['route'],
      'options' => $options
    ]);
  }
];
