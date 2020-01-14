<?php

if (!class_exists('TCMB')) {
    /**
     * class.tcmb.php
     *
     * An open source application library.
     *
     * This content is released under the MIT License (MIT)
     *
     * Permission is hereby granted, free of charge, to any person obtaining a copy
     * of this software and associated documentation files (the "Software"), to deal
     * in the Software without restriction, including without limitation the rights
     * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
     * copies of the Software, and to permit persons to whom the Software is
     * furnished to do so, subject to the following conditions:
     *
     * The above copyright notice and this permission notice shall be included in
     * all copies or substantial portions of the Software.
     *
     * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
     * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
     * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
     * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
     * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
     * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
     * THE SOFTWARE.
     *
     * @package    class.tcmb.php
     * @author     Emre Can ÖZTAŞ <me@emrecanoztas.com>
     * @copyright  2020 class.tcmb.php
     * @license    https://opensource.org/licenses/MIT  MIT License
     * @link       https://github.com/ecoztas/php-tcmb
     * @since      Version 1.0.0
     * @filesource
     */
    class TCMB
    {
        // Global $code değişkeni
        public $code;
        // Lokal TCMB XML dosya verisi
        private $_xml;
        // Lokal TCMB XML dosya içerik bilgisi
        private $_code_table;
        // TCMB XML dosya adresi
        const TCMB_URL  = 'http://www.tcmb.gov.tr/kurlar/today.xml';

        public function __construct()
        {
            // TCMB XML dosyası çağrısı
            $this->_xml = @simplexml_load_file(self::TCMB_URL);
            // TCMB XML dosyası çağrısı boş değilse
            if ($this->_xml) {
                $this->code = '';
                $this->_code_table = array (
                    'USD' => array ('key' => 0, 'name_eng' => 'US DOLLAR', 'name_tr' => 'ABD DOLARI'),
                    'AUD' => array ('key' => 1, 'name_eng' => 'AUSTRALIAN DOLLAR', 'name_tr' => 'AVUSTRALYA DOLARI'),
                    'DKK' => array ('key' => 2, 'name_eng' => 'DANISH KRONE', 'name_tr' => 'DANİMARKA KRONU'),
                    'EUR' => array ('key' => 3, 'name_eng' => 'EURO', 'name_tr' => 'EURO'),
                    'GBP' => array ('key' => 4, 'name_eng' => 'POUND STERLING', 'name_tr' => 'İNGİLİZ STERLİNİ'),
                    'CHF' => array ('key' => 5, 'name_eng' => 'SWISS FRANK', 'name_tr' => 'İSVİÇRE FRANGI'),
                    'SEK' => array ('key' => 6, 'name_eng' => 'SWEDISH KRONA', 'name_tr' => 'İSVEÇ KRONU'),
                    'CAD' => array ('key' => 7, 'name_eng' => 'CANADIAN DOLLAR', 'name_tr' => 'KANADA DOLARI'),
                    'KWD' => array ('key' => 8, 'name_eng' => 'KUWAITI DINAR', 'name_tr' => 'KUVEYT DİNARI'),
                    'NOK' => array ('key' => 9, 'name_eng' => 'NORWEGIAN KRONE', 'name_tr' => 'NORVEÇ KRONU'),
                    'SAR' => array ('key' => 10, 'name_eng' => 'SAUDI RIYAL', 'name_tr' => 'SUUDİ ARABİSTAN RİYALİ'),
                    'JPY' => array ('key' => 11, 'name_eng' => 'JAPENESE YEN', 'name_tr' => 'JAPON YENİ'),
                    'BGN' => array ('key' => 12, 'name_eng' => 'BULGARIAN LEV', 'name_tr' => 'BULGAR LEVASI'),
                    'RON' => array ('key' => 13, 'name_eng' => 'NEW LEU', 'name_tr' => 'RUMEN LEYİ'),
                    'RUB' => array ('key' => 14, 'name_eng' => 'RUSSIAN ROUBLE', 'name_tr' => 'RUS RUBLESİ'),
                    'IRR' => array ('key' => 15, 'name_eng' => 'IRANIAN RIAL', 'name_tr' => 'İRAN RİYALİ'),
                    'CNY' => array ('key' => 16, 'name_eng' => 'CHINESE RENMINBI', 'name_tr' => 'ÇİN YUANI'),
                    'PKR' => array ('key' => 17, 'name_eng' => 'PAKISTANI RUPEE', 'name_tr' => 'PAKİSTAN RUPİSİ'),
                    'QAR' => array ('key' => 18, 'name_eng' => 'QATARI RIAL', 'name_tr' => 'KATAR RİYALİ')
                );
            } else {
                exit('TCMB XML file failed! Please check it!');
            }
        }

        /**
         * Global $code değişkenine atama yapar.
         * @param   string $code
         * @example set_code('CAD'); veya set_code('USD'); gibi
         */
        public function set_code($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
        }

        /**
         * Global $code bilgisini verir.
         * @return  string
         * @example get_code();
         */
        public function get_code()
        {
            return ($this->code);
        }

        /**
         * TCMB XML dosyası aktif tarihini verir.
         * @return  date
         * @example get_date();
         */
        public function get_date()
        {
            return ($this->_xml['Date']);
        }

        /**
         * TCMB XML dosyasındaki tabloya göre; istenilen kod değerini verir.
         * $_code_table değişkenini kontrol edebilirsiniz.
         * @param   string $code
         * @return  integer
         * @example get_key('GBP');
         */
        public function get_key($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $key = $this->_code_table[$this->code]['key'];

                    return ($key);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para birimlerinin İngilizce isimlerini verir.
         * @param   string $code
         * @return  string
         * @example get_name_eng('CAD');
         */
        public function get_name_eng($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $name = $this->_code_table[$this->code]['name_eng'];

                    return ($name);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para birimlerinin Türkçe isimlerini verir.
         * @param   string $code
         * @return  string
         * @example get_name_tr('CAD');
         */
        public function get_name_tr($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $name = $this->_code_table[$this->code]['name_tr'];

                    return ($name);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para biriminin Türk Lirası karşılığındaki alış değerini verir.
         * @param   string $code
         * @return  double
         * @example the_buying('CAD');
         */
        public function the_buying($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $key    = $this->_code_table[$this->code]['key'];
                    $buying = @$this->_xml->Currency[$key]->BanknoteBuying;

                    return ((double)$buying);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para biriminin Türk Lirası karşılığındaki satış değerini verir.
         * @param   string $code
         * @return  double
         * @example the_selling('CAD');
         */
        public function the_selling($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $key     = $this->_code_table[$this->code]['key'];
                    $selling = @$this->_xml->Currency[$key]->BanknoteSelling;

                    return ((double)$selling);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para biriminin Türk Lirası karşılığındaki Forex alış değerini verir.
         * @param   string $code
         * @return  double
         * @example the_forex_buying('CAD');
         */
        public function the_forex_buying($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $key            = $this->_code_table[$this->code]['key'];
                    $forex_buying   = @$this->_xml->Currency[$key]->ForexBuying;

                    return ((double)$forex_buying);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }

        /**
         * Para biriminin Türk Lirası karşılığındaki Forex satış değerini verir.
         * @param   string $code
         * @return  double
         * @example the_forex_selling('CAD');
         */
        public function the_forex_selling($code='')
        {
            !empty($code) ? $this->code = $code : $this->code = $this->code;
            if (!empty($this->code)) {
                if (array_key_exists($this->code, $this->_code_table)) {
                    $key                = $this->_code_table[$this->code]['key'];
                    $forex_selling      = @$this->_xml->Currency[$key]->ForexSelling;

                    return ((double)$forex_selling);
                } else {
                    return (null);
                }
            } else {
                return (false);
            }
        }
    }
}
