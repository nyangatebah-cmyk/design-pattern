<?php
// Abstraction
abstract class Shape {
    protected $color;

    // Injecting the implementation (Bridge)
    public function __construct(ColorInterface $color) {
        $this->color = $color;
    }

    abstract public function draw();
}

// Refined Abstractions
class Circle extends Shape {
    private $radius;

    public function __construct($radius, ColorInterface $color) {
        parent::__construct($color);
        $this->radius = $radius;
    }

    public function draw() {
        echo "Drawing Circle of radius {$this->radius} in " . $this->color->applyColor() . "
";
    }
}

class Square extends Shape {
    private $side;

    public function __construct($side, ColorInterface $color) {
        parent::__construct($color);
        $this->side = $side;
    }

    public function draw() {
        echo "Drawing Square of side {$this->side} in " . $this->color->applyColor() . "
";
    }
}

// Implementor interface for the bridge
interface ColorInterface {
    public function applyColor(): string;
}

// Concrete Implementors
class RedColor implements ColorInterface {
    public function applyColor(): string {
        return "red color";
    }
}

class BlueColor implements ColorInterface {
    public function applyColor(): string {
        return "blue color";
    }
}

// Usage example
$red = new RedColor();
$blue = new BlueColor();

$circleRed = new Circle(5, $red);
$circleRed->draw(); // Drawing Circle of radius 5 in red color

$squareBlue = new Square(10, $blue);
$squareBlue->draw(); // Drawing Square of side 10 in blue color

$circleBlue = new Circle(8, $blue);
$circleBlue->draw(); // Drawing Circle of radius 8 in blue color
?>