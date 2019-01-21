<?php

/**
 * Class for plateau
 */
class Input
{
  /**
   * Input an information of the size of the plateau
   * return two values (x and y)
   * @return array x and y co-ordinates
   */
  static function inputSizeOfPlateau()
  {
    $sizeOfPlateau = explode(' ', trim(fgets(STDIN)));
    return $sizeOfPlateau;
  }

  /**
   * Input an information of the first position of rover
   * return three values (x, y and orientation)
   * @return array x , y co-ordinates and his orientation
   */
  static function inputPositionOfRover()
  {
    $positionOfRover = explode(' ', trim(fgets(STDIN)));
    return $positionOfRover;
  }

  /**
   * Input an information of the order to rover
   * @return array
   */
  static function inputOrderToRover()
  {
    $orderToRover = trim(fgets(STDIN));
    $len = strlen($orderToRover);
    for ($i = 0; $i < $len ; $i++)
    {
      $arrayOfOrder[] = $orderToRover[$i];
    }
    return $arrayOfOrder;
  }

}

class Position
 {

   /**
    * method to get the orientation of a rover
    * @param  String $position
    * @return integer
    */
   static function getDegree($position)
   {
     switch (strtoupper($position[2]))
     {
       case 'N':
           $degree = 360; // North
           break;
       case 'E':
           $degree = 90; // West
           break;
       case 'S':
           $degree = 180; // South
           break;
       case 'W':
           $degree = 270; // East
           break;
     }
     return $degree;
   }

   /**
    * method to get an orientation from the degree
    * @param  integer $orientation
    * @return string
    */
   static function getOrientation($degree)
   {
     switch ($degree)
     {
       case -720:
       case -360:
       case 0:
       case 360:
       case 720:
           $currentOrientation = 'N';
           break;
       case -630:
       case -270:
       case 90:
       case 450:
       case 810:
           $currentOrientation = 'E';
           break;
       case -540:
       case -180:
       case 180:
       case 540:
       case 900:
           $currentOrientation = 'S';
           break;
       case -450:
       case -90:
       case 270:
       case 630:
       case 990:
           $currentOrientation = 'W';
           break;
     }
     return $currentOrientation;
   }
 }

class Control
{
  /**
   * This methode will make a rover move
   * @param  array $position [$position[0] = x, $position[1] = y, $position[2] = orientation]
   * @param  array $order
   * @return array return $position after moving on the plateau
   */
  static function orderToRover($position, $order)
  {
    $currentDegree = Position::getDegree($position);

    for ($i = 0; $i < count($order); $i++)
    {
      if (isset($order[$i]) && ($order[$i] === 'M'))
      {
          if (Position::getOrientation($currentDegree) === 'N') :
            $position[1]++; // Move to up = y + 1
          elseif (Position::getOrientation($currentDegree) === 'E') :
            $position[0]++; // Move to right = x + 1
          elseif (Position::getOrientation($currentDegree) === 'S') :
            $position[1]--; // Move to down = y - 1
          elseif (Position::getOrientation($currentDegree) === 'W') :
            $position[0]--; // Move to left = x - 1
          endif;
      }
      elseif (isset($order[$i]) && ($order[$i] === 'R'))
      {
        $currentDegree = $currentDegree + 90;
      }
      elseif (isset($order[$i]) && ($order[$i] === 'L'))
      {
        $currentDegree = $currentDegree - 90;
      }
      else
      {
        echo "You didn't give a right order. You can only input [M, R or L] as an order" . "\n";
        break;
      }
    }
    $position[2] = Position::getOrientation($currentDegree);
    return $position;
  }
}

class Terminal
{
  /**
   * [interfaceTerminal description]
   * An interface on terminal
   * This methode will ask users to input some informations to operate the programe
   */
  static function interfaceTerminal(){

    // Input size of the plateau
    echo 'Size of the plateau? EX: 5 5' . "\n";
    $plateau = Input::inputSizeOfPlateau();

    // Starting point of the rover No.1
    echo 'The position of the rover No.1? EX: 1 2 N' . "\n";
    $positionOfRover1 = Input::inputPositionOfRover();

    // Input of an order for rover No.1
    echo 'Give an order to rover No.1. You can only use M(move), R(turn to right) and L(turn to left) EX: MRMMLM' . "\n";
    $orderToRover1 = Input::inputOrderToRover();

    $finalPositionRover1 = Control::orderToRover($positionOfRover1, $orderToRover1);

    // Starting point of the rover No.2
    echo 'The position of the rover No.2? EX: 3 3 E' . "\n";
    $positionOfRover2 = Input::inputPositionOfRover();

    // Input of an order for rover No.1
    echo 'Give an order to rover No.1. You can only use M(move), R(turn to right) and L(turn to left) EX: MRMMLM' . "\n";
    $orderToRover2 = Input::inputOrderToRover();

    $finalPositionRover2 = Control::orderToRover($positionOfRover2, $orderToRover2);

    echo 'Result:' . "\n";
    echo 'Plateau max X = ' . $plateau[0] . ' and max Y = ' . $plateau[1] . "\n";
    echo 'New coordinates:' . "\n";

    if (($finalPositionRover1[0] < 0) || ($finalPositionRover1[0] > $plateau[0]) ||
        ($finalPositionRover1[1] < 0) || ($finalPositionRover1[1] > $plateau[1]))
        {
          echo 'The rover No.1 is out of the plateau * ';
        }
    else
    {
      echo $finalPositionRover1[0] . ' ' . $finalPositionRover1[1] . ' ' . $finalPositionRover1[2] . ' * ';
    }
    if (($finalPositionRover2[0] < 0) || ($finalPositionRover2[0] > $plateau[0]) ||
        ($finalPositionRover2[1] < 0) || ($finalPositionRover2[1] > $plateau[1]))
        {
          echo 'The rover No.2 is out of the plateau';
        }
    else
    {
      echo $finalPositionRover2[0] . ' ' . $finalPositionRover2[1] . ' ' . $finalPositionRover2[2];
    }
  }
}

Terminal::interfaceTerminal();
