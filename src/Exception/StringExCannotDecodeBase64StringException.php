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

namespace modethirteen\TypeEx\Exception;

use Exception;

class StringExCannotDecodeBase64StringException extends Exception {

    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     */
    public function __construct(string $string) {
        $this->string = $string;
        parent::__construct('Cannot decode base64 encoded string');
    }

    public function getString() : string {
        return $this->string;
    }
}
