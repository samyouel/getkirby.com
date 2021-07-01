<?php snippet('templates/features/section', [
  'id'    => 'plugins',
  'title' => 'Panel areas',
  'intro' => 'The plugin API you’ve been dreaming of',
  'text'  => 'Our new Fiber architecture splits the Panel in areas. Site area, users area, settings area, etc. You can now create your own areas and build entire applications on top of the Panel. <a href="/releases/3.6/features/fiber">Learn more &rsaquo;</a>',
  'figure' => 'templates/release-36/plugins-figure',
  'reverse' => true,
  'features' => [
    [
      'title' => 'Custom routes',
      'text' => 'Building custom views with your own routes is now as simple as routing for your Kirby site. Define props for your view components and no longer worry about API endpoints, state management or any other complex stuff. Just start building.'
    ],
    [
      'title' => 'Your own dialogs in seconds',
      'text' => 'Dialogs can now also be defined in PHP and opened with a simple JS call `$dialog("my-dialog")`. Create form dialogs, text dialogs or confirmation dialogs to delete entries. It’s just so much fun.'
    ],
    [
      'title' => 'Access control made simple',
      'text' => 'You want your own permissions for your shiny new Panel area? No problem. It’s automatically handled for you. Deny access for individual roles and the Panel will kick users out if they are not allowed in.'
    ],
    [
      'title' => 'No more API endpoint hassle',
      'text' => 'With Fiber, you can return exactly the kind of data you need for your Panel components. No multiple API calls or custom API routes. Write some PHP and be done.'
    ],
  ]
]);
