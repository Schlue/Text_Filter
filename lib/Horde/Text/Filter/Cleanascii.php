<?php
/**
 * Removes some common entities and high-ascii or otherwise nonstandard
 * characters common in text pasted from Microsoft Word into a browser.
 *
 * This function should NOT be used on non-ASCII text; it may and probably
 * will butcher other character sets indescriminately.  Use it only to clean
 * US-ASCII (7-bit) text which you suspect (or know) may have invalid or
 * non-printing characters in it.
 *
 * Copyright 2004-2009 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Jan Schneider <jan@horde.org>
 * @package Horde_Text
 */
class Horde_Text_Filter_Cleanascii extends Horde_Text_Filter
{
    /**
     * Executes any code necessary before applying the filter patterns.
     *
     * @param string $text  The text before the filtering.
     *
     * @return string  The modified text.
     */
    public function preProcess($text)
    {
        if (preg_match('/|([^#]*)#.*/', $text, $regs)) {
            $text = $regs[1];

            if (!empty($text)) {
                $text = $text . "\n";
            }
        }

        return $text;
    }

    /**
     * Returns a hash with replace patterns.
     *
     * @return array  Patterns hash.
     */
    public function getPatterns()
    {
        /* Remove control characters. */
        $regexp = array('/[\x00-\x1f]+/' => '');

        /* The '�' entry may look wrong, depending on your editor,
         * but it's not - that's not really a single quote. */
        $replace = array(
            chr(150) => '-',
            chr(167) => '*',
            '��' => '*',
            '�' => '...',
            '�' => "'",
            '�' => "'",
            '�' => '"',
            '�' => '"',
            '�' => '*',
            '�' => '-',
            '�' => '-',
            '�' => '*',
            '&#61479;' => '.',
            '&#61572;' => '*',
            '&#61594;' => '*',
            '&#61640;' => '-',
            '&#61623;' => '-',
            '&#61607;' => '*',
            '&#61553;' => '*',
            '&#61558;' => '*',
            '&#8226;' => '*',
            '&#9658;' => '>',
        );

        return array('regexp' => $regexp, 'replace' => $replace);
    }

}
