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
namespace modethirteen\TypeEx\Tests\StringEx;

use modethirteen\TypeEx\StringEx;
use PHPUnit\Framework\TestCase;

class startsWith_Test extends TestCase  {

    /**
     * @test
     */
    public function String_starts_with() : void {

        // act
        $result = (new StringEx('foobar'))->startsWith('foo');

        // assert
        static::assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function String_does_not_start_with() : void {

        // act
        $result = (new StringEx('foobar'))->startsWith('gak');

        // assert
        static::assertEquals(false, $result);
    }

    /**
     * @test
     */
    public function String_does_not_start_with_case() : void {

        // act
        $result = (new StringEx('foobar'))->startsWith('FOO');

        // assert
        static::assertEquals(false, $result);
    }
}
