<?php

namespace PhpOffice\PhpSpreadsheet\Style;

use PhpOffice\PhpSpreadsheet\Calculation\MathTrig;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;

class NumberFormat extends Supervisor
{
    // Pre-defined formats
    const FORMAT_GENERAL = 'General';

    const FORMAT_TEXT = '@';

    const FORMAT_NUMBER = '0';
    const FORMAT_NUMBER_00 = '0.00';
    const FORMAT_NUMBER_COMMA_SEPARATED1 = '#,##0.00';
    const FORMAT_NUMBER_COMMA_SEPARATED2 = '#,##0.00_-';

    const FORMAT_PERCENTAGE = '0%';
    const FORMAT_PERCENTAGE_00 = '0.00%';

    const FORMAT_DATE_YYYYMMDD2 = 'yyyy-mm-dd';
    const FORMAT_DATE_YYYYMMDD = 'yyyy-mm-dd';
    const FORMAT_DATE_DDMMYYYY = 'dd/mm/yyyy';
    const FORMAT_DATE_DMYSLASH = 'd/m/yy';
    const FORMAT_DATE_DMYMINUS = 'd-m-yy';
    const FORMAT_DATE_DMMINUS = 'd-m';
    const FORMAT_DATE_MYMINUS = 'm-yy';
    const FORMAT_DATE_XLSX14 = 'mm-dd-yy';
    const FORMAT_DATE_XLSX15 = 'd-mmm-yy';
    const FORMAT_DATE_XLSX16 = 'd-mmm';
    const FORMAT_DATE_XLSX17 = 'mmm-yy';
    const FORMAT_DATE_XLSX22 = 'm/d/yy h:mm';
    const FORMAT_DATE_DATETIME = 'd/m/yy h:mm';
    const FORMAT_DATE_TIME1 = 'h:mm AM/PM';
    const FORMAT_DATE_TIME2 = 'h:mm:ss AM/PM';
    const FORMAT_DATE_TIME3 = 'h:mm';
    const FORMAT_DATE_TIME4 = 'h:mm:ss';
    const FORMAT_DATE_TIME5 = 'mm:ss';
    const FORMAT_DATE_TIME6 = 'h:mm:ss';
    const FORMAT_DATE_TIME7 = 'i:s.S';
    const FORMAT_DATE_TIME8 = 'h:mm:ss;@';
    const FORMAT_DATE_YYYYMMDDSLASH = 'yyyy/mm/dd;@';

    const FORMAT_CURRENCY_USD_SIMPLE = '"$"#,##0.00_-';
    const FORMAT_CURRENCY_USD = '$#,##0_-';

    const FORMAT_CURRENCY_EUR_SIMPLE = '#,##0.00_-"€"';
    const FORMAT_CURRENCY_EUR = '#,##0_-"€"';

    const FORMAT_ACCOUNTING_USD = '_("$"* # ##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)';
    const FORMAT_ACCOUNTING_EUR = '_("€"* # ##0.00_);_("€"* \(#,##0.00\);_("€"* "-"??_);_(@_)';

    // UTILISER POUR ANADEFI NE PAS SUPPRIMER
    const FORMAT_ACCOUNTING_EUR_COMPTABILITE = '#,##0_-"K€"';

    /**
     * Excel built-in number formats.
     *
     * @var array
     */
    protected static $builtInFormats;

    /**
     * Excel built-in number formats (flipped, for faster lookups).
     *
     * @var array
     */
    protected static $flippedBuiltInFormats;

    /**
     * Format Code.
     *
     * @var string
     */
    protected $formatCode = self::FORMAT_GENERAL;

    /**
     * Built-in format Code.
     *
     * @var string
     */
    protected $builtInFormatCode = 0;

    /**
     * Create a new NumberFormat.
     *
     * @param bool $isSupervisor Flag indicating if this is a supervisor or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     * @param bool $isConditional Flag indicating if this is a conditional style or not
     *                                    Leave this value at default unless you understand exactly what
     *                                        its ramifications are
     */
    public function __construct($isSupervisor = false, $isConditional = false)
    {
        // Supervisor?
        parent::__construct($isSupervisor);

        if ($isConditional) {
            $this->formatCode = null;
            $this->builtInFormatCode = false;
        }
    }

