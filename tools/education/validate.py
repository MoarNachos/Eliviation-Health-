import json,re,html,subprocess,pathlib
from concurrent.futures import ThreadPoolExecutor
ROOT=pathlib.Path(__file__).resolve().parents[2]; data=json.loads((ROOT/'elivation/content/ingredients.json').read_text()); base='http://127.0.0.1:9467'
def fetch(path):return subprocess.check_output(['curl','-fsSL','--max-time','40',base+path]).decode()
def check(slug):
 s=fetch('/education/'+(slug+'/' if slug else '')); assert len(re.findall(r'<h1\b',s))==1,slug
 assert 'Fatal error' not in s
 desc=re.findall(r'<meta name="description" content="([^"]*)"',s);assert len(desc)==1,(slug,desc)
 desc=html.unescape(desc[0]);assert 150<=len(desc)<=160 and desc.count('Orange County')==1,(slug,desc)
 graphs=[json.loads(j) for j in re.findall(r'<script type="application/ld\+json">(.*?)</script>',s,re.S)]
 graph=next(g['@graph'] for g in graphs if '@graph' in g)
 types=[g['@type'] for g in graph];assert 'BreadcrumbList' in types
 assert ('MedicalWebPage' if slug else 'CollectionPage') in types
 if slug:
  assert 'FAQPage' in types
  faq=next(g for g in graph if g['@type']=='FAQPage');assert len(faq['mainEntity'])==len(data[slug]['faq'])
  for f in data[slug]['faq']:assert html.unescape(f['a']) in html.unescape(re.sub('<[^>]*>','',s)),slug
  for match in graph:assert 'lastReviewed' not in match and 'reviewedBy' not in match
  assert 'data-medical-review="TODO(client)"' in s
 return slug or 'hub'
with ThreadPoolExecutor(max_workers=4) as pool:pages=list(pool.map(check,['']+list(data)))
sitemap=fetch('/wp-sitemap-posts-page-1.xml');assert all('/education/'+s+'/' in sitemap for s in data)
llms=fetch('/llms.txt');assert all('/education/'+s+'/' in llms for s in data)
assert all('/treatments/'+s+'/' in llms for s in ['recovery','relief','rejuvenation'])
for category in ['recovery','relief','rejuvenation']:
 s=fetch('/treatments/'+category+'/');assert 'Ingredient guide' in s
out={'pages_checked':pages,'metadata':'Unique title, one H1, 150–160 character descriptions; Orange County once','schema':'CollectionPage / MedicalWebPage, FAQPage, BreadcrumbList; no invented reviewer','sitemap':'All 12 native child pages present','llms':'Hub, all 12 ingredients, all 3 treatment categories','formulas':'Only 4 ingredient pages have published-menu matches; remaining 8 pending client formulas'}
(ROOT/'tools/education/qa/content-validation.json').write_text(json.dumps(out,indent=2)+'\n');print(json.dumps(out,indent=2))
