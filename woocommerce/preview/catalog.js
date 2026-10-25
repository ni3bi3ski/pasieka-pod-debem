/* Podglad: ceny z cennika 2026, bez zamowien i bez deklaracji stanow magazynowych. */
(function(){
'use strict';
const classic=[['wielokwiatowy','Wielokwiatowy',58],['rzepakowy','Rzepakowy',58],['mniszkowy','Mniszkowy',58],['nawlociowy','Nawłociowy',58],['slonecznikowy','Słonecznikowy',58],['lipowy','Lipowy',63],['akacjowy','Akacjowy',63],['gryczany','Gryczany',65],['spadziowy','Spadziowy',65],['nektarowo-spadziowy','Nektarowo-spadziowy',65]];
const creams=[['malina','Z maliną'],['cytryna','Z cytryną'],['rokitnik','Z rokitnikiem'],['truskawka','Z truskawką'],['zurawina','Z żurawiną'],['limonka-mieta','Limonka i mięta'],['czarna-porzeczka','Z czarną porzeczką'],['czerwona-porzeczka','Z czerwoną porzeczką'],['pylek','Z pyłkiem pszczelim']];
const products=classic.map(([id,name,large])=>({id,name,category:'miody',variants:[['400 g',33],['1,1 kg',large]]}));
creams.forEach(([id,name])=>products.push({id:'kremowany-'+id,name,category:'kremowane',variants:[['400 g',36]]}));
products.push({id:'pylek',name:'Pyłek pszczeli',category:'inne',variants:[['200 g',30],['0,5 kg',55]]},{id:'pierzga',name:'Pierzga',category:'inne',variants:[['200 g',80]]});
// Po dodaniu fotografii: id produktu -> {src: rzeczywista sciezka, alt: opis}. Bez domyslania nazw plikow.
const photos={};
const selected=new Set(['wielokwiatowy','lipowy','akacjowy','gryczany','kremowany-malina','pylek']);
const grid=document.getElementById('product-grid');const status=document.getElementById('catalog-status');const expand=document.getElementById('catalog-expand');if(!grid||!status||!expand)return;
const labels={miody:'Miód klasyczny',kremowane:'Miód kremowany',inne:'Produkt pszczeli'};
const format=new Intl.NumberFormat('pl-PL',{style:'currency',currency:'PLN'});
function el(tag,className,text){const node=document.createElement(tag);if(className)node.className=className;if(text!==undefined)node.textContent=text;return node}
products.forEach((product,index)=>{
const card=el('article','sample-card');card.dataset.category=product.category;card.dataset.productId=product.id;card.dataset.selected=String(selected.has(product.id));
const media=el('div','product-media');const photo=photos[product.id];
if(photo&&photo.src){const image=el('img');image.src=photo.src;image.alt=photo.alt||product.name;image.loading='lazy';image.width=800;image.height=1000;media.append(image)}else{const placeholder=el('div','media-placeholder');placeholder.setAttribute('aria-hidden','true');placeholder.append(el('span','media-index',String(index+1).padStart(2,'0')),el('small','','Zdjęcie produktu'));media.append(placeholder)}
const title=el('h3','',product.name);title.id='product-title-'+product.id;card.setAttribute('aria-labelledby',title.id);
const group=el('fieldset','variant-group');group.append(el('legend','','Gramatura'));
const controls=el('div','variant-buttons');const price=el('span','product-price',format.format(product.variants[0][1]));const weight=el('span','price-weight','/ '+product.variants[0][0]);
const priceRow=el('div','price-row');priceRow.setAttribute('aria-live','polite');priceRow.setAttribute('aria-atomic','true');priceRow.append(price,weight);
if(product.variants.length===1){controls.append(el('span','single-weight',product.variants[0][0]))}else{product.variants.forEach(([size,amount],i)=>{const button=el('button','weight-option',size);button.type='button';button.setAttribute('aria-label',size+' — '+product.name);button.setAttribute('aria-pressed',String(i===0));button.addEventListener('click',()=>{controls.querySelectorAll('button').forEach(option=>option.setAttribute('aria-pressed',String(option===button)));price.textContent=format.format(amount);weight.textContent='/ '+size});controls.append(button)})}
group.append(controls);card.append(media,el('span','product-tag',labels[product.category]),title,group,priceRow);grid.append(card);
});
const buttons=Array.from(document.querySelectorAll('[data-filter]'));let current='selected';
function filter(category){current=category;let count=0;grid.querySelectorAll('.sample-card').forEach(card=>{const visible=category==='all'||(category==='selected'?card.dataset.selected==='true':card.dataset.category===category);card.hidden=!visible;if(visible)count++});buttons.forEach(button=>button.setAttribute('aria-pressed',String(button.dataset.filter===category)));status.textContent='Pokazujemy '+count+' z '+products.length+' pozycji · ceny według cennika 2026';expand.textContent=category==='all'?'Wróć do wybranych (6)':'Zobacz całą ofertę (21)';expand.hidden=false}
buttons.forEach(button=>button.addEventListener('click',()=>filter(button.dataset.filter)));
document.querySelectorAll('[data-category-link]').forEach(link=>link.addEventListener('click',()=>filter(link.dataset.categoryLink)));
expand.addEventListener('click',()=>filter(current==='all'?'selected':'all'));
filter('selected');
})();
