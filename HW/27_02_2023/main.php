<?php





abstract class Animal {

    abstract public function walk();

    public function say()
    {
        return $this->voice;
    }
}

abstract class Ungulates extends Animal {
    protected $stepVoice = "Топ-топ-топ";

}
abstract class Birds extends Animal {
    protected $stepVoice = "Вжих-вжих-топ-топ";
    abstract function tryToFly();

    // todo Перегружаем чтобы не требовало в функциях где он не нужен
    public function walk() {
        return;
    }
}

class Cow extends Ungulates {
    protected $voice = "Мууу";
    function __construct() {
        echo $this->walk();
    }

    public function walk()
    {
        return "Топ топ топ";
    }
}

class Pig extends Ungulates {
    protected $voice = "Хрююю";
    function __construct() {
        echo $this->walk();
    }
    public function walk()
    {
        return "Топ топ топ";
    }
}

class Chicken extends Birds {
    protected $voice = "КоКоКо";
    function __construct() {
        echo $this->tryToFly();
    }

    public function tryToFly() {
        return $this->stepVoice;
    }
}

class Goose extends Birds {
    protected $voice = "ГаГаГа";
    function __construct() {
        echo $this->tryToFly();
    }

    public function tryToFly() {
        return $this->stepVoice;
    }
}

class Turkey extends Birds {
    protected $voice = "ГулГулГул";
    function __construct() {
        echo $this->tryToFly();
    }

    public function tryToFly() {
        return $this->stepVoice;
    }
}

class Horse extends Ungulates {
    protected $voice = "Игого";
    function __construct() {
        echo $this->walk();
    }
    public function walk()
    {
        return "Топ топ топ";
    }
}


class Farm {
    public $animals;

    public function addAnimal(Animal $animal) {
        $this->animals[] = $animal;
    }

    public function rollCall() {
        echo "<b>Перекличка:</b><br>";
        foreach ($this->animals as $animal) {
            echo $animal->say();
            echo "<br>";
        }
        echo "<b>Конец переклички</b><br>";
    }
}

class BirdFarm extends Farm
{
    protected $count = 0;
    function showAnimalsCount() {
        $this->count += 1;
    }
}

class Farmer {
    function addAnimal(Farm $farm, Animal $animal) {
        $farm->addAnimal($animal);
    }
    function rollCall(Farm $farm) {
        $farm->rollCall();
    }
}






// todo 1 часть задания
$farm = new Farm;
$farm->addAnimal(new Cow());
echo "<br>";
$farm->addAnimal(new Pig());
echo "<br>";
$farm->addAnimal(new Pig());
echo "<br>";
$farm->addAnimal(new Chicken());
echo "<br>";
$farm->rollCall();


// todo 2 часть задания
echo "<br><br><br><br>";
$farm = new Farm;
$farmer = new Farmer;
$birdFarm = new BirdFarm;

$cow1 = new Cow();
echo "<br>";
$pig1 = new Pig();
echo "<br>";
$pig2 = new Pig();
echo "<br>";
$chicken = new Chicken();
echo "<br>";
$turkey1 = new Turkey();
echo "<br>";
$turkey2 = new Turkey();
echo "<br>";
$turkey3 = new Turkey();
echo "<br>";
$horse1 = new Horse();
echo "<br>";
$horse2 = new Horse();
echo "<br>";
$goose = new Goose();
echo "<br>";

$farmer->addAnimal($farm, $cow1);
$farmer->addAnimal($farm, $pig1);
$farmer->addAnimal($farm, $pig2);
$farmer->addAnimal($birdFarm, $chicken);
$farmer->addAnimal($birdFarm, $turkey1);
$farmer->addAnimal($birdFarm, $turkey2);
$farmer->addAnimal($birdFarm, $turkey3);
$farmer->addAnimal($farm, $horse1);
$farmer->addAnimal($farm, $horse2);
$farmer->addAnimal($birdFarm, $goose);
$farmer->rollCall($farm);
$farmer->rollCall($birdFarm);
