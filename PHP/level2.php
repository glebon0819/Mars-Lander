<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/
$pointsArray = array();
fscanf(STDIN, "%d",
    $surfaceN // the number of points used to draw the surface of Mars.
);
for ($i = 0; $i < $surfaceN; $i++)
{
    fscanf(STDIN, "%d %d",
        $landX, // X coordinate of a surface point. (0 to 6999)
        $landY // Y coordinate of a surface point. By linking all the points together in a sequential fashion, you form the surface of Mars.
    );
    $points[$landX] = $landY;
}

$xPoints = array_keys($points);
$range_height = 0;

// find the area of flat ground:
$range = 0;
$lastY = -1;
$lastX = -1;
foreach($points as $xPoint => $yPoint){
    $currentY = $yPoint;
    $currentX = $xPoint;
    if($lastY == $currentY){
        $range = array($lastX, $currentX);
        $range_height = $lastY;
    } 
    $lastY = $currentY;
    $lastX = $currentX;
}
error_log(var_export($points, true));
//error_log(var_export($range, true));

// game loop
while (TRUE)
{
    fscanf(STDIN, "%d %d %d %d %d %d %d",
        $X,
        $Y,
        $hSpeed, // the horizontal speed (in m/s), can be negative.
        $vSpeed, // the vertical speed (in m/s), can be negative.
        $fuel, // the quantity of remaining fuel in liters.
        $rotate, // the rotation angle in degrees (-90 to 90).
        $power // the thrust power (0 to 4).
    );
    
    // determine if the lander is to the left or the right of the landing zone
    $left = false;
    $right = false;
    $center = false;
    if($X < $range[0]){
        $left = true;
    }
    elseif($X > $range[1]){
        $right = true;
    }
    else {
        $center = true;
    }
    
    // calculates the height and distance of the tallest obstacle that is in the way
    $tallest = array();
    $pos = array_search($range[0], $xPoints);
    if($right){
        $new_range = array_slice($points, $pos+2, null, true);
        foreach($new_range as $x => $y){
            if($X < $x){
                unset($new_range[$x]);
            }
        }
    }
    elseif($left){
        $new_range = array_slice($points, 0, $pos, true);
        foreach($new_range as $x => $y){
            if($X > $x){
                unset($new_range[$x]);
            }
        }
    }
    else {
        $new_range = null;
        $tallest = array();
    }
    if($new_range != null){
        arsort($new_range);
        reset($new_range);
        $tallest[key($new_range)] = current($new_range);
    }
    
    // determines if the lander needs to evade an incoming obstacle
    $incoming = false;
    $cruise = false;
    if(($Y - current($tallest)) < 300){
        $incoming = true;
    }
    //arsort($points);
    if($Y - $range_height <= 500){
        $cruise = true;
        error_log(var_export($cruise, true));
    }
    
    // determines what the lander should do
    $thrust = 3;
    $angle = 0;
    if($vSpeed <= -30){
        $thrust = 4;
    }
    if(!$incoming){
        // checks if lander is above the landing zone
        if($center){
            if($hSpeed > 12){
                if($hSpeed > 80){
                    $angle = 80;
                    $thrust = 4;
                }
                elseif($hSpeed > 50 && $hSpeed < 80){
                    $angle = 60;
                    $thrust = 4;
                }
                else {
                    $angle = 45;
                    $thrust = 4;
                }
                
            }
            elseif($hSpeed < -12){
                
                if($hSpeed < -80){
                    $angle = -60;
                    $thrust = 4;
                }
                elseif($hSpeed < -20 && $hSpeed > -80){
                    $angle = -45;
                    $thrust = 4;
                }
                else {
                    $angle = -30;
                }
            }
            else {
                
            }
        }
        elseif($right){
            if($cruise){
                $thrust = 4;
            }
            else {
                if($hSpeed < -50){
                    // slow down
                    if($hSpeed < -90){
                        $angle = -45;
                    }
                    elseif($hSpeed < -70 && $hSpeed > -90){
                        $angle = -30;
                    }
                    else {
                        $angle = -20;
                    }
                }
            
                // if the lander is going the wrong way
                elseif($hSpeed > 0){
                    $angle = 60;
                    $thrust = 4;
                }
                else {
                    $angle = 20;
                }
            }
        }
        elseif($left) {
            if($cruise){
                $thrust = 4;
            }
            else {
                if($hSpeed > 50){
                    // slow down
                    if($hSpeed > 90){
                        $angle = 60;
                    }
                    elseif($hSpeed > 70 && $hSpeed < 90){
                        $angle = 45;
                    }
                    else {
                        $angle = 20;
                    }
                }
                elseif($hSpeed < 0){
                    $angle = -60;
                }
                else {
                    $angle = -20;
                }
            }
        }
    }
    else {
        //$angle = -20;
        $thrust = 4;
        /*if($right){
            $angle = 20;
        }
        if($left){
            $angle = -20;
        }*/
    }
    
    echo($angle . " " . $thrust . "\n");
}
?>