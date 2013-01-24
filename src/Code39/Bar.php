<?php

    namespace Code39;

    class Bar {

        /**
         * Wide bar flag
         *
         * @const ATTR_WIDE
         */
        const ATTR_WIDE = 0x01;

        /**
         * Black bar flag
         *
         * @const ATTR_BLACK
         */
        const ATTR_BLACK = 0x02;

        /**
         * Width of bar
         *
         * @var int $width
         */
        private $width;

        /**
         * Whether the bar is black
         *
         * @var bool $black
         */
        private $black;

        /**
         * Constructor
         *
         * @param bool $wide
         * @param bool $black
         */
        public function __construct($wide, $black) {
            $this->width = $wide ? 3 : 1;
            $this->black = (bool) $black;
        }

        /**
         * Returns the width
         *
         * @return int
         */
        public function getWidth() {
            return $this->width;
        }

        /**
         * Returns TRUE if bar is black
         *
         * @return bool
         */
        public function isBlack() {
            return $this->black;
        }

    }
