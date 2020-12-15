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
namespace modethirteen\TypeEx\Tests\StringEx;

use modethirteen\TypeEx\StringEx;
use PHPUnit\Framework\TestCase;

class stringify_Test extends TestCase {

    /**
     * @return array
     */
    public static function value_expected_Provider() : array {
        return [
            [null, ''],
            ['foo', 'foo'],
            [true, 'true'],
            [false, 'false'],
            [['foo', 'bar'], 'foo,bar'],
            [['foo', 'plugh', 'bar' => ['baz']], 'foo,plugh,baz'],
            [function() { return 'foo'; }, 'foo'],
            [function() { return 123; }, '123'],
            [function() { return ['foo', 'bar']; }, 'foo,bar'],
            [function() { return ['foo', 'plugh', 'bar' => ['baz']]; }, 'foo,plugh,baz'],
            [function() { return new class { function __toString() : string { return 'xyzzy'; }}; }, 'xyzzy'],
            [123, '123'],
            [new class { function __toString() : string { return 'qux'; }}, 'qux']
        ];
    }

    /**
     * @dataProvider value_expected_Provider
     * @test
     * @param mixed $value
     * @param string $expected
     */
    public function Can_stringify($value, string $expected) : void {

        // act
        $result = StringEx::stringify($value);

        // assert
        static::assertEquals($expected, $result);
    }
}
