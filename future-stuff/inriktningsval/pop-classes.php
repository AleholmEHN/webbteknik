<?php
/**
 * Lägg in elever i DB
 */

error_reporting(E_ALL);
ini_set("display_errors", "on");

/**
 * Databasanslutning
 */
require_once("dbcx.php");
$dbh = dbcx();

$elever = file("te1b-2012.cvs");
$elever = array_merge(file("te1a-2012.cvs"), $elever);

// echo "<pre>";
// var_dump($elever);
// klass,efternamn, fornamn,personnummer


$sql  = "INSERT INTO elever (personnummer, fornamn, efternamn, klass, kod, year) ";
$sql .= "VALUES (:personnummer, :fornamn, :efternamn, :klass, :kod, :year)";
$stmt = $dbh->prepare($sql);
$stmt->bindParam(":personnummer", $personnummer);
$stmt->bindParam(":fornamn", $fornamn);
$stmt->bindParam(":efternamn", $efternamn);
$stmt->bindParam(":klass", $klass);
$stmt->bindParam(":kod", $kod);
$stmt->bindParam(":year", $year);

date_default_timezone_set("Europe/Stockholm");
$year = date("Y");

// 2012 sa alla koder börja med a, 2013 med b, o.s.v.
$varv     = $year - 2012;
$kodstart = "a";
for ($i = 0; $i < $varv; $i++) {
    $kodstart++;
}
$chars = "abcdefghijkmnpqrstvxyz"; // Urval gjort med användbarhet i åtanke (nolla förväxlas med o, etc)
$charlen = strlen($chars) - 1; // Bara ASCII så strlen OK

foreach ( $elever as $e ) {
    // skapa resten av koden med slump
    $kod = $kodstart . $chars[rand(0, $charlen)] . $chars[rand(0, $charlen)] . $chars[rand(0, $charlen)];
    echo "<p>$kod</p>"; // debug
    // skapa variabler med list()
    
}
