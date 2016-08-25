<?php

class Resources {
  public static function getList() {
    return array(
      'metals',       //Used as general building materials
      'fuel',         //Used to power slower than light speed ships and terestrial vehicles
      'food',         //Used to feed population
      'population',   //Literally people
      'science',      //Used to purchase technologies and create inventions
      'antimatter',   //Used to power anti-matter drives and weapons
      'deuterium',    //Used to power slower than light speed ships
      'he3',          //Fissionable energy source, used for ships and power reactors
      'monopoles',    //TODO: Not sure what these might be used for yet
      'polymers',     //Used as general building materials
      'rare_earth',   //Used to build electronics
      'oxygen',       //Used for breating also required for fuel to work
      'hydrogen',     //Used as fuel
      'lithium',      //Used for electrical storage
      'gluon_arrays', //Very expensive to produce, used for gravitational astronomy and some FTL designs
      'collapsium',   //Extremely durable metal used for armor
      'dilithium',    //Very rare, used to power some FTL designs
    );
  }
}