# Testy i ograniczenia

## Kontrole przygotowanej paczki

We wcześniejszej sesji przygotowania sprawdzono składnię JavaScript, linki i zasoby podglądu, identyfikatory elementów, paczki instalacyjne, aplikowanie patcha, zawartość lokalnego commita i Git bundle. Nie były to testy wykonania WordPressa. Aktualna publikacja jest podzielona na commity integracji, więc ma inne SHA. Podgląd repozytorium importuje CSS motywu zamiast jego kopii; nie wykonano ponownego testu wizualnego tej zmiany.

Nie wykonano PHP lint (brak interpretera PHP), instalacji WordPressa, testów przeglądarkowych ani płatności. Kontrole plików nie są audytem bezpieczeństwa, dostępności ani prawa. Nie deklarujemy przetestowanego sklepu produkcyjnego.

## Instalacja i bezpieczeństwo na stagingu

- [ ] Backup bazy i plików, HTTPS oraz hasło hostingu.
- [ ] PHP lint: find wp-content/themes/pasieka-pod-debem wp-content/plugins/pasieka-start -name '*.php' -exec php -l {} \;
- [ ] Aktywacja z WooCommerce bez błędów PHP.
- [ ] Dwukrotne uruchomienie instalatora bez dublowania szkiców.
- [ ] Dokumenty pozostają szkicami; produkty bez cen i z zerowym stanem.
- [ ] Konfiguracja wymaga administratora i poprawnego nonce.
- [ ] Prawidłowe przypisanie katalogu, koszyka, checkoutu, konta i permalinków.

## Wygląd i obsługa

- [ ] Szerokości 360, 390, 768, 1280 i 1600 px bez poziomego przewijania.
- [ ] Klawiatura: link do treści, menu, FAQ, formularze i widoczny fokus.
- [ ] Menu mobilne: otwarcie, wybór pozycji i Escape.
- [ ] Nawigacja i treść po wyłączeniu JavaScriptu.
- [ ] Realne zdjęcia z opisami alt, właściwymi proporcjami i rozmiarem.
- [ ] Katalog, karta produktu, galeria, warianty, koszyk, checkout, konto i 404.
- [ ] Czytelne formularze, błędy i podsumowanie na telefonie.

## Blokada i środowiska

- [ ] Zamknięty sklep blokuje dodanie przez UI, URL add-to-cart i Store API.
- [ ] Zablokowane są istniejący koszyk, checkout i opłacenie oczekującego zamówienia.
- [ ] W production nie jest dostępne otwarcie wyłącznie testowe.
- [ ] Na stagingu działa otwarcie testowe; sandbox operatora włączono osobno.
- [ ] Zmiana staging na production blokuje otwarcie wyłącznie testowe.
- [ ] Świadome otwarcie produkcyjne działa po konfiguracji; ponowne zamknięcie blokuje zakup.
- [ ] Wtyczka pozostaje aktywna; widoczność WooCommerce jest ustawiona niezależnie.

## Zamówienia i płatności — sandbox

- [ ] Jeden i kilka produktów, zmiana ilości, usuwanie, odświeżenie i sesja.
- [ ] Zgodność cen, gramatur, wariantów, dostaw i podatków.
- [ ] Brak sprzedaży ponad stan, jeśli niedozwolona.
- [ ] Adres w strefie, poza strefą i odbiór osobisty.
- [ ] Zakup bez konta i z kontem według ustawień.
- [ ] Płatność poprawna, odrzucona, anulowana i opóźniona.
- [ ] Status zmienia autorytatywne potwierdzenie operatora/webhook, nie samo wejście na podziękowanie.
- [ ] Magazyn po zakupie, anulowaniu i zwrocie.
- [ ] E-maile klienta i obsługi oraz link do zamówienia.
- [ ] Przewoźnik/paczkomat/etykiety, jeśli dodano integracje.
- [ ] Zwrot testowy zgodnie z możliwościami operatora.

## Produkcja

- [ ] Rzeczywiste dane sprzedawcy, oferta, zdjęcia i dokumenty bez placeholderów.
- [ ] Właściwe podatki i koszty dostawy.
- [ ] Oznaczenie/usunięcie testowych zamówień i przywrócenie stanów.
- [ ] Production, klucze produkcyjne, webhooki docelowej domeny, HTTPS i poczta.
- [ ] Cache nie ujawnia koszyka innej osobie.
- [ ] Backup, aktualizacje i test jako niezalogowany klient.
- [ ] Otwarcie sprzedaży i widoczności dopiero po gotowości. Staging pozostaje za hasłem.
