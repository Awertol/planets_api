<?php
header('Content-Type: text/plain; charset=utf-8');

// 1. Získání cesty z URL (univerzální způsob pro DigitalOcean)
$requestUri = $_SERVER['REQUEST_URI']; 

// Rozsekáme URL podle lomítek a vezmeme poslední část
$parts = explode('/', rtrim($requestUri, '/'));
$lastPart = end($parts);

// Pokud je poslední část číslo, použijeme ho, jinak dáme 1
$n = is_numeric($lastPart) ? (int)$lastPart : 1;
$n = max(1, min(50, $n));

// 2. Zásoba pro generování (Prefixy, čísla a přípony)
$prefixes = ["Kepler", "Gliese", "HD", "TOI", "WASP", "OGLE", "K2", "Gamma", "Gliese", "HATS", "PDS", "Gaia", "Proxima", "Trappist", "Wolf", "LHS"];
$letters = ["a", "b", "c", "d", "e", "f", "g"];

$generatedPlanets = [];

// 3. Generování unikátních názvů
while (count($generatedPlanets) < $n) {
    $p = $prefixes[array_rand($prefixes)]; // Náhodný název
    $num = 0;
    $decision = rand(1,2);
    if($decision == 1)
    {
    	$num = rand(1, 40000);                   // Náhodné číslo
    }
    else
    {
        $num = rand(1, 100);
    }
    $suffix = (rand(0, 10) > 3) ? $letters[array_rand($letters)] : ""; // 70% šance na písmeno

    $fullLabel = "$p-$num$suffix";

    // Zajistíme, aby se v jednom seznamu jméno neopakovalo
    if (!in_array($fullLabel, $generatedPlanets)) {
        $generatedPlanets[] = $fullLabel;
    }
}

// 4. Výpis do konzole/prohlížeče
echo implode(PHP_EOL, $generatedPlanets);
?>
