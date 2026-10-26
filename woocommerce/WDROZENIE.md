# Wdrożenie

## 1. Środowisko i backup

Potrzebujesz hostingu PHP z bazą danych, HTTPS i WordPressem. GitHub Pages nie uruchamia WordPressa/WooCommerce; może nadal prezentować starą stronę HTML lub statyczny podgląd.

Aktualne wymagania instalowanej wersji WooCommerce:
https://woocommerce.com/document/server-requirements/

Zrób backup plików i bazy. Staging zabezpiecz hasłem hostingu i wyłącz indeksowanie; samo noindex nie chroni dostępu. Ustaw język polski i właściwą strefę czasową WordPressa.

## 2. Instalacja

Z katalogu głównego repozytorium uruchom:

```sh
python3 woocommerce/tools/package.py
```

Dwa instalacyjne ZIP-y powstaną w woocommerce/dist.

W WordPressie:
1. Zainstaluj i aktywuj WooCommerce.
2. Wygląd → Motywy → Dodaj nowy → Wyślij motyw: pasieka-pod-debem.zip.
3. Wtyczki → Dodaj nową → Wyślij wtyczkę: pasieka-start.zip.
4. W menu Pasieka utwórz brakujące strony i dokumenty robocze.
5. Osobnym przyciskiem ustaw stronę główną Pasieki.
6. Na nowym polskim sklepie ustaw PLN/Polskę/kg/cm osobnym przyciskiem. Zmiana waluty nie przelicza istniejących cen.
7. Zaimportuj produkty z pliku woocommerce/products-import.csv (sekcja 4).
8. Zapisz bezpośrednie odnośniki i sprawdź katalog, koszyk, zamówienie oraz konto.

Istniejące strony nie są nadpisywane. Jeśli strona o tym samym adresie już istnieje, sprawdź treść i publikację ręcznie. Koszyk i checkout są tworzone przez klasyczne shortcode.

## 3. Wygląd i kontakt

Wygląd → Dostosuj → Pasieka — treści i kontakt:
- ustaw nagłówek, wprowadzenie i opis pasieki;
- dodaj rzeczywiste zdjęcie główne zamiast ilustracji, zoptymalizowane i z opisem alternatywnym;
- wpisz potwierdzony telefon, e-mail oraz dokładny adres;
- zaznacz publikację danych dopiero po ich sprawdzeniu.

Stary index.html zawierał +48 665 381 292 i ul. Ochabska 92, 43-430 Kiczyce. Nie potwierdzono niezależnie aktualności tych danych jako danych sprzedawcy. Nie są domyślnym kontaktem motywu. Sprawdź osobno adres prawny, odbioru i reklamacji.

## 4. Produkty

Oferta pochodzi z pliku woocommerce/products-import.csv (Produkty → Importuj). Plik zawiera 21 produktów: 10 miodów klasycznych i pyłek pszczeli jako produkty z wariantami gramatury (22 warianty) oraz 9 miodów kremowanych i pierzgę jako produkty proste. Każdy wariant ma własny SKU (np. MW-LIPOWY-400G) połączony z produktem nadrzędnym kolumną Parent oraz cenę z cennika 2026.

Przed importem i po nim:
- Importuj najpierw na stagingu. Przy ponownym imporcie zaznacz „Aktualizuj istniejące produkty” — dopasowanie odbywa się po SKU, więc pozycje nie zostaną zdublowane.
- Wtyczka pasieka-start nie tworzy już szkiców produktów. Jeśli instalowałeś starszą wersję (1.0.1), usuń szkice o SKU PPD-START-* przed importem.
- Wszystkie produkty startują ze stanem „brak w magazynie”. Po potwierdzeniu dostępności zmień stan zbiorczo (Produkty → zaznacz → Edycja zbiorowa) lub w wariantach. Kontrola we wtyczce wymaga co najmniej jednego produktu z ceną i dostępnością.
- Gramatury zapisano jako „400 g”, „1100 g”, „200 g” i „500 g”. Importer rozdziela wartości atrybutów przecinkami, więc zapis „1,1 kg” zostałby rozbity na dwie wartości.
- Ceny wpisano z cennika 2026. Potwierdź, że są to ceny końcowe (brutto), oraz ustaw właściwe podatki. Pierzga 0,5 kg nie ma ceny w cenniku i nie została dodana.
- Plik nie zawiera zdjęć, opisów alternatywnych ani masy wysyłkowej. Dodaj realne zdjęcia (najlepiej w proporcji 3:4), cenę końcową, podatki, rzeczywisty stan i masę zapakowanej przesyłki.
- Nazwy w sklepie są pełne („Miód lipowy”, „Miód kremowany z maliną”), bo kategorie i koszyk nie pokazują kontekstu zakładek z podglądu.