    /**
     * Get the shared style component for the currently active cell in currently active sheet.
     * Only used for style supervisor.
     *
     * @return NumberFormat
     */
    public function getSharedComponent()
    {
        return $this->parent->getSharedComponent()->getNumberFormat();
    }

    /**
     * Build style array from subcomponents.
     *
     * @param array $array
     *
     * @return array
     */
    public function getStyleArray($array)
    {
        return ['numberFormat' => $array];
    }

    /**
     * Apply styles from array.
     *
     * <code>
     * $spreadsheet->getActiveSheet()->getStyle('B2')->getNumberFormat()->applyFromArray(
     *     [
     *         'formatCode' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE
     *     ]
     * );
     * </code>
     *
     * @param array $pStyles Array containing style information
     *
     * @return $this
     */
    public function applyFromArray(array $pStyles)
    {
        if ($this->isSupervisor) {
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($this->getStyleArray($pStyles));
        } else {
            if (isset($pStyles['formatCode'])) {
                $this->setFormatCode($pStyles['formatCode']);
            }
        }

        return $this;
    }

    /**
     * Get Format Code.
     *
     * @return string
     */
    public function getFormatCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getFormatCode();
        }
        if ($this->builtInFormatCode !== false) {
            return self::builtInFormatCode($this->builtInFormatCode);
        }

        return $this->formatCode;
    }

    /**
     * Set Format Code.
     *
     * @param string $pValue see self::FORMAT_*
     *
     * @return $this
     */
    public function setFormatCode($pValue)
    {
        if ($pValue == '') {
            $pValue = self::FORMAT_GENERAL;
        }
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(['formatCode' => $pValue]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->formatCode = $pValue;
            $this->builtInFormatCode = self::builtInFormatCodeIndex($pValue);
        }

        return $this;
    }

    /**
     * Get Built-In Format Code.
     *
     * @return int
     */
    public function getBuiltInFormatCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getBuiltInFormatCode();
        }

        return $this->builtInFormatCode;
    }

    /**
     * Set Built-In Format Code.
     *
     * @param int $pValue
     *
     * @return $this
     */
    public function setBuiltInFormatCode($pValue)
    {
        if ($this->isSupervisor) {
            $styleArray = $this->getStyleArray(['formatCode' => self::builtInFormatCode($pValue)]);
            $this->getActiveSheet()->getStyle($this->getSelectedCells())->applyFromArray($styleArray);
        } else {
            $this->builtInFormatCode = $pValue;
            $this->formatCode = self::builtInFormatCode($pValue);
        }

        return $this;
    }

    /**
     * Fill built-in format codes.
     */
    private static function fillBuiltInFormatCodes(): void
    {
        //  [MS-OI29500: Microsoft Office Implementation Information for ISO/IEC-29500 Standard Compliance]
        //  18.8.30. numFmt (Number Format)
        //
        //  The ECMA standard defines built-in format IDs
        //      14: "mm-dd-yy"
        //      22: "m/d/yy h:mm"
        //      37: "#,##0 ;(#,##0)"
        //      38: "#,##0 ;[Red](#,##0)"
        //      39: "#,##0.00;(#,##0.00)"
        //      40: "#,##0.00;[Red](#,##0.00)"
        //      47: "mmss.0"
        //      KOR fmt 55: "yyyy-mm-dd"
        //  Excel defines built-in format IDs
        //      14: "m/d/yyyy"
        //      22: "m/d/yyyy h:mm"
        //      37: "#,##0_);(#,##0)"
        //      38: "#,##0_);[Red](#,##0)"
        //      39: "#,##0.00_);(#,##0.00)"
        //      40: "#,##0.00_);[Red](#,##0.00)"
        //      47: "mm:ss.0"
        //      KOR fmt 55: "yyyy/mm/dd"

        // Built-in format codes
        if (self::$builtInFormats === null) {
            self::$builtInFormats = [];

            // General
            self::$builtInFormats[0] = self::FORMAT_GENERAL;
            self::$builtInFormats[1] = '0';
            self::$builtInFormats[2] = '0.00';
            self::$builtInFormats[3] = '#,##0';
            self::$builtInFormats[4] = '#,##0.00';

            self::$builtInFormats[9] = '0%';
            self::$builtInFormats[10] = '0.00%';
            self::$builtInFormats[11] = '0.00E+00';
            self::$builtInFormats[12] = '# ?/?';
            self::$builtInFormats[13] = '# ??/??';
            self::$builtInFormats[14] = 'm/d/yyyy'; // Despite ECMA 'mm-dd-yy';
            self::$builtInFormats[15] = 'd-mmm-yy';
            self::$builtInFormats[16] = 'd-mmm';
            self::$builtInFormats[17] = 'mmm-yy';
            self::$builtInFormats[18] = 'h:mm AM/PM';
            self::$builtInFormats[19] = 'h:mm:ss AM/PM';
            self::$builtInFormats[20] = 'h:mm';
            self::$builtInFormats[21] = 'h:mm:ss';
            self::$builtInFormats[22] = 'm/d/yyyy h:mm'; // Despite ECMA 'm/d/yy h:mm';

            self::$builtInFormats[37] = '#,##0_);(#,##0)'; //  Despite ECMA '#,##0 ;(#,##0)';
            self::$builtInFormats[38] = '#,##0_);[Red](#,##0)'; //  Despite ECMA '#,##0 ;[Red](#,##0)';
            self::$builtInFormats[39] = '#,##0.00_);(#,##0.00)'; //  Despite ECMA '#,##0.00;(#,##0.00)';
            self::$builtInFormats[40] = '#,##0.00_);[Red](#,##0.00)'; //  Despite ECMA '#,##0.00;[Red](#,##0.00)';

            self::$builtInFormats[44] = '_("$"* #,##0.00_);_("$"* \(#,##0.00\);_("$"* "-"??_);_(@_)';
            self::$builtInFormats[45] = 'mm:ss';
            self::$builtInFormats[46] = '[h]:mm:ss';
            self::$builtInFormats[47] = 'mm:ss.0'; //  Despite ECMA 'mmss.0';
            self::$builtInFormats[48] = '##0.0E+0';
            self::$builtInFormats[49] = '@';

            // CHT
            self::$builtInFormats[27] = '[$-404]e/m/d';
            self::$builtInFormats[30] = 'm/d/yy';
            self::$builtInFormats[36] = '[$-404]e/m/d';
            self::$builtInFormats[50] = '[$-404]e/m/d';
            self::$builtInFormats[57] = '[$-404]e/m/d';

            // THA
            self::$builtInFormats[59] = 't0';
            self::$builtInFormats[60] = 't0.00';
            self::$builtInFormats[61] = 't#,##0';
            self::$builtInFormats[62] = 't#,##0.00';
            self::$builtInFormats[67] = 't0%';
            self::$builtInFormats[68] = 't0.00%';
            self::$builtInFormats[69] = 't# ?/?';
            self::$builtInFormats[70] = 't# ??/??';

            // JPN
            self::$builtInFormats[28] = '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[29] = '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[31] = 'yyyy"年"m"月"d"日"';
            self::$builtInFormats[32] = 'h"時"mm"分"';
            self::$builtInFormats[33] = 'h"時"mm"分"ss"秒"';
            self::$builtInFormats[34] = 'yyyy"年"m"月"';
            self::$builtInFormats[35] = 'm"月"d"日"';
            self::$builtInFormats[51] = '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[52] = 'yyyy"年"m"月"';
            self::$builtInFormats[53] = 'm"月"d"日"';
            self::$builtInFormats[54] = '[$-411]ggge"年"m"月"d"日"';
            self::$builtInFormats[55] = 'yyyy"年"m"月"';
            self::$builtInFormats[56] = 'm"月"d"日"';
            self::$builtInFormats[58] = '[$-411]ggge"年"m"月"d"日"';

            // Flip array (for faster lookups)
            self::$flippedBuiltInFormats = array_flip(self::$builtInFormats);
        }
    }

    /**
     * Get built-in format code.
     *
     * @param int $pIndex
     *
     * @return string
     */
    public static function builtInFormatCode($pIndex)
    {
        // Clean parameter
        $pIndex = (int) $pIndex;

        // Ensure built-in format codes are available
        self::fillBuiltInFormatCodes();

        // Lookup format code
        if (isset(self::$builtInFormats[$pIndex])) {
            return self::$builtInFormats[$pIndex];
        }

        return '';
    }

    /**
     * Get built-in format code index.
     *
     * @param string $formatCode
     *
     * @return bool|int
     */
    public static function builtInFormatCodeIndex($formatCode)
    {
        // Ensure built-in format codes are available
        self::fillBuiltInFormatCodes();

        // Lookup format code
        if (array_key_exists($formatCode, self::$flippedBuiltInFormats)) {
            return self::$flippedBuiltInFormats[$formatCode];
        }

        return false;
    }

    /**
     * Get hash code.
     *
     * @return string Hash code
     */
    public function getHashCode()
    {
        if ($this->isSupervisor) {
            return $this->getSharedComponent()->getHashCode();
        }

        return md5(
            $this->formatCode .
            $this->builtInFormatCode .
            __CLASS__
        );
    }

    /**
     * Search/replace values to convert Excel date/time format masks to PHP format masks.
     *
     * @var array
     */
    private static $dateFormatReplacements = [
        // first remove escapes related to non-format characters
        '\\' => '',
        //    12-hour suffix
        'am/pm' => 'A',
        //    4-digit year
        'e' => 'Y',
        'yyyy' => 'Y',
        //    2-digit year
        'yy' => 'y',
        //    first letter of month - no php equivalent
        'mmmmm' => 'M',
        //    full month name
        'mmmm' => 'F',
        //    short month name
        'mmm' => 'M',
        //    mm is minutes if time, but can also be month w/leading zero
        //    so we try to identify times be the inclusion of a : separator in the mask
        //    It isn't perfect, but the best way I know how
        ':mm' => ':i',
        'mm:' => 'i:',
        //    month leading zero
        'mm' => 'm',
        //    month no leading zero
        'm' => 'n',
        //    full day of week name
        'dddd' => 'l',
        //    short day of week name
        'ddd' => 'D',
        //    days leading zero
        'dd' => 'd',
        //    days no leading zero
        'd' => 'j',
        //    seconds
        'ss' => 's',
        //    fractional seconds - no php equivalent
        '.s' => '',
    ];

    /**
     * Search/replace values to convert Excel date/time format masks hours to PHP format masks (24 hr clock).
     *
     * @var array
     */
    private static $dateFormatReplacements24 = [
        'hh' => 'H',
        'h' => 'G',
    ];

    /**
     * Search/replace values to convert Excel date/time format masks hours to PHP format masks (12 hr clock).
     *
     * @var array
     */
    private static $dateFormatReplacements12 = [
        'hh' => 'h',
        'h' => 'g',
    ];

    private static function setLowercaseCallback($matches)
    {
        return mb_strtolower($matches[0]);
    }

    private static function escapeQuotesCallback($matches)
    {
        return '\\' . implode('\\', str_split($matches[1]));
    }

    private static function formatAsDate(&$value, &$format): void
    {
        // strip off first part containing e.g. [$-F800] or [$USD-409]
        // general syntax: [$<Currency string>-<language info>]
        // language info is in hexadecimal
        // strip off chinese part like [DBNum1][$-804]
        $format = preg_replace('/^(\[[0-9A-Za-z]*\])*(\[\$[A-Z]*-[0-9A-F]*\])/i', '', $format);

        // OpenOffice.org uses upper-case number formats, e.g. 'YYYY', convert to lower-case;
        //    but we don't want to change any quoted strings
        $format = preg_replace_callback('/(?:^|")([^"]*)(?:$|")/', ['self', 'setLowercaseCallback'], $format);

        // Only process the non-quoted blocks for date format characters
        $blocks = explode('"', $format);
        foreach ($blocks as $key => &$block) {
            if ($key % 2 == 0) {
                $block = strtr($block, self::$dateFormatReplacements);
                if (!strpos($block, 'A')) {
                    // 24-hour time format
                    // when [h]:mm format, the [h] should replace to the hours of the value * 24
                    if (false !== strpos($block, '[h]')) {
                        $hours = (int) ($value * 24);
                        $block = str_replace('[h]', $hours, $block);

                        continue;
                    }
                    $block = strtr($block, self::$dateFormatReplacements24);
                } else {
                    // 12-hour time format
                    $block = strtr($block, self::$dateFormatReplacements12);
                }
            }
        }
        $format = implode('"', $blocks);

        // escape any quoted characters so that DateTime format() will render them correctly
        $format = preg_replace_callback('/"(.*)"/U', ['self', 'escapeQuotesCallback'], $format);

        $dateObj = Date::excelToDateTimeObject($value);
        $value = $dateObj->format($format);
    }

    private static function formatAsPercentage(&$value, &$format): void
    {
        if ($format === self::FORMAT_PERCENTAGE) {
            $value = round((100 * $value), 0) . '%';
        } else {
            if (preg_match('/\.[#0]+/', $format, $m)) {
                $s = substr($m[0], 0, 1) . (strlen($m[0]) - 1);
                $format = str_replace($m[0], $s, $format);
            }
            if (preg_match('/^[#0]+/', $format, $m)) {
                $format = str_replace($m[0], strlen($m[0]), $format);
            }
            $format = '%' . str_replace('%', 'f%%', $format);

            $value = sprintf($format, 100 * $value);
        }
    }

    private static function formatAsFraction(&$value, &$format): void
    {
        $sign = ($value < 0) ? '-' : '';

        $integerPart = floor(abs($value));
        $decimalPart = trim(fmod(abs($value), 1), '0.');
        $decimalLength = strlen($decimalPart);
        $decimalDivisor = 10 ** $decimalLength;

        $GCD = MathTrig::GCD($decimalPart, $decimalDivisor);

        $adjustedDecimalPart = $decimalPart / $GCD;
        $adjustedDecimalDivisor = $decimalDivisor / $GCD;

        if ((strpos($format, '0') !== false)) {
            $value = "$sign$integerPart $adjustedDecimalPart/$adjustedDecimalDivisor";
        } elseif ((strpos($format, '#') !== false)) {
            if ($integerPart == 0) {
                $value = "$sign$adjustedDecimalPart/$adjustedDecimalDivisor";
            } else {
                $value = "$sign$integerPart $adjustedDecimalPart/$adjustedDecimalDivisor";
            }
        } elseif ((substr($format, 0, 3) == '? ?')) {
            if ($integerPart == 0) {
                $integerPart = '';
            }
            $value = "$sign$integerPart $adjustedDecimalPart/$adjustedDecimalDivisor";
        } else {
            $adjustedDecimalPart += $integerPart * $adjustedDecimalDivisor;
            $value = "$sign$adjustedDecimalPart/$adjustedDecimalDivisor";
        }
    }

    private static function mergeComplexNumberFormatMasks($numbers, $masks)
    {
        $decimalCount = strlen($numbers[1]);
        $postDecimalMasks = [];

        do {
            $tempMask = array_pop($masks);
            $postDecimalMasks[] = $tempMask;
            $decimalCount -= strlen($tempMask);
        } while ($decimalCount > 0);

        return [
            implode('.', $masks),
            implode('.', array_reverse($postDecimalMasks)),
        ];
    }

    private static function processComplexNumberFormatMask($number, $mask)
    {
        $result = $number;
        $maskingBlockCount = preg_match_all('/0+/', $mask, $maskingBlocks, PREG_OFFSET_CAPTURE);

        if ($maskingBlockCount > 1) {
            $maskingBlocks = array_reverse($maskingBlocks[0]);

            foreach ($maskingBlocks as $block) {
                $divisor = 1 . $block[0];
                $size = strlen($block[0]);
                $offset = $block[1];

                $blockValue = sprintf(
                    '%0' . $size . 'd',
                    fmod($number, $divisor)
                );
                $number = floor($number / $divisor);
                $mask = substr_replace($mask, $blockValue, $offset, $size);
            }
            if ($number > 0) {
                $mask = substr_replace($mask, $number, $offset, 0);
            }
            $result = $mask;
        }

        return $result;
    }

    private static function complexNumberFormatMask($number, $mask, $splitOnPoint = true)
    {
        $sign = ($number < 0.0);
        $number = abs($number);

        if ($splitOnPoint && strpos($mask, '.') !== false && strpos($number, '.') !== false) {
            $numbers = explode('.', $number);
            $masks = explode('.', $mask);
            if (count($masks) > 2) {
                $masks = self::mergeComplexNumberFormatMasks($numbers, $masks);
            }
            $result1 = self::complexNumberFormatMask($numbers[0], $masks[0], false);
            $result2 = strrev(self::complexNumberFormatMask(strrev($numbers[1]), strrev($masks[1]), false));

            return (($sign) ? '-' : '') . $result1 . '.' . $result2;
        }

        $result = self::processComplexNumberFormatMask($number, $mask);

        return (($sign) ? '-' : '') . $result;
    }

    private static function formatStraightNumericValue($value, $format, array $matches, $useThousands, $number_regex)
    {
        $left = $matches[1];
        $dec = $matches[2];
        $right = $matches[3];

        // minimun width of formatted number (including dot)
        $minWidth = strlen($left) + strlen($dec) + strlen($right);
        if ($useThousands) {
            $value = number_format(
                $value,
                strlen($right),
                StringHelper::getDecimalSeparator(),
                StringHelper::getThousandsSeparator()
            );
            $value = preg_replace($number_regex, $value, $format);
        } else {
            if (preg_match('/[0#]E[+-]0/i', $format)) {
                //    Scientific format
                $value = sprintf('%5.2E', $value);
            } elseif (preg_match('/0([^\d\.]+)0/', $format) || substr_count($format, '.') > 1) {
                if ($value == (int) $value && substr_count($format, '.') === 1) {
                    $value *= 10 ** strlen(explode('.', $format)[1]);
                }
                $value = self::complexNumberFormatMask($value, $format);
            } else {
                $sprintf_pattern = "%0$minWidth." . strlen($right) . 'f';
                $value = sprintf($sprintf_pattern, $value);
                $value = preg_replace($number_regex, $value, $format);
            }
        }

        return $value;
    }

    private static function formatAsNumber($value, $format)
    {
        // The "_" in this string has already been stripped out,
        // so this test is never true. Furthermore, testing
        // on Excel shows this format uses Euro symbol, not "EUR".
        //if ($format === self::FORMAT_CURRENCY_EUR_SIMPLE) {
        //    return 'EUR ' . sprintf('%1.2f', $value);
        //}

        // Some non-number strings are quoted, so we'll get rid of the quotes, likewise any positional * symbols
        $format = str_replace(['"', '*'], '', $format);

        // Find out if we need thousands separator
        // This is indicated by a comma enclosed by a digit placeholder:
        //        #,#   or   0,0
        $useThousands = preg_match('/(#,#|0,0)/', $format);
        if ($useThousands) {
            $format = preg_replace('/0,0/', '00', $format);
            $format = preg_replace('/#,#/', '##', $format);
        }

        // Scale thousands, millions,...
        // This is indicated by a number of commas after a digit placeholder:
        //        #,   or    0.0,,
        $scale = 1; // same as no scale
        $matches = [];
        if (preg_match('/(#|0)(,+)/', $format, $matches)) {
            $scale = 1000 ** strlen($matches[2]);

            // strip the commas
            $format = preg_replace('/0,+/', '0', $format);
            $format = preg_replace('/#,+/', '#', $format);
        }

        if (preg_match('/#?.*\?\/\?/', $format, $m)) {
            if ($value != (int) $value) {
                self::formatAsFraction($value, $format);
            }
        } else {
            // Handle the number itself

            // scale number
            $value = $value / $scale;
            // Strip #
            $format = preg_replace('/\\#/', '0', $format);
            // Remove locale code [$-###]
            $format = preg_replace('/\[\$\-.*\]/', '', $format);

            $n = '/\\[[^\\]]+\\]/';
            $m = preg_replace($n, '', $format);
            $number_regex = '/(0+)(\\.?)(0*)/';
            if (preg_match($number_regex, $m, $matches)) {
                $value = self::formatStraightNumericValue($value, $format, $matches, $useThousands, $number_regex);
            }
        }

        if (preg_match('/\[\$(.*)\]/u', $format, $m)) {
            //  Currency or Accounting
            $currencyCode = $m[1];
            [$currencyCode] = explode('-', $currencyCode);
            if ($currencyCode == '') {
                $currencyCode = StringHelper::getCurrencyCode();
            }
            $value = preg_replace('/\[\$([^\]]*)\]/u', $currencyCode, $value);
        }

        return $value;
    }

    private static function splitFormatCompare($value, $cond, $val, $dfcond, $dfval)
    {
        if (!$cond) {
            $cond = $dfcond;
            $val = $dfval;
        }
        switch ($cond) {
            case '>':
                return $value > $val;

            case '<':
                return $value < $val;

            case '<=':
                return $value <= $val;

            case '<>':
                return $value != $val;

            case '=':
                return $value == $val;
        }

        return $value >= $val;
    }

    private static function splitFormat($sections, $value)
    {
        // Extract the relevant section depending on whether number is positive, negative, or zero?
        // Text not supported yet.
        // Here is how the sections apply to various values in Excel:
        //   1 section:   [POSITIVE/NEGATIVE/ZERO/TEXT]
        //   2 sections:  [POSITIVE/ZERO/TEXT] [NEGATIVE]
        //   3 sections:  [POSITIVE/TEXT] [NEGATIVE] [ZERO]
        //   4 sections:  [POSITIVE] [NEGATIVE] [ZERO] [TEXT]
        $cnt = count($sections);
        $color_regex = '/\\[(' . implode('|', Color::NAMED_COLORS) . ')\\]/';
        $cond_regex = '/\\[(>|>=|<|<=|=|<>)([+-]?\\d+([.]\\d+)?)\\]/';
        $colors = ['', '', '', '', ''];
        $condops = ['', '', '', '', ''];
        $condvals = [0, 0, 0, 0, 0];
        for ($idx = 0; $idx < $cnt; ++$idx) {
            if (preg_match($color_regex, $sections[$idx], $matches)) {
                $colors[$idx] = $matches[0];
                $sections[$idx] = preg_replace($color_regex, '', $sections[$idx]);
            }
            if (preg_match($cond_regex, $sections[$idx], $matches)) {
                $condops[$idx] = $matches[1];
                $condvals[$idx] = $matches[2];
                $sections[$idx] = preg_replace($cond_regex, '', $sections[$idx]);
            }
        }
        $color = $colors[0];
        $format = $sections[0];
        $absval = $value;
        switch ($cnt) {
            case 2:
                $absval = abs($value);
                if (!self::splitFormatCompare($value, $condops[0], $condvals[0], '>=', 0)) {
                    $color = $colors[1];
                    $format = $sections[1];
                }

                break;
            case 3:
            case 4:
                $absval = abs($value);
                if (!self::splitFormatCompare($value, $condops[0], $condvals[0], '>', 0)) {
                    if (self::splitFormatCompare($value, $condops[1], $condvals[1], '<', 0)) {
                        $color = $colors[1];
                        $format = $sections[1];
                    } else {
                        $color = $colors[2];
                        $format = $sections[2];
                    }
                }

                break;
        }

        return [$color, $format, $absval];
    }

    /**
     * Convert a value in a pre-defined format to a PHP string.
     *
     * @param mixed $value Value to format
     * @param string $format Format code, see = self::FORMAT_*
     * @param array $callBack Callback function for additional formatting of string
     *
     * @return string Formatted string
     */
    public static function toFormattedString($value, $format, $callBack = null)
    {
        // For now we do not treat strings although section 4 of a format code affects strings
        if (!is_numeric($value)) {
            return $value;
        }

        // For 'General' format code, we just pass the value although this is not entirely the way Excel does it,
        // it seems to round numbers to a total of 10 digits.
        if (($format === self::FORMAT_GENERAL) || ($format === self::FORMAT_TEXT)) {
            return $value;
        }

        // Convert any other escaped characters to quoted strings, e.g. (\T to "T")
        $format = preg_replace('/(\\\(((.)(?!((AM\/PM)|(A\/P))))|([^ ])))(?=(?:[^"]|"[^"]*")*$)/u', '"${2}"', $format);

        // Get the sections, there can be up to four sections, separated with a semi-colon (but only if not a quoted literal)
        $sections = preg_split('/(;)(?=(?:[^"]|"[^"]*")*$)/u', $format);

        [$colors, $format, $value] = self::splitFormat($sections, $value);

        // In Excel formats, "_" is used to add spacing,
        //    The following character indicates the size of the spacing, which we can't do in HTML, so we just use a standard space
        $format = preg_replace('/_./', ' ', $format);

        // Let's begin inspecting the format and converting the value to a formatted string

        //  Check for date/time characters (not inside quotes)
        if (preg_match('/(\[\$[A-Z]*-[0-9A-F]*\])*[hmsdy](?=(?:[^"]|"[^"]*")*$)/miu', $format, $matches)) {
            // datetime format
            self::formatAsDate($value, $format);
        } else {
            if (substr($format, 0, 1) === '"' && substr($format, -1, 1) === '"') {
                $value = substr($format, 1, -1);
            } elseif (preg_match('/%$/', $format)) {
                // % number format
                self::formatAsPercentage($value, $format);
            } else {
                $value = self::formatAsNumber($value, $format);
            }
        }

        // Additional formatting provided by callback function
        if ($callBack !== null) {
            [$writerInstance, $function] = $callBack;
            $value = $writerInstance->$function($value, $colors);
        }

        return $value;
    }
}
