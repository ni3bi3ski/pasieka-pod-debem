# Pasieka pod Dębem

Strona internetowa Pasieki pod Dębem z prostym sklepem. To jeden plik HTML, bez serwera i bez procesu budowania.

## Jak działa sklep

Klient dodaje produkty do koszyka, podaje imię i telefon, a zamówienie wysyła SMS-em na numer pasieki albo kopiuje do schowka. Każde zamówienie dostaje numer w formacie `PPD-DDMM-123`, żeby łatwo je odnaleźć. Sklep nie przyjmuje płatności online. Cenę końcową i termin odbioru osobistego potwierdza pasieka.

Koszyk oraz wpisane imię i telefon zapamiętują się w przeglądarce klienta. Na telefonie widać dolny pasek koszyka.

## Jak edytować produkty i ceny

Otwórz `index.html` i znajdź blok `KONFIGURACJA` na początku sekcji `<script>`.

```js
var PRODUCTS=[
 {id:'lipowy',name:'Miód lipowy',desc:'Wyraźny, świeży aromat.',
  variants:[{label:'Słoik 400 g',price:null}],
  stock:true,badge:null,img:null,tone:'#c98a1e'}
];
```

- `price: null` wyświetla „Zapytaj o cenę”.
- `price: 35` wyświetla „35,00 zł” i wlicza produkt do sumy w koszyku.
- Kilka gramatur: `variants:[{label:'400 g',price:22},{label:'900 g',price:42}]`. Klient wybierze wariant z listy.
- `stock: false` zamienia przycisk na „Brak”.
- `badge: 'Nowość'` dodaje etykietę na zdjęciu.
- Aby dodać produkt, dopisz kolejny obiekt z unikalnym `id`.
- Numer telefonu zamówień jest w zmiennej `PHONE`, adres strony w `SITE_URL`.

## Jak dodać zdjęcia

1. Wrzuć pliki do folderu `assets/` w repozytorium.
2. Zdjęcie główne: wpisz ścieżkę w `HERO_IMG`, np. `'assets/hero.jpg'`.
3. Zdjęcia słoików: wpisz ścieżkę w polu `img` produktu.
4. Galeria: dopisz wpisy w `GALLERY`. Sekcja pojawi się po dodaniu pierwszego zdjęcia.

## Uruchomienie lokalnie

Otwórz `index.html` w przeglądarce.

## Publikacja

Najprościej przez GitHub Pages: Settings → Pages → Deploy from a branch → `main` / root.
