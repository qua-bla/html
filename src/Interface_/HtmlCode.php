<?php

namespace hemio\html\Interface_;

/**
 * Represents everything that can be converted to a string and might be given
 *  to the client as HTML code. This implies that implementations do everything
 *  required for input sanitization.
 */
interface HtmlCode
{

    /**
     * Should only return strings that can be part of a valid HTML code
     *
     * @return string HTML code
     */
    public function __toString();

    /**
     * @return string
     */
    public function describe();

    /**
     *
     * @param \hemio\html\Interface_\callable $hook
     * @param string $idx
     */
    public function addHookToString(callable $hook, $idx = null);
}
