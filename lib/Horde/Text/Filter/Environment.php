<?php
/**
 * Replaces occurences of %VAR% with VAR, if VAR exists in the webserver's
 * environment.  Ignores all text after a '#' character (shell-style
 * comments).
 *
 * Copyright 2004-2010 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/lgpl.html.
 *
 * @author  Jan Schneider <jan@horde.org>
 * @package Horde_Text
 */
class Horde_Text_Filter_Environment extends Horde_Text_Filter
{
    /**
     * Returns a hash with replace patterns.
     *
     * @return array  Patterns hash.
     */
    public function getPatterns()
    {
        $regexp = array('/^#.*$\n/m' => '',
                        '/^([^#]*)#.*$/m' => '$1',
                        '/%([A-Za-z_]+)%/e' => 'getenv("$1")');
        return array('regexp' => $regexp);
    }

}
