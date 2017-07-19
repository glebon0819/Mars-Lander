<?php
/**
 * Auto-generated code below aims at helping you parse
 * the standard input according to the problem statement.
 **/

fscanf(STDIN, "%d",
    $surfaceN // the number of points used to draw the surface of Mars.
);
for ($i = 0; $i < $surfaceN; $i++)
{
    fscanf(STDIN, "%d %d",
        $landX, // X coordinate of a surface point. (0 to 6999)
        $landY // Y coordinate of a surface point. By linking all the points together in a sequential fashion, you form the surface of Mars.
    );
    //$points[] = array($landX, $landY);
    $points[$landX] = $landY;
}

$time = 0;
error_log(var_export($points, true));
//$xpoints = array_keys($points);
//error_log(var_export($xpoints, true));

$range = 0;
$lastY = -1;
$lastX = -1;
foreach($points as $xPoint => $yPoint){
    $currentY = $yPoint;
    $currentX = $xPoint;
    if($lastY == $currentY){
        $range = array($lastX, $currentX);
    } 
    $lastY = $currentY;
    $lastX = $currentX;
}
error_log(var_export($range, true));

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

    // Write an action using echo(). DON'T FORGET THE TRAILING \n
    // To debug (equivalent to var_dump): error_log(var_export($var, true));
    
    // 2 integers: rotate power. rotate is the desired rotation angle (should be 0 for level 1), power is the desired thrust power (0 to 4).
    
    if($time >= 18){
        echo("0 4\n");
    }
    else {
        echo("0 1\n");
    }
    
    $time++;
    
    //echo("20 3\n");
    
}
?>