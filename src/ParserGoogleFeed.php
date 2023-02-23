<?php namespace silici0\GoogleParserFeed;

use SimpleXMLElement;
use JsonSerializable;

class ParserGoogleFeed extends SimpleXMLElement implements JsonSerializable 
{
    public function jsonSerialize(): ?array
    {
        $array = array();

        // json encode attributes if any.
        if ($attributes = $this->attributes()) {
            $array['@attributes'] = iterator_to_array($attributes);
        }

        $namespaces = [null] + $this->getDocNamespaces(true);
        // json encode child elements if any. group on duplicate names as an array.
        foreach ($namespaces as $namespace) {
            foreach ($this->children($namespace) as $name => $element) {
                if (isset($array[$name])) {
                    if (!is_array($array[$name])) {
                        $array[$name] = [$array[$name]];
                    }
                    $array[$name][] = $element;
                } else {
                    $array[$name] = $element;
                }
            }
        }

        // json encode non-whitespace element simplexml text values.
        $text = trim($this);
        if (strlen($text)) {
            if ($array) {
                $array['@text'] = $text;
            } else {
                $array = $text;
            }
        }

        // return empty elements as NULL (self-closing or empty tags)
        if (!$array) {
            $array = NULL;
        }

        return $array;
    }

    public function toArray() {
        return (array) json_decode(json_encode($this));
    }
}
