<?php declare(strict_types=1);
/**
 * TypeEx
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
namespace modethirteen\TypeEx;

use Closure;

class StringEx {

    /**
     * @param string|null $string
     * @return bool
     */
    public static function isNullOrEmpty(?string $string) : bool {
        return $string === null || $string === '';
    }

    /**
     * Convert any value to string
     *
     * @param mixed $value
     * @return string
     */
    public static function stringify($value) : string {
        if($value === null) {
            return '';
        }
        if(is_string($value)) {
            return $value;
        }
        if(is_bool($value)) {
            return $value ? 'true' : 'false';
        }
        if(is_array($value)) {
            return implode(',', array_map(function($v) : string {
                return self::stringify($v);
            }, $value));
        }
        if($value instanceof Closure) {
            return self::stringify($value());
        }
        return strval($value);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    private static function endsWithHelper(string $haystack, string $needle) : bool {
        $length = strlen($needle);
        $start = $length * -1;
        return (substr($haystack, $start) === $needle);
    }

    /**
     * @param string $haystack
     * @param string $needle
     * @return bool
     */
    private static function startsWithHelper(string $haystack, string $needle) : bool {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }

    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     */
    final public function __construct(string $string) {
        $this->string = $string;
    }

    /**
     * @return string
     */
    public function __toString() : string {
        return $this->toString();
    }

    /**
     * @note when comparing a string array, returns true if one or more values match
     * @param string|string[] $needle
     * @return bool
     */
    public function contains($needle) : bool {
        if(is_array($needle)) {
            foreach($needle as $n) {
                $pos = strpos($this->string, self::stringify($n));
                if($pos !== false) {
                    return true;
                }
            }
            return false;
        }
        return strpos($this->string, self::stringify($needle)) !== false;
    }

    /**
     * @param int $max
     * @return static
     */
    public function ellipsis(int $max = 100) : object {
        $string = $this->string;
        if(strlen($string) <= $max) {
            return new static($string);
        }
        $result = substr($string, 0, $max);
        $string = (strpos($string, ' ') === false)
            ? $result . '…'
            : preg_replace('/\w+$/', '', $result) . '…';
        return new static($string);
    }

    /**
     * @param string $needle
     * @return bool
     */
    public function endsWith(string $needle) : bool {
        return self::endsWithHelper($this->string, $needle);
    }

     /**
     * @param string $needle
     * @return bool
     */
    public function endsWithInvariantCase(string $needle) : bool {
        return self::endsWithHelper(strtolower($this->string), strtolower($needle));
    }

    /**
     * @param string $prefix
     * @return static
     */
    public function removePrefix(string $prefix) : object {
        $string = $this->string;
        return new static(
            (substr($string, 0, strlen($prefix)) === $prefix)
                ? substr($string, strlen($prefix), strlen($string))
                : $string
        );
    }

    /**
     * Replace variables surrounded with {{ }}
     *
     * @param IStringDictionary $replacements - collection of variables to their string values - ex: ['variable' => 'value']
     * @return static
     */
    public function template(IStringDictionary $replacements) : object {
        $string = $this->string;
        $keys = $replacements->getKeys();
        if(empty($keys)) {
            return new static($string);
        }
        $search = array_map(function(string $var) : string {
            return '{{' . trim($var) . '}}';
        }, $keys);
        return new static(str_replace($search, array_values($replacements->toArray()), $string));
    }

    /**
     * @return static
     */
    public function trim() : object {
        return new static(trim($this->string));
    }

    /**
     * @return string
     */
    public function toString() : string {
        return $this->string;
    }

    /**
     * @param string $needle
     * @return bool
     */
    public function startsWith(string $needle) : bool {
        return self::startsWithHelper($this->string, $needle);
    }

    /**
     * @param string $needle
     * @return bool
     */
    public function startsWithInvariantCase(string $needle) : bool {
        return self::startsWithHelper(strtolower($this->string), strtolower($needle));
    }
}
