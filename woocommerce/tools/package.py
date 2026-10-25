from pathlib import Path
from zipfile import ZipFile, ZIP_DEFLATED
root = Path(__file__).resolve().parents[1]
dist = root / 'dist'
dist.mkdir(exist_ok=True)
for folder, name in [('theme', 'pasieka-pod-debem'), ('plugin', 'pasieka-start')]:
    source = root / folder / name
    target = dist / (name + '.zip')
    with ZipFile(target, 'w', ZIP_DEFLATED) as archive:
        for path in sorted(source.rglob('*')):
            if path.is_file():
                archive.write(path, path.relative_to(source.parent))
    with ZipFile(target) as archive:
        assert archive.testzip() is None
    print(str(target.relative_to(root)), target.stat().st_size, 'bytes')
