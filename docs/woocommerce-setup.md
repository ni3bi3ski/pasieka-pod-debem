# WooCommerce — instrukcja wdrożenia krok po kroku

> Pakiet przygotowany dla Pasieki Pod Dębem. Wykonaj go po zakupie domeny i hostingu. Płatności online włączysz dopiero po konfiguracji Przelewy24.

## 1. Domena i hosting

1. Kup domenę, np. `miodpoddebem.pl` (sprawdź dostępność przy zakupie).
2. Wybierz hosting z automatyczną instalacją WordPressa i darmowym SSL.
3. Sprawdź cenę odnowienia po pierwszym roku, nie tylko cenę promocyjną.
4. Po zakupie zaloguj się do panelu hostingu i zainstaluj WordPress.

## 2. WordPress i WooCommerce

1. Zaloguj się do panelu WordPressa: `twojadomena.pl/wp-admin`.
2. Włącz SSL w panelu hostingu i upewnij się, że strona działa przez `https://`.
3. W menu **Wtyczki → Dodaj nową** wyszukaj **WooCommerce** i zainstaluj.
4. Uruchom kreator WooCommerce: kraj Polska, waluta PLN, adres sklepu: ul. Ochabska 92, 43-430 Kiczyce.
5. Pomiń płatności na tym etapie — skonfigurujesz je później.

## 3. Import produktów

1. W panelu WordPressa wejdź w **Produkty → Wszystkie produkty → Importuj**.
2. Wgraj plik `woocommerce/products-import.csv` z tego repozytorium.
3. Zaznacz opcję aktualizacji istniejących produktów, jeśli importujesz ponownie.
4. Po imporcie sprawdź kategorie: **Miody klasyczne**, **Kremowane**, **Pyłek i pierzga**.
5. Uzupełnij warianty cenowe dla miodów klasycznych i pyłku:
   - miody klasyczne: 400 g — 33 zł, 1,1 kg — cena z cennika,
   - pyłek: 200 g — 30 zł, 0,5 kg — 55 zł,
   - pierzga: 200 g — 80 zł,
   - kremowane: 400 g — 36 zł.

## 4. Wygląd sklepu

1. Zainstaluj lekki motyw zgodny z WooCommerce, np. **Storefront** lub **Blocksy**.
2. Ustaw logo Pasieki Pod Dębem i kolory: ciemna zieleń, krem, brąz.
3. Utwórz strony: **Sklep**, **O pasiece**, **Kontakt**, **Informacje**.
4. Skopiuj treści z podglądu `woocommerce/preview/` i uzupełnij dane firmy.
5. Ustaw menu: Sklep, O pasiece, Kontakt, Informacje.

## 5. Płatności Przelewy24

1. Załóż konto na Przelewy24 i przejdź weryfikację firmy.
2. W panelu Przelewy24 dodaj sklep i pobierz klucze API.
3. W WordPressie zainstaluj oficjalną wtyczkę **Przelewy24 dla WooCommerce**.
4. Wklej klucze w ustawieniach wtyczki i włącz: BLIK, szybkie przelewy, karty.
5. Wykonaj płatność testową BLIKIEM i kartą.
6. Sprawdź, czy zamówienie pojawia się w WooCommerce i czy dostajesz powiadomienie.

## 6. Przed publikacją

1. Uzupełnij dane firmy: pełna nazwa, NIP, e-mail, telefon.
2. Opublikuj regulamin, politykę prywatności i zasady zwrotów.
3. Sprawdź certyfikat SSL (`https://` i kłódka w przeglądarce).
4. Zrób zamówienie testowe i sprawdź e-maile do klienta oraz administratora.
5. Ustaw produkty jako „Opublikowane” dopiero po potwierdzeniu dostępności.

## 7. Po starcie

- Aktualizuj WordPressa, WooCommerce i wtyczki regularnie.
- Rób kopię zapasową sklepu co najmniej raz w tygodniu.
- Sprawdzaj zamówienia i dostępność miodów.
- Aktualizuj zdjęcia produktów, gdy będą gotowe właściwe fotografie słoików.
