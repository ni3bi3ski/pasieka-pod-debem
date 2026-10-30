from pathlib import Path

root = Path(__file__).resolve().parents[1]
page = root / 'woocommerce/preview/index.html'
old = 'https://ni3bi3ski.github.io/pasieka-pod-debem/'
new = 'https://pasiekakiczyce.pl/'
text = page.read_text(encoding='utf-8')
updated = text.replace(old, new)
if updated != text:
    page.write_text(updated, encoding='utf-8')
    print('Updated preview URLs to pasiekakiczyce.pl')
else:
    print('Preview URLs already up to date')
