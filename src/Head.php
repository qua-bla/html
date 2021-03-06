<?php

namespace hemio\html;

/**
 * The <code>head</code> element collects the document’s metadata.
 *
 * @since version 1.0
 * @url http://www.w3.org/TR/html5/document-metadata.html#the-head-element
 */
class Head extends Abstract_\ElementContent
{

    use Trait_\DefaultElementContent;

    public static function tagName()
    {
        return 'head';
    }

    function __construct(Interface_\ContentModelText $objTitleContent)
    {
        $this['_TITLE']   = new Title;
        $this['_TITLE'][] = $objTitleContent;
        $this['_BASE']    = new Nothing();
        $objCharset       = ($this['_CHARSET'] = new Meta);
        $objCharset->setAttribute('charset', 'utf-8');
    }

    /**
     *
     * @param string $strName
     * @param string $strContent
     * @return \hemio\html\Meta
     */
    function addMeta($strName, $strContent)
    {
        $objMeta = new Meta();
        $this->addChild($objMeta);

        $objMeta->setAttribute('name', $strName);
        $objMeta->setAttribute('content', $strContent);
        return $objMeta;
    }

    /**
     *
     * @param string $strFilename
     */
    function addCssFile($strFilename)
    {
        $link = new Link();
        $link->setAttribute('rel', 'stylesheet');
        $link->setAttribute('type', 'text/css');
        $link->setAttribute('href', $strFilename);

        $this['_CSS_'.$strFilename] = $link;
    }

    /**
     *
     * @param string $url
     */
    function addJsFile($url)
    {
        $script = new Script();
        $script->setAttribute('type', 'text/javascript');
        $script->setAttribute('src', $url);

        $this['_JS_'.$url] = $script;
    }

    /**
     *
     * @param type $url
     * @todo URL
     */
    public function setBaseUrl($url)
    {
        $base          = new Base();
        $base->setAttribute('href', $url);
        $this['_BASE'] = $base;
    }

    public function blnIsBlock()
    {
        return true;
    }

    public function isValidChild(Interface_\HtmlCode $child)
    {
        return $child instanceof Interface_\ContentModelMetadata;
    }

    public function addChild(Interface_\ContentModelMetadata $child)
    {
        return $this->addChildInternal($child);
    }
}
