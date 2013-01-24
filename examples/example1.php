<?php

    // Load classes
    require __DIR__.'/../src/Code39/Bar.php';
    require __DIR__.'/../src/Code39/Character.php';
    require __DIR__.'/../src/Code39/CharacterSequence.php';
    require __DIR__.'/../src/Code39/Generator.php';
    require __DIR__.'/../src/Code39/Parameters.php';

    // The data to encode
    $data = 'CODE39';

    // Generate image
    $gen = new \Code39\Generator;
    $image = $gen->generate($data);

    // Save image to file
    imagepng($image, 'example1.png');
