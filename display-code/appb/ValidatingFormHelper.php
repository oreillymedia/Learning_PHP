// This code goes just after the "class FormHelper" declaration
    // This array expresses, for the specified elements,
    // what attribute names have what allowed values.
    protected $allowedAttributes = ['button' => ['type' => ['submit',
                                                            'reset',
                                                            'button' ] ] ];


    // tag() is modified to pass $tag as the first argument to
    // $this->attributes()
    public function tag($tag, $attributes = array(), $isMultiple = false) {
        return "<$tag {$this->attributes($tag, $attributes, $isMultiple)} />";
    }

    // start() is also modified to pass $tag as the first argument to
    // $this->attributes();
    public function start($tag, $attributes = array(), $isMultiple = false) {
        // <select> and <textarea> tags don't get value attributes on them
        $valueAttribute = (! (($tag == 'select')||($tag == 'textarea')));
        $attrs = $this->attributes($tag, $attributes, $isMultiple,
                                   $valueAttribute);
        return "<$tag $attrs>";
    }


    // attributes() is modified to accept $tag as a first argument,
    // set up $attributeCheck if allowed attributes for the tag have
    // been defined in $this->allowedAttributes, and then, if allowed
    // attributes have been defined, see if the provided value is
    // allowed and throw an exception if not.
    protected function attributes($tag, $attributes, $isMultiple,
                                  $valueAttribute = true) {
        $tmp = array();
        // If this tag could include a value attribute and it
        // has a name and there's an entry for the name
        // in the values array, then set a value attribute
        if ($valueAttribute && isset($attributes['name']) &&
            array_key_exists($attributes['name'], $this->values)) {
            $attributes['value'] = $this->values[$attributes['name']];
        }
        if (isset($this->allowedAttributes[$tag])) {
            $attributeCheck = $this->allowedAttributes[$tag];
        } else {
            $attributeCheck = array();
        }
        foreach ($attributes as $k => $v) {
            // Check if the attribute's value is allowed
            if (isset($attributeCheck[$k]) &&
                (! in_array($v, $attributeCheck[$k]))) {
                throw new InvalidArgumentException("$v is not allowed as value for $k");
            }
            // True boolean value means boolean attribute
            if (is_bool($v)) {
                if ($v) { $tmp[] = $this->encode($k); }
            }
            // Otherwise k=v
            else {
                $value = $this->encode($v);
                // If this is an element that might have multiple values,
                // tack [] onto its name
                if ($isMultiple && ($k == 'name')) {
                    $value .= '[]';
                }
                $tmp[] = "$k=\"$value\"";
            }
        }
        return implode(' ', $tmp);
    }