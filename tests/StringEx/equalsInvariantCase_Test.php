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

class equalsInvariantCase_Test extends TestCase  {

    /**
     * @test
     */
    public function String_equals() : void {

        // act
        $result = (new StringEx('foobar'))->equalsInvariantCase('foobar');

        // assert
        static::assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function String_equals_invariant_case() : void {

        // act
        $result = (new StringEx('foobar'))->equalsInvariantCase('fooBAR');

        // assert
        static::assertEquals(true, $result);
    }

    /**
     * @test
     */
    public function String_does_not_equal() : void {

        // act
        $result = (new StringEx('foobar'))->equals('gak');

        // assert
        static::assertEquals(false, $result);
    }
}
