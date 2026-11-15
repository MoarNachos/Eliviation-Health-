"""Export the homepage and Relief only; preserve other design-review pages."""
from pathlib import Path
import json,re,subprocess
from concurrent.futures import ThreadPoolExecutor
ROOT=Path(__file__).resolve().parents[2]
SOURCE='http://127.0.0.1:9481'
OUT=ROOT.parent/'staging-build/video-section-update/design-review'
PAGES=['','treatments/relief/']
def fetch(path):return subprocess.check_output(['curl','-fsSL','--retry','2','--max-time','45',SOURCE+'/'+path])
def page(path):
 s=fetch(path).decode()
 assert '<h1' in s and 'Fatal error' not in s,path
 s=s.replace(SOURCE+'/', 'https://www.elivationhealth.com/design-review/')
 s=re.sub(r'<link\b[^>]*(?:api\.w\.org|oembed|wp-json)[^>]*>', '', s)
 s=re.sub(r'<meta\b[^>]*name=[\"\']robots[\"\'][^>]*>', '', s, flags=re.I)
 s=s.replace('</head>','<meta name="robots" content="noindex,nofollow,noarchive"></head>')
 s=re.sub(r'(<body\b[^>]*>)',r'\1<aside style="padding:10px 20px;background:#0F2846;color:white;text-align:center;font:14px sans-serif">Design review preview · Medical review pending · Booking continues on the live booking site.</aside>',s,count=1)
 # Keep the established direct-booking behavior on treatment previews. Ingredient drawer is separate.
 s=s.replace('</body>',"<script>document.addEventListener('click',function(e){var a=e.target.closest('[data-eh-book],.eh-nav__book');if(!a)return;e.preventDefault();e.stopImmediatePropagation();window.location.assign(a.href||'https://book.elivationhealth.com/');},true);</script></body>")
 target=OUT/path/'index.html';target.parent.mkdir(parents=True,exist_ok=True);target.write_text(s)
 return path
with ThreadPoolExecutor(max_workers=4) as pool:print('Exported',len(list(pool.map(page,PAGES))),'pages')
for asset in ['css/visit-video.css','js/visit-video.js']:
 p=OUT/'wp-content/themes/elivation/assets'/asset;p.parent.mkdir(parents=True,exist_ok=True);p.write_bytes((ROOT/'elivation/assets'/asset).read_bytes())
import shutil
shutil.copytree(ROOT/'elivation/assets/video',OUT/'wp-content/themes/elivation/assets/video',dirs_exist_ok=True)
print(OUT)
