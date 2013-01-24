<?php

    namespace Code39;

    class Character {

        /**
         * Code 39 encoding map
         *
         * @var array $charSequences
         */
        private $charSequences = array(
            '0' => array(2, 0, 2, 1, 3, 0, 3, 0, 2),
            '1' => array(3, 0, 2, 1, 2, 0, 2, 0, 3),
            '2' => array(2, 0, 3, 1, 2, 0, 2, 0, 3),
            '3' => array(3, 0, 3, 1, 2, 0, 2, 0, 2),
            '4' => array(2, 0, 2, 1, 3, 0, 2, 0, 3),
            '5' => array(3, 0, 2, 1, 3, 0, 2, 0, 2),
            '6' => array(2, 0, 3, 1, 3, 0, 2, 0, 2),
            '7' => array(2, 0, 2, 1, 2, 0, 3, 0, 3),
            '8' => array(3, 0, 2, 1, 2, 0, 3, 0, 2),
            '9' => array(2, 0, 3, 1, 2, 0, 3, 0, 2),
            'A' => array(3, 0, 2, 0, 2, 1, 2, 0, 3),
            'B' => array(2, 0, 3, 0, 2, 1, 2, 0, 3),
            'C' => array(3, 0, 3, 0, 2, 1, 2, 0, 2),
            'D' => array(2, 0, 2, 0, 3, 1, 2, 0, 3),
            'E' => array(3, 0, 2, 0, 3, 1, 2, 0, 2),
            'F' => array(2, 0, 3, 0, 3, 1, 2, 0, 2),
            'G' => array(2, 0, 2, 0, 2, 1, 3, 0, 3),
            'H' => array(3, 0, 2, 0, 2, 1, 3, 0, 2),
            'I' => array(2, 0, 3, 0, 2, 1, 3, 0, 2),
            'J' => array(2, 0, 2, 0, 3, 1, 3, 0, 2),
            'K' => array(3, 0, 2, 0, 2, 0, 2, 1, 3),
            'L' => array(2, 0, 3, 0, 2, 0, 2, 1, 3),
            'M' => array(3, 0, 3, 0, 2, 0, 2, 1, 2),
            'N' => array(2, 0, 2, 0, 3, 0, 2, 1, 3),
            'O' => array(3, 0, 2, 0, 3, 0, 2, 1, 2),
            'P' => array(2, 0, 3, 0, 3, 0, 2, 1, 2),
            'Q' => array(2, 0, 2, 0, 2, 0, 3, 1, 3),
            'R' => array(3, 0, 2, 0, 2, 0, 3, 1, 2),
            'S' => array(2, 0, 3, 0, 2, 0, 3, 1, 2),
            'T' => array(2, 0, 2, 0, 3, 0, 3, 1, 2),
            'U' => array(3, 1, 2, 0, 2, 0, 2, 0, 3),
            'V' => array(2, 1, 3, 0, 2, 0, 2, 0, 3),
            'W' => array(3, 1, 3, 0, 2, 0, 2, 0, 2),
            'X' => array(2, 1, 2, 0, 3, 0, 2, 0, 3),
            'Y' => array(3, 1, 2, 0, 3, 0, 2, 0, 2),
            'Z' => array(2, 1, 3, 0, 3, 0, 2, 0, 2),
            '-' => array(2, 1, 2, 0, 2, 0, 3, 0, 3),
            '.' => array(3, 1, 2, 0, 2, 0, 3, 0, 2),
            ' ' => array(2, 1, 3, 0, 2, 0, 3, 0, 2),
            '$' => array(2, 1, 2, 1, 2, 1, 2, 0, 2),
            '/' => array(2, 1, 2, 1, 2, 0, 2, 1, 2),
            '+' => array(2, 1, 2, 0, 2, 1, 2, 1, 2),
            '%' => array(2, 0, 2, 1, 2, 1, 2, 1, 2)
        );

        /**
         * Code 39 character map
         *
         * @var array $charMap
         */
        private $charMap = array(
            "\x00" => '%U', "\x01" => '$A', "\x02" => '$B', "\x03" => '$C',
            "\x04" => '$D', "\x05" => '$E', "\x06" => '$F', "\x07" => '$G',
            "\x08" => '$H', "\x09" => '$I', "\x0A" => '$J', "\x0B" => '$K',
            "\x0C" => '$L', "\x0D" => '$M', "\x0E" => '$N', "\x0F" => '$O',
            "\x10" => '$P', "\x11" => '$Q', "\x12" => '$R', "\x13" => '$S',
            "\x14" => '$T', "\x15" => '$U', "\x16" => '$V', "\x17" => '$W',
            "\x18" => '$X', "\x19" => '$Y', "\x1A" => '$Z', "\x1B" => '%A',
            "\x1C" => '%B', "\x1D" => '%C', "\x1E" => '%D', "\x1F" => '%E',
            "\x20" => ' ',  "\x21" => '/A', "\x22" => '/B', "\x23" => '/C',
            "\x24" => '/D', "\x25" => '/E', "\x26" => '/F', "\x27" => '/G',
            "\x28" => '/H', "\x29" => '/I', "\x2A" => '/J', "\x2B" => '/K',
            "\x2C" => '/L', "\x2D" => '-',  "\x2E" => '.',  "\x2F" => '/O',
            "\x30" => '0',  "\x31" => '1',  "\x32" => '2',  "\x33" => '3',
            "\x34" => '4',  "\x35" => '5',  "\x36" => '6',  "\x37" => '7',
            "\x38" => '8',  "\x39" => '9',  "\x3A" => '/Z', "\x3B" => '%F',
            "\x3C" => '%G', "\x3D" => '%H', "\x3E" => '%I', "\x3F" => '%J',
            "\x40" => '%V', "\x41" => 'A',  "\x42" => 'B',  "\x43" => 'C',
            "\x44" => 'D',  "\x45" => 'E',  "\x46" => 'F',  "\x47" => 'G',
            "\x48" => 'H',  "\x49" => 'I',  "\x4A" => 'J',  "\x4B" => 'K',
            "\x4C" => 'L',  "\x4D" => 'M',  "\x4E" => 'N',  "\x4F" => 'O',
            "\x50" => 'P',  "\x51" => 'Q',  "\x52" => 'R',  "\x53" => 'S',
            "\x54" => 'T',  "\x55" => 'U',  "\x56" => 'V',  "\x57" => 'W',
            "\x58" => 'X',  "\x59" => 'Y',  "\x5A" => 'Z',  "\x5B" => '%K',
            "\x5C" => '%L', "\x5D" => '%M', "\x5E" => '%N', "\x5F" => '%0',
            "\x60" => '%W', "\x61" => '+A', "\x62" => '+B', "\x63" => '+C',
            "\x64" => '%D', "\x65" => '+E', "\x66" => '+F', "\x67" => '+G',
            "\x68" => '%H', "\x69" => '+I', "\x6A" => '+J', "\x6B" => '+K',
            "\x6C" => '%L', "\x6D" => '+M', "\x6E" => '+N', "\x6F" => '+O',
            "\x70" => '%P', "\x71" => '+Q', "\x72" => '+R', "\x73" => '+S',
            "\x74" => '%T', "\x75" => '+U', "\x76" => '+V', "\x77" => '+W',
            "\x78" => '%X', "\x79" => '+Y', "\x7A" => '+Z', "\x7B" => '%P',
            "\x7C" => '%Q', "\x7D" => '+R', "\x7E" => '+S', "\x7F" => '%Z'
        );

        /**
         * Code 39 sequence terminator
         *
         * @var array $sequenceTerminator
         */
        private $sequenceTerminator = array(2, 1, 2, 0, 3, 0, 3, 0, 2);

        /**
         * Character this object represents
         *
         * @var string $char
         */
        private $char;

        /**
         * Bars that represent this character
         *
         * @var array $bars
         */
        private $bars;

        /**
         * Constructor
         *
         * @var string $char
         */
        public function __construct($char = NULL) {
            if (isset($char)) {
                $this->setChar($char);
            }
        }

        /**
         * String conversion
         *
         * @return string
         */
        public function __toString() {
            return $this->getChar();
        }

        /**
         * Sets the character
         *
         * @var string $char
         */
        public function setChar($char) {
            $ord = ord($char);
            if (strlen($char) !== 1 || $ord < 0 || ($ord > 127 && $ord !== 255)) {
                throw new \InvalidArgumentException('Invalid or unrepresentable character '.$char.' ('.sprintf('0x%02X', $ord).')');
            }
            $this->char = $char;
            $this->setBars($char);
        }

        /**
         * Returns the character as a string
         *
         * @return string
         */
        public function getChar() {
            return $this->char;
        }

        /**
         * Converts the character to an array of Bar objects
         *
         * @var string $char
         */
        private function setBars($char) {
            $this->bars = $format = array();

            if ($char === "\xFF") {
                $format = $this->sequenceTerminator;
            } else {
                $seq = $this->charMap[$char];

                if (strlen($seq) > 1) {
                    $format = array_merge($this->charSequences[$seq[0]], array(0));
                    $seq = $seq[1];
                }

                $format = array_merge($format, $this->charSequences[$seq]);
            }

            foreach ($format as $bar) {
                $this->bars[] = new Bar($bar & Bar::ATTR_WIDE, $bar & Bar::ATTR_BLACK);
            }
        }

        /**
         * Returns the character as an array of Bar objects
         *
         * @return array
         */
        public function getBars() {
            return $this->bars;
        }

    }
