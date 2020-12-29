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

use modethirteen\TypeEx\Exception\StringExCannotDecodeBase64StringException;
use modethirteen\TypeEx\StringEx;
use PHPUnit\Framework\TestCase;

class decodeBase64_Test extends TestCase  {

    /**
     * @test
     * @throws StringExCannotDecodeBase64StringException
     */
    public function Can_decode() : void {

        // act
        $result = (new StringEx('Zm9vIGJhciBiYXogcXV4'))->decodeBase64();

        // assert
        static::assertEquals('foo bar baz qux', $result->toString());
    }

    /**
     * @test
     * @throws StringExCannotDecodeBase64StringException
     */
    public function Can_decode_strict() : void {

        // act
        $result = (new StringEx('Zm9vIGJhciBiYXogcXV4'))->decodeBase64(true);

        // assert
        static::assertEquals('foo bar baz qux', $result->toString());
    }

    /**
     * @test
     * @throws StringExCannotDecodeBase64StringException
     */
    public function Can_decode_weak() : void {

        // act
        $result = (new StringEx('🐇'))->decodeBase64();

        // assert
        static::assertEquals('', $result->toString());
    }

    /**
     * @test
     * @throws StringExCannotDecodeBase64StringException
     */
    public function Cannot_decode_strict_with_special_characters() : void {

        // assert
        static::expectException(StringExCannotDecodeBase64StringException::class);

        // act
        (new StringEx('🐇'))->decodeBase64(true);
    }
}
