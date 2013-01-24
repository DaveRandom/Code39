<?php

    namespace Code39;

    class Parameters {

        /**
         * Widths of bars in barcode
         *
         * @var array $barWidths
         */
        private $barWidths = array(1, 3);

        /**
         * Bar height
         *
         * @var int $barHeight
         */
        private $barHeight = 50;

        /**
         * Bar width multiplier
         *
         * @var int $barWidthMultiplier
         */
        private $barWidthMultiplier = 1;

        /**
         * Padding (x, y)
         *
         * @var array $padding
         */
        private $padding = array(5, 5);

        /**
         * Whether to include text
         *
         * @var bool $text
         */
        private $showText = TRUE;

        /**
         * Text size
         *
         * @var int $textSize
         */
        private $textSize = 3;

        /**
         * Text top margin
         *
         * @var int $textTopMargin
         */
        private $textTopMargin = 4;

        /**
         * Barcode background color (RGB)
         *
         * @var array $background
         */
        private $backgroundColor = array(255, 255, 255);

        /**
         * Bar color (RGB)
         *
         * @var array $background
         */
        private $barColor = array(0, 0, 0);

        /**
         * Convert hex color string to array
         *
         * @param string $hex
         * @return array
         */
        private function hexColorToArray($hex) {
            if (!preg_match('/^#?([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})$/', strtoupper(trim($hex)), $parts)) {
                return FALSE;
            }

            return array(hexdec($parts[1]), hexdec($parts[2]), hexdec($parts[3]));
        }

        /**
         * Normalize color argument to int array
         *
         * @param mixed $background
         * @return array
         */
        private function parseColorArgument($color) {
            if (is_string($color)) {
                $result = $this->hexColorToArray($color);

                if (!$result) {
                    throw new \InvalidArgumentException('String must be a valid hexadecimal 24-bit color code');
                }
            } else if (is_array($color)) {
                if (count($color) !== 3) {
                    throw new \InvalidArgumentException('Array must have exactly 3 elements');
                }

                foreach ($color as &$channel) {
                    $channel = (int) $channel;
                    if ($channel < 0 || $channel > 255) {
                        throw new \InvalidArgumentException('Color channel values must be between 0 and 255');
                    }
                }

                $result = array_values($color);
            } else {
                throw new \InvalidArgumentException('Color must be specified as string or array');
            }

            return $result;
        }

        /**
         * Set width multiplier (px)
         *
         * @param int $multiplier
         */
        public function setBarWidthMultiplier($multiplier) {
            $multiplier = (int) $multiplier;
            if ($multiplier < 1) {
                throw new \InvalidArgumentException('Width multiplier must be a positive integer greater than zero');
            }

            $this->barWidthMultiplier = $multiplier;
        }

        /**
         * Get width multiplier (px)
         *
         * @return int
         */
        public function getBarWidthMultiplier() {
            return $this->barWidthMultiplier;
        }

        /**
         * Set bar height (px)
         *
         * @param int $barHeight
         */
        public function setBarHeight($barHeight) {
            $barHeight = (int) $barHeight;
            if ($barHeight < 1) {
                throw new \InvalidArgumentException('Bar height must be a positive integer greater than zero');
            }

            $this->barHeight = $barHeight;
        }

        /**
         * Get bar height (px)
         *
         * @return int
         */
        public function getBarHeight() {
            return $this->barHeight;
        }

        /**
         * Set padding
         *
         * @param mixed $paddingX
         * @param int $paddingY
         */
        public function setPadding($paddingX, $paddingY = NULL) {
            if (is_array($paddingX)) {
                if (!isset($paddingX[0], $paddingX[1])) {
                    throw new \InvalidArgumentException('Both X and Y padding values must be specified');
                }
                $paddingY = (int) $paddingX[1];
                $paddingX = (int) $paddingX[0];
            } else {
                if (!isset($paddingY)) {
                    throw new \InvalidArgumentException('Both X and Y padding values must be specified');
                }
                $paddingX = (int) $paddingX;
                $paddingY = (int) $paddingY;
            }
            if ($paddingX < 0 || $paddingY < 0) {
                throw new \InvalidArgumentException('Padding values must be positive integers');
            }

            $this->padding = array($paddingX, $paddingY);
        }

        /**
         * Get padding
         *
         * @param int $component
         * @return mixed
         */
        public function getPadding($component = NULL) {
            if (!isset($component, $this->padding[$component])) {
                $result = $this->padding;
            } else {
                $result = $this->padding[$component];
            }
            return $result;
        }

        /**
         * Set whether the code text is shown
         *
         * @param bool $show
         */
        public function setShowText($show) {
            $this->showText = (bool) $show;
        }

        /**
         * Get whether the code text is shown
         *
         * @return bool
         */
        public function getShowText() {
            return $this->showText;
       }

       /**
         * Set text size
         *
         * @param int $textSize
         */
        public function setTextSize($textSize) {
            $textSize = (int) $textSize;
            if ($textSize < 1 || $textSize > 5) {
                throw new \InvalidArgumentException('Text size must be an integer between 1 and 5');
            }

            $this->textSize = $textSize;
        }

        /**
         * Get text size
         *
         * @return int
         */
        public function getTextSize() {
            return $this->textSize;
        }

       /**
         * Set text top margin
         *
         * @param int $textTopMargin
         */
        public function setTextTopMargin($textTopMargin) {
            $textTopMargin = (int) $textTopMargin;
            if ($textTopMargin < 1 || $textTopMargin > 5) {
                throw new \InvalidArgumentException('Text size must be an integer between 1 and 5');
            }

            $this->textTopMargin = $textTopMargin;
        }

        /**
         * Get text top margin
         *
         * @return int
         */
        public function getTextTopMargin() {
            return $this->textTopMargin;
        }

        /**
         * Set background color
         *
         * @param mixed $color
         */
        public function setBackgroundColor($color) {
            $this->backgroundColor = $this->parseColorArgument($color);
        }

        /**
         * Get background color
         *
         * @return array
         */
        public function getBackgroundColor() {
            return $this->backgroundColor;
        }

        /**
         * Set bar color
         *
         * @param mixed $color
         */
        public function setBarColor($color) {
            $this->barColor = $this->parseColorArgument($color);
        }

        /**
         * Get bar color
         *
         * @return array
         */
        public function getBarColor() {
            return $this->barColor;
        }

    }
