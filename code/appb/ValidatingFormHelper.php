<?php
// RUNNER STUB START
class FormHelper {
// RUNNER STUB END

    // This code goes just after the "class FormHelper" declaration
    // This array expresses, for the specified elements,
    // what attribute names have what allowed values.
    protected $allowedAttributes = ['button' => ['type' => ['submit',
                                                            'reset',
                                                            'button' ] ] ];
// RUNNER STUB START
    protected $values = array();

    public function __construct($values = array()) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->values = $_POST;
        } else {
            $this->values = $values;
        }
    }

    public function input($type, $attributes = array(), $isMultiple = false) {
        $attributes['type'] = $type;
        if (($type == 'radio') || ($type == 'checkbox')) {
            if ($this->isOptionSelected($attributes['name'] ?? null,
                                        $attributes['value'] ?? null)) {
                $attributes['checked'] = true;
            }
        }
        return $this->tag('input', $attributes, $isMultiple);
    }

    public function select($options, $attributes = array()) {
        $multiple = $attributes['multiple'] ?? false;
        return
            $this->start('select', $attributes, $multiple) .
            $this->options($attributes['name'] ?? null, $options) .
            $this->end('select');
    }

    public function textarea($attributes = array()) {
        $name = $attributes['name'] ?? null;
        $value = $this->values[$name] ?? '';
        return $this->start('textarea', $attributes) .
               htmlentities($value) .
               $this->end('textarea');
    }

// RUNNER STUB END

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
// RUNNER STUB START
    public function end($tag) {
        return "</$tag>";
    }

// RUNNER STUB END

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
// RUNNER STUB START
    protected function options($name, $options) {
        $tmp = array();
        foreach ($options as $k => $v) {
            $s = "<option  value=\"{$this->encode($k)}\"";
            if ($this->isOptionSelected($name, $k)) {
                $s .= ' selected';
            }
            $s .= ">{$this->encode($v)}</option>";
            $tmp[] = $s;
        }
        return implode('', $tmp);
    }

    protected function isOptionSelected($name, $value) {
        // If there's no entry for $name in the values array,
        // then this option can't be selected
        if (! isset($this->values[$name])) {
            return false;
        }
        // If the entry for $name in the values array is itself
        // an array, check if $value is in that array
        else if (is_array($this->values[$name])) {
            return in_array($value, $this->values[$name]);
        }
        // Otherwise, compare $value to the entry to for $name
        // in the values array
        else {
            return $value == $this->values[$name];
        }
    }

    public function encode($s) {
        return htmlentities($s);
    }
}
// RUNNER STUB END