/* Ceny przepisane z Pasieka/Miód cennik 2026.pdf. Brak danych o magazynie. */
(function(){
'use strict';
const classic=[['Wielokwiatowy',58],['Rzepakowy',58],['Mniszkowy',58],['Nawłociowy',58],['Słonecznikowy',58],['Lipowy',63],['Akacjowy',63],['Gryczany',65],['Spadziowy',65],['Nektarowo-spadziowy',65]];
const creams=['Malina','Cytryna','Rokitnik','Truskawka','Żurawina','Limonka – mięta','Czarna porzeczka','Czerwona porzeczka','Z pyłkiem pszczelim'];
const products=classic.map(([name,large])=>({name:'Miód '+name.toLocaleLowerCase('pl'),category:'miody',variants:[['400 g',33],['1,1 kg',large]]}));
creams.forEach(name=>products.push({name:'Miód kremowany — '+name.toLocaleLowerCase('pl'),category:'kremowane',variants:[['400 g',36]]}));
products.push({name:'Pyłek pszczeli',category:'inne',variants:[['200 g',30],['0,5 kg',55]]},{name:'Pierzga',category:'inne',variants:[['200 g',80]]});
const grid=document.getElementById('product-grid');
const status=document.getElementById('catalog-status');
if(!grid||!status)return;
const labels={miody:'Miód klasyczny',kremowane:'Miód kremowany',inne:'Produkt pszczeli'};
const format=new Intl.NumberFormat('pl-PL',{style:'currency',currency:'PLN'});
function el(tag,className,text){const node=document.createElement(tag);if(className)node.className=className;if(text!==undefined)node.textContent=text;return node}
products.forEach((product,index)=>{
const card=el('article','sample-card');card.dataset.category=product.category;
const visual=el('div','sample-image');const bee=el('img');bee.src='../../Pasieka/Same%20pszcz%C3%B3%C5%82ki/Sama%20pszczo%C5%82a%20-%20filled.svg';bee.alt='';bee.width=85;bee.height=100;bee.loading='lazy';visual.append(bee,el('span','image-note','Znak marki · zdjęcie w przygotowaniu'));
const title=el('h3','',product.name);title.id='product-title-'+index;card.setAttribute('aria-labelledby',title.id);
const label=el('label','variant-label','Gramatura');const select=el('select','variant-select');select.setAttribute('aria-label','Gramatura: '+product.name);
product.variants.forEach(([weight,price])=>{const option=el('option','',weight+' · '+format.format(price));option.value=String(price);select.append(option)});
label.append(select);const price=el('span','product-price',format.format(product.variants[0][1]));price.setAttribute('aria-live','polite');
select.addEventListener('change',()=>{price.textContent=format.format(Number(select.value))});
card.append(visual,el('span','product-tag',labels[product.category]),title,label,price,el('p','availability-note','Dostępność do potwierdzenia · podgląd bez zakupów'));grid.append(card);
});
const buttons=Array.from(document.querySelectorAll('[data-filter]'));
function filter(category){let count=0;grid.querySelectorAll('.sample-card').forEach(card=>{card.hidden=category!=='all'&&card.dataset.category!==category;if(!card.hidden)count++});buttons.forEach(button=>button.setAttribute('aria-pressed',String(button.dataset.filter===category)));status.textContent='Liczba pozycji: '+count+' · ceny według cennika 2026'}
buttons.forEach(button=>button.addEventListener('click',()=>filter(button.dataset.filter)));filter('all');
})();
