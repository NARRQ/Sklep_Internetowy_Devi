<?php

function sprawdz_bledy()
{
  if ($_FILES['obrazek']['error'] > 0)
  {
    echo 'problem: ';
    switch ($_FILES['obrazek']['error'])
    {
      // jest większy niż domyślny maksymalny rozmiar,
      // podany w pliku konfiguracyjnym
      case 1: {echo 'Rozmiar pliku jest zbyt duży.'; break;} 

      // jest większy niż wartość pola formularza 
      // MAX_FILE_SIZE
      case 2: {echo 'Rozmiar pliku jest zbyt duży.'; break;}

      // plik nie został wysłany w całości
      case 3: {echo 'Plik wysłany tylko częściowo.'; break;}

      // plik nie został wysłany
      case 4: {echo 'Nie wysłano żadnego pliku.'; break;}

      // pozostałe błędy
      default: {echo 'Wystąpił błąd podczas wysyłania.';
        break;}
    }
    return false;
  }
  return true;
}

function sprawdz_typ()
{
	if ($_FILES['obrazek']['type'] != 'image/png')
		return false;
	return true;
}

function zapisz_plik()
{
  // Użyj oryginalnej nazwy pliku i ścieżki katalogu temp
  $lokalizacja = './temp/' . $_FILES['obrazek']['name'];

  if(is_uploaded_file($_FILES['obrazek']['tmp_name']))
  {
    if(!move_uploaded_file($_FILES['obrazek']['tmp_name'], $lokalizacja))
    {
      echo 'problem: Nie udało się skopiować pliku do katalogu.';
      return false;  
    }
  }
  else
  {
    echo 'problem: Możliwy atak podczas przesyłania pliku.';
    echo 'Plik nie został zapisany.';
    return false;
  }
  return true;
}

sprawdz_bledy();
sprawdz_typ();
zapisz_plik();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" method="post">
    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />
    <!-- Zmieniono nazwę z "nazwa_pliku" na "obrazek" -->
    <input type="file" name="obrazek" />
    <input type="submit" value="wyślij" />
    </form>
</body>
</html>