Sprawdź po imporcie: 21 produktów, 22 warianty, poprawne ceny wariantów, kategorie Miody klasyczne / Kremowane / Pyłek i pierzga oraz brak duplikatów.

## 5. Ustawienia sklepu

WooCommerce → Ustawienia:
- Ogólne: pełne dane sprzedawcy, kraje sprzedaży i dostaw, waluta.
- Podatki: zgodnie z sytuacją działalności; motyw nie narzuca VAT.
- Wysyłka: strefy, koszty i rzeczywiście oferowane metody; ewentualny odbiór osobisty z adresem i terminami.
- Płatności: przelew bankowy lub zgodna bramka. BLIK/karty wymagają integracji i konta operatora. Pasieka nie łączy się sama z Przelewy24.
- InPost: osobna integracja, konto i konfiguracja, jeśli chcesz paczkomaty. Projekt nie dodaje selektora ani API przewoźnika.
- E-maile: nadawca, adres powiadomień i sprawdzona dostarczalność przez hosting lub SMTP.
- Konta i prywatność: zakupy bez konta, rejestracja i retencja danych.

Klucze i hasła wpisuj w panelach usług, nie w repozytorium ani podglądzie.

## 6. Dokumenty

Cztery strony informacyjne są szkicami. Uzupełnij je zgodnie z realnym sprzedawcą, produktami, procesami i wtyczkami; zweryfikuj z kompetentną osobą. Nie publikuj placeholderów.

Przypisz opublikowaną politykę w Ustawienia → Prywatność oraz regulamin w WooCommerce → Ustawienia → Zaawansowane. Sprawdź koszyk, zamówienie i konto. Stopka używa slugów regulamin, polityka-prywatnosci, dostawa-i-platnosci, zwroty-i-reklamacje. Zmiana slugów wymaga zmiany odwołań w footer.php.

Motyw nie dodaje analityki, reklam ani zewnętrznych fontów. Osadzona mapa Google ładuje się dopiero po kliknięciu „Pokaż mapę”. Zrób audyt cookies i potrzebnych zgód po instalacji dodatków.

## 7. Testy bez otwierania produkcji

Na chronionym stagingu w wp-config.php przed końcową linią konfiguracji ustaw:

```php
define('WP_ENVIRONMENT_TYPE', 'staging');
```

Nie definiuj stałej drugi raz, jeśli już istnieje. Osobno włącz sandbox w integracji operatora — przycisk testowy Pasieki tego nie robi.

W panelu Pasieka użyj przycisku otwarcia testowego, dostępnego tylko w staging/development/local. W WooCommerce udostępnij sklep testerom, zachowując hasło hostingu. Wykonaj TESTY.md, w tym płatność poprawną, odrzuconą, anulowaną, webhook, magazyn i e-maile.
https://woocommerce.com/document/managing-orders/testing-orders/

## 8. Start produkcyjny

Usuń/oznacz testowe zamówienia i przywróć rzeczywiste stany. Migrację wykonuj procedurą hostingu uwzględniającą serializowane dane; nie prostym find/replace na całej bazie SQL.

Na produkcji usuń testową definicję WP_ENVIRONMENT_TYPE lub ustaw production. Otwarcie wyłącznie testowe zostanie wtedy zablokowane. Sprawdź docelową domenę, HTTPS, produkcyjne dane operatora, adresy powrotu, webhooki, pocztę i koszty.

Po testach świadomie odblokuj sprzedaż produkcyjną w panelu Pasieka. Lista sprawdza obecność ustawień, nie ich poprawność merytoryczną. Widoczność Wkrótce w WooCommerce jest osobnym ustawieniem.

Zdejmij hasło produkcji i włącz indeksowanie dopiero po gotowości. Staging nadal chroń. Koszyka, checkoutu, konta i sesji nie cache'uj; sprawdź sklep jako niezalogowany klient.

## 9. Utrzymanie i powrót

Aktualizuj WordPress, WooCommerce i integracje po testach. Backupuj bazę i pliki. Zamówienia nie są przechowywane w motywie.

W razie problemu zablokuj sprzedaż i przywróć poprzednie pliki. Nie przywracaj starej bazy po nowych zamówieniach bez ich zachowania. Nie usuwaj zamówień i produktów w celu wymiany motywu. Unikaj kierowania klientów równolegle na stary i nowy koszyk.
