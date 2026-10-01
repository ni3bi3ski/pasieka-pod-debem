# Pasieka pod Dębem

Strona internetowa Pasieki pod Dębem z prostym sklepem. To jeden plik HTML bez serwera i bez procesu budowania.

## Jak działa sklep

Klient dodaje produkty do koszyka, podaje imię i telefon, a zamówienie wysyła SMS-em na numer pasieki albo kopiuje do schowka. Sklep nie przyjmuje płatności online. Cenę końcową i termin odbioru osobistego potwierdza pasieka.

## Jak edytować produkty i ceny

Otwórz `index.html` i znajdź tablicę `PRODUCTS` na początku bloku `<script>`:

```js
var PRODUCTS=[
 {id:'lipowy',name:'Miód lipowy',desc:'Słoik 400 g.',price:null}
];
```

- `price: null` wyświetla napis „Zapytaj o cenę”.
- `price: 35` wyświetla „35,00 zł” i wlicza produkt do sumy w koszyku.
- Aby dodać produkt, dopisz kolejny obiekt z unikalnym `id`.
- Numer telefonu zamówień jest w zmiennej `PHONE`.

## Uruchomienie lokalnie

Otwórz `index.html` w przeglądarce.

## Publikacja

Najprościej przez GitHub Pages: Settings → Pages → Deploy from a branch → `main` / root.
