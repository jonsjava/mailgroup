<?php
session_start();
/* ######################################################################################## */
/* Mailer Group Solution -- Multi-User Mass Mailing System with opt out and Admin abilities */
/* Copyright (C) 2008  Jon Harris                                                           */
/*                                                                                          */
/* This program is free software; you can redistribute it and/or                            */
/* modify it under the terms of the GNU General Public License                              */
/* as published by the Free Software Foundation.                                            */
/*                                                                                          */
/* This program is distributed in the hope that it will be useful,                          */
/* but WITHOUT ANY WARRANTY; without even the implied warranty of                           */
/* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                            */
/* GNU General Public License for more details.                                             */
/*                                                                                          */
/* You should have received a copy of the GNU General Public License                        */
/* along with this program; if not, write to the Free Software                              */
/* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.          */
/* ######################################################################################## */
header('Content-type: image/png');

$im = imagecreate(180, 70);

$lightcolour1 = imagecolorallocate($im, 0,0,0);
$lightcolour2 = imagecolorallocate($im, rand(0,70),rand(0, 70),rand(0, 70));
$backgroundcolour = imagecolorallocate($im, rand(200, 255),rand(200, 255),rand(200, 255));

$_SESSION['code'] = str_replace('7', '1', rand(10000, 99999));
$id = $_SESSION['code'];

imagefill($im, 0, 0, $backgroundcolour);

$end1 = rand(0, 100);
imagefilledrectangle($im, 0, 0, $end1, 70, ImageColorAllocate($im, rand(235, 255),rand(235, 255),rand(235, 255)));
$end2 = $end1+rand(0, 100);
imagefilledrectangle($im, $end1, 0, $end2, 70, ImageColorAllocate($im, rand(235, 255),rand(235, 255),rand(235, 255)));
$end3 = $end2+rand(0, 100);
imagefilledrectangle($im, $end2, 0, $end3, 70, ImageColorAllocate($im, rand(235, 255),rand(235, 255),rand(235, 255)));
imagefilledrectangle($im, $end3, 0, 180, 70, ImageColorAllocate($im, rand(235, 255),rand(235, 255),rand(235, 255)));

$y1 = rand(25, 50);
ImageTTFText ($im, rand(17, 20), rand(-30, 30), rand(10, 20), $y1, $lightcolour1, 'fonts/verdana.ttf', substr($id, 0, 1));
$y2 = rand(25, 50);
ImageTTFText ($im, rand(17, 20), rand(0, 30), rand(45, 55), $y2, $lightcolour2, 'fonts/arial.ttf', substr($id, 1, 1));
$y3 = rand(25, 50);
ImageTTFText ($im, rand(17, 25), rand(-20, 0), rand(80, 90), $y3, $lightcolour1, 'fonts/times.ttf', substr($id, 2, 1));
$y4 = rand(25, 50);
ImageTTFText ($im, rand(16, 25), rand(0, 30), rand(115, 125), $y4, $lightcolour1, 'fonts/verdana.ttf', substr($id, 3, 1));
$y5 = rand(25, 50);
ImageTTFText ($im, rand(18, 20), rand(-25, 0), rand(150, 160), $y5, $lightcolour2, 'fonts/times.ttf', substr($id, 4, 1));

$x = rand(0, 50);
$y = rand(0, 50);
imagerectangle($im, $x, $y, $x+rand(100, 120), $y+rand(60, 80), $lightcolour1);
imagepolygon($im, array (rand(0, 180), rand(0, 70),rand(0, 180), rand(0, 70),rand(0, 180), rand(0, 70)),3,$lightcolour);
imagepolygon($im, array (rand(0, 180), rand(0, 70),rand(0, 180), rand(0, 70),rand(0, 180), rand(0, 70),rand(0, 180), rand(0, 70)),4,ImageColorAllocate($im, rand(60, 120),rand(60, 120),rand(60, 120)));

$start = rand(0, 5);
for($a = 1; $a < 9; $a++) {
imageline($im, $start+$a*20, 0, $start+$a*20, 70, imagecolorallocate($im, 0, 0, 0));
}

imagepng($im);

?>
?>