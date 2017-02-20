<?php

class KirbyStatic {
  private $options = [];

  public function __construct () {
    $this->options = require(realpath(__DIR__) . DS . 'options.php');

    $this->registerRoute();

    if ($this->options['widget']) {
      $this->registerWidget();
    }
  }

  private function registerRoute () {
    kirby()->set('route', [
      'pattern' => $this->options['route'],
      'action' => function () {
        return $this->generateStatic();
      }
    ]);
  }

  private function registerWidget () {
    $widget = realpath(__DIR__) . DS . '../kirby-static-widget';
    kirby()->set('widget', 'kirby-static-widget', $widget);
  }

  // Modified from: https://gist.github.com/bastianallgeier/5f182b30d4c90152b468
  private function generateStatic () {
    $kirby = kirby();
    $kirby->urls->index = $this->options['url'];

    $site = $kirby->site();

    if ($site->multilang()) {
      die('Multilanguage sites are not supported');
    }

    // Empty static dir if exists
    if (file_exists($this->options['path'])) {
      dir::clean($this->options['path']);
    }

    dir::copy(kirby()->roots()->assets(),  $this->options['path'] . DS . 'assets');
    dir::copy(kirby()->roots()->content(), $this->options['path'] . DS . 'content');

    if ($this->options['thumbs']) {
      dir::copy(kirby()->roots()->thumbs(), $this->options['path'] . DS . 'thumbs');
    }

    // set the timezone for all date functions
    date_default_timezone_set($kirby->options['timezone']);

    // load all extensions
    $kirby->extensions();

    // load all plugins
    $kirby->plugins();

    // load all models
    $kirby->models();

    // load all language variables
    $kirby->localize();

    // if single page app, only generate index
    if ($this->options['spa']) {
      $page = $site->page('home');
      $site->visit($page->uri());
      $html = $kirby->render($page);
      $root = $this->options['path'] . DS . 'index.html';
      f::write($root, $html);
    }

    // otherwise generate html for all pages
    else {
      foreach ($site->index() as $page) {
        $site->visit($page->uri());
        $html = $kirby->render($page);

        if ($page->isHomePage()) {
          $root = $this->options['path'] . DS . 'index.html';
        } else {
          $root = $this->options['path'] . DS . $page->uri() . DS . 'index.html';
        }

        f::write($root, $html);
      }
    }

    return new Response("Static exported to <b>{$this->options['path']}</b>.");
  }
}
