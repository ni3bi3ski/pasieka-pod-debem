# Pasieka Pod Dębem — WordPress / WooCommerce

Wersja źródeł 1.0.1, odtworzona z kodu projektu w rozmowie. Nie jest bitową kopią wcześniejszego ZIP-a. Źródła uporządkowano w katalogach theme/plugin/preview, dodano skrypt pakowania i poprawiono kontrolę istniejącej strony głównej. Podgląd importuje CSS motywu zamiast dublować arkusz. To nowy projekt sklepu, nie kopia starego index.html.

## Zakres

Projekt dodaje tylko katalog woocommerce/. Istniejąca strona HTML w katalogu głównym pozostaje bez zmian. Sam push nie przełącza GitHub Pages ani nie uruchamia WordPressa.

- theme/pasieka-pod-debem/ — motyw strony głównej i WooCommerce.
- plugin/pasieka-start/ — inicjalizacja stron, szkice produktów, panel wdrożenia i blokada zakupów.
- preview/ — statyczny podgląd; otwórz index.html bez budowania, zachowując strukturę katalogów całego projektu.
- tools/package.py — budowa dwóch instalacyjnych ZIP-ów bez bibliotek zewnętrznych.
- WDROZENIE.md — konfiguracja i publikacja.
- TESTY.md — kontrole plików oraz testy wymagane na WordPressie.

## Paczki instalacyjne

W katalogu głównym repozytorium uruchom:

```sh
python3 woocommerce/tools/package.py
```

Motyw i wtyczka pojawią się w woocommerce/dist/; folder jest ignorowany przez Git. Nie wgrywaj ZIP-a całego repozytorium jako motywu.

## Wdrożenie w skrócie

1. Przygotuj WordPress z HTTPS na chronionym stagingu i aktywuj WooCommerce.
2. Wgraj ZIP motywu przez Wygląd → Motywy i ZIP wtyczki przez Wtyczki.
3. W panelu Pasieka utwórz brakujące strony i szkice produktów.
4. Osobnymi przyciskami ustaw stronę główną oraz PLN/Polskę, jeżeli chcesz zmienić te ustawienia.
5. Uzupełnij produkty, ceny, magazyn, zdjęcia, dane sprzedawcy, dostawy, płatności i dokumenty.
6. Przeprowadź pełne testy według TESTY.md przed uruchomieniem produkcji.

## Ograniczenia

Przygotowano kod, ale nie uruchomiono go na WordPressie w środowisku generowania. Nie wykonano PHP lint, testu transakcji ani testów wizualnych w przeglądarce. Kontrole plików nie zastępują testów na hostingu. Sprzedaż jest domyślnie zablokowana.

Nie dodano fikcyjnych cen, opinii, certyfikatów ani obietnic zdrowotnych. SVG to ilustracje, nie zdjęcia produktów. Telefon i ulica ze starej strony nie są automatycznie publikowane.

Płatności online wymagają osobnej integracji i konta operatora. InPost, SMTP, księgowość, faktury i analityka nie są częścią tej wtyczki. Dokumenty informacyjne są szkicami redakcyjnymi, nie poradą prawną.

Nie dezaktywuj wtyczki Pasieka w celu ominięcia blokady: po wyłączeniu jej zabezpieczenia przestają działać.
