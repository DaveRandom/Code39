<?php

    // Load classes
    require __DIR__.'/../src/Code39/Bar.php';
    require __DIR__.'/../src/Code39/Character.php';
    require __DIR__.'/../src/Code39/CharacterSequence.php';
    require __DIR__.'/../src/Code39/Generator.php';
    require __DIR__.'/../src/Code39/Parameters.php';

    // The data to encode
    $data = 'CODE39';

    // Set a few parameters
    $params = new \Code39\Parameters;
    $params->setBackgroundColor('#FFFF99');
    $params->setBarHeight(20);
    $params->setTextTopMargin(1);
    $params->setPadding(2, 2);

    // Generate image
    $gen = new \Code39\Generator;
    $image = $gen->generate($data, $params);

    // Save image to file
    imagepng($image, 'example2.png');
