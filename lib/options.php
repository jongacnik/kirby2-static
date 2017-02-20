<?php

return [
  'spa' => kirby()->option('kirby-static.spa', false),
  'url' => kirby()->option('kirby-static.url', ''),
  'path' => kirby()->option('kirby-static.path', kirby()->roots()->index() . DS . 'static'),
  'route' => kirby()->option('kirby-static.route', 'kirby-static/v1'),
  'thumbs' => kirby()->option('kirby-static.thumbs', true),
  'widget' => kirby()->option('kirby-static.widget', true)
];
