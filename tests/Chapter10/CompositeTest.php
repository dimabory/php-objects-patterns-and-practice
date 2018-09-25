<?php
declare(strict_types=1);

namespace Tests\Chapter10;

use Acme\Chapter10\Composite\{
    Argument,
    Attribute,
    ClassComposite,
    Constant,
    Extending,
    Implementing,
    Keywords\Modifier,
    Keywords\Typehinting,
    Keywords\Visibility,
    Method,
    Types\AbstractType};
use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{
    public function testEmptyClass()
    {
        $this->assertClassBuilding(new ClassComposite('EmptyClass'));
    }

    public function testEmptyClassWithNamespace()
    {
        $this->assertClassBuilding(new ClassComposite('EmptyClassWithNamespace', 'Hello\World'));
    }

    public function testFinalClass()
    {
        $this->assertClassBuilding(new ClassComposite('FinalClass', null, Modifier::final()));
    }

    public function testAbstractClass()
    {
        $this->assertClassBuilding(new ClassComposite('AbstractClass', null, Modifier::abstract()));
    }

    public function testClassCanExtend()
    {
        $this->assertClassBuilding(new ClassComposite('ClassExtendsStd', null, null, new Extending(\stdClass::class)));
    }

    public function testClassCanImplement()
    {
        $this->assertClassBuilding(
            new ClassComposite('ClassImplementsIterator', null, null, null, new Implementing(\Iterator::class))
        );
    }

    public function testClassWithConstant()
    {
        $class = new ClassComposite('ClassWithConstant');
        $class->addElement(new Constant('a', Visibility::public(), AbstractType::integer(1)));
        $class->addElement(new Constant('b', Visibility::protected(), AbstractType::str('1')));
        $class->addElement(
            new Constant(
                'c',
                Visibility::private(),
                AbstractType::collection(AbstractType::integer(1), AbstractType::str('2'), AbstractType::decimal(2.01))
            )
        );

        $this->assertClassBuilding($class);
    }

    public function testClassWithAttribute()
    {
        $class = new ClassComposite('ClassWithAttribute');
        $class->addElement(new Attribute('foo', Visibility::public()));
        $class->addElement(new Attribute('bar', Visibility::protected(), false, AbstractType::integer(1)));
        $class->addElement(new Attribute('baz', Visibility::private(), true, AbstractType::str('string')));

        $this->assertClassBuilding($class);
    }

    public function testClassWithMethod()
    {
        $class = new ClassComposite('ClassWithMethod', 'A\B\C\D', Modifier::abstract());
        $class->addElement(new Method('foo'));
        $class->addElement(new Method('staticFoo', Visibility::public(), true));
        $class->addElement(new Method('bar', Visibility::protected(), false, null, [new Argument('a')]));
        $class->addElement(
            new Method(
                'baz', Visibility::private(), false, null, [
                new Argument('a', Typehinting::float()),
                new Argument('b', Typehinting::int()),
                new Argument('c', Typehinting::string()),
                new Argument('d', Typehinting::bool()),
                new Argument('e', Typehinting::array()),
            ], Typehinting::int()
            )
        );
        $class->addElement(
            new Method(
                'iterate', Visibility::public(), false, null, [new Argument('iterator', Typehinting::iterable())]
            )
        );
        $class->addElement(
            new Method(
                'call',
                Visibility::public(),
                false,
                null,
                [new Argument('cb', Typehinting::callable())],
                Typehinting::string()
            )
        );
        $class->addElement(
            new Method(
                'asBool',
                Visibility::public(),
                false,
                null,
                [new Argument('flag', Typehinting::int(), AbstractType::integer(1))],
                Typehinting::bool()
            )
        );
        $class->addElement(
            new Method(
                'finalMethod',
                Visibility::protected(),
                false,
                Modifier::final(),
                [new Argument('obj', Typehinting::object())],
                Typehinting::withClass('stdClass')
            )
        );
        $class->addElement(
            new Method(
                'abstractMethod',
                Visibility::public(),
                false,
                Modifier::abstract(),
                [new Argument('composite', Typehinting::withClass(ClassComposite::class))]
            )
        );

        $this->assertClassBuilding($class);
    }

    private function getFixtureFor(string $name): ?string
    {
        $path    = sprintf('%s%s.php.sample', dirname(__FILE__).'/fixtures/', $name);
        $content = file_get_contents($path);

        if (!$content) {
            self::fail("Content not found for {$path}");
        }

        return $content ?: null;
    }

    private function assertClassBuilding(ClassComposite $classComposite): void
    {
        self::assertSame($this->getFixtureFor($classComposite->name()), $classComposite->build());
    }
}
