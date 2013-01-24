<?php

    namespace Code39;

    class Generator {

        /**
         * Default parameter object
         *
         * @var Parameters $palette
         */
        private $defaultParameters;

        /**
         * Image color palette
         *
         * @var array $palette
         */
        private $palette = array();

        /**
         * Image resource
         *
         * @var resource $image
         */
        private $image;

        /**
         * Constructor
         */
        public function  __construct() {
            if (!function_exists('imagegif')) {
                throw new \RuntimeException('The GD extension is unavailable on this PHP instance');
            }

            $this->defaultParameters = new Parameters;
        }

        /**
         * Convert int array to int color ID
         *
         * @param array $color
         * @return int
         */
        private function getColor($image, $color) {
            return imagecolorallocate($image, $color[0], $color[1], $color[2]);
        }

        /**
         * Initialize a GD image resource
         *
         * @param CharacterSequence $data
         * @param Parameters $parameters
         * @return resource
         */
        private function initializeImage($data, $parameters) {
            list($width, $height) = $this->getImageDimensions($data, $parameters);

            $image = imagecreatetruecolor($width, $height);

            $background = $this->getColor($image, $parameters->getBackgroundColor());
            imagefilledrectangle($image, 0, 0, $width, $height, $background);

            return $image;
        }

        /**
         * Draw a bar on the image
         *
         * @param Bar $bar
         * @param int $left
         */
        private function drawBar($image, $bar, $left, $parameters) {
            $padding = $parameters->getPadding();
            $top = $padding[1];
            $right = ($left + ($bar->getWidth() * $parameters->getBarWidthMultiplier())) - 1;
            $bottom = ($parameters->getBarHeight() + $top) - 1;

            if ($bar->isBlack()) {
                $color = $this->getColor($image, $parameters->getBarColor());
                imagefilledrectangle($image, $left, $top, $right, $bottom, $color);
            }
        }

        /**
         * Draw the bars on the image
         *
         * @param resource $image
         * @param CharacterSequence $data
         * @param Parameters $parameters
         */
        private function drawBars($image, $data, $parameters) {
            $position = current($parameters->getPadding());

            foreach ($data->getBarSequence() as $bar) {
                $this->drawBar($image, $bar, $position, $parameters);
                $position += $bar->getWidth() * $parameters->getBarWidthMultiplier();
            }
        }

        /**
         * Draw the text on the image
         *
         * @param resource $image
         * @param CharacterSequence $data
         * @param Parameters $parameters
         */
        private function drawText($image, $data, $parameters) {
            $text = $data->getCharacterString(CharacterSequence::SEQ_TERMINATORS | CharacterSequence::SEQ_DELIM, ' ');

            list($imageWidth, $imageHeight) = $this->getImageDimensions($data, $parameters);

            $textSize = $parameters->getTextSize();
            $textWidth = imagefontwidth($textSize) * strlen($text);

            $upperLeftX = floor(($imageWidth - $textWidth) / 2);
            $upperLeftY = $parameters->getBarHeight() + $parameters->getPadding(1) + $parameters->getTextTopMargin() - 2;

            $color = $this->getColor($image, $parameters->getBarColor());

            imagestring($image, $textSize, $upperLeftX, $upperLeftY, $text, $color);
        }

        /**
         * Normalize barcode decription arguments
         *
         * @param mixed $data
         * @param Parameters $parameters
         */
        private function normalizeArguments(&$data, &$parameters) {
            if (!($data instanceof CharacterSequence)) {
                $data = CharacterSequence::createFromString((string) $data);
            }
            if (!isset($parameters)) {
                $parameters = isset($this->defaultParameters) ? $this->defaultParameters : new Parameters;
            }
        }

        /**
         * Set the default parameter object
         *
         * @param Parameters $parameters
         */
        public function setDefaultParameters(Parameters $parameters = NULL) {
            $this->defaultParameters = $parameters;
        }

        /**
         * Render image
         *
         * @param mixed $data
         * @param Parameters $parameters
         * @return resource
         */
        public function generate($data, Parameters $parameters = NULL) {
            $this->normalizeArguments($data, $parameters);

            $image = $this->initializeImage($data, $parameters);

            $this->drawBars($image, $data, $parameters);
            if ($parameters->getShowText()) {
                $this->drawText($image, $data, $parameters);
            }

            return $image;
        }

        /**
         * Calculate dimensions of generated image
         *
         * @param mixed $data
         * @param Parameters $parameters
         * @return array
         */
        public function getImageDimensions($data, Parameters $parameters = NULL) {
            $this->normalizeArguments($data, $parameters);

            $barWidth = $data->getWidth() * $parameters->getBarWidthMultiplier();
            $paddingWidth = $parameters->getPadding(0) * 2;

            $barHeight = $parameters->getBarHeight();
            $paddingHeight = $parameters->getPadding(1) * 2;

            $textWidth = $textHeight = 0;
            if ($parameters->getShowText()) {
                $text = $data->getCharacterString(CharacterSequence::SEQ_TERMINATORS | CharacterSequence::SEQ_DELIM, ' ');

                $textWidth = imagefontwidth($parameters->getTextSize()) * strlen($text);
                $textHeight = imagefontheight($parameters->getTextSize()) + $parameters->getTextTopMargin() - 2;
            }

            $totalWidth = $barWidth + $paddingWidth;
            if ($textWidth > $totalWidth) {
                $totalWidth = $textWidth;
            }
            $totalHeight = $barHeight + $paddingHeight + $textHeight;

            return array($totalWidth, $totalHeight);
        }

    }
