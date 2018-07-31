<?php

class Bar {

   private $foo;


   public function __construct($newFoo){

      try{
         $this->setFoo($newFoo);
      } catch( \Exception  $exception) {
         // determine what exception type was thrown
         $exceptionType = get_class($exception);
         throw(new $exceptionType($exception->getMessage(), 0, $exception));
      }
   }

   public function getfoo() {
      return $this->foo;
   }

   public function setFoo($newFoo) {
      if($newFoo === "a") {
         throw new Exception("foo cannot equal a");
      }
   }
}

class TestBar {
   protected $testFoo = "a";

   // this function should not be in the test class
   public function assertIsString($testFoo) {
      if((is_string($testFoo)) !== true) {
         return "value is not a string";
      } else {
         return true;
      }
   }

   public function setup() {
      return $bar = new Bar($this->testFoo);
   }

   public function tearDown() {
      return null;
   }

   public function testFooIsString() {
      $bar = $this->setup();
      if($this->assertIsString($bar->getFoo()) !== true ) {
         echo "assertion failed";
      }

      $bar = $this->tearDown();
   }

}

$testBar = new TestBar();