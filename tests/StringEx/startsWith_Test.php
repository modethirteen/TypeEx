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
namespace modethirteen\Tests\StringEx;

use modethirteen\StringEx;
use PHPUnit\Framework\TestCase;

class startsWith_Test extends TestCase  {

    /**
     * @test
     */
    public function String_starts_with() : void {

        // act
        $result = StringEx::startsWith('foobar', 'foo');

        // assert
        static::assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function String_does_start_with() : void {

        // act
        $result = StringEx::startsWith('foobar', 'gak');

        // assert
        static::assertEquals(false, $result);
    }

    /**
     * @test
     */
    public function Case_is_strict_when_checking_starts_with() : void {

        // act
        $result = StringEx::startsWith('foobar', 'FOO');

        // assert
        static::assertEquals(false, $result);
    }
}
