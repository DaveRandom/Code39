<?php

    namespace Code39;

    class CharacterSequence {

        /**
         * Include sequence terminators flag
         *
         * @const SEQ_TERMINATORS
         */
        const SEQ_TERMINATORS = 1;

        /**
         * Use sequence delimiter flag
         *
         * @const SEQ_DELIM
         */
        const SEQ_DELIM = 2;

        /**
         * Characters in the sequence
         *
         * @var array $sequenceTerminator
         */
        private $characters = array();

        /**
         * Code 39 sequence terminator
         *
         * @var array $sequenceTerminator
         */
        private $sequenceTerminator;

        /**
         * Code 39 character separator
         *
         * @var array $characterSeparator
         */
        private $characterSeparator;

        /**
         * Static factory
         *
         * @param string $str
         * @return CharacterSequence
         */
        public static function createFromString($str) {
            $length = strlen($str);
            if (!$length) {
                throw new \InvalidArgumentException('Cannot create CharacterSequence from empty string');
            }

            $instance = new self;
            for ($i = 0; $i < $length; $i++) {
                $instance->push(new Character($str[$i]));
            }

            return $instance;
        }

        /**
         * Constructor
         */
        public function __construct() {
            $this->characterSeparator = new Bar(FALSE, FALSE);
            $this->sequenceTerminator = new Character("\xFF");
        }

        /**
         * Push a Character onto the sequence
         *
         * @param Character $char
         * @return int
         */
        public function push(Character $char) {
            return array_push($this->characters, $char);
        }

        /**
         * Pop a Character off the sequence
         *
         * @return Character
         */
        public function pop() {
            return array_pop($this->characters);
        }

        /**
         * Unshift a Character onto the sequence
         *
         * @param Character $char
         * @return int
         */
        public function unshift(Character $char) {
            return array_unshift($this->characters, $char);
        }

        /**
         * Shift a Character off the sequence
         *
         * @return Character
         */
        public function shift() {
            return array_shift($this->characters);
        }

        /**
         * Get the character data as an ASCII string
         *
         * @param int $flags
         * @param string $delim
         * @return string
         */
        public function getCharacterString($flags = 0, $delim = NULL) {
            if (!($flags & self::SEQ_DELIM)) {
                $delim = '';
            }

            $result = implode($delim, $this->characters);

            if ($flags & self::SEQ_TERMINATORS) {
                $result = '*'.$delim.$result.$delim.'*';
            }

            return $result;
        }

        /**
         * Get the character data as an array of Bar objects
         *
         * @param int $flags
         * @return array
         */
        public function getBarSequence($flags = 1) {
            $result = array();

            if ($flags & self::SEQ_TERMINATORS) {
                $result = array_merge($this->sequenceTerminator->getBars(), array($this->characterSeparator));
            }

            foreach ($this->characters as $char) {
                $result = array_merge($result, $char->getBars(), array($this->characterSeparator));
            }

            if ($flags & self::SEQ_TERMINATORS) {
                $result = array_merge($result, $this->sequenceTerminator->getBars());
            } else {
                array_pop($result);
            }

            return $result;
        }

        /**
         * Get the width of the sequence bars
         *
         * @param int $flags
         * @return int
         */
        public function getWidth($flags = 1) {
            $result = 0;

            $bars = $this->getBarSequence($flags);
            foreach ($bars as $bar) {
                $result += $bar->getWidth();
            }

            return $result;
        }

    }
