<?php declare(strict_types=1);
/**
 * modethirteen.php
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
namespace modethirteen\Tests\StringUtil;

use modethirteen\StringEx;
use PHPUnit\Framework\TestCase;

class endsWith_Test extends TestCase  {

    /**
     * @test
     */
    public function String_ends_with() : void {

        // act
        $result = StringEx::endsWith('foobar', 'ar');

        // assert
        static::assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function String_does_not_end_with() : void {

        // act
        $result = StringEx::endsWith('foobar', 'gak');

        // assert
        static::assertEquals(false, $result);
    }
}
