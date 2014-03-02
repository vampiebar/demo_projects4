<?php
function satirSay($yol, $uzantilar)
{
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($yol));
    $dosyalar = array(); 
    foreach ($rii as $dosya) {
        if ($dosya->isDir()){ 
            continue;
        }
        $parcala = explode('.', $dosya->getFilename());
        $uzanti = end($parcala); 
        if (in_array($uzanti, $uzantilar)) { 
            $dosyalar[$dosya->getPathname()] = count(file($dosya->getPathname())); 
      
        }
    }
    return $dosyalar;
}
$yolBu = "login/";
$uzantilarBunlar = array('php', 'css', 'html', 'json', 'js');
$toplamSatir = 0;
$sonuclar = satirSay($yolBu, $uzantilarBunlar);
foreach ($sonuclar as $key => $value)
{
    echo $key . ": " . $value . "<br />";
    $toplamSatir += $value;
}
echo "Toplam $toplamSatir satir kod yazmisim ya la";
?>