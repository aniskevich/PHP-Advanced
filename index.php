<?php
    require_once 'db.php';
    include 'Core.php';
    include 'skeleton.php';

    /**
     * 5 Дан код:
     *   class A {
     *      public function foo() {
     *           static $x = 0;
     *           echo ++$x;
     *       }
     *   }
     *   $a1 = new A();
     *   $a2 = new A();
     *   $a1->foo();
     *   $a2->foo();
     *   $a1->foo();
     *   $a2->foo();
     * 
       Выведет 1 2 3 4. При каждом вызовете метода инкрементируется статическая локальная переменная $x.
       Без наследования метод остается в единственном экземпляре.
     */

    /**
     * 6 Немного изменим п.5
     *   class A {
     *      public function foo() {
     *          static $x = 0;
     *          echo ++$x;
     *      }
     *   }
     *   class B extends A {
     *   }
     *   $a1 = new A();
     *   $b1 = new B();
     *   $a1->foo(); 
     *   $b1->foo(); 
     *   $a1->foo(); 
     *   $b1->foo();
     * Объясните результаты в этом случае.
       Выведет 1 1 2 2. При наследовании создался новый метод со своей статической локальной переменной.
     */

    /**
     * 7 Дан код:
     *    class A {
     *    public function foo() {
     *        static $x = 0;
     *        echo ++$x;
     *        }
     *    }
     *    class B extends A {
     *    }
     *    $a1 = new A;
     *    $b1 = new B;
     *    $a1->foo();
     *    $b1->foo();
     *    $a1->foo();
     *    $b1->foo();
        Нет конструктора, поэтому кроме отсутствия скобок ничем не отличается от 6 задания.
     */